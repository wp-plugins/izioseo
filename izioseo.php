<?php

/*
Plugin Name: izioSEO
Plugin URI: http://www.goizio.com/izioseo/
Description: Ein umfangreiches Plugin zur Suchmaschinenoptimierung f&uuml;r Wordpress. Einfache "on-the-fly" SEO-L&ouml;sung mit vielen m&ouml;glichen <a href="/wp-admin/admin.php?page=options">Einstellungen</a>.
Version: 1.2.1
Author: Mathias 'United20' Schmidt
Author URI: http://www.goizio.com/
*/

/*
 * Initialisieren der Klasse
 */
$izioseo = new izioSEO();
register_activation_hook(__FILE__, array($izioseo, 'activate')); // Aktivierung des Plugins

/**
 * Hooks & Filter
 */
add_action('init', array($izioseo, 'language'));
if (preg_match('!wp\-admin!', $_SERVER['PHP_SELF'])) // nur Adminbereich
{
	if (isset($_GET['export']) && isset($_GET['page']) && $_GET['page'] == 'reset')
	{
		add_action('init', array($izioseo, 'exportOptions'), 1);
	}
	if (isset($_GET['export']) && $_GET['export'] == 'keywords-csv' && isset($_GET['page']) && $_GET['page'] == 'statistic')
	{
		add_action('init', array($izioseo, 'exportKeywords'), 1);
	}
	if (isset($_GET['export']) && $_GET['export'] == 'request-csv' && isset($_GET['page']) && $_GET['page'] == 'statistic')
	{
		add_action('init', array($izioseo, 'exportRequests'), 1);
	}
	if (isset($_GET['export']) && $_GET['export'] == 'referer-csv' && isset($_GET['page']) && $_GET['page'] == 'statistic')
	{
		add_action('init', array($izioseo, 'exportReferers'), 1);
	}
	if (isset($_GET['export']) && $_GET['export'] == 'links-csv' && isset($_GET['page']) && $_GET['page'] == 'statistic')
	{
		add_action('init', array($izioseo, 'exportLinks'), 1);
	}
	if (isset($_GET['flash']) && isset($_GET['page']) && $_GET['page'] == 'statistic')
	{
		add_action('init', array($izioseo, 'flashData'), 1);
	}

	add_action('admin_menu', array($izioseo, 'admin')); // Adminmenu
	if ((float)substr($izioseo->wpv, 0, 3) >= 2.7) // Hilfe
	{
		add_filter('contextual_help', array($izioseo, 'showHelp'));
	}

	// Einstellungspannel fuer Artikel und Seiten und die damit verbundene Speicherfunktion
	add_action('save_post', array($izioseo, 'savePostMeta'));
	add_action('edit_form_advanced', array($izioseo, 'addPostMeta'));
	add_action('edit_page_form', array($izioseo, 'addPostMeta'));

	// Umlaute korrekt aus URL entfernen
	remove_filter('sanitize_title', 'sanitize_title_with_dashes');
	add_filter('sanitize_title', array($izioseo, 'convertTitleToUrlName'));
}
else
{
	if (get_option('izioseo_redirect_permalink') == 'on')
	{
		add_action('template_redirect', array($izioseo, 'redirectPermalink'), 1);
	}

	add_action('template_redirect', array($izioseo, 'title'), 0);
	add_action('wp_head', array($izioseo, 'meta'), 0);
	add_filter('the_content', array($izioseo, 'setAdSection'), 1000000);
	add_filter('the_content', array($izioseo, 'seoImages'), 1000000);

	// RSS Feeds nicht indizieren
	add_action('atom_head', array($izioseo, 'noindexRSSFeed'));
	add_action('rss_head', array($izioseo, 'noindexRSSFeed'));
	add_action('rss2_head', array($izioseo, 'noindexRSSFeed'));

	// rel="nofollow" fuer Blogelemente
	if (get_option('izioseo_nofollow_categories') == 'on')
	{
		add_filter('wp_list_categories', array($izioseo, 'setNofollow'), 1000000);
		add_filter('the_category', array($izioseo, 'setNofollow'), 1000000);
	}
	if (get_option('izioseo_nofollow_bookmarks') == 'on')
	{
		add_filter('wp_list_bookmarks', array($izioseo, 'setNofollow'), 1000000);
	}
	if (get_option('izioseo_nofollow_tags') == 'on')
	{
		add_filter('wp_generate_tag_cloud', array($izioseo, 'setNofollow'), 1000000);
	}

	// Anonymisierung von Links
	if (isset($_GET['goto']) && preg_match('/^[a-zA-Z0-9]{32}$/', $_GET['goto']))
	{
		add_action('init', array($izioseo, 'redirectLink'), 1);
	}
	add_filter('the_content', array($izioseo, 'anonymContentLinks'), 1000000);
	add_filter('comment_author_link', array($izioseo, 'anonymCommentLinks'), 1000000);
	add_filter('comment_text', array($izioseo, 'anonymCommentLinks'), 1000000);
	add_filter('wp_list_bookmarks', array($izioseo, 'anonymBookmarkLinks'), 1000000);
}

/**
 * izioSEO Klasse
 *
 * @author Mathias Schmidt
 */
class izioSEO
{

	/**
	 * Worpress Version
	 *
	 * @var string
	 */
	var $wpv = null;

	/**
	 * aktuelle Version
	 *
	 * @var string
	 */
	var $version = '1.2.1';

	/**
	 * Website von izioSEO
	 *
	 * @var string
	 */
	var $website = 'http://www.goizio.com/';

	/**
	 * Newsfeed fuer das Dashboard
	 *
	 * @var string
	 */
	var $rss = 'http://www.goizio.com/feed/';

	/**
	 * Standardeinstellungen
	 * 
	 * @var array
	 */
	var $settings = array(
		'izioseo_rewrite_titles' => 'on',
		'izioseo_title' => '',
		'izioseo_keywords' => '',
		'izioseo_description' => '',
		'izioseo_analytics_type' => 'urchin',
		'izioseo_analytics_tracking_id' => '',
		'izioseo_wptools' => '',
		'izioseo_google_adsection' => 'on',
		'izioseo_noindex_rssfeed' => 'on',
		'izioseo_collect_keywords' => 'off',
		'izioseo_lenght_description_min' => 100,
		'izioseo_lenght_description' => 170,
		'izioseo_lenght_keywords' => 6,
		'izioseo_use_default' => 'generate',
		'izioseo_use_tags' => 'off',
		'izioseo_use_categories' => 'off',
		'izioseo_use_referers' => 'off',
		'izioseo_format_title_post' => '%post_title% - %blog_title%',
		'izioseo_format_title_page' => '%page_title% - %blog_title%',
		'izioseo_format_title_search' => 'Suchergebnisse zu %search% - %blog_title%',
		'izioseo_format_title_category' => '%category_title% - %blog_title%',
		'izioseo_format_title_paged' => ' - Seite %page%',
		'izioseo_format_title_tag' => '%tag% - %blog_title%',
		'izioseo_format_title_archive' => '%date% - %blog_title%',
		'izioseo_format_title_404' => 'Seite %request_words% wurde nicht gefunden - %blog_title%',
		'izioseo_format_description' => '%description%',
		'izioseo_robots_home' => 'index,follow',
		'izioseo_robots_post' => 'index,follow',
		'izioseo_robots_page' => 'index,follow',
		'izioseo_robots_search' => 'noindex,follow,noarchive',
		'izioseo_robots_category' => 'noindex,follow,noarchive',
		'izioseo_robots_archive' => 'noindex,follow,noarchive',
		'izioseo_robots_tag' => 'noindex,follow,noarchive',
		'izioseo_robots_404' => 'noindex,follow,noarchive',
		'izioseo_robots_noodp' => 'off',
		'izioseo_nofollow_categories' => 'off',
		'izioseo_nofollow_bookmarks' => 'off',
		'izioseo_nofollow_tags' => 'off',
		'izioseo_redirect_permalink' => 'on',
		'izioseo_image_use' => 'on',
		'izioseo_image_alt' => '%image_title% in %post_title%',
		'izioseo_anonym_content_link' => 'off',
		'izioseo_anonym_comment_link' => 'off',
		'izioseo_anonym_bookmark_link' => 'off',
		'__izioseo_reset_export' => 0
	);

	/**
	 * aktuelle Url
	 * 
	 * @var string
	 */
	var $url = null;

	/**
	 * aktueller externer Referer
	 * 
	 * @var string
	 */
	var $referer = null;
	
	/**
	 * Bilder-/Icon-Pfad
	 * 
	 * @var string
	 */
	var $images = null;

	/**
	 * aktuelles Template fuer den Adminbereich
	 * 
	 * @var string
	 */
	var $template = null;

	/**
	 * das Datenbankobjekt von Wordpress
	 */
	var $db = null;

	/**
	 * Akronyme
	 *
	 * @var array
	 */
	var $acronyms = array();

	/**
	 * Stopwords
	 *
	 * @var array
	 */
	var $stopwords = array();

	/**
	 * die gesammelten Keywords
	 *
	 * @var array
	 */
	var $keywords = array();

	/**
	 * der aktuelle Post
	 * 
	 * @var object
	 */
	var $post = null;

	/**
	 * der aktuelle Autor des Posts
	 * 
	 * @var object
	 */
	var $author = null;

	/**
	 * Suchmaschinen
	 *
	 * @var array
	 */
	var $searchengines = array(
		array('google', 'q', 'Google', '#d01f3c'),
		array('alltheweb', 'query', 'All The Web', '#34558a'),
		array('altavista', 'q', 'AltaVista', '#990000'),
		array('aol', 'query', 'AOL', '#facb0f'),
		array('excite', 'search', 'Excite', '#221e1f'),
		array('hotbot', 'query', 'Hotbot', '#99ff32'),
		array('lycos', 'query', 'Lycos', '#cccccc'),
		array('yahoo', 'p', 'Yahoo!', '#ff0033'),
		array('t-online', 'q', 'T-Online', '#e20074'),
		array('msn', 'q', 'MSN', '#38b859'),
		array('netscape', 'search', 'Netscape', '#18929C'),
		array('cuil', 'q', 'Cuil', '#115bf8'),
		array('ask', 'q', 'Ask', '#cc0000'),
		array('live', 'q', 'Live', '#549c00')
	);

	/**
	 * Konstruktor der Klasse
	 */
	function izioSEO()
	{
		$this->getWpVersion();
		$this->getCurUrl();
		$this->getReferer();
		$this->getImageDir();
		$this->initDB();
		
		// Referer und Suchanfragen speichern
		if (! empty($this->referer))
		{
			$search = $this->analyseReferer($this->referer);
			if (! empty($search))
			{
				$this->saveSearch($search);
			}
			else
			{
				$this->saveReferer();
			}
		}
	}

	/**
	 * Wordpressversion holen
	 */
	function getWpVersion()
	{
		global $wp_version;
		$this->wpv = $wp_version;
	}

	/**
	 * holt die aktuelle Url der Seite
	 */
	function getCurUrl()
	{
		$this->url = mysql_escape_string($_SERVER['REQUEST_URI']);
	}

	/**
	 * holen des externen Referers
	 */
	function getReferer()
	{
		if (isset($_SERVER['HTTP_REFERER']) && $this->getDomain($_SERVER['HTTP_REFERER']) != $this->getDomain(get_option('siteurl')) && !preg_match('!wp\-admin!', $_SERVER['HTTP_REFERER']))
		{
			$this->referer = $_SERVER['HTTP_REFERER'];
		}
	}

	/**
	 * Holt wichtige Keywords aus dem Referer und wichtet bestehende Keywords staerker als alle anderen
	 *
	 * @param array $keywords
	 * @return array
	 */
	function getRefererKeywords($keywords)
	{
		$referers = $this->db->fetchResults('SELECT referer_keyword, COUNT(referer_keyword) AS referer_keyword_count FROM #izioseo_referers_keywords AS rk INNER JOIN #izioseo_referers AS r ON r.referer_id=rk.referer_id WHERE r.post_url="' . $this->url . '" GROUP BY rk.referer_keyword');
		$weighting = ($sum = array_sum($keywords)) ? 1 / $sum : 0;
		foreach ($referers as $referer)
		{
			if (isset($keywords[$referer->referer_keyword]))
			{
				$keywords[$referer->referer_keyword] += ($referer->referer_keyword_count * $weighting);
			}
			else
			{
				$keywords[$referer->referer_keyword] = ($referer->referer_keyword_count * $weighting);
			}
		}
		return $keywords;
	}

	/**
	 * Speichert den aktuellen Referer, auch wenn er keine Suchmaschine ist
	 *
	 * @return integer
	 */
	function saveReferer()
	{
		$post = $this->getCurPost();
		$insert = array(
			'post_id' => (isset($post->ID) ? $post->ID : 0),
			'post_url' => $this->url,
			'referer_searchengine' => '',
			'referer_request' => '',
			'referer_url' => $this->referer,
			'referer_date' => time()
		);
		return $this->db->insert('#izioseo_referers', $insert, array('ignore' => true));
	}

	/**
	 * speichert den Suchstring in der Datenbank und extrahiert daraus alle Relevanten Keywords
	 *
	 * @param array $search
	 */
	function saveSearch($search)
	{
		$search['request'] = utf8_encode($search['request']);
		$keywords = $this->extractKeywords($search['request']);
		if (is_array($keywords) && count($keywords))
		{
			$post = $this->getCurPost();
			$insert = array(
				'post_id' => (isset($post->ID) ? $post->ID : 0),
				'post_url' => $this->url,
				'referer_searchengine' => $search['searchengine'],
				'referer_request' => $search['request'],
				'referer_url' => $this->referer,
				'referer_date' => time()
			);
			$id = $this->db->insert('#izioseo_referers', $insert, array('ignore' => true));
			if ($id)
			{
				foreach ($keywords as $keyword)
				{
					$insert = array(
						'referer_id' => $id,
						'referer_keyword' => utf8_encode($keyword)
					);
					$this->db->insert('#izioseo_referers_keywords', $insert, array('ignore' => true));
				}
			}
		}
	}

	/**
	 * analysiert den Referer einer Suchmaschine und gibt den Suchstring zurueck
	 *
	 * @param string $referer
	 * @return array
	 */
	function analyseReferer($referer)
	{
		$domain = explode('/', $referer);
		for($n = 0; $n < count($this->searchengines); $n++)
		{
		    if (eregi($this->searchengines[$n][0], $referer))
		    {
				$parse = parse_url($referer);
				parse_str($parse['query'], $output);
				return array(
					'searchengine' => $this->searchengines[$n][0],
					'request' => $output[$this->searchengines[$n][1]]
				);
		    }
		}
		return null;
	}

	/**
	 * Umschreiben der Request URI in Worte
	 *
	 * @param string $request
	 * @return string
	 */
	function getRequest($request)
	{
		$words = array();
		$request = str_replace('.html', ' ', $request);
		$request = str_replace('.htm', ' ', $request);
		$request = str_replace('.php', ' ', $request);
		$request = preg_replace('/[^0-9a-zA-Z \-]/', ' ', $request);
		$request = preg_replace('/\s\s+/', ' ', $request);
		$request = explode(' ', trim($request));
		foreach ($request as $token)
		{
			$words[] = ucwords(trim($token));
		}
		return implode(' ', $words);
	}

	/**
	 * holt die Domain aus einer URL
	 *
	 * @param string $url
	 * @return string
	 */
	function getDomain($url)
	{
		$matches = parse_url($url);
		return isset($matches['host']) ? $matches['host'] : false;
	}

	/**
	 * holt den aktuellen Pfad zu den Bildern und Icons fuer izioSEO
	 */
	function getImageDir()
	{
		$this->images = WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/images/';
	}

	/**
	 * holt den Pfad des jeweiligen Templates
	 */
	function getTemplate()
	{
		if ((float)substr($this->wpv, 0, 3) >= 2.7)
		{
			$this->template = '2.7';
		}
		else
		{
			wp_admin_css('dashboard');
			$this->template = '2.6';
		}
		$this->template = '/' . trim(dirname(__FILE__), '/') . '/templates/' . $this->template . '/';
	}

	/**
	 * den aktuellen Post und seine Daten holen
	 *
	 * @param boolean $reload
	 * @return array
	 */
	function getCurPost($reload = false)
	{
		global $wp_query;
		if (! empty($wp_query) && (empty($this->post) || $reload))
		{
			$this->post = $wp_query->get_queried_object();
			if (empty($this->post))
			{
				global $post;
				$this->post = $post;
			}
		}
		return $this->post;
	}

	/**
	 * hole den Autor des aktuellen Beitrags
	 *
	 * @param boolean $reload
	 * @return array
	 */
	function getAuthor($reload = false)
	{
		$post = $this->getCurPost();
		if (isset($post->post_author) && (empty($this->author) || $reload))
		{
			$this->author = get_userdata($post->post_author);
		}
		return $this->author;
	}

	/**
	 * die Kategorien zu dem aktuellen Post holen
	 *
	 * @param boolean $reload
	 * @return array
	 */
	function getCategory($reload = false)
	{
		if (empty($this->categories) || $reload)
		{
			$this->categories = get_the_category();
		}
		return $this->categories;
	}

	/**
	 * initialisieren des Datenbankobjektes von Wordpress
	 */
	function initDB()
	{
		require_once(dirname(__FILE__) . '/classes/DB.class.php');
		$this->db = new DB();
	}

	/**
	 * aendert einen String in einen URL-Namen
	 *
	 * @param string $input
	 * @param boolean $noHtmlEncode
	 * @return string
	 */
	function convertToUrlName($input, $noHtmlEncode = false)
	{
		if ($noHtmlEncode)
		{
			$output = utf8_encode(strtolower(utf8_decode($input)));
		}
		else
		{
			$output = strtolower(html_entity_decode($input));
		}
		$transTable = array(
			'ä' => 'ae',
			'ö' => 'oe',
			'ü' => 'ue',
			'Ä' => 'Ae',
			'Ö' => 'Oe',
			'Ü' => 'Ue',
			'ß' => 'ss'
		);
		$output = strtr($output, $transTable);
		$output = preg_replace('/[^A-Za-z0-9-\.]/', '-', $output);
		$output = preg_replace('/-+/', '-', $output);
		$output = trim($output, '-');
		return $output;
	}

	/**
	 * kuerzen eines Textes
	 *
	 * @param string $str
	 * @param integer $length
	 * @param string $type hard / soft
	 * @return string
	 */
	function truncate($str, $length = 256, $type = 'soft')
	{
		if ($type[0] == 'h')
		{
			return substr($str, 0, $length) . ($length < strlen($str) ? '...' : '');
		}
		elseif ($type[0] == 's')
		{
			$res = '';
			$words = explode(' ', $str);
			foreach ($words as $word)
			{
				if (strlen($res . ' ' . $word) > $length)
				{
					return $res . ($length < strlen($str) ? '...' : '');
				}
				$res .= ' ' . $word;
			}
			return $res;
		}
		return $str;
	}

	/**
	 * gibt den RegEx fuer eine Url zurueck
	 *
	 * @return string
	 */
	function TmplUrl()
	{
		$tlds = 'aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel';
		return '/^((https?|news):\/\/)?([a-zA-Z]([a-zA-Z0-9\-]*\.)+([a-z]{2}|' . $tlds . ')|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-zA-Z0-9_\-\.~]+)*(\/([a-zA-Z0-9_\-\.]*)(\?[a-zA-Z0-9+_\-\.%=&amp;]*)?)?(#[a-zA-Z][a-zA-Z0-9_]*)?$/';
	}

	/**
	 * entfernt aus einem Text die Stopwords
	 *
	 * @param string $string
	 * @return string
	 */
	function stripStopwords($string)
	{
		$this->loadStopwords();
		$string = utf8_encode(strtolower(utf8_decode($string)));
		$string = preg_replace('/([\w\x88-\xFF]+)/', ' $1 ', $string);
		if (count($this->stopwords))
		{
			for($i = 0; $i < count($this->stopwords); $i++)
			{
				if ($val = trim($this->stopwords[$i]))
				{
					$pat[' ' . $val . ' '] = '';
				}
			}
			$string = strtr($string, $pat);
			$string = preg_replace('/ ([\w\x88-\xFF]+) /', '$1', $string);
			$string = preg_replace('/\s\s+/', ' ', $string);
		}
		return $string;
	}

	/**
	 * Entfernt einfach HTML aus einem String
	 *
	 * @param string $text
	 * @return string
	 */
	function stripHTML($text)
	{
		$text = strip_tags($text);
		$text = str_replace('&nbsp;', ' ', $text);
		$text = str_replace("\r\n", ' ', $text);
		$text = str_replace("\n", ' ', $text);
		$text = preg_replace('/[^0-9a-zA-Z-&.,;:\(\)#!?\/\' \x80-\xFF]/', ' ', $text);
		$text = preg_replace('/\s\s+/', ' ', $text);
		$text = str_replace(' . ', '. ', $text);
		return trim($text);
	}

	/**
	 * wandele jeden ersten Buchstaben eines Wortes in einen Grossbuchstaben um
	 *
	 * @param string $string
	 * @return string
	 */
	function capitalize($string)
	{
		$tokens = explode(' ', trim($string));
		while (list($key, $val) = each($tokens))
		{
			$tokens[$key] = trim($tokens[$key]);
			$tokens[$key] = strtoupper(substr($tokens[$key], 0, 1)) . substr($tokens[$key], 1);
		}
		return implode(' ', $tokens);
	}

	/**
	 * Aktivieren von izioSEO und die damit verbundenen Einstellungen zur Datenbank hinzufuegen
	 */
	function activate()
	{
		// Optionen speichern
		foreach ($this->settings as $key => $value)
		{
			add_option($key, $value);
		}

		// Tabellen erstellen
		if (! is_int($this->db->query('SELECT * FROM #izioseo_referers')))
		{
			$this->db->query('
				CREATE TABLE IF NOT EXISTS #izioseo_referers (
					referer_id int(10) unsigned NOT NULL auto_increment,
					post_id int(10) unsigned NOT NULL default "0",
					post_url varchar(255) NOT NULL,
					referer_searchengine varchar(50) NOT NULL,
					referer_url varchar(255) NOT NULL,
					referer_request varchar(255) NOT NULL,
					referer_date int(10) unsigned NOT NULL default "0",
					PRIMARY KEY  (referer_id),
					KEY izioseo_unique_referer (post_id,referer_url)
				) ENGINE=MyISAM DEFAULT CHARSET=' . DB_CHARSET . ' AUTO_INCREMENT=1 ;
			');
		}
		if (! is_int($this->db->query('SELECT * FROM #izioseo_referers_keywords')))
		{
			$this->db->query('
				CREATE TABLE IF NOT EXISTS #izioseo_referers_keywords (
					referer_id int(10) unsigned NOT NULL default "0",
					referer_keyword varchar(255) NOT NULL,
					UNIQUE KEY izioseo_unique_keyword (referer_id,referer_keyword)
				) ENGINE=MyISAM DEFAULT CHARSET=' . DB_CHARSET . ';
			');
		}
		if (! is_int($this->db->query('SELECT * FROM #izioseo_anonym_links')))
		{
			$this->db->query('
				CREATE TABLE IF NOT EXISTS #izioseo_anonym_links (
					link_id int(10) unsigned NOT NULL auto_increment,
					link_url varchar(255) NOT NULL,
					link_hash varchar(32) NOT NULL,
					link_hits int(10) unsigned NOT NULL default "0",
					PRIMARY KEY  (link_id),
					UNIQUE KEY izioseo_hash (link_hash)
				) ENGINE=MyISAM DEFAULT CHARSET=' . DB_CHARSET . ';
			');
		}
	}

	/**
	 * gibt den Titel als saubere URL zurueck
	 *
	 * @param string $title
	 * @return string
	 */
	function convertTitleToUrlName($title)
	{
		$title = $this->convertToUrlName($title, true);
	    return sanitize_title_with_dashes($title);
	}

	/**
	 * verknuepft die Einstellungsseite von izioSEO mit dem Menu von Wordpress
	 */
	function admin()
	{
		$this->getTemplate();

		add_menu_page(__('izioSEO Wordpress SEO Plugin', 'izioseo'), __('izioSEO', 'izioseo'), 100, __FILE__, array($this, 'overviewMenu'), $this->images . 'izioseo.png');
		add_submenu_page(__FILE__, __('&Uuml;bersicht', 'izioseo'), __('&Uuml;bersicht', 'izioseo'), 10, 'overview', array($this, 'overviewMenu'));
		add_submenu_page(__FILE__, __('Einstellungen', 'izioseo'), __('Einstellungen', 'izioseo'), 10, 'options', array($this, 'optionsMenu'));
		add_submenu_page(__FILE__, __('Keywords', 'izioseo'), __('Keywords', 'izioseo'), 10, 'keywords', array($this, 'keywordsMenu'));
		add_submenu_page(__FILE__, __('Statistik', 'izioseo'), __('Statistik', 'izioseo'), 10, 'statistic', array($this, 'statisticMenu'));
		add_submenu_page(__FILE__, __('robots.txt', 'izioseo'), __('robots.txt', 'izioseo'), 10, 'robots', array($this, 'robotsMenu'));
		add_submenu_page(__FILE__, __('Zur&uuml;cksetzen', 'izioseo'), __('Zur&uuml;cksetzen', 'izioseo'), 10, 'reset', array($this, 'resetMenu'));
	}

	/**
	 * Initialisiert die Multisprachfaehigkeit (falls vorhanden)
	 */
	function language()
	{
		load_plugin_textdomain('izioSeo', PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/language/');
	}

	/**
	 * Hilfe fuer den Adminbereich von izioSEO
	 *
	 * @param string $content
	 * @return string
	 */
	function showHelp($content)
	{
		return $content . '
	<h5>' . __('Hilfe f&uuml;r das Wordpress SEO Plugin izioSEO ', 'izioseo') . '</h5>
	<div class="metabox-prefs">' . str_replace('%dir%', $this->images, __('Alle Einstellungsm&ouml;glichkeiten besitzen einen Hilfelink. Mit einem Klick auf das Symbol <img src="%dir%help.png" alt="Hilfe" height="12" width="12" /> gelangen Sie zur Dokumentation und Beschreibung f&uuml;r die jeweilige Einstellungsm&ouml;glickeit.', 'izioseo')) . '</div>
	<h5>' . __('Weitere Informationen', 'izioseo') . '</h5>
	<div class="metabox-prefs">
		<a href="' . trim($this->website, '/') . '/">' . __('Plugin Homepage', 'izioseo') . '</a> |
		<a href="' . trim($this->website, '/') . '/dokumentation/">Dokumentation</a> |
		<a href="' . trim($this->website, '/') . '/downloads/">' . __('Aktuelle Version downloaden', 'izioseo') . '</a> |
		<a href="http://wordpress.org/extend/plugins/izioseo/">' . __('Wordpress Plugin Datenbank', 'izioseo') . '</a> |
		<a href="https://svn.wp-plugins.org/izioseo/">' . __('SVN Repository', 'izioseo') . '</a>
	</div>';
	}

	/**
	 * erstellt einen Hilfe-Button mit Verlinkung zu der entsprechenden Funktionen
	 *
	 * @param string $name
	 * @return string
	 */
	function helpButton($name)
	{
		$url = trim($this->website, '/') . '/dokumentation/' . $this->convertToUrlName($name) . '/';
		return '<a href="' . $url . '"><img src="' . $this->images . 'help.png" alt="' . $name . '" height="12" width="12" /></a>';
	}

	/**
	 * Uebersicht ueber den Umfang und die Funktionen von izioSEO (Dashboard)
	 */
	function overviewMenu()
	{
		// RSS News holen
		require_once(ABSPATH . WPINC . '/rss.php');
		$rss = fetch_rss($this->rss);

		// Pagerank
		require_once(dirname(__FILE__) . '/classes/PageRank.class.php');
		$pr = new GooglePR;

		require_once($this->template . 'overview.tpl.php');
	}

	/**
	 * liest den AlexaRank ueber die API von alexa.com aus
	 *
	 * @return string
	 */
	function alexaRank()
	{
		$xml = @simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url=' . get_option('siteurl'));
		if (isset($xml->SD->POPULARITY['TEXT']))
		{
			return number_format($xml->SD->POPULARITY['TEXT'], 0, ',', '.');
		}
		return 'n/a';
	}

	/**
	 * Einstellungsseite fuer das gesamte SEO Plugin
	 */
	function optionsMenu()
	{
		if (isset($_POST['izioseo']))
		{
			$message = $this->saveOptions($_POST['izioseo']);
		}
		$data = $this->loadOptions();
		$robots = array(
			'index,follow',
			'noindex,follow',
			'index,nofollow',
			'noindex,nofollow',
			'index,follow,noarchive',
			'index,nofollow,noarchive',
			'noindex,follow,noarchive',
			'noindex,nofollow,noarchive'
		);
		$anonym = array(
			'no' => __('Deaktiviert', 'izioseo'),
			'standard' => __('Standard (mit Linktracking)', 'izioseo'),
			'anonym.to' => __('anonym.to (kein Linktracking)', 'izioseo'),
		);
		require_once($this->template . 'options.tpl.php');
	}

	/**
	 * laedt die Optionen fuer Einstellungsseite
	 * 
	 * @return array
	 */
	function loadOptions()
	{
		$data = array();
		foreach ($this->settings as $key => $value)
		{
			$data[$key] = htmlspecialchars(stripcslashes(get_option($key)));
		}
		return $this->aiospGlobals($data);
	}

	/**
	 * speichern der globalen Optionen von izioSEO
	 *
	 * @params array $data
	 * @return boolean
	 */
	function saveOptions($data)
	{
		if (! empty($data) && is_array($data) && count($data))
		{
			$data['izioseo_analytics_tracking_id'] = preg_match('/UA-(.*)-(.*)/', $data['izioseo_analytics_tracking_id']) ? $data['izioseo_analytics_tracking_id'] : '';
			$data['izioseo_rewrite_titles'] = isset($data['izioseo_rewrite_titles']) && $data['izioseo_rewrite_titles'] == 'on' ? 'on' : 'off';
			$data['izioseo_google_adsection'] = isset($data['izioseo_google_adsection']) && $data['izioseo_google_adsection'] == 'on' ? 'on' : 'off';
			$data['izioseo_noindex_rssfeed'] = isset($data['izioseo_noindex_rssfeed']) && $data['izioseo_noindex_rssfeed'] == 'on' ? 'on' : 'off';
			$data['izioseo_log'] = isset($data['izioseo_log']) && $data['izioseo_log'] == 'on' ? 'on' : 'off';
			$data['izioseo_use_categories'] = isset($data['izioseo_use_categories']) && $data['izioseo_use_categories'] == 'on' ? 'on' : 'off';
			$data['izioseo_use_tags'] = isset($data['izioseo_use_tags']) && $data['izioseo_use_tags'] == 'on' ? 'on' : 'off';
			$data['izioseo_use_referers'] = isset($data['izioseo_use_referers']) && $data['izioseo_use_referers'] == 'on' ? 'on' : 'off';
			$data['izioseo_robots_noodp'] = isset($data['izioseo_robots_noodp']) && $data['izioseo_robots_noodp'] == 'on' ? 'on' : 'off';
			$data['izioseo_nofollow_categories'] = isset($data['izioseo_nofollow_categories']) && $data['izioseo_nofollow_categories'] == 'on' ? 'on' : 'off';
			$data['izioseo_nofollow_bookmarks'] = isset($data['izioseo_nofollow_bookmarks']) && $data['izioseo_nofollow_bookmarks'] == 'on' ? 'on' : 'off';
			$data['izioseo_nofollow_tags'] = isset($data['izioseo_nofollow_tags']) && $data['izioseo_nofollow_tags'] == 'on' ? 'on' : 'off';
			$data['izioseo_redirect_permalink'] = isset($data['izioseo_redirect_permalink']) && $data['izioseo_redirect_permalink'] == 'on' ? 'on' : 'off';
			$data['izioseo_image_use'] = isset($data['izioseo_image_use']) && $data['izioseo_image_use'] == 'on' ? 'on' : 'off';
			foreach ($data as $key => $value)
			{
				update_option($key, trim($value));
			}
			return 'true';
		}
	}

	/**
	 * Menu fuer die Keywords, Stopwords und Akronyme
	 */
	function keywordsMenu()
	{
		if (isset($_POST['keywords']))
		{
			$data = $_POST['keywords'];
			$data['izioseo_collect_keywords'] = isset($data['izioseo_collect_keywords']) && $data['izioseo_collect_keywords'] == 'on' ? 'on' : 'off';
			update_option('izioseo_collect_keywords', $data['izioseo_collect_keywords']);

			$message = $this->mergeKeywordFiles($data);
		}

		$this->loadAcronyms();
		$this->loadKeywords();
		$this->loadStopwords();
		$data = array(
			'izioseo_collect_keywords' => htmlspecialchars(stripcslashes(get_option('izioseo_collect_keywords'))),
			'izioseo_file_keywords' => htmlspecialchars(stripcslashes(utf8_encode(implode("\r\n", $this->keywords)))),
			'izioseo_file_stopwords' => htmlspecialchars(stripcslashes(implode("\r\n", $this->stopwords))),
			'izioseo_file_acronyms' => htmlspecialchars(stripcslashes(implode("\r\n", $this->acronyms)))
		);
		require_once($this->template . 'keywords.tpl.php');
	}

	/**
	 * speichert die Stopword-, Keyword- und Acronymlisten ab und verschmelzt diese
	 *
	 * @param array $data
	 */
	function mergeKeywordFiles($data)
	{
		$error = false;
		$files = array(
			'izioseo_file_acronyms' => dirname(__FILE__) . '/acronyms.txt',
			'izioseo_file_keywords' => dirname(__FILE__) . '/keywords.txt',
			'izioseo_file_stopwords' => dirname(__FILE__) . '/stopwords.txt'
		);
		foreach ($data as $key => $value)
		{
			$data[$key] = array_unique(explode('<br />', nl2br($data[$key])));
		}
		$data['izioseo_file_stopwords'] = $this->mergeArrays($data['izioseo_file_stopwords'], $data['izioseo_file_keywords']);
		$data['izioseo_file_stopwords'] = $this->mergeArrays($data['izioseo_file_stopwords'], $data['izioseo_file_acronyms']);
		foreach ($files as $key => $file)
		{
			// Daten saeubern
			$tmp = array();
			foreach ($data[$key] as $word)
			{
				if (strlen(trim($word)))
				{
					$tmp[] = trim(utf8_decode($word));
				}
			}
			sort($tmp);
			$data[$key] = $tmp;

			// Daten in Dateien schreiben
			if ($hdl = @fopen($file, 'wb'))
			{
				fputs($hdl, implode("\r\n", $data[$key]));
				fclose($hdl);
			}
			else
			{
				$error = true;
			}
		}
		if ($error)
		{
			return 'error merge';
		}
		return 'success merge';
	}

	/**
	 * sammeln aller Keywords in eine Datei, damit diese dann gefiltert in die Stopwordliste hinzugefuegt werden koennen
	 *
	 * @params array $keywords
	 */
	function collectKeywords($keywords)
	{
		$this->keywordList = dirname(__FILE__) . '/keywords.txt';
		$file = array();
		if (file_exists($this->keywordList))
		{
			$tmp = @file($this->keywordList);
			foreach ($tmp as $key => $value)
			{
				$file[$key] = trim($value);
			}
		}
		foreach ($keywords as $keyword)
		{
			if (! in_array($keyword, $file))
			{
				$file[] = trim($keyword);
			}
		}
		if ($hdl = @fopen($this->keywordList, 'wb'))
		{
			fputs($hdl, implode("\r\n", $file));
			fclose($hdl);
		}
	}

	/**
	 * verbindet zwei Arrays miteinander und filtert doppelte Keys heraus
	 *
	 * @param array $arr1
	 * @param array $arr2
	 * @return array
	 */
	function mergeArrays($arr1, $arr2)
	{
		return array_unique(array_merge($arr1, $arr2));
	}

	/**
	 * Laden der Acronyme aus dem Dateisystem
	 *
	 * @return boolean
	 */
	function loadAcronyms()
	{
		$file = dirname(__FILE__) . '/acronyms.txt';
		if ((empty($this->acronyms) || ! count($this->acronyms)) && file_exists($file))
		{
			$raw = file($file);
			foreach ($raw as $word)
			{
				$word = trim(utf8_encode($word));
				if (strlen($word) && ! in_array($word, $this->acronyms))
				{
					$this->acronyms[] = $word;
				}
			}
		}
	}

	/**
	 * laedt die gesammelten Keywords in das Plugin
	 */
	function loadKeywords()
	{
		$file = dirname(__FILE__) . '/keywords.txt';
		if ((empty($this->keywords) || ! count($this->keywords)) && file_exists($file))
		{
			$raw = file($file);
			foreach ($raw as $word)
			{
				$word = trim(utf8_encode($word));
				if (strlen($word) && ! in_array($word, $this->keywords))
				{
					$this->keywords[] = $word;
				}
			}
		}
	}

	/**
	 * laden der Stopwordsliste
	 */
	function loadStopwords()
	{
		$file = dirname(__FILE__) . '/stopwords.txt';
		if ((empty($this->stopwords) || ! count($this->stopwords)) && file_exists($file))
		{
			$raw = file($file);
			foreach ($raw as $word)
			{
				$word = trim(utf8_encode($word));
				if (strlen($word) && ! in_array($word, $this->stopwords))
				{
					$this->stopwords[] = $word;
				}
			}
		}
	}

	/**
	 * Statistikmenu fuer die Keywords und Referers
	 */
	function statisticMenu()
	{
		require_once(dirname(__FILE__) . '/classes/OpenFlashCharts/open_flash_chart_object.php');
		$pluginDir = WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/';

		require_once(dirname(__FILE__) . '/classes/Statistics.class.php');
		$stats = new Statistics();

		$nr = isset($_GET['nr']) && preg_match('/^[0-9]+$/', $_GET['nr']) ? $_GET['nr'] : 10;
		$nk = isset($_GET['nk']) && preg_match('/^[0-9]+$/', $_GET['nk']) ? $_GET['nk'] : 10;
		$nref = isset($_GET['nref']) && preg_match('/^[0-9]+$/', $_GET['nref']) ? $_GET['nref'] : 10;
		$nl = isset($_GET['nl']) && preg_match('/^[0-9]+$/', $_GET['nl']) ? $_GET['nl'] : 10;
		$export = isset($_GET['export']) ? addslashes($_GET['export']) : 'referer-csv';

		require_once($this->template . 'statistics.tpl.php');
	}

	/**
	 * generiert die Daten fuer das Pie-Diagramm (Open Flash Charts)
	 */
	function flashData()
	{
		@ob_end_clean();

		require_once(dirname(__FILE__) . '/classes/Statistics.class.php');
		$s = new Statistics();

		require_once(dirname(__FILE__) . '/classes/OpenFlashCharts/open-flash-chart.php');
		$g = new graph();

		$data = array();
		$names = array();
		$stats = $s->getSearchengines();
		foreach ($this->searchengines as $se)
		{
			if (isset($stats[$se[0]]))
			{
				$data[] = round($stats[$se[0]]['percent']);
				$names[] = $se[2];
				$colors[] = $se[3];
			}
		}
		if (!array_sum($data) || array_sum($data) != 100)
		{
			$data[] = 100 - array_sum($data);
			$names[] = __('sonstige', 'izioseo');
			$colors[] = '#7e7e7e';
		}

		$g->pie(75, '#e1e1e1','{font-size: 12px; color: #000;', false, 1);
		$g->pie_values($data, $names);
		$g->pie_slice_colours($colors);
		$g->set_tool_tip('#x_label#: #val#%');
		echo $g->render();
	}


	/**
	 * exportieren der Keywords als CSV-Datei
	 */
	function exportKeywords()
	{
		require_once(dirname(__FILE__) . '/classes/Statistics.class.php');
		$stats = new Statistics();

		$name = 'izioseo-keywords-' . date('Y-m-d-h-i-s', time()) . '.csv';
		$header = array(__('URL', 'izioseo'), __('Keyword', 'izioseo'), __('Anzahl', 'izioseo'));
		$keywords = $stats->getKeywordsToUrls(get_option('siteurl', true));
		$this->exportAsCSV($name, $header, $keywords);
	}

	/**
	 * exportieren der Suchanfragen als CSV-Datei
	 */
	function exportRequests()
	{
		require_once(dirname(__FILE__) . '/classes/Statistics.class.php');
		$stats = new Statistics();

		$name = 'izioseo-requests-' . date('Y-m-d-h-i-s', time()) . '.csv';
		$header = array(__('URL', 'izioseo'), __('Suchanfrage', 'izioseo'), __('Suchmaschine', 'izioseo'), __('Anfragende URL', 'izioseo'), __('Anzahl', 'izioseo'));
		$requests = $stats->getRequestsToUrls(get_option('siteurl', true));
		$this->exportAsCSV($name, $header, $requests);
	}

	/**
	 * exportieren die anonymisierten Links
	 */
	function exportLinks()
	{
		require_once(dirname(__FILE__) . '/classes/Statistics.class.php');
		$stats = new Statistics();

		$name = 'izioseo-links-' . date('Y-m-d-h-i-s', time()) . '.csv';
		$header = array(__('Link URL', 'izioseo'), __('Aufrufe', 'izioseo'));
		$this->exportAsCSV($name, $header, $stats->getPopularLinks());
	}

	/**
	 * exportieren der verlinkenden Seiten als CSV-Datei
	 */
	function exportReferers()
	{
		require_once(dirname(__FILE__) . '/classes/Statistics.class.php');
		$stats = new Statistics();

		$name = 'izioseo-referers-' . date('Y-m-d-h-i-s', time()) . '.csv';
		$header = array(__('URL', 'izioseo'), __('Verweisende URL', 'izioseo'),__('Anzahl', 'izioseo'));
		$requests = $stats->getReferersToUrls(get_option('siteurl', true));
		$this->exportAsCSV($name, $header, $requests);
	}

	/**
	 * Erstellt eine CSV-Datei und stellt diese zum Download bereit
	 *
	 * @param string $name
	 * @param array $header
	 * @param array $content
	 */
	function exportAsCSV($name, $header, $keywords)
	{
		$csv = implode(';', $header) . ";\n";
		foreach ($keywords as $keyword)
		{
			$csv .= stripslashes(implode(';', str_replace(';', '', $keyword))) . ";\n";
		}

		@ob_end_clean();
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename=' . $name);
		header('Content-Length: ' . strlen($csv));
		header('Content-type: text/csv; charset=' . get_option('blog_charset', 'UTF-8'), true);

		echo $csv;
		exit;
	}

	/**
	 * Menu zur Bearbeitung der robots.txt
	 */
	function robotsMenu()
	{
		if (isset($_POST['robotstxt']))
		{
			$message = $this->writeRobotsTxt($_POST['robotstxt']);
		}
		$robotsTxt = $this->loadRobotsTxt();
		require_once($this->template . 'robots.tpl.php');
	}

	/**
	 * laedt den Inhalt der robots.txt
	 *
	 * @return string
	 */
	function loadRobotsTxt()
	{
		$file = dirname(__FILE__) . '/../../../robots.txt';
		if (file_exists($file))
		{
			return @file_get_contents($file);
		}
		return "User-agent: *\r\nDisallow:";
	}

	/**
	 * Schreibt die robots.txt mit dem eingegebenen Inhalt
	 *
	 * @param string $content
	 * @return string
	 */
	function writeRobotsTxt($content)
	{
		$file = realpath(dirname(__FILE__) . '/../../../robots.txt');
		if ($hdl = @fopen($file, 'wb'))
		{
			fputs($hdl, $content);
			fclose($hdl);

			return 'success robots';
		}
		return 'error robots';
	}

	/**
	 * Menu um Benutzereinstellung zu laden, loeschen oder zurueck zu setzen
	 */
	function resetMenu()
	{
		// Importieren
		if (isset($_FILES['import']['type']) && $_FILES['import']['type'] == 'text/xml')
		{
			$message = 'error no import';
			if ($file = @file_get_contents($_FILES['import']['tmp_name']))
			{
				$message = 'error no settings imported';
				if ($count = $this->importOptions($file))
				{
					$message = 'success settings imported';
				}
			}
		}
		elseif (isset($_FILES['import']))
		{
			$message = 'error no valid xml file';
		}
		// Zuruecksetzen auf Standard
		if (isset($_GET['reset']) && $this->resetOptions())
		{
			$message = 'success reset';
		}
		// Statistik loeschen
		if (isset($_GET['truncate']) && $this->resetStatistic())
		{
			$message = 'success truncate';
		}
		require_once($this->template . 'reset.tpl.php');
	}

	/**
	 * generiert eine XML-Datei mit den Einstellungen von izioSEO und stellt diese zum Download bereit
	 */
	function exportOptions()
	{
		update_option('__izioseo_reset_export', time());

		$xml = "<?xml version=\"1.0\" encoding=\"" . get_option('blog_charset', 'UTF-8') . "\"?>\n<izioseo>\n";
		$options = $this->db->fetchResults('SELECT option_name, option_value FROM #options WHERE option_name LIKE "izioseo_%"');
		foreach ($options as $option)
		{
			$xml .= "\t<" . $option->option_name . '><![CDATA[' . stripslashes($option->option_value) . ']]></' . $option->option_name . ">\n";
		}
		$xml .= "</izioseo>";

		@ob_end_clean();
		header('Content-Description: File Transfer');
		header('Content-Disposition: attachment; filename=izioseo-options-' . date('Y-m-d-H-i-s', time()) . '.xml');
		header('Content-Length: ' . strlen($xml));
		header('Content-type: text/xml; charset=' . get_option('blog_charset', 'UTF-8'), true);

		echo $xml;
		exit;
	}

	/**
	 * Importiert eine XML-Datei mit den Einstellungen fuer izioSEO
	 *
	 * @param string $xml
	 * @return integer
	 */
	function importOptions($file)
	{
		$n = 0;
		$options = $this->parseXML($file);
		foreach ($options as $option)
		{
			if (strtolower($option['tag']) != 'izioseo')
			{
				update_option(strtolower($option['tag']), $option['value']);
				$n++;
			}
		}
		if ($n)
		{
			return $n;
		}
		return false;
	}

	/**
	 * Parsen einer XML-Datei mit Rueckgabe der Werte als Array
	 * 
	 * @param string $xml
	 * @return string
	 */
	function parseXML($xml)
	{
		$hdl = xml_parser_create();
		xml_parse_into_struct($hdl, $xml, $options, $index);
		xml_parser_free($hdl);
		return $options;
	}

	/**
	 * loescht alle Statistiken
	 *
	 * @return boolean
	 */
	function resetStatistic()
	{
		$this->db->truncate('#izioseo_anonym_links');
		$this->db->truncate('#izioseo_referers');
		$this->db->truncate('#izioseo_referers_keywords');
		return true;
	}

	/**
	 * setzte die Einstellungen von izioSEO auf die Standardwerte zurueck
	 *
	 * @return boolean
	 */
	function resetOptions()
	{
		$n = 0;
		foreach ($this->settings as $key => $value)
		{
			if (substr($key, 0, 8) == 'izioseo_' && update_option($key, $value))
			{
				$n++;
			}
		}
		return $n > 0;
	}

	/**
	 * Baue das Panel fuer die Posts zusammen
	 */
	function addPostMeta()
	{
		$post = $this->getCurPost(true);
		if ($post->ID > 0 && preg_match('/^[0-9]{1,10}$/', $post->ID))
		{
			$data = array(
				'disable' => htmlspecialchars(stripcslashes(get_post_meta($post->ID, 'izioseo_post_disable', true))),
				'title' => htmlspecialchars(stripcslashes(get_post_meta($post->ID, 'izioseo_post_title', true))),
				'keywords' => htmlspecialchars(stripcslashes(get_post_meta($post->ID, 'izioseo_post_keywords', true))),
				'description' => htmlspecialchars(stripcslashes(get_post_meta($post->ID, 'izioseo_post_description', true))),
				'robots' => htmlspecialchars(stripcslashes(get_post_meta($post->ID, 'izioseo_post_robots', true))),
				'use' => htmlspecialchars(stripcslashes(get_post_meta($post->ID, 'izioseo_post_use', true))),
				'adsection' => htmlspecialchars(stripcslashes(get_post_meta($post->ID, 'izioseo_post_google_adsection', true))),
				'seo_image_use' => htmlspecialchars(stripcslashes(get_post_meta($post->ID, 'izioseo_post_image_use', true))),
				'seo_image_alt' => htmlspecialchars(stripcslashes(get_post_meta($post->ID, 'izioseo_post_image_alt', true)))
			);
			if (strlen(implode('', $data)) == 'on')
			{
				$data['disable'] = 'off';
			}
		}
		else
		{
			$data = array(
				'disable' => 'off',
				'title' => '',
				'keywords' => '',
				'description' => '',
				'robots' => '',
				'use' => get_option('izioseo_use_default', true),
				'adsection' => get_option('izioseo_google_adsection', true),
				'seo_image_use' => get_option('izioseo_image_use', true),
				'seo_image_alt' => get_option('izioseo_image_alt', true)
			);
		}
		$data = $this->aiospPost($post->ID, $data);
		$select = array(
			'',
			'index,follow',
			'index,nofollow',
			'noindex,follow',
			'noindex,nofollow',
			'index,follow,noarchive',
			'index,nofollow,noarchive',
			'noindex,follow,noarchive',
			'noindex,nofollow,noarchive'
		);
		$use = array(
			'none' => __('Keine nutzen', 'izioseo'),
			'default' => __('Standardwerte nutzen', 'izioseo'),
			'generate' => __('Keywords und Beschreibung generieren', 'izioseo')
		);
		require_once($this->template . 'tags.tpl.php');
	}

	/**
	 * Speichern der META-Tags
	 *
	 * @param integer $id
	 */
	function savePostMeta($id)
	{
		$data = isset($_POST['izioseo']) && is_array($_POST['izioseo']) && count($_POST['izioseo']) ? $_POST['izioseo'] : null;
		if (! empty($id) && ! empty($data) && is_array($data))
		{
			$data['izioseo_post_disable'] = !isset($data['izioseo_post_disable']) || $data['izioseo_post_disable'] == 'off' ? 'on' : 'off';
			$data['izioseo_post_google_adsection'] = isset($data['izioseo_post_google_adsection']) && $data['izioseo_post_google_adsection'] == 'on' ? 'on' : 'off';
			$data['izioseo_post_image_use'] = isset($data['izioseo_post_image_use']) && $data['izioseo_post_image_use'] == 'on' ? 'on' : 'off';
			foreach ($data as $key => $value)
			{
				delete_post_meta($id, $key);
				if (strlen(trim($value)))
				{
					add_post_meta($id, $key, $value);
				}
			}
		}
	}

	/**
	 * laden der zusaetzlichen Felder aus All In One Seo
	 *
	 * @param integer $id
	 * @param array $data
	 * @return array
	 */
	function aiospPost($id, $data)
	{
		if (!$id)
		{
			$data['disable'] = htmlspecialchars(stripcslashes(get_post_meta($id, 'aiosp_disable', true)));
		}
		if (!strlen(trim($data['title'])))
		{
			$data['title'] = htmlspecialchars(stripcslashes(get_post_meta($id, 'title', true)));
		}
		if (!strlen(trim($data['keywords'])))
		{
			$data['keywords'] = htmlspecialchars(stripcslashes(get_post_meta($id, 'keywords', true)));
		}
		if (!strlen(trim($data['description'])))
		{
			$data['description'] = htmlspecialchars(stripcslashes(get_post_meta($id, 'description', true)));
		}
		return $data;
	}

	/**
	 * laden der globalen Einstellungen von All In One Seo
	 *
	 * @param array $data
	 * @return array
	 */
	function aiospGlobals($data)
	{
		if (!strlen(trim($data['izioseo_title'])))
		{
			$data['izioseo_title'] = htmlspecialchars(stripcslashes(get_option('aiosp_home_title', '')));
		}
		if (!strlen(trim($data['izioseo_keywords'])))
		{
			$data['izioseo_keywords'] = htmlspecialchars(stripcslashes(get_option('aiosp_home_keywords', '')));
		}
		if (!strlen(trim($data['izioseo_description'])))
		{
			$data['izioseo_description'] = htmlspecialchars(stripcslashes(get_option('aiosp_home_description', '')));
		}
		return $data;
	}

	/**
	 * den RSS Feed nicht indizieren
	 */
	function noindexRSSFeed()
	{
		if (get_option('izioseo_noindex_rssfeed') == 'on')
		{
			echo "<xhtml:meta xmlns:xhtml=\"http://www.w3.org/1999/xhtml\" name=\"robots\" content=\"noindex\" />\n";
		}
	}

	/**
	 * Filterfunktion fuer die Google AdSesction
	 *
	 * @param string $content
	 * @return string
	 */
	function setAdSection($content)
	{
		$post = $this->getCurPost(true);
		$use = (get_option('izioseo_google_adsection') == 'on') || (is_object($post) && get_post_meta($post->ID, 'izioseo_post_google_adsection', true) == 'on');
		if ($use)
		{
			return "\n<!-- google_ad_section_start -->\n" . trim($content) . "\n<!-- google_ad_section_end -->\n";
		}
		return $content;
	}

	/**
	 * umschreiben der Bilder zu einer Suchmaschinenfreundlichen Darstellung
	 *
	 * @param string $content
	 * @return string
	 */
	function seoImages($content)
	{
		$post = $this->getCurPost(true);
		$use = (get_option('izioseo_image_use') == 'on') || (is_object($post) && get_post_meta($post->ID, 'izioseo_post_image_use', true) == 'on');
		if ($use)
		{
			$content = preg_replace_callback('/<img[^>]+/', array($this, 'processImages'), $content);
		}
		return $content;
	}

	/**
	 * Callback Funktion fuer die Bilder damit diese die korrekte Formatierung erhalten.
	 *
	 * @param array $matches
	 * @return string
	 */
	function processImages($matches)
	{
		$author = $this->getAuthor(true);
		$post = $this->getCurPost(true);
		$cats = $this->getCategory();
		$alt = isset($post->ID) ? get_post_meta($post->ID, 'izioseo_post_image_alt', true) : null;
		if (empty($alt))
		{
			$alt = get_option('izioseo_image_alt', '&image_title% in %post_title%');
		}

		$matches[0] = preg_replace('/"\/$/', '" /', $matches[0]);
		$matches[0] = preg_replace('/"$/', '" /', $matches[0]);
		$matches[0] = preg_replace('/" $/', '" /', $matches[0]);
		$matches[0] = preg_replace('/\s*=\s*/', '=', substr($matches[0], 0, strlen($matches[0]) - 2));

		preg_match('/src\s*=\s*([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/', $matches[0], $source);
		$saved = $source[2];

		preg_match('%[^/]+(?=\.[a-z]{3}\z)%', $source[2], $source);
		$pieces = preg_split('/(\w+=)/', $matches[0], -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

		if (in_array('title=', $pieces))
		{
			$key = array_search('title=', $pieces);
			$pieces[$key] = '';
			$pieces[$key+1] = '';
		}
		if (! in_array('alt=', $pieces))
		{
			$alt = str_replace('%blog_title%', get_bloginfo('name'), $alt);
			$alt = str_replace('%post_title%', $post->post_title, $alt);
			$alt = str_replace('%image_title%', $this->getRequest($source[0]), $alt);
			$alt = str_replace('%category_title%', $cats[0]->slug, $alt);
			$alt = str_replace('%post_author%', $author->display_name, $alt);
			$alt = str_replace('"', '', $alt);
			$alt = str_replace('\'', '', $alt);

			array_push($pieces, ' alt="' . $alt . '"');
		}
		else
		{
			$key = array_search('alt=', $pieces);
			if (strlen(trim($pieces[$key+1])) || strpos($saved, str_replace('"', '', trim($pieces[$key+1]))))
			{
				$alt = str_replace('%blog_title%', get_bloginfo('name'), $alt);
				$alt = str_replace('%post_title%', isset($post->post_title) ? $post->post_title : '', $alt);
				$alt = str_replace('%image_title%', $this->getRequest($source[0]), $alt);
				$alt = str_replace('%category_title%', $cats[0]->slug, $alt);
				$alt = str_replace('%post_author%', isset($author->display_name) ? $author->display_name : '', $alt);
				$alt = str_replace('"', '', $alt);
				$alt = str_replace('\'', '', $alt);

				$pieces[$key+1] = '"' . $alt . '" ';
			}
		}
		return implode('', $pieces) . ' /';
	}

	/**
	 * Setzt alle Links des Strings auf nofollow
	 *
	 * @param string $content
	 * @return string
	 */
	function setNofollow($content)
	{
		$content = preg_replace_callback('/\<a[^>]+?\>/', array($this, 'linkPart'), $content);
		return $content;
	}

	/**
	 * ersetzt Attribute in einem <a ... > - Konstrukt
	 *
	 * @param array $matches
	 * @return string
	 */
	function linkPart($matches)
	{
		$result = preg_replace_callback('/(rel\s*=\s*[\"\'])(.*?)([\"\'][\/\> ])/', array($this, 'linkAttributes'), $matches[0]);
		if (substr($result, -1) != '>')
		{
			$result .= '>';
		}
		if (! substr_count($result, 'nofollow'))
		{
			$result = str_replace('>', ' rel="nofollow">', $result);
		}
		return $result;
	}

	/**
	 * holt die Attribute des Links
	 *
	 * @param array $matches
	 * @return string
	 */
	function linkAttributes($matches)
	{
		if (isset($matches[2]) && ! substr_count($matches[2], 'nofollow'))
		{
			$rel = explode(' ', $matches[2]);
			$rel[] = 'nofollow';
			return ' rel="' . implode(' ', $rel) . '" ';
		}
		return $matches[0];
	}

	/**
	 * Externe Links im Content anonymisieren
	 *
	 * @param string $content
	 * @return string
	 */
	function anonymContentLinks($content)
	{
		if (($type = get_option('izioseo_anonym_content_link')) != 'off')
		{
			return $this->anonymLinks($content, $type);
		}
		return $content;
	}

	/**
	 * Externe Links in den Kommentaren anonymisieren
	 *
	 * @param string $content
	 * @return string
	 */
	function anonymCommentLinks($content)
	{
		if (($type = get_option('izioseo_anonym_comment_link')) != 'off')
		{
			return $this->anonymLinks($content, $type);
		}
		return $content;
	}

	/**
	 * Externe Links in der Blogroll anonymisieren
	 *
	 * @param string $content
	 * @return string
	 */
	function anonymBookmarkLinks($content)
	{
		if (($type = get_option('izioseo_anonym_bookmark_link')) != 'off')
		{
			return $this->anonymLinks($content, $type);
		}
		return $content;
	}

	/**
	 * anonymisiere externe Links und schreibe diese in die Datenbank
	 *
	 * @param string $content
	 * @param string $type
	 * @return string
	 */
	function anonymLinks($content, $type)
	{
		if ($type == 'standard')
		{
			return preg_replace_callback('/<a (.*?)href=["|\'](.*?)\/\/(.*?)["|\'](.*?)>(.*?)<\/a>/i', array($this, 'parseExternalLinks'), $content);
		}
		elseif ($type == 'anonym.to')
		{
			return preg_replace_callback('/<a (.*?)href=["|\'](.*?)\/\/(.*?)["|\'](.*?)>(.*?)<\/a>/i', array($this, 'parseExternalLinksForProxy'), $content);
		}
		return $content;
	}

	/**
	 * Parst alle externen Links und gibt diese Anonymisiert zurueck
	 *
	 * @param array $matches
	 * @return string
	 */
	function parseExternalLinks($matches)
	{
		if ($this->getDomain($matches[3]) != $this->getDomain($_SERVER['HTTP_HOST']))
		{
			$md5 = $this->insertAnonymLinks($matches[2] . '//' . $matches[3]);
			$link = '<a href="' . $this->generateAnonymLink($md5) . '"' . $matches[1] . $matches[4] . '>' . $matches[5] . '</a>';
			$link = preg_replace_callback('/\<a[^>]+?\>/', array($this, 'linkPart'), $link);
			return $link;
		}
		return '<a href="' . $matches[2] . '//' . $matches[3] . '"' . $matches[1] . $matches[4] . '>' . $matches[5] . '</a>';	 
	}

	/**
	 * Parst alle externen Links und gibt diese fuer einen Anonymisierungs-Proxy (anonym.to) zurueck
	 *
	 * @param array $matches
	 * @return string
	 */
	function parseExternalLinksForProxy($matches)
	{
		if ($this->getDomain($matches[3]) != $this->getDomain($_SERVER['HTTP_HOST']))
		{
			$link = '<a href="http://anonym.to/?' . $matches[2] . '//' . $matches[3] . '"' . $matches[1] . $matches[4] . '>' . $matches[5] . '</a>';	 
			$link = preg_replace_callback('/\<a[^>]+?\>/', array($this, 'linkPart'), $link);
			return $link;
		}
		return '<a href="' . $matches[2] . '//' . $matches[3] . '"' . $matches[1] . $matches[4] . '>' . $matches[5] . '</a>';	 
	}

	/**
	 * Fuegt einen Link in die Datenbank hinzu und gibt den MD5-Hash des Links zurueck
	 *
	 * @param string $url
	 * @return string
	 */
	function insertAnonymLinks($url)
	{
		$insert = array(
			'link_url' => $url,
			'link_hash' => md5($url),
		);
		$this->db->insert('#izioseo_anonym_links', $insert, array('ignore' => true));
		return $insert['link_hash'];
	}

	/**
	 * generiert den Anonymisierten Link
	 *
	 * @param string $md5
	 * @return string
	 */
	function generateAnonymLink($md5)
	{
		return trim(get_option('siteurl'), '/') . '?goto=' . $md5;
	}

	/**
	 * Leitet den anonymen Link weiter und zaehlt die Hits
	 */
	function redirectLink()
	{
		if ($link = $this->db->fetchResults('SELECT * FROM #izioseo_anonym_links WHERE link_hash="' . mysql_escape_string($_GET['goto']) . '"'))
		{
			$this->db->update('#izioseo_anonym_links', 'link_hits=link_hits+1', 'WHERE link_id=' . $link[0]->link_id);
			header('Location: ' . $link[0]->link_url);
		}
		exit;
	}

	/**
	 * Weiterleiten von Permalinks
	 */
	function redirectPermalink()
	{
		if (is_404())
		{
		 	if ($postId = $this->db->fetchOne('SELECT ID FROM #posts WHERE post_name="' . mysql_escape_string(basename($this->url)) . '" AND post_status="publish"'))
		 	{
		 		$permalink = get_permalink($postId);
				header('HTTP/1.1 301 Moved Permanently');
				header('Location: ' . $permalink);
				exit;
		 	}
		}
	}

	/**
	 * extrahiert relevante Keywords aus einem Text
	 *
	 * @params string $text
	 * @return string
	 */
	function extractKeywords($text)
	{
		$return = array();
		if (strlen(trim($text)))
		{
			$clear = $this->stripStopwords($this->stripHtml($text));
			$words = explode(' ', $clear);
			$reg = array();
			for($i = 0; $i < count($words); $i++)
			{
				if (! empty($words[$i]) && $words[$i][0] == strtolower($words[$i][0]) && ! is_numeric($words[$i]) && strlen($words[$i]) > 1)
				{
					if (array_key_exists($words[$i], $reg))
					{
						$reg[$words[$i]]++;
					}
					else
					{
						$reg[$words[$i]] = 1;
					}
				}
			}
			if (get_option('izioseo_use_referers', true) == 'on')
			{
				$reg = $this->getRefererKeywords($reg);
			}
			arsort($reg);
			$all = array_sum($reg);
			foreach ($reg as $word => $count)
			{
				if ($count >= 1 && ! preg_match('/^[0-9]+$/', $word) && strlen(trim($word)) >= 2)
				{
					$return[] = preg_replace('/[^0-9a-zA-Z-, \x80-\xFF]/', '', trim(utf8_decode($word), ','));
				}
			}
			if (get_option('izioseo_collect_keywords') == 'on' && is_array($return))
			{
				$this->collectKeywords($return);
			}
		}
		return $return;
	}

	/**
	 * umschreiben des Titels
	 */
	function title()
	{
		if (!is_feed() && get_option('izioseo_rewrite_titles') == 'on')
		{
			ob_start(array($this, 'rewriteTitle'));
		}
	}

	/**
	 * umschreiben des Seitentitels
	 *
	 * @param string $header
	 * @return string
	 */
	function rewriteTitle($header)
	{
		global $s;

		// aktuellen Post holen
		$post = $this->getCurPost();
		if ((is_home() || $this->isStaticFrontpage()) && ! $this->isStaticPostpage()) // Startseite
		{
			$title = get_option('izioseo_title');
			if (empty($title))
			{
				$title = get_option('aiosp_home_title');
				if (empty($title))
				{
					$title = get_option('blogname');
				}
			}
			$title = $this->getPagedTitle($title);
			return $this->replaceTitle($header, $title);
		}
		elseif (is_single()) // Single Post
		{
			$author = $this->getAuthor();
			$categories = $this->getCategory();
			$category = (count($categories) > 0 ? $categories[0]->cat_name : '');
			if (! ($title = get_post_meta($post->ID, 'izioseo_post_title', true)))
			{
				if (! ($title = get_post_meta($post->ID, 'title', true)))
				{
					if (! ($title = get_post_meta($post->ID, 'izioseo_post_title_tag', true)))
					{
						$title = wp_title('', false);
					}
				}
			}
			$format = get_option('izioseo_format_title_post', '%post_title% - %blog_title%');
			$new = str_replace('%blog_title%', get_bloginfo('name'), $format);
			$new = str_replace('%blog_description%', get_bloginfo('description'), $new);
			$new = str_replace('%post_title%', $title, $new);
			$new = str_replace('%category_title%', $category, $new);
			$new = str_replace('%post_author_login%', $author->user_login, $new);
			if (isset($author->display_name))
			{
				$new = str_replace('%post_author_username%', $author->display_name, $new);
			}
			if (isset($author->first_name))
			{
				$new = str_replace('%post_author_firstname%', ucwords($author->first_name), $new);
			}
			if (isset($author->last_name))
			{
				$new = str_replace('%post_author_lastname%', ucwords($author->last_name), $new);
			}
			$title = $this->getPagedTitle($title);
			return $this->replaceTitle($header, $new);
		}
		elseif (is_search() && isset($s) && ! empty($s)) // die Suchergebnisse
		{
			$search = (function_exists('attribute_escape') ? attribute_escape(stripcslashes($s)) : wp_specialchars(stripcslashes($s), true));
			$search = $this->capitalize($search);
			$format = get_option('izioseo_format_title_search', 'Suchergebnisse zu %search% - %blog_title%');
			$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
			$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
			$title = str_replace('%search%', $search, $title);
			$title = $this->getPagedTitle($title);
			return $this->replaceTitle($header, $title);
		}
		elseif (is_category() && ! is_feed()) // Kategorie
		{
			$category = ucwords(single_cat_title('', false));
			$description = category_description();
			$format = get_option('izioseo_format_title_category', '%category_title% - %blog_title%');
			$title = str_replace('%category_title%', $category, $format);
			$title = str_replace('%category_description%', $description, $title);
			$title = str_replace('%blog_title%', get_bloginfo('name'), $title);
			$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
			$title = $this->getPagedTitle($title);
			return $this->replaceTitle($header, $title);
		}
		elseif (is_page() || $this->isStaticPostpage()) // eine Seite
		{
			$author = $this->getAuthor();
			if (! ($title = get_post_meta($post->ID, 'izioseo_post_title', true)))
			{
				if (! ($title = get_post_meta($post->ID, 'title', true)))
				{
					$title = $post->post_title;
				}
			}
			$format = get_option('izioseo_format_title_page', '%page_title% - %blog_title%');
			$new = str_replace('%blog_title%', get_bloginfo('name'), $format);
			$new = str_replace('%blog_description%', get_bloginfo('description'), $new);
			$new = str_replace('%page_title%', $title, $new);
			$new = str_replace('%page_author_login%', $author->user_login, $new);
			$new = str_replace('%page_author_nicename%', $author->user_nicename, $new);
			$new = str_replace('%page_author_firstname%', ucwords($author->first_name), $new);
			$new = str_replace('%page_author_lastname%', ucwords($author->last_name), $new);
			$new = $this->getPagedTitle($new);
			return $this->replaceTitle($header, $new);
		}
		elseif (is_tag()) // Tags
		{
			$tag = $this->capitalize(wp_title('', false));
			$format = get_option('izioseo_format_title_tag', '%tag% - %blog_title%');
			$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
			$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
			$title = str_replace('%tag%', $tag, $title);
			$title = $this->getPagedTitle($title);
			return $this->replaceTitle($header, $title);
		}
		elseif (is_archive()) // Archiv
		{
			$date = wp_title('', false);
			$format = get_option('izioseo_format_title_archive', '%date% - %blog_title%');
			$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
			$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
			$title = str_replace('%date%', $date, $title);
			$title = $this->getPagedTitle($title);
			return $this->replaceTitle($header, $title);
		}
		elseif (is_404()) // 404 Fehlerseite
		{
			$format = get_option('izioseo_format_title_404', 'Seite %request_words% wurde nicht gefunden - %blog_title%');
			$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
			$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
			$title = str_replace('%request_url%', $this->url, $title);
			$title = str_replace('%request_words%', $this->getRequest($this->url), $title);
			return $this->replaceTitle($header, $title);
		}
		return $header;
	}

	/**
	 * ersetzt den Titel im Header
	 *
	 * @param string $header
	 * @param string $title
	 * @return string
	 */
	function replaceTitle($header, $title)
	{
		$title = $this->stripHtml($title);
		$start = strpos($header, '<title>');
		$end = strpos($header, '</title>');
		if ($start && $end)
		{
			return substr($header, 0, $start + 7) . $title . substr($header, $end);
		}
		return $header;
	}

	/**
	 * erstellt den Titel fuer eine Seite mit Seitenzahlen
	 *
	 * @param string $title
	 * @return string
	 */
	function getPagedTitle($title)
	{
		global $paged;
		if (is_paged())
		{
			$part = get_option('izioseo_format_title_paged', ' - Seite %page%');
			if (! empty($part))
			{
				$part = str_replace('%page%', $paged, trim($part));
			}
			else
			{
				$part = '';
			}
			if (substr_count($title, '%page%'))
			{
				$title = str_replace('%page%', $part, trim($title));
			}
			else
			{
				$title .= ' ' . $part;
			}
		}
		else
		{
			$title = str_replace('%page%', '', trim($title));
		}
		return $title;
	}

	/**
	 * ist eine statische Seite die Startseite
	 *
	 * @return boolean
	 */
	function isStaticFrontpage()
	{
		$post = $this->getCurPost();
		return get_option('show_on_front') == 'page' && is_page() && $post->ID == get_option('page_on_front');
	}

	/**
	 * ist eine statische Seite die Seite mit dem Blog
	 *
	 * @return boolean
	 */
	function isStaticPostpage()
	{
		$post = $this->getCurPost();
		return get_option('show_on_front') == 'page' && is_home() && $post->ID == get_option('page_for_posts');
	}

	/**
	 * die Funktion fuer den Headerbereich
	 *
	 * @return boolean
	 */
	function meta()
	{
		$header = '';
		$post = $this->getCurPost();

		// Feeds ausschliessen
		if (is_feed())
		{
			return false;
		}

		// Titel umschreiben
		if (get_option('izioseo_rewrite_titles') == 'on')
		{
			ob_end_flush();
		}

		$webmastertools = $this->getWebmasterTools(); // Webmastertools
		$analytics = $this->getAnalyticsCode(); // Analytics Code generieren

		// Wenn die METAs fuer die Seite/den Post deaktiviert sind
		if ((is_single() || is_page()) && (get_post_meta($post->ID, 'izioseo_post_disable') == 'on' || get_post_meta($post->ID, 'aiosp_disable', true) == 'on'))
		{
			if (! empty($webmastertools) && strlen(trim($webmastertools)))
			{
				$header .= "\t<meta name=\"verify-v1\" content=\"" . $webmastertools . "\" />\r\n";
			}
			if (! empty($analytics) && strlen(trim($analytics)))
			{
				$header .= "\r\n" . $analytics . "\r\n";
			}

			$header .= $this->getBrand();

			// ausgeben des Headerbereiches
			if (strlen(trim($header)))
			{
				echo "\r\n" . $header . "\r\n";
			}
			return true;
		}
		$description = $this->getDescription(); // Description holen
		$keywords = $this->getKeywords(); // Keywords holen
		$robots = $this->getRobots(); // Robots holen
		$noodp = $this->getNoOdp(); // Open Directory Project Robots
		if ($noodp)
		{
			$robots .= ',' . $noodp;
		}
		$robots = trim($robots, ',');

		if (! empty($description) && strlen(trim($description)))
		{
			$header .= "\t<meta name=\"description\" content=\"" . $description . "\" />\r\n";
		}
		if (! empty($keywords) && strlen(trim($keywords)))
		{
			$header .= "\t<meta name=\"keywords\" content=\"" . $keywords . "\" />\r\n";
		}
		if (! empty($robots) && strlen(trim($robots)))
		{
			$header .= "\t<meta name=\"robots\" content=\"" . $robots . "\" />\r\n";
		}
		if (! empty($webmastertools) && strlen(trim($webmastertools)))
		{
			$header .= "\t<meta name=\"verify-v1\" content=\"" . $webmastertools . "\" />\r\n";
		}
		if (! empty($analytics) && strlen(trim($analytics)))
		{
			$header .= "\r\n" . $analytics . "\r\n";
		}

		$header .= $this->getBrand();

		// ausgeben des Headerbereiches
		if (strlen(trim($header)))
		{
			echo "\r\n" . $header . "\r\n";
		}
		return true;
	}

	/**
	 * baue den Code fuer die Webmastertools zusammen
	 *
	 * @return string
	 */
	function getWebmasterTools()
	{
		$trackingId = trim(get_option('izioseo_wptools'));
		if (strlen($trackingId) >= 44)
		{
			return $trackingId;
		}
	}

	/**
	 * baut den Analytics Code zusammen und gibt diesen zurueck
	 *
	 * @return string
	 */
	function getAnalyticsCode()
	{
		$trackingId = get_option('izioseo_analytics_tracking_id');
		if (! empty($trackingId) && preg_match('/UA-(.*)-(.*)/', $trackingId))
		{
			$type = strtolower(get_option('izioseo_analytics_type', 'urchin'));
			if ($type == 'urchin')
			{
				return '	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
	<script type="text/javascript">
	<!--
		_uacct = "' . $trackingId . '";
		urchinTracker();
	//-->
	</script>';
			}
			elseif ($type == 'ga')
			{
				return '	<script type="text/javascript">
	<!--
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
	//-->
	</script>
	<script type="text/javascript">
	<!--
		var pageTracker = _gat._getTracker("' . $trackingId . '");
		pageTracker._trackPageview();
	//-->
	</script>';
			}
		}
	}

	/**
	 * Setzen des Brandings
	 *
	 * @return string
	 */
	function getBrand()
	{
		if (isset($this->website) && strlen(trim($this->website)))
		{
			return "\r\n\t<!-- Suchmaschinenoptimierung durch izioSEO " . $this->version . " - " . $this->website . " //-->";
		}
		return '';
	}

	/**
	 * gibt die seitenspezifischen META-Robots zurueck
	 *
	 * @return string
	 */
	function getRobots()
	{
		$robots = null;
		$post = $this->getCurPost();
		if (isset($post->ID) && $post->ID && !is_archive())
		{
			$robots = get_post_meta($post->ID, 'izioseo_post_robots', true);
		}
		if (empty($robots))
		{
			if (is_home() || $this->isStaticFrontpage() || $this->isStaticFrontpage())
			{
				$robots = get_option('izioseo_robots_home', 'index,follow');
			}
			elseif (is_single())
			{
				$robots = get_option('izioseo_robots_post', 'index,follow');
			}
			elseif (is_page())
			{
				$robots = get_option('izioseo_robots_page', 'index,follow');
			}
			elseif (is_search())
			{
				$robots = get_option('izioseo_robots_search', 'noindex,follow');
			}
			elseif (is_category())
			{
				$robots = get_option('izioseo_robots_category', 'noindex,follow');
			}
			elseif (is_tag())
			{
				$robots = get_option('izioseo_robots_tag', 'noindex,follow');
			}
			elseif (is_archive())
			{
				$robots = get_option('izioseo_robots_archive', 'noindex,follow');
			}
			elseif (is_404())
			{
				$robots = get_option('izioseo_robots_404', 'noindex,follow');
			}
			else
			{
				$robots = 'noindex,follow';
			}
		}
		if ($robots != 'index,follow')
		{
			return strtolower($robots);
		}
		return null;
	}

	/**
	 * hole die Robots fuer das Open Directory Project
	 *
	 * @return string
	 */
	function getNoOdp()
	{
		$post = $this->getCurPost();
		if ((is_object($post) && isset($post->ID) && get_post_meta($post->ID, 'izioseo_post_noodp', true) == 'on') || get_option('izioseo_robots_noodp', true) == 'on')
		{
			return 'noodp';
		}
	}

	/**
	 * Holen der META-Description
	 *
	 * @return string
	 */
	function getDescription()
	{
		if (! is_paged())
		{
			if ((is_home() && ! $this->isStaticPostpage()) || $this->isStaticFrontpage())
			{
				$description = get_option('izioseo_description');
				if (empty($description))
				{
					$description = get_option('aiosp_home_description');
				}
			}
			elseif (is_single() || is_page())
			{
				$post = $this->getCurPost();
				$description = get_post_meta($post->ID, 'izioseo_post_description', true);
				if (empty($description))
				{
					$description = get_post_meta($post->ID, 'description', true);
				}
			}
			elseif (is_category())
			{
				$description = category_description();
			}
			if (empty($description))
			{
				$post = $this->getCurPost();
				$use = isset($post->ID) ? $this->getUse($post->ID) : null;
				if ($use == 'generate')
				{
					$description = $this->generateDescription();
				}
				elseif ($use == 'default')
				{
					$description = get_option('izioseo_description');
					if (empty($description))
					{
						$description = get_option('aiosp_home_description');
					}
				}
				else
				{
					$description = '';
				}
			}
		}
		if (isset($description) && strlen(trim($description)))
		{
			$description = $this->setFormat($description);
			return $this->cleanDescription($description);
		}
	}

	/**
	 * holt den die Behandlung der META-Tags fuer einen bestimmten Post oder eine Seite
	 *
	 * @param integer $postId
	 * @return string
	 */
	function getUse($postId)
	{
		$use = get_post_meta($postId, 'izioseo_post_use', true);
		if (empty($use))
		{
			$use = get_option('izioseo_use_default');
		}
		return strtolower($use);
	}

	/**
	 * generiert die Beschreibung zu einem Post oder einer Seite
	 *
	 * @return string
	 */
	function generateDescription()
	{
		global $posts;
		$description = '';
		if (is_array($posts) && count($posts) > 0)
		{
			// Sammeln der Texte
			$title = array();
			$content = array();
			foreach ($posts as $post)
			{
				if ($post)
				{
					$title[] = $post->post_title;
					$content[] = $post->post_content;
				}
			}
			if (count($title) > 0 && count($content) > 0)
			{
				$keywords = $this->extractKeywords(implode(' ', $title) . ' ' . implode(' ', $content));
				$description = $this->extractDescription(implode(' ', $content), $keywords);
			}
			if (strlen(trim($description)) < get_option('izioseo_lenght_description_min', 100))
			{
				$description = $this->cleanDescription(implode(' ', $content));
			}
		}
		return $description;
	}

	/**
	 * Extrahiert aus einem laengeren Text eine META-Beschreibung
	 *
	 * @param string $text
	 * @param array $keywords
	 */
	function extractDescription($text, $keywords)
	{
		$text = $this->stripHtml($text);
		$split = explode('. ', $this->encodeAcronyms($text));
		$sentences = array();
		foreach ($split as $row)
		{
			$sum = 0;
			foreach ($keywords as $word)
			{
				if (strlen(trim($row)) && strlen(trim($word)))
				{
					$sum += substr_count($row, $word);
				}
			}
			$sentences[$sum] = trim($row);
		}
		arsort($sentences);
		$description = array();
		foreach ($sentences as $sentence)
		{
			if (strlen(trim($sentence)))
			{
				$description[] = trim(trim($sentence, '.'));
			}
			$join = implode('. ', $description);
			if (strlen(trim($join)) > get_option('izioseo_lenght_description', 170))
			{
				break;
			}
		}
		if (count($description))
		{
			$description = implode('. ', $description);
			$description = str_replace(' ,', ',', $description);
			$description = str_replace(' .', '.', $description);
			$description = str_replace(',,', ',', $description);
			$description = str_replace('..', '.', $description);
			return $this->decodeAcronyms($description);
		}
	}

	/**
	 * ersetzt alle Acronyme in einem Text durch einen Platzhalter
	 *
	 * @param string $text der originale Text
	 * @return text
	 */
	function encodeAcronyms($text)
	{
		$loaded = is_array($this->acronyms) && ! count($this->acronyms) ? $this->loadAcronyms() : true;
		if ($loaded)
		{
			$text = preg_replace('/([\w\x88-\xFF]+)/', '$1', $text);
			foreach ($this->acronyms as $key => $acronym)
			{
				$text = str_replace(trim(trim($acronym), '.') . '.', '{{' . $key . '}}', $text);
			}
		}
		return $text;
	}

	/**
	 * Ersetzt die Platzhalter fuer die Acronyme wieder mit den eigentlichen Acronymen
	 *
	 * @param string $text der codierte Text mit dem Platzhaltern
	 * @return string
	 */
	function decodeAcronyms($text)
	{
		$loaded = is_array($this->acronyms) && ! count($this->acronyms) ? $this->loadAcronyms() : true;
		if ($loaded)
		{
			$text = preg_replace('/([\w\x88-\xFF]+)/', '$1', $text);
			foreach ($this->acronyms as $key => $acronym)
			{
				$text = str_replace('{{' . $key . '}}', trim(trim($acronym), '.') . '.', $text);
			}
		}
		return $text;
	}

	/**
	 * bereinigt die META-Beschreibung
	 *
	 * @param string $description
	 * @return string
	 */
	function cleanDescription($description)
	{
		$description = $this->stripHTML($description);
		$description = $this->truncate($description, get_option('izioseo_lenght_description', 170));
		return trim($description);
	}

	/**
	 * definiert das Format der META-Beschreibung
	 *
	 * @param string $description
	 * @return string
	 */
	function setFormat($description)
	{
		$description = str_replace('%description%', $description, get_option('izioseo_format_description', '%description%'));
		$description = str_replace('%blog_title%', get_bloginfo('name'), $description);
		$description = str_replace('%blog_description%', get_bloginfo('description'), $description);
		$description = str_replace('%wp_title%', $this->getOriginalTitle(), $description);
		return $description;
	}

	/**
	 * den originalen Titel des Posts holen
	 *
	 * @return string
	 */
	function getOriginalTitle()
	{
		global $s;

		$post = $this->getCurPost();
		if (is_home())
		{
			return get_option('blogname');
		}
		else if (is_single() || is_page() || is_archive() || is_tag())
		{
			return wp_title('', false);
		}
		elseif (is_search() && isset($s) && ! empty($s))
		{
			$search = function_exists('attribute_escape') ? attribute_escape(stripcslashes($s)) : wp_specialchars(stripcslashes($s), true);
			return $this->capitalize($search);
		}
		elseif (is_category() && ! is_feed())
		{
			return ucwords(single_cat_title('', false));
		}

		// Defaulttitle nehmen (eigentlich 404 Fehlerseite) und das Format dazu setzen
		$format = get_option('izioseo_formate_404_title');
		$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
		$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
		$title = str_replace('%request_url%', $this->url, $title);
		$title = str_replace('%request_words%', $this->getRequest($this->url), $title);
		return $title;
	}

	/**
	 * holt alle Keywords zu dem Post oder der Seite
	 *
	 * @return string
	 */
	function getKeywords()
	{
		$post = $this->getCurPost();
		$default = get_option('izioseo_keywords');
		if (empty($default))
		{
			$default = get_option('aiosp_home_keywords');
		}
		if (! is_paged() && ! is_404() && isset($post->ID) && $this->getUse($post->ID) != 'none')
		{

			if ((is_home() || $this->isStaticFrontpage()) && $default && ! $this->isStaticPostpage())
			{
				$keywords = $default;
			}
			else
			{
				$keywords = $this->getAllKeywords($default);
			}
		}
		else
		{
			$keywords = '';
		}
		return $this->cleanKeywords($keywords);
	}

	/**
	 * Holt alle Keywords fuer die Seite
	 *
	 * @param string $default
	 * @return string $keywords
	 */
	function getAllKeywords($default)
	{
		global $posts;

		$keywords = array();
		if (is_array($posts) && count($posts) > 0)
		{
			foreach ($posts as $post)
			{
				if ($post)
				{
					// die angegebenen Keywords des Posts holen
					if ($postKeywords = get_post_meta($post->ID, 'izioseo_post_keywords', true))
					{
						$list = explode(',', $this->stripHtml($postKeywords));
						foreach ($list as $keyword)
						{
							if (! in_array($keyword, $keywords))
							{
								$keywords[] = trim($keyword);
							}
						}
					}
					// optionales Feld "keywords" mit einbeziehen, da andere Plugins dieses nutzen, u.a. All In One SEO
					if ($postKeywords = get_post_meta($post->ID, 'keywords', true))
					{
						$list = explode(',', $this->stripHtml($postKeywords));
						foreach ($list as $keyword)
						{
							if (! in_array($keyword, $keywords))
							{
								$keywords[] = trim($keyword);
							}
						}
					}
					// Tags des Posts holen
					if (function_exists('get_the_tags') && get_option('izioseo_use_tags') == 'on')
					{
						$tags = get_the_tags($post->ID);
						if (is_array($tags) && count($tags))
						{
							foreach ($tags as $tag)
							{
								if (! in_array($tag->name, $keywords))
								{
									$keywords[] = utf8_decode($tag->name);
								}
							}
						}
					}
					// Kategorien mit in die Keywords mit einbeziehen
					if (get_option('izioseo_use_categories') == 'on' && ! is_page())
					{
						$categories = get_the_category($post->ID);
						foreach ($categories as $category)
						{
							if (! in_array($category->cat_name, $keywords))
							{
								$keywords[] = utf8_decode($category->cat_name);
							}
						}
					}
				}
			}
		}
		// wenn keine Keywords vorhanden sind, wie sich izioSEO verhalten soll bzw. wenn zu wenige vorhanden sind
		if (is_array($keywords) && count($keywords) < get_option('izioseo_lenght_keywords', 6))
		{
			$use = $this->getUse($post->ID);
			if ($use == 'default' && ! count($keywords))
			{
				$keywords = explode(',', $this->stripHtml($default));
			}
			elseif ($use == 'generate' && is_array($posts) && count($posts) > 0)
			{
				foreach ($posts as $post)
				{
					if ($post)
					{
						$generate = $this->extractKeywords($post->post_content);
						$keywords = array_merge($keywords, $generate);
						$keywords = array_merge($keywords, explode(',', $this->stripHtml($default)));
					}
				}
			}
		}
		return $this->uniqueKeywords($keywords, get_option('izioseo_lenght_keywords', 6));
	}

	/**
	 * vergleicht alle gesammelten Keywords und hol nur einmal jedes Keyword
	 *
	 * @param array $keywords
	 * @param integer $len
	 * @return string
	 */
	function uniqueKeywords($keywords, $len = false)
	{
		$small = array();
		foreach ($keywords as $word)
		{
			$small[] = utf8_encode(strtolower($word));
		}
		$small = array_unique($small);
		if ($len)
		{
			$small = array_slice($small, 0, $len);
		}
		return implode(', ', $small);
	}

	/**
	 * formatiert die Keywords nach dem Format: keyword1, keyword2, keyword3, ...
	 *
	 * @param string $keywords
	 * @return string
	 */
	function cleanKeywords($keywords)
	{
		$keywords = utf8_decode($keywords);
		$keywords = $this->stripHtml($keywords);
		$keywords = explode(', ', $keywords);
		$keywords = implode(', ', $keywords);
		$keywords = utf8_encode($keywords);
		return $keywords;
	}

}
