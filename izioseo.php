<?php

/*
Plugin Name: izioSEO
Plugin URI: http://www.goizio.com/izioseo/
Description: Ein umfangreiches Plugin zur Suchmaschinenoptimierung f&uuml;r Wordpress. Einfache "on-the-fly" SEO-L&ouml;sung mit vielen m&ouml;glichen <a href="options-general.php?page=izioseo/izioseo.php">Einstellungen</a>.
Version: 1.1.1
Author: Mathias 'United20' Schmidt
Author URI: http://www.goizio.com/
*/

/**
 * Options erstellen
 */
add_option('izioseo_log', 'on', 'Logs aktivieren/deaktivieren', 'yes');
add_option('izioseo_rewrite_titles', 'on', 'Umschreiben der Seitentitel', 'yes');
add_option('izioseo_title', '', 'Titel fuer die Startseite und als standard Titel', 'yes');
add_option('izioseo_keywords', '', 'Hauptkeywords fuer die Startseite und als standard Keywords', 'yes');
add_option('izioseo_description', '', 'Beschreibung fuer die Startseite und als standard Beschreibung', 'yes');
add_option('izioseo_analytics_type', 'urchin', 'Typ des Google Analytics Tracking Codes (urchin = alter Code, ga = neuer Code)', 'yes');
add_option('izioseo_analytics_tracking_id', '', 'Google Analytics Tracking ID', 'yes');
add_option('izioseo_wptools', '', 'Google Webmastertools Identifikations ID', 'yes');
add_option('izioseo_google_adsection', 'on', 'Relevante Bereiche fuer Google AdSense markieren', 'yes');
add_option('izioseo_noindex_rssfeed', 'on', 'RSS Feeds nicht fuer Suchmaschinen indizieren', 'yes');
add_option('izioseo_collect_keywords', 'off', 'Generierte Keywords in eine seperate Datei speichern', 'yes');
add_option('izioseo_lenght_description_min', '100', 'Minimale Laenge der META-Beschreibung', 'yes');
add_option('izioseo_lenght_description', '170', 'Maximale Laenge der META-Beschreibung', 'yes');
add_option('izioseo_lenght_keywords', '6', 'Anzahl der maximalen Keywords', 'yes');
add_option('izioseo_use_default', 'generate', 'Was soll als default Werte verwendet werden (none = META-Tags werden weggelassen, generate = META-Tags werden aus Text und Tags generiert, default = die Werte fuer die Startseite)', 'yes');
add_option('izioseo_use_tags', 'off', 'Tags fuer Keywords mit einbeziehen', 'yes');
add_option('izioseo_use_categories', 'off', 'Kategoriename fuer Keywords mit einbeziehen', 'yes');
add_option('izioseo_use_referers', 'off', 'Bezieht in die Generierung der Keywords den Referer mit ein', 'yes');
add_option('izioseo_format_title_post', '%post_title% - %blog_title%', 'Formatierung des Titels fuer einen Artikel', 'yes');
add_option('izioseo_format_title_page', '%page_title% - %blog_title%', 'Formatierung des Titels fuer eine Seite', 'yes');
add_option('izioseo_format_title_search', 'Suchergebnisse zu %search% - %blog_title%', 'Formatierung des Titels fuer Suchergebnisse', 'yes');
add_option('izioseo_format_title_category', '%category_title% - %blog_title%', 'Formatierung des Titels fuer eine Kategorie', 'yes');
add_option('izioseo_format_title_paged', ' - Seite %page%', 'Formatierung des zusaetzlichen Titels fuer Seitenzahlen', 'yes');
add_option('izioseo_format_title_tag', '%tag% - %blog_title%', 'Formatierung des Titels fuer einen Tag', 'yes');
add_option('izioseo_format_title_archive', '%date% - %blog_title%', 'Formatierung des Titels fuer eine Archivseite', 'yes');
add_option('izioseo_format_title_404', 'Seite %request_words% wurde nicht gefunden - %blog_title%', 'Formatierung des Titels fuer die 404 Fehlerseite', 'yes');
add_option('izioseo_format_description', '%description%', 'Formatierung der META-Beschreibung.', 'yes');
add_option('izioseo_robots_home', 'index,follow', 'META-Robots fuer den Blog', 'yes');
add_option('izioseo_robots_post', 'index,follow', 'META-Robots fuer einen Artikel', 'yes');
add_option('izioseo_robots_page', 'index,follow', 'META-Robots fuer eine Seite', 'yes');
add_option('izioseo_robots_search', 'noindex,follow', 'META-Robots fuer die Suchergebnissseiten ', 'yes');
add_option('izioseo_robots_category', 'noindex,follow', 'META-Robots fuer eine Kategorie', 'yes');
add_option('izioseo_robots_archive', 'noindex,follow', 'META-Robots fuer eine Archivseite', 'yes');
add_option('izioseo_robots_tag', 'noindex,follow', 'META-Robots fuer einen Tag', 'yes');
add_option('izioseo_robots_404', 'noindex,follow', 'META-Robots fuer die 404 Fehlerseite', 'yes');
add_option('izioseo_robots_noodp', 'off', 'META-Robots fuer das Open Directory Project', 'yes');
add_option('izioseo_nofollow_categories', 'off', 'Kategorieauflistung auf nofollow setzen', 'yes');
add_option('izioseo_nofollow_bookmarks', 'off', 'Blogroll auf nofollow setzen', 'yes');
add_option('izioseo_nofollow_tags', 'off', 'Tagcloud auf nofollow setzen', 'yes');
add_option('izioseo_redirect_permalink', 'on', '301-Weiterleitung verwenden bei geanderten Permalinks', 'yes');
add_option('izioseo_image_use', 'on', 'Suchmaschinenfreundliche Bilder verwenden', 'yes');
add_option('izioseo_image_alt', '%image_title% in %post_title%', 'Formatierung des alt-Textes eines Bildes', 'yes');

/**
 * Statusvariablen
 */
add_option('__izioseo_firstrun_v11', 'on', 'izioSEO v1.1 wurde noch nie ausgefuehrt', 'yes');
add_option('__izioseo_reset_export', '0', 'Datum des letzten Exports', 'yes');

/*
 * Initialisieren der Klasse
 */
$izioseo = new izioSEO();

/**
 * Action-Hooks setzen
 */
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
if (isset($_GET['flash']) && isset($_GET['page']) && $_GET['page'] == 'statistic')
{
	add_action('init', array($izioseo, 'flashData'), 1);
}
if (get_option('izioseo_redirect_permalink', true) == 'on')
{
	add_action('template_redirect', array($izioseo, 'redirectPermalink'));
}

add_action('init', array($izioseo, 'init'));
add_action('admin_menu', array($izioseo, 'adminMenu'));
add_action('edit_post', array($izioseo, 'saveMetaTags'));
add_action('edit_page_form', array($izioseo, 'saveMetaTags'));
add_action('save_post', array($izioseo, 'saveMetaTags'));
add_action('publish_post', array($izioseo, 'saveMetaTags'));
add_action('edit_form_advanced', array($izioseo, 'addMetaTags'));
add_action('edit_page_form', array($izioseo, 'addMetaTags'));

add_action('wp_head', array($izioseo, 'wp_head'), 0);
add_action('template_redirect', array($izioseo, 'template_redirect'));
add_action('rss_head', array($izioseo, 'noindexRSSFeed'));
add_action('rss2_head', array($izioseo, 'noindexRSSFeed'));

/**
 * Filter setzen
 */
add_filter('the_content', array($izioseo, 'setGoogleAdsFilter'));
add_filter('the_content', array($izioseo, 'seoImages'), 1000000);
if ((float)substr($izioseo->wpVersion, 0, 3) >= 2.7)
{
	add_filter('contextual_help', array($izioseo, 'showHelp'));
}
if (get_option('izioseo_nofollow_categories', true) == 'on')
{
	add_filter('wp_list_categories', array($izioseo, 'setNofollowLinks'));
	add_filter('the_category', array($izioseo, 'setNofollowLinks'));
}
if (get_option('izioseo_nofollow_bookmarks', true) == 'on')
{
	add_filter('wp_list_bookmarks', array($izioseo, 'setNofollowLinks'));
}
if (get_option('izioseo_nofollow_tags', true) == 'on')
{
	add_filter('wp_generate_tag_cloud', array($izioseo, 'setNofollowLinks'));
}

/**
 * Umlaute aus URL's entfernen
 */
remove_filter('sanitize_title', 'sanitize_title_with_dashes');
add_filter('sanitize_title', array($izioseo, 'cleanPermalink'));

/**
 * izioSEO Klasse
 *
 * @author Mathias Schmidt
 */
class izioSEO
{

	/**
	 * aktuelle Version
	 *
	 * @var string
	 */
	var $version = '1.1.1';

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
	 * Worpress Version
	 *
	 * @var string
	 */
	var $wpVersion = null;

	/**
	 * Log-System benutzen
	 *
	 * @var boolean
	 */
	var $useLog = false;

	/**
	 * Log-System benutzen
	 *
	 * @var boolean
	 */
	var $logFile = '/izioseo.log';

	/**
	 * maximale Laenge der META-Beschreibung
	 *
	 * @var integer
	 */
	var $minDescrLen = 100;

	/**
	 * maximale Laenge der META-Beschreibung
	 *
	 * @var integer
	 */
	var $descrLen = 170;

	/**
	 * maximale Anzahl an Keywords fuer die META-Keywords
	 *
	 * @var integer
	 */
	var $keywordLen = 6;

	/**
	 * Stopwords
	 *
	 * @var array
	 */
	var $stopwords = array();

	/**
	 * Akronyme
	 *
	 * @var array
	 */
	var $acronyms = array();

	/**
	 * die gesammelten Keywords
	 *
	 * @var array
	 */
	var $keywords = array();

	/**
	 * Datei mit den Akronymen
	 *
	 * @var string
	 */
	var $acronymList = '/acronyms.txt';

	/**
	 * Datei fuer die Keywords
	 *
	 * @var string
	 */
	var $keywordList = '/keywords.txt';

	/**
	 * Datei mit den Stopwords
	 *
	 * @var string
	 */
	var $stopwordList = '/stopwords.txt';

	/**
	 * Variable mit den Daten des aktuellen Posts
	 *
	 * @var array
	 */
	var $post = null;

	/**
	 * Variable mit den Daten des Autors
	 *
	 * @var array
	 */
	var $author = null;

	/**
	 * aktuellen Kategorien
	 *
	 * @var array
	 */
	var $categories = null;

	/**
	 * das Datenbankobjekt von Wordpress
	 *
	 * @var object
	 */
	var $db = null;

	/**
	 * Bilder Pfad
	 *
	 * @var string
	 */
	var $images = '/images/';

	/**
	 * aktuelle Referer URL
	 *
	 * @var string
	 */
	var $referer = null;

	/**
	 * aktuelle Referer URL
	 *
	 * @var string
	 */
	var $url = null;

	/**
	 * Toplevel Domains laenger als zwei Zeichen
	 *
	 * @var string
	 */
	var $tlds = 'aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel';

	/**
	 * Template fuer das Backend
	 *
	 * @var string
	 */
	var $template = '2.7';

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
		$this->getWordpressVersion();
		$this->initWpDB();
		$this->firstrun();
		$this->setLenght();
		$this->activateLog();
		$this->setImagesDir();
		$this->getCurUrl();
		$this->getReferer();
	}

	/**
	 * Wordpressversion holen
	 */
	function getWordpressVersion()
	{
		global $wp_version;
		$this->wpVersion = $wp_version;
	}

	/**
	 * initialisieren des Datenbankobjektes
	 */
	function initWpDB()
	{
		global $wpdb;
		if (! defined('DB_PREFIX'))
		{
			define('DB_PREFIX', $wpdb->prefix);
		}
		$this->db = $wpdb;
	}

	/**
	 * fuehrt einen MySQL-Query aus
	 *
	 * @param string $query
	 * @return ressource
	 */
	function query($query)
	{
		return $this->db->query($this->replacePrefix($query));
	}

	/**
	 * Loeschen eines oder mehrerer Datensaetze aus der Datenbank
	 *
	 * @param string $table
	 * @param string $where
	 * @return integer
	 */
	function delete($table, $where)
	{
		return $this->query('DELETE FROM ' . $table . ' WHERE ' . $where);
	}

	/**
	 * Update eines Datensatzes
	 *
	 * @param string $table
	 * @param string/array $fields
	 * @param string $where
	 * @return integer
	 */
	function update($table, $fields, $where)
	{
		$query = 'UPDATE ' . $table . ' SET ';
		if (is_array($fields))
		{
			$values = array();
			foreach ($fields as $field => $value)
			{
				$values[] = $field . '="' . addslashes($value) . '"';
			}
			$query .= implode(',', $values);
		}
		else
		{
			$query .= $fields . ' ';
		}
		$query .= $where;
		return $this->query($query);
	}

	/**
	 * Fuegt einen Datensatz in eine Datenbanktabelle ein
	 *
	 * @param string $table
	 * @param array $fields
	 * @param array $options
	 * @return integer
	 */
	function insert($table, $fields, $options = array())
	{
		$query = 'INSERT ';
		if (isset($options['ignore']) && $options['ignore'] == true)
		{
			$query .= 'IGNORE ';
		}
		$query .= 'INTO ' . $table . ' SET ';
		$queryFields = array();
		foreach ($fields as $key => $value)
		{
			if (preg_match('/^[0-9]+$/', $key))
			{
				$queryFields[] = addslashes($value);
			}
			else
			{
				$queryFields[] = $key . '="' . addslashes($value) . '"';
			}
		}
		$this->query($query . implode(', ', $queryFields));
		return mysql_insert_id();
	}

	/**
	 * gibt die Resultate eines Queries zurueck
	 *
	 * @param string $query
	 * @return array
	 */
	function fetchResults($query)
	{
		return $this->db->get_results($this->replacePrefix($query));
	}

	/**
	 * gibt einen Wert eines Queries zurueck
	 *
	 * @param string $query
	 * @return mixed
	 */
	function fetchOne($query)
	{
		return $this->db->get_var($this->replacePrefix($query));
	}

	/**
	 * ersetzen des Platzhalters # in einem Query
	 *
	 * @param string $query
	 * @return string
	 */
	function replacePrefix($query)
	{
		return str_replace('#', DB_PREFIX, $query);
	}

	/**
	 * Es werden diverse Funktionen beim ersten Aufruf der jeweiligen Version ausgefuehrt
	 */
	function firstrun()
	{
		if ((float)$this->version >= 1.1 && get_option('__izioseo_firstrun_v11') == 'on')
		{
			// Options und Post-Options updaten
			$adsection = get_option('izioseo_google_adsection', true);
			$image = array(
				'use' => get_option('izioseo_image_use', true),
				'alt' => get_option('izioseo_image_alt', '%image_title% in %post_title%')
			);
			$posts = $this->fetchResults('SELECT DISTINCT post_id FROM #postmeta WHERE meta_key="izioseo_post_disable" AND meta_value="off"');
			foreach ($posts as $post)
			{
				add_post_meta($post->post_id, 'izioseo_post_google_adsection', $adsection, true);
				add_post_meta($post->post_id, 'izioseo_post_image_use', $image['use'], true);
				add_post_meta($post->post_id, 'izioseo_post_image_alt', $image['alt'], true);
			}

			// Tabellen erstellen
			if (! is_int($this->query('SELECT * FROM #izioseo_referers')))
			{
				$this->query('
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
			if (! is_int($this->query('SELECT * FROM #izioseo_referers_keywords')))
			{
				$this->query('
					CREATE TABLE IF NOT EXISTS #izioseo_referers_keywords (
						referer_id int(10) unsigned NOT NULL default "0",
						referer_keyword varchar(255) NOT NULL,
						UNIQUE KEY izioseo_unique_keyword (referer_id,referer_keyword)
					) ENGINE=MyISAM DEFAULT CHARSET=' . DB_CHARSET . ';
				');
			}

			// Status setzen
			update_option('__izioseo_firstrun_v11', 'off');
		}
	}

	/**
	 * setzen der Laenge fuer Beschreibung und Keywords
	 */
	function setLenght()
	{
		$this->minDescrLen = get_option('izioseo_lenght_description_min', 100);
		$this->descrLen = get_option('izioseo_lenght_description', 170);
		$this->keywordLen = get_option('izioseo_lenght_keywords', 6);
	}

	/**
	 * das Logsystem aktivieren und den Logfile setzen
	 */
	function activateLog()
	{
		$this->useLog = (get_option('izioseo_log') > 0);
		$this->logFile = dirname(__FILE__) . '/' . trim($this->logFile, '/');
	}

	/**
	 * setzt den Pfad zu den Bildern fuer izioSEO
	 *
	 * @return string
	 */
	function setImagesDir()
	{
		$this->images = WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/' . trim($this->images, '/') . '/';
		return $this->images;
	}

	/**
	 * holt die aktuelle Url ohne die Domain
	 *
	 * @return string
	 */
	function getCurUrl()
	{
		$this->url = addslashes($_SERVER['REQUEST_URI']);
		return $this->url;
	}

	/**
	 * gibt den Referer einer externen URL zurueck
	 *
	 * @return string
	 */
	function getReferer()
	{
		$blogUrl = get_option('siteurl');
		if (
			$blogUrl &&
			isset($_SERVER['HTTP_REFERER']) &&
			strlen(trim($_SERVER['HTTP_REFERER'])) &&
			substr($_SERVER['HTTP_REFERER'], 0, strlen($blogUrl)) != $blogUrl &&
			substr($_SERVER['HTTP_REFERER'], 0, strlen(str_replace('www.', '', $blogUrl))) != str_replace('www.', '', $blogUrl) &&
			preg_match($this->TmplUrl(), $_SERVER['HTTP_REFERER'])
		)
		{
			$this->referer = $_SERVER['HTTP_REFERER'];
			$search = $this->analyseReferer($this->referer);
			if (! empty($search))
			{
				$this->saveSearchKeywords($search);
			}
			elseif (!$this->isSearchengine($this->referer))
			{
				$this->saveReferer();
			}
			return $this->referer;
		}
		return null;
	}

	/**
	 * gibt den RegEx fuer eine Url zurueck
	 *
	 * @return string
	 */
	function TmplUrl()
	{
		return '/^((https?|news):\/\/)?([a-zA-Z]([a-zA-Z0-9\-]*\.)+([a-z]{2}|' . $this->tlds . ')|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-zA-Z0-9_\-\.~]+)*(\/([a-zA-Z0-9_\-\.]*)(\?[a-zA-Z0-9+_\-\.%=&amp;]*)?)?(#[a-zA-Z][a-zA-Z0-9_]*)?$/';
	}

	/**
	 * Ueberprueft, ob der Referer eine Suchmaschine ist
	 *
	 * @param string $referer
	 * @return boolean
	 */
	function isSearchengine($referer)
	{
		$domain = explode('/', $referer);
		for($n = 0; $n < count($this->searchengines); $n++)
		{
		    if (eregi($this->searchengines[$n][0], $referer))
		    {
				return true;
		    }
		}
		return false;
	}

	/**
	 * Holt wichtige Keywords aus dem Referer und wichtet bestehende Keywords staerker als alle anderen
	 *
	 * @param array $keywords
	 * @return array
	 */
	function getRefererKeywords($keywords)
	{
		$referers = $this->fetchResults('SELECT referer_keyword, COUNT(referer_keyword) AS referer_keyword_count FROM #izioseo_referers_keywords AS rk INNER JOIN #izioseo_referers AS r ON r.referer_id=rk.referer_id WHERE r.post_url="' . $this->url . '" GROUP BY rk.referer_keyword');
		$weighting = 1 / array_sum($keywords);
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
	 * speichert den Suchstring in der Datenbank und extrahiert daraus alle Relevanten Keywords
	 *
	 * @param array $search
	 */
	function saveSearchKeywords($search)
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
			$id = $this->insert('#izioseo_referers', $insert, array('ignore' => true));
			if ($id)
			{
				foreach ($keywords as $keyword)
				{
					$insert = array(
						'referer_id' => $id,
						'referer_keyword' => utf8_encode($keyword)
					);
					$this->insert('#izioseo_referers_keywords', $insert, array('ignore' => true));
				}
			}
		}
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
		return $this->insert('#izioseo_referers', $insert, array('ignore' => true));
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
	 * die Funktion fuer den Headerbereich
	 *
	 * @return boolean
	 */
	function wp_head()
	{
		$header = '';
		$post = $this->getCurPost();

		// Feeds ausschliessen
		if (is_feed())
		{
			return false;
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

			// diese Zeile und den Inhalt der Funktion setAuthor() unberuehrt lassen und nicht entfernen oder aendern
			$header .= $this->setAuthor();

			// ausgeben des Headerbereiches
			if (strlen(trim($header)))
			{
				echo "\r\n" . $header . "\r\n";
			}
			return true;
		}

		// Titel umschreiben
		if (get_option('izioseo_rewrite_titles') == 'on')
		{
			if (function_exists('ob_list_handlers'))
			{
				$handlers = ob_list_handlers();
			}
			else
			{
				$handlers = array();
			}
			if (sizeof($handlers) > 0 && strtolower($handlers[count($handlers) - 1]) == strtolower('izioSEO::outputCallbackForTitle'))
			{
				ob_end_flush();
			}
			else
			{
				$this->log('error', __('Probleme mit einem anderen Plugin', 'izioseo'));
				$this->ob_start_detected = true;
				if (function_exists('ob_list_handlers'))
				{
					foreach (ob_list_handlers() as $handler)
					{
						$this->log('attention', __('Weitere Output-Handler vorhanden:', 'izioseo') . ' ' . $handler);
					}
				}
			}
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

		// diese Zeile und den Inhalt der Funktion setAuthor() unberuehrt lassen und nicht entfernen oder aendern
		$header .= $this->setAuthor();

		// ausgeben des Headerbereiches
		if (strlen(trim($header)))
		{
			echo "\r\n" . $header . "\r\n";
		}
		return true;
	}

	/**
	 * umschreiben des Titels
	 *
	 * @return boolean
	 */
	function template_redirect()
	{
		$post = $this->getCurPost();
		if (is_feed())
		{
			return false;
		}
		if (get_option('izioseo_rewrite_titles') == 'on')
		{
			ob_start(array($this, 'outputCallbackForTitle'));
		}
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
		if (empty($this->author) || $reload)
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
	 * der Calback fuer den Titel
	 *
	 * @return string
	 */
	function outputCallbackForTitle($content)
	{
		return $this->rewriteTitle($content);
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

		// Plugin "Simple Tagging"
		global $STagging;

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
			$title = get_post_meta($post->ID, 'izioseo_post_title', true);
			if (! $title)
			{
				$title = get_post_meta($post->ID, 'title', true);
				if (! $title)
				{
					$title = get_post_meta($post->ID, 'izioseo_post_title_tag', true);
					if (! $title)
					{
						$title = wp_title('', false);
					}
				}
			}
			$format = get_option('izioseo_format_title_post', '%post_title% - %blog_title%');
			$new = str_replace('%blog_title%', get_bloginfo('name'), $format);
			$new = str_replace('%blog_description%', get_bloginfo('description'), $new);
			$new = str_replace('%post_title%', $title, $new);
			$new = str_replace('%category%', $category, $new);
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
			$title = get_post_meta($post->ID, 'izioseo_post_title', true);
			if (! $title)
			{
				$title = get_post_meta($post->ID, 'title', true);
				if (! $title)
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
		elseif (function_exists('is_tag') && is_tag()) // Tags
		{
			$tag = wp_title('', false);
			if ($tag)
			{
				$tag = $this->capitalize($tag);
				$format = get_option('izioseo_format_title_tag', '%tag% - %blog_title%');
				$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
				$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
				$title = str_replace('%tag%', $tag, $title);
				$title = $this->getPagedTitle($title);
				return $this->replaceTitle($header, $title);
			}
			if (isset($STagging) && $STagging->is_tag_view()) // fuer Simple Tagging
			{
				$tag = $STagging->search_tag;
				if ($tag)
				{
					$tag = $this->capitalize($tag);
					$format = get_option('izioseo_format_title_tag', '%tag% - %blog_title%');
					$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
					$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
					$title = str_replace('%tag%', $tag, $title);
					$title = $this->getPagedTitle($title);
					return $this->replaceTitle($header, $title);
				}
			}
		}
		elseif (isset($STagging) && $STagging->is_tag_view()) // fuer Simple Tagging
		{
			$tag = $STagging->search_tag;
			if ($tag)
			{
				$tag = $this->capitalize($tag);
				$format = get_option('izioseo_format_title_tag', '%tag% - %blog_title%');
				$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
				$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
				$title = str_replace('%tag%', $tag, $title);
				$title = $this->getPagedTitle($title);
				return $this->replaceTitle($header, $title);
			}
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
			$title = str_replace('%request_words%', $this->requestAsWords($this->url), $title);
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
		$text = preg_replace('/[^0-9a-zA-Z-&.,;:#!?\/\' \x80-\xFF]/', ' ', $text);
		$text = preg_replace('/\s\s+/', ' ', $text);
		$text = str_replace(' . ', '. ', $text);
		return trim($text);
	}

	/**
	 * Zaehlt die Woerter eines Textes mit Beruecksichtigung des Zeichensatzes
	 *
	 * @param string $text
	 * @param string $charset der Typ des eingehenden Zeichensatzes
	 * @return integer
	 */
	function countWords($text, $charset = 'ISO-8859-1')
	{
		if ($charset !== 'ISO-8859-1')
		{
			$text = @iconv($charset, 'ISO-8859-1', $text);
		}
		$text = trim($text);
		$text = preg_replace('/[^\w\d]+/', ' ', $text);
		$text = preg_replace('/\s+/', ' ', $text);
		return substr_count($text, ' ');
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
	 * laden der Stopwordsliste
	 */
	function loadStopwords()
	{
		if ((empty($this->stopwords) || ! count($this->stopwords)) && file_exists(dirname(__FILE__) . '/' . trim($this->stopwordList, '/')))
		{
			$raw = file(dirname(__FILE__) . '/' . trim($this->stopwordList, '/'));
			foreach ($raw as $word)
			{
				$word = trim(utf8_encode($word));
				if (! in_array($word, $this->stopwords))
				{
					$this->stopwords[] = $word;
				}
			}
		}
	}

	/**
	 * Loggt alle Vorgaenge des Plugins
	 *
	 * @param string $type
	 * @param string $msg
	 */
	function log($type, $msg)
	{
		if ($this->useLog)
		{
			$type = str_replace('[', '(', $type);
			$type = str_replace(']', ')', $type);
			$msg = str_replace('[', '(', $msg);
			$msg = str_replace(']', ')', $msg);
			error_log('[' . date('Y-m-d H:i:s', time()) . '][' . $type . '][' . $msg . "]\n", 3, $this->logFile);
		}
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
		if (! is_paged() && ! is_404() && $this->getUse($post->ID) != 'none')
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
					$postKeywords = get_post_meta($post->ID, 'izioseo_post_keywords', true);
					if ($postKeywords)
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
					$postKeywords = get_post_meta($post->ID, 'keywords', true);
					if ($postKeywords)
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
									$keywords[] = $tag->name;
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
								$keywords[] = $category->cat_name;
							}
						}
					}
					// Ultimate Tag Warrior
					global $utw;
					if ($utw)
					{
						$tags = $utw->GetTagsForPost($post);
						if (is_array($tags))
						{
							foreach ($tags as $tag)
							{
								$keywords[] = stripcslashes($tag);
							}
						}
					}
				}
			}
		}
		// wenn keine Keywords vorhanden sind, wie sich izioSEO verhalten soll bzw. wenn zu wenige vorhanden sind
		if (is_array($keywords) && count($keywords) < $this->keywordLen)
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
		return $this->getUniqueKeywords($keywords, $this->keywordLen);
	}

	/**
	 * vergleicht alle gesammelten Keywords und hol nur einmal jedes Keyword
	 *
	 * @param array $keywords
	 * @param integer $len
	 * @return string
	 */
	function getUniqueKeywords($keywords, $len = false)
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
					$return[] = preg_replace('/[^0-9a-zA-Z-, \x80-\xFF]/', '', trim($word, ','));
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
	 * sammeln aller Keywords in eine Datei, damit diese dann gefiltert in die Stopwordliste hinzugefuegt werden koennen
	 *
	 * @params array $keywords
	 */
	function collectKeywords($keywords)
	{
		$this->keywordList = dirname(__FILE__) . '/' . trim($this->keywordList, '/');
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
		$hdl = @fopen($this->keywordList, 'wb');
		if ($hdl)
		{
			fputs($hdl, implode("\r\n", $file));
			fclose($hdl);
		}
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
				$use = $this->getUse($post->ID);
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
			$description = $this->setDescriptionFormat($description);
			return $this->cleanDescription($description);
		}
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
			if (strlen(trim($description)) < $this->minDescrLen)
			{
				$description = $this->truncate($this->cleanDescription(implode(' ', $content)), $this->descrLen);
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
			if (strlen(trim($join)) > $this->descrLen)
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
	 * Laden der Acronyme aus dem Dateisystem
	 *
	 * @return boolean
	 */
	function loadAcronyms()
	{
		$file = dirname(__FILE__) . '/' . trim($this->acronymList, '/');
		if (file_exists($file))
		{
			$this->acronyms = file($file);
			foreach ($this->acronyms as $key => $value)
			{
				$value = trim(utf8_encode($value));
				if (! in_array($value, $this->acronyms))
				{
					$this->acronyms[$key] = $value;
				}
			}
			return true;
		}
		return false;
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
				if (function_exists('str_ireplace'))
				{
					$text = str_ireplace(trim(trim($acronym), '.') . '.', '{{' . $key . '}}', $text);
				}
				else
				{
					$text = str_replace(trim(trim($acronym), '.') . '.', '{{' . $key . '}}', $text);
				}
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
				if (function_exists('str_ireplace'))
				{
					$text = str_ireplace('{{' . $key . '}}', trim(trim($acronym), '.') . '.', $text);
				}
				else
				{
					$text = str_replace('{{' . $key . '}}', trim(trim($acronym), '.') . '.', $text);
				}
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
		$description = $this->truncate($description, $this->descrLen);
		return trim($description);
	}

	/**
	 * definiert das Format der META-Beschreibung
	 *
	 * @param string $description
	 * @return string
	 */
	function setDescriptionFormat($description)
	{
		// Format holen
		$format = get_option('izioseo_format_description', '%description%');
		if (! isset($format) || empty($format))
		{
			$format = "%description%";
		}
		$description = str_replace('%description%', $description, $format);
		$description = str_replace('%blog_title%', get_bloginfo('name'), $description);
		$description = str_replace('%blog_description%', get_bloginfo('description'), $description);
		$description = str_replace('%wp_title%', $this->getOriginalTitle(), $description);
		return $description;
	}

	/**
	 * gibt die seitenspezifischen META-Robots zurueck
	 *
	 * @return string
	 */
	function getRobots()
	{
		$post = $this->getCurPost();
		$robots = null;
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
			elseif (function_exists('is_tag') && is_tag())
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
		else if (is_single() || is_page() || is_archive())
		{
			return wp_title('', false);
		}
		elseif (is_search() && isset($s) && ! empty($s))
		{
			if (function_exists('attribute_escape'))
			{
				$search = attribute_escape(stripcslashes($s));
			}
			else
			{
				$search = wp_specialchars(stripcslashes($s), true);
			}
			return $this->capitalize($search);
		}
		elseif (is_category() && ! is_feed())
		{
			$description = category_description();
			return ucwords(single_cat_title('', false));
		}
		elseif (function_exists('is_tag') && is_tag())
		{
			$tag = wp_title('', false);
			return $tag ? $tag : '';
		}

		// Defaulttitle nehmen (eigentlich 404 Fehlerseite) und das Format dazu setzen
		$format = get_option('izioseo_formate_404_title');
		$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
		$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
		$title = str_replace('%request_url%', $this->url, $title);
		$title = str_replace('%request_words%', $this->requestAsWords($this->url), $title);
		return $title;
	}

	/**
	 * Umschreiben der Request URI in Worte
	 *
	 * @param string $request
	 * @return string
	 */
	function requestAsWords($request)
	{
		$words = array();
		$request = preg_replace('/[^0-9a-zA-Z \-]/', ' ', $request);
		$request = str_replace('.html', ' ', $request);
		$request = str_replace('.htm', ' ', $request);
		$request = str_replace('.php', ' ', $request);
		$request = preg_replace('/\s\s+/', ' ', $request);
		$request = explode(' ', trim($request));
		foreach ($request as $token)
		{
			$words[] = ucwords(trim($token));
		}
		return implode(' ', $words);
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
	 * Initialisiert die Multisprachfaehigkeit
	 */
	function init()
	{
		load_plugin_textdomain('izioSeo', PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/language');
	}

	/**
	 * verknuepft die Einstellungsseite von izioSeo mit dem Menu von Wordpress
	 */
	function adminMenu()
	{
		$this->setBackendTemplate();

		add_menu_page(__('izioSEO Wordpress SEO Plugin', 'izioseo'), __('izioSEO', 'izioseo'), 100, __FILE__, array($this, 'overviewMenu'), $this->images . 'izioseo.png');
		add_submenu_page(__FILE__, __('&Uuml;bersicht', 'izioseo'), __('&Uuml;bersicht', 'izioseo'), 10, 'overview', array($this, 'overviewMenu'));
		add_submenu_page(__FILE__, __('Einstellungen', 'izioseo'), __('Einstellungen', 'izioseo'), 10, 'options', array($this, 'optionsMenu'));
		add_submenu_page(__FILE__, __('Keywords', 'izioseo'), __('Keywords', 'izioseo'), 10, 'keywords', array($this, 'keywordsMenu'));
		add_submenu_page(__FILE__, __('Statistik', 'izioseo'), __('Statistik', 'izioseo'), 10, 'statistic', array($this, 'statisticMenu'));
		add_submenu_page(__FILE__, __('robots.txt', 'izioseo'), __('robots.txt', 'izioseo'), 10, 'robots', array($this, 'robotsMenu'));
		add_submenu_page(__FILE__, __('Zur&uuml;cksetzen', 'izioseo'), __('Zur&uuml;cksetzen', 'izioseo'), 10, 'reset', array($this, 'resetMenu'));
	}

	/**
	 * Setzt den Template-Ordner fuer die entsprechende Wordpress Version
	 */
	function setBackendTemplate()
	{
		if ((float)substr($this->wpVersion, 0, 3) >= 2.7)
		{
			$this->template = '2.7';
		}
		else
		{
			wp_admin_css('dashboard');
			$this->template = '2.6';
		}
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

		// Messages
		$messages = $this->getErrorMessages();

		require_once (dirname(__FILE__) . '/templates/' . $this->template . '/overview.tpl.php');
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
		$data = array(
			'izioseo_rewrite_titles' => htmlspecialchars(stripcslashes(get_option('izioseo_rewrite_titles'))),
			'izioseo_title' => htmlspecialchars(stripcslashes(get_option('izioseo_title'))),
			'izioseo_keywords' => htmlspecialchars(stripcslashes(get_option('izioseo_keywords'))),
			'izioseo_description' => htmlspecialchars(stripcslashes(get_option('izioseo_description'))),
			'izioseo_analytics_type' => htmlspecialchars(stripcslashes(get_option('izioseo_analytics_type'))),
			'izioseo_analytics_tracking_id' => htmlspecialchars(stripcslashes(get_option('izioseo_analytics_tracking_id'))),
			'izioseo_wptools' => htmlspecialchars(stripcslashes(get_option('izioseo_wptools'))),
			'izioseo_google_adsection' => htmlspecialchars(stripcslashes(get_option('izioseo_google_adsection'))),
			'izioseo_noindex_rssfeed' => htmlspecialchars(stripcslashes(get_option('izioseo_noindex_rssfeed'))),
			'izioseo_lenght_description' => htmlspecialchars(stripcslashes(get_option('izioseo_lenght_description'))),
			'izioseo_lenght_description_min' => htmlspecialchars(stripcslashes(get_option('izioseo_lenght_description_min'))),
			'izioseo_lenght_keywords' => htmlspecialchars(stripcslashes(get_option('izioseo_lenght_keywords'))),
			'izioseo_use_default' => htmlspecialchars(stripcslashes(get_option('izioseo_use_default'))),
			'izioseo_use_tags' => htmlspecialchars(stripcslashes(get_option('izioseo_use_tags'))),
			'izioseo_use_categories' => htmlspecialchars(stripcslashes(get_option('izioseo_use_categories'))),
			'izioseo_use_referers' => htmlspecialchars(stripcslashes(get_option('izioseo_use_referers'))),
			'izioseo_format_title_post' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_post'))),
			'izioseo_format_title_page' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_page'))),
			'izioseo_format_title_search' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_search'))),
			'izioseo_format_title_category' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_category'))),
			'izioseo_format_title_paged' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_paged'))),
			'izioseo_format_title_tag' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_tag'))),
			'izioseo_format_title_archive' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_archive'))),
			'izioseo_format_title_404' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_404'))),
			'izioseo_format_description' => htmlspecialchars(stripcslashes(get_option('izioseo_format_description'))),
			'izioseo_robots_home' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_home'))),
			'izioseo_robots_post' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_post'))),
			'izioseo_robots_page' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_page'))),
			'izioseo_robots_search' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_search'))),
			'izioseo_robots_category' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_category'))),
			'izioseo_robots_archive' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_archive'))),
			'izioseo_robots_tag' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_tag'))),
			'izioseo_robots_404' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_404'))),
			'izioseo_robots_noodp' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_noodp'))),
			'izioseo_log' => htmlspecialchars(stripcslashes(get_option('izioseo_log'))),
			'izioseo_nofollow_categories' => htmlspecialchars(stripcslashes(get_option('izioseo_nofollow_categories'))),
			'izioseo_nofollow_bookmarks' => htmlspecialchars(stripcslashes(get_option('izioseo_nofollow_bookmarks'))),
			'izioseo_nofollow_tags' => htmlspecialchars(stripcslashes(get_option('izioseo_nofollow_tags'))),
			'izioseo_redirect_permalink' => htmlspecialchars(stripcslashes(get_option('izioseo_redirect_permalink'))),
			'izioseo_image_use' => htmlspecialchars(stripcslashes(get_option('izioseo_image_use'))),
			'izioseo_image_alt' => htmlspecialchars(stripcslashes(get_option('izioseo_image_alt')))
		);
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
		require_once (dirname(__FILE__) . '/templates/' . $this->template . '/options.tpl.php');
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

			$message = $this->mergeFiles($data);
		}

		$this->loadKeywords(true);
		$this->loadStopwords(true);
		$this->loadAcronyms();
		$data = array(
			'izioseo_collect_keywords' => htmlspecialchars(stripcslashes(get_option('izioseo_collect_keywords'))),
			'izioseo_file_keywords' => htmlspecialchars(stripcslashes(utf8_encode(implode("\r\n", $this->keywords)))),
			'izioseo_file_stopwords' => htmlspecialchars(stripcslashes(implode("\r\n", $this->stopwords))),
			'izioseo_file_acronyms' => htmlspecialchars(stripcslashes(implode("\r\n", $this->acronyms)))
		);
		require_once (dirname(__FILE__) . '/templates/' . $this->template . '/keywords.tpl.php');
	}

	/**
	 * speichert die Stopword-, Keyword- und Acronymlisten ab und verschmelzt diese
	 *
	 * @param array $data
	 */
	function mergeFiles($data)
	{
		$error = false;
		$files = array(
			'izioseo_file_keywords' => dirname(__FILE__) . '/' . trim($this->keywordList, '/'),
			'izioseo_file_stopwords' => dirname(__FILE__) . '/' . trim($this->stopwordList, '/'),
			'izioseo_file_acronyms' => dirname(__FILE__) . '/' . trim($this->acronymList, '/')
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
			$hdl = @fopen($file, 'wb');
			if ($hdl)
			{
				fputs($hdl, implode("\r\n", $data[$key]));
				fclose($hdl);
			}
			else
			{
				$error = true;
			}
			unset($hdl);
		}
		if ($error)
		{
			return 'error merge';
		}
		return 'success merge';
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
		$return = array_merge($arr1, $arr2);
		return array_unique($return);
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
		$export = isset($_GET['export']) ? addslashes($_GET['export']) : 'referer-csv';

		require_once (dirname(__FILE__) . '/templates/' . $this->template . '/statistics.tpl.php');
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
				$data[] = (int)$stats[$se[0]]['percent'];
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
	 * Menu zur Bearbeitung der robots.txt
	 */
	function robotsMenu()
	{
		if (isset($_POST['robotstxt']))
		{
			$message = $this->writeRobotsTxt($_POST['robotstxt']);
		}
		$robotsTxt = $this->loadRobotsTxt();
		require_once (dirname(__FILE__) . '/templates/' . $this->template . '/robots.tpl.php');
	}

	/**
	 * Menu um Benutzereinstellung zu laden, loeschen oder zurueck zu setzen
	 */
	function resetMenu()
	{
		// Importieren
		if (isset($_FILES['import']['type']) && $_FILES['import']['type'] == 'text/xml')
		{
			$xml = @file_get_contents($_FILES['import']['tmp_name']);
			if ($xml)
			{
				$count = $this->importOptions($xml);
				if ($count)
				{
					$message = 'success settings imported';
				}
				else
				{
					$message = 'error no settings imported';
				}
			}
			else
			{
				$message = 'error no import';
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

		require_once (dirname(__FILE__) . '/templates/' . $this->template . '/reset.tpl.php');
	}

	/**
	 * laedt die gesammelten Keywords in das Plugin
	 */
	function loadKeywords()
	{
		if ((empty($this->keywords) || ! count($this->keywords)) && file_exists(dirname(__FILE__) . '/' . trim($this->keywordList, '/')))
		{
			$raw = file(dirname(__FILE__) . '/' . trim($this->keywordList, '/'));
			foreach ($raw as $word)
			{
				$word = trim($word);
				if (! in_array($word, $this->keywords))
				{
					$this->keywords[] = $word;
				}
			}
		}
	}

	/**
	 * Baue das Panel fuer die Posts zusammen
	 */
	function addMetaTags()
	{
		global $post;
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
			if (strlen(trim(implode('', $data))) == 'on')
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
		$data = $this->aiospLoadPost($post->ID, $data);
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
			'none' => 'keine Nutzen',
			'default' => 'Standardwerte nutzen',
			'generate' => 'Keywords generieren'
		);
		$wpVersion = $this->wpVersion;
		require_once (dirname(__FILE__) . '/templates/' . $this->template . '/tags.tpl.php');
	}

	/**
	 * Speichern der META-Tags
	 *
	 * @param integer $id
	 */
	function saveMetaTags($id)
	{
		$data = isset($_POST['izioseo']) && is_array($_POST['izioseo']) && count($_POST['izioseo']) ? $_POST['izioseo'] : null;
		$data['izioseo_post_disable'] = !isset($data['izioseo_post_disable']) || $data['izioseo_post_disable'] == 'off' ? 'on' : 'off';
		$data['izioseo_post_google_adsection'] = isset($data['izioseo_post_google_adsection']) && $data['izioseo_post_google_adsection'] == 'on' ? 'on' : 'off';
		$data['izioseo_post_image_use'] = isset($data['izioseo_post_image_use']) && $data['izioseo_post_image_use'] == 'on' ? 'on' : 'off';
		if (! empty($id) && ! empty($data) && is_array($data))
		{
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
	 * Filterfunktion fuer die Google AdSesction
	 *
	 * @param string $data
	 * @return string
	 */
	function setGoogleAdsFilter($data = '')
	{
		$useAdSection = get_option('izioseo_google_adsection') == 'on';

		// separat fuer einen bestimmten Post ausschalten
		$post = $this->getCurPost(true);
		if (is_object($post) && isset($post->ID))
		{
			$useAdSection = get_post_meta($post->ID, 'izioseo_post_google_adsection', true) == 'on';
		}
		if ($useAdSection)
		{
			return "\n<!-- google_ad_section_start -->\n" . trim($data) . "\n<!-- google_ad_section_end -->\n";
		}
		return $data;
	}

	/**
	 * umschreiben der Bilder zu einer Suchmaschinenfreundlichen Darstellung
	 *
	 * @param string $data
	 * @return string
	 */
	function seoImages($data = '')
	{
		$useSeoImages = get_option('izioseo_image_use') == 'on';

		// separat fuer einen bestimmten Post ausschalten
		$post = $this->getCurPost(true);
		if (is_object($post) && isset($post->ID))
		{
			$useSeoImages = get_post_meta($post->ID, 'izioseo_post_image_use', true) == 'on';
		}
		if ($useSeoImages)
		{
			$data = preg_replace_callback('/<img[^>]+/', array($this, 'processSeoImages'), $data);
		}
		return $data;
	}


	/**
	 * Callback Funktion fuer die Bilder damit diese die korrekte Formatierung erhalten.
	 *
	 * @param array $matches
	 * @return string
	 */
	function processSeoImages($matches)
	{
		$author = $this->getAuthor();
		$post = $this->getCurPost(true);
		$cats = get_the_category();
		$alt = get_post_meta($post->ID, 'izioseo_post_image_alt', true);
		if (!strlen(trim($alt)))
		{
			$alt = get_option('izioseo_image_alt', '&image_title% in %post_title%');
		}

		$matches[0] = preg_replace('|"/$|', '" /', $matches[0]);
		$matches[0] = preg_replace('|"$|', '" /', $matches[0]);
		$matches[0] = preg_replace('|" $|', '" /', $matches[0]);
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
			$alt = str_replace('%image_title%', $this->requestAsWords($source[0]), $alt);
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
				$alt = str_replace('%post_title%', $post->post_title, $alt);
				$alt = str_replace('%image_title%', $this->requestAsWords($source[0]), $alt);
				$alt = str_replace('%category_title%', $cats[0]->slug, $alt);
				$alt = str_replace('%post_author%', $author->display_name, $alt);
				$alt = str_replace('"', '', $alt);
				$alt = str_replace('\'', '', $alt);

				$pieces[$key+1] = '"' . $alt . '" ';
			}
		}
		return implode('', $pieces) . ' /';
	}

	/**
	 * Setzen des Autors
	 *
	 * @return string
	 */
	function setAuthor()
	{
		if (isset($this->website) && strlen(trim($this->website)))
		{
			return "\r\n\t<!-- Suchmaschinenoptimierung durch izioSEO " . $this->version . " - " . $this->website . " //-->";
		}
		return '';
	}

	/**
	 * den RSS Feed nicht indizieren
	 */
	function noindexRSSFeed()
	{
		if (get_option('izioseo_noindex_rssfeed', true) == 'on')
		{
			echo "<xhtml:meta xmlns:xhtml=\"http://www.w3.org/1999/xhtml\" name=\"robots\" content=\"noindex\" />\n";
		}
	}

	/**
	 * Setzt alle Links des Strings auf nofollow (RegEx und Callback bei Ronald Kirschler <ronald.kirschler@absofort.de>)
	 *
	 * @param string $content
	 * @return string
	 */
	function setNofollowLinks($content)
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

		$robots = "User-agent: *\r\nDisallow:";
		$hdl = @fopen($file, 'r');
		if ($hdl)
		{
			fputs($hdl, $robots);
			fclose($hdl);
		}
		return $robots;
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
		$hdl = fopen($file, 'wb');
		if ($hdl)
		{
			fputs($hdl, $content);
			fclose($hdl);

			return 'success robots';
		}
		return 'error robots';
	}

	/**
	 * laden der zusaetzlichen Felder aus All In One Seo
	 *
	 * @param integer $id
	 * @param array $data
	 * @return array
	 */
	function aiospLoadPost($id, $data)
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
	function aiospLoadGlobals($data)
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
	 * Weiterleiten von Permalinks
	 */
	function redirectPermalink()
	{
		if (is_404())
		{
		 	$url = basename($this->url);
		 	if ($postId = $this->getPostIdByUrl($url))
		 	{
		 		$permalink = get_permalink($postId);
				header('HTTP/1.1 301 Moved Permanently');
				header('Location: ' . $permalink);
				exit;
		 	}
		}
	}

	/**
	 * Holt die ID des weiter zu leitenden Posts
	 *
	 * @param string $url
	 * @return integer
	 */
	function getPostIdByUrl($url)
	{
	 	return $this->fetchOne('SELECT ID FROM #posts WHERE post_name="' . $url . '" AND post_status="publish" ');
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
		$url = trim($this->website, '/') . '/dokumentation/' . $this->convertToUrlName($name . 'äöü') . '/';
		return '<a href="' . $url . '"><img src="' . $this->images . 'help.png" alt="' . $name . '" height="12" width="12" /></a>';
	}

	/**
	 * liest den AlexaRank ueber die API von alexa.com aus
	 *
	 * @return string
	 */
	function getAlexaRank()
	{
		$xml = @simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url=' . get_option('siteurl'));
		if (isset($xml->SD->POPULARITY['TEXT']))
		{
			return number_format($xml->SD->POPULARITY['TEXT'], 0, ',', '.');
		}
		return 'n/a';
	}

	/**
	 * gibt ein Array mit allen Fehlermeldungen und Hinweisen zurueck
	 *
	 * @return array
	 */
	function getErrorMessages()
	{
		$logs = $this->readLog();
		$warnings = $this->getTemplateWarnings();
		return array_merge($logs, $warnings);
	}

	/**
	 * liest den Error-Log von izioSEO aus und gibt diesen als Array zurueck
	 *
	 * @return array
	 */
	function readLog()
	{
		$return = array();
		if (file_exists($this->logFile))
		{
			$logs = @file($this->logFile);
			if (is_array($logs) && count($logs))
			{
				foreach ($logs as $log)
				{
					if (strlen(trim($log)))
					{
						preg_match('/\[(.*?)\]\[(.*?)\]\[(.*?)\]/si', trim($log), $matches);
						$return[] = array(
							'timestamp' => strtotime($matches[1]),
							'type' => trim($matches[2]),
							'msg' => trim($matches[3])
						);
					}
				}
			}
		}
		return $return;
	}

	/**
	 * ueberprueft das bestehende Template auf doppelte META-Daten, sowie Analytics und Webmastertools Code
	 *
	 * @return array
	 */
	function getTemplateWarnings()
	{
		$return = array();
		$html = @file_get_contents(get_option('siteurl'));
		if ($html)
		{
			$this->detectWarning($html, '/<title>(.*?)<\/title>/si', '&lt;title&gt;...&lt;/title&gt; kommt mehr als einmal bei der Ausgabe vor', &$return);
			$this->detectWarning($html, '/description[\'"]\scontent=[\'"](.*?)[\'"]/si', 'Beschreibung (&lt;meta type="description" ... /&gt;) wird mehr als einmal bei der Ausgabe verwendet', &$return);
			$this->detectWarning($html, '/keywords[\'"]\scontent=[\'"](.*?)[\'"]/si', 'Keywords (&lt;meta type="keywords" ... /&gt;) werden mehr als einmal bei der Ausgabe verwendet', &$return);
			$this->detectWarning($html, '/robots[\'"]\scontent=[\'"](.*?)[\'"]/si', 'META-Robots (&lt;meta type="robots" ... /&gt;) werden mehr als einmal bei der Ausgabe verwendet', &$return);
			$this->detectWarning($html, '/verify-v1[\'"]\scontent=[\'"](.*?)[\'"]/si', 'Das Google Webmastertools Tracking ist mehr als einmal bei der Ausgabe vorhanden', &$return);
			$trackingId = get_option('izioseo_analytics_tracking_id');
			if (strlen(trim($trackingId)) && substr_count($html, $trackingId) > 1)
			{
				$return[] = array(
					'timestamp' => time(),
					'type' => 'warning',
					'msg' => __('Es wird mehr als einmal die selbe Google Analytics Tracking ID bei der Ausgabe verwendet', 'izioseo')
				);
			}
			$trackingId = get_option('izioseo_wptools');
			if (strlen(trim($trackingId)) && substr_count($html, $trackingId) > 1)
			{
				$return[] = array(
					'timestamp' => time(),
					'type' => 'warning',
					'msg' => __('Es wird mehr als einmal die selbe Google Webmastertools Tracking ID bei der Ausgabe verwendet', 'izioseo')
				);
			}
		}
		return $return;
	}

	/**
	 * Sucht ueber einen RegEx einen bestimmten HTML-Ausschnitt in der Website und gibt eine Fehlermeldung aus, wenn
	 * diese doppelt vorkommt
	 *
	 * @param string $html
	 * @param string $regex
	 * @param string $msg
	 * @param array $return
	 */
	function detectWarning($html, $regex, $msg, &$return)
	{
		preg_match_all($regex, $html, $matches);
		if (count($matches[0]) > 1)
		{
			$return[] = array(
				'timestamp' => time(),
				'type' => 'warning',
				'msg' => __($msg, 'izioseo')
			);
		}
	}

	/**
	 * generiert eine XML-Datei mit den Einstellungen von izioSEO und stellt diese zum Download bereit
	 */
	function exportOptions()
	{
		update_option('__izioseo_reset_export', time());

		$xml = "<?xml version=\"1.0\" encoding=\"" . get_option('blog_charset', 'UTF-8') . "\"?>\n<izioseo>\n";
		$options = $this->fetchResults('SELECT option_name, option_value FROM #options WHERE option_name LIKE "izioseo_%"');
		foreach ($options as $option)
		{
			$key = $option->option_name;
			$value = stripslashes($option->option_value);
			if (preg_match('/^[0-9]*$/', $value))
			{
				$xml .= "\t<" . $key . ">" . $value . "</" . $key . ">\n";
			}
			else
			{
				$xml .= "\t<" . $key . "><![CDATA[" . $value . "]]></" . $key . ">\n";
			}
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
	function importOptions($xml)
	{
		$n = 0;
		$xml = str_replace(array('<![CDATA[', ']]>'), '', $xml);

		preg_match_all('/<(.*?)>(.*?)<\/.*?>/', $xml, $matches);

		for ($m = 0; $m < count($matches[1]); $m++)
		{
			$key = $matches[1][$m];
			$value = $matches[2][$m];
			if (substr($key, 0, 8) == 'izioseo_')
			{
				update_option($key, $value);
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
	 * setzte die Einstellungen von izioSEO auf die Standardwerte zurueck
	 *
	 * @return boolean
	 */
	function resetOptions()
	{
		if ($this->delete('#options', 'option_name LIKE "izioseo_%"'))
		{
			return true;
		}
		return false;
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
			$keyword = str_replace(';', '', $keyword);
			$csv .= implode(';', $keyword) . ";\n";
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
	 * Pruefen ob eine neue Version von izioSEO vorhanden ist und gibt die neue Versionsnummer zurueck
	 *
	 * @return string
	 */
	function newVersion()
	{
		$current = get_option('update_plugins');
		if ($current->response && isset($current->response['izioseo/izioseo.php']))
		{
			$plugin = $current->response['izioseo/izioseo.php'];
			$url = admin_url('plugin-install.php?tab=plugin-information&plugin=izioseo&TB_iframe=true&width=640&height=480');

			echo '<br /><br />';
			printf(__('There is a new version of %1$s available. <a href="%2$s" class="thickbox" title="%1$s">View version %3$s Details</a> or <a href="%4$s">upgrade automatically</a>.'), 'izioSEO', $url, $plugin->new_version, wp_nonce_url('update.php?action=upgrade-plugin&amp;plugin=izioseo', 'upgrade-plugin_izioseo'));
		}
	}

	/**
	 * gibt den Titel als saubere URL zurueck
	 *
	 * @param string $title
	 * @return string
	 */
	function cleanPermalink($title)
	{
		$title = $this->convertToUrlName($title, true);
	    return sanitize_title_with_dashes($title);
	}

}
