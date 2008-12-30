<?php

/*
Plugin Name: izioSeo
Plugin URI: http://www.goizio.com/
Description: Ein umfangreiches Plugin zur Suchmaschinenoptimierung f&uuml;r Wordpress. Einfache "on-the-fly" SEO-L&ouml;sung.
Version: 1.05
Author: Mathias 'United20' Schmidt
Author URI: http://www.goizio.com/
*/

/**
 * Options erstellen
 */
add_option('izioseo_log', 'on', 'Das Log-System von izioSEO an-/ausschalten.', 'yes');
add_option('izioseo_rewrite_titles', 'on', 'Sollen die Titel der Seiten durch izioSEO umgeschrieben werden.', 'yes');
add_option('izioseo_title', '', 'Der Titel fuer die Startseite des Blogs und als alternativer Titel fuer Unterseiten.', 'yes');
add_option('izioseo_keywords', '', 'Die META-Keywords fuer die Startseite des Blogs und als alternative Keywords fuer Unterseiten.', 'yes');
add_option('izioseo_description', '', 'Die META-Beschreibung fuer die Startseite des Blogs und als alternative Beschreibung fuer Unterseiten.', 'yes');
add_option('izioseo_lang_id', 'de', 'Die Sprache der Website. (Laenderkuerzel z.B. "de")', 'yes');
add_option('izioseo_analytics_type', 'urchin', 'Ueber welchen Trackingcode soll Google Analytics eingebunden werden. (alt = urchin, neu = ga)', 'yes');
add_option('izioseo_analytics_tracking_id', '', 'ID fuer den Trackingcode fuer das Google Analytics Tracking.', 'yes');
add_option('izioseo_wptools', '', 'Die ID fuer die Identifikation der Google Webmaster Tools.', 'yes');
add_option('izioseo_google_adsection', 'on', 'Relevante Bereiche fuer Google AdSense markieren.', 'yes');
add_option('izioseo_noindex_rssfeed', 'on', 'RSS Feeds nicht fuer Suchmaschinen indizieren.', 'yes');
add_option('izioseo_collect_keywords', 'off', 'Keywords in eine seperate Datei speichern, wo daraus Stopwords gefiltert werden koennen.', 'yes');
add_option('izioseo_lenght_description', '170', 'Maximale Laenge der META-Beschreibung.', 'yes');
add_option('izioseo_lenght_description_min', '100', 'Minimale Laenge der META-Beschreibung.', 'yes');
add_option('izioseo_lenght_keywords', '6', 'Anzahl der zu generierenden Keywords.', 'yes');
add_option('izioseo_use_default', 'generate', 'Was soll als default Werte verwendet werden. (none = META-Tags werden weggelassen, generate = META-Tags werden aus Text und Tags generiert, default = die Werte fuer die Startseite)', 'yes');
add_option('izioseo_use_tags', 'off', 'izioSeo bezieht in die Generierung der Keywords die Tags mit ein.', 'yes');
add_option('izioseo_use_categories', 'off', 'izioSEO bezieht in die Generierung der Keywords die Kategorien mit ein.', 'yes');
add_option('izioseo_format_title_post', '%post_title% - %blog_title%', 'Das Format des Titels fuer einen einzelnen Post.', 'yes');
add_option('izioseo_format_title_page', '%page_title% - %blog_title%', 'Format des Titels einer statischen Seite.', 'yes');
add_option('izioseo_format_title_search', 'Suchergebnisse zu %search% - %blog_title%', 'Das Format des Titels fuer Suchergebnisse.', 'yes');
add_option('izioseo_format_title_category', '%category_title% - %blog_title%', 'Das Format des Titels fuer eine Kategorie.', 'yes');
add_option('izioseo_format_title_paged', ' - Seite %page%', 'Der zusaetzliche Teil des Seitentitels fuer Seiten mit Seitenzahl.', 'yes');
add_option('izioseo_format_title_tag', '%tag% - %blog_title%', 'Das Format des Titels der Seite fuer einen Tag.', 'yes');
add_option('izioseo_format_title_archive', '%date% - %blog_title%', 'Die Formatierung des Archivtitels.', 'yes');
add_option('izioseo_format_title_404', 'Seite %request_words% wurde nicht gefunden - %blog_title%', 'Der Titel fuer die 404 Fehlerseite.', 'yes');
add_option('izioseo_format_description', '%description%', 'Das Format der META-Beschreibung.', 'yes');
add_option('izioseo_robots_home', 'index,follow', 'Die META-Robots fuer die Startseite bzw. den Blog.', 'yes');
add_option('izioseo_robots_post', 'index,follow', 'Die META-Robots fuer einen Blogpost.', 'yes');
add_option('izioseo_robots_page', 'index,follow', 'Die META-Robots fuer eine Seite des Blogs.', 'yes');
add_option('izioseo_robots_search', 'noindex,follow', 'Die META-Robots fuer die Suchergebnissseiten.', 'yes');
add_option('izioseo_robots_category', 'noindex,follow', 'Die META-Robots fuer die KAtegorieseiten.', 'yes');
add_option('izioseo_robots_archive', 'noindex,follow', 'Die META-Robots fuer die Archiv-Seiten.', 'yes');
add_option('izioseo_robots_tag', 'noindex,follow', 'Die META-Robots fuer die Tag-Seiten.', 'yes');
add_option('izioseo_robots_404', 'noindex,follow', 'Die META-Robots fuer die Fehlerseiten.', 'yes');
add_option('izioseo_robots_noodp', 'off', 'Die Robots fuer das Open Directory Project.', 'yes');
add_option('izioseo_robots_noydir', 'off', 'Die Robots fuer das Yahoo! Directory.', 'yes');
add_option('izioseo_nofollow_categories', 'off', 'Links der Kategorieauflistung auf nofollow setzen.', 'yes');
add_option('izioseo_nofollow_bookmarks', 'off', 'Links der Blogroll auf nofollow setzen.', 'yes');
add_option('izioseo_nofollow_tags', 'off', 'Links der Tagcloud auf auf nofollow setzen.', 'yes');
add_option('izioseo_redirect_permalink', 'on', 'Weiterleiten von geanderten Permalinks.', 'yes');


/**
 * Verwendete META-felder fuer die jeweilige Seite und den Post:
 *
 * 	izioseo_post_disable: Sollen META-Daten ueberhaupt generiert werden.
 * 	izioseo_post_title: Individueller Titel der Seite
 * 	izioseo_post_description: Individuelle Beschreibung der Seite
 * 	izioseo_post_keywords: Individuelle Keywords der Seite
 * 	izioseo_post_robots: Individuelle Robots fuer eine Seite
 * 	izioseo_post_use: gibt an wie sich izioSeo verhalten soll, wenn keine META-Daten vorhanden sind (none = kompletten META-Daten weglassen, generate = META-Daten aus Text generieren und mit default Werten und Tags kombinieren, default = die Standardwerte nutzen)
 *
 */

/*
 * Initialisieren der Klasse
 */
$izioseo = new izioSEO();
if (get_option('izioseo_redirect_permalink'))
{
	add_action('template_redirect', array($izioseo, 'redirectPermalink') );
}
add_action('wp_head', array($izioseo, 'wp_head'), 0);
add_action('template_redirect', array($izioseo, 'template_redirect'));
add_action('init', array($izioseo, 'init'));
add_action('admin_menu', array($izioseo, 'adminMenu'));
if (substr($izioseo->wpVersion, 0, 3) >= '2.5')
{
	add_action('edit_form_advanced', array($izioseo, 'addMetaTags'));
	add_action('edit_page_form', array($izioseo, 'addMetaTags'));
}
else
{
	add_action('dbx_post_advanced', array($izioseo, 'addMetaTags'));
	add_action('dbx_page_advanced', array($izioseo, 'addMetaTags'));
}
add_action('edit_post', array($izioseo, 'saveMetaTags'));
add_action('publish_post', array($izioseo, 'saveMetaTags'));
add_action('save_post', array($izioseo, 'saveMetaTags'));
add_action('edit_page_form', array($izioseo, 'saveMetaTags'));
add_action('rss_head', array($izioseo, 'noindexRSSFeed'));
add_action('rss2_head', array($izioseo, 'noindexRSSFeed'));

/**
 * Filter setzen
 */
add_filter('the_content', array($izioseo, 'setGoogleAdsFilter'));
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

class izioSEO
{

	/**
	 * aktuelle Version
	 *
	 * @var string
	 */
	var $version = '1.05';

	/**
	 * Minimale PHP 5 Version
	 *
	 * @ignore
	 * @var string
	 */
	var $requirePHPVersion = '5.0.0';

	/**
	 * PHP 5 kompatibel
	 *
	 * @ignore
	 * @var boolean
	 */
	var $php5 = false;

	/**
	 * Website of izioSEO
	 *
	 * @var string
	 */
	var $website = 'http://www.goizio.com/';

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
	var $descrLen = 170;

	/**
	 * maximale Laenge der META-Beschreibung
	 *
	 * @var integer
	 */
	var $minDescrLen = 100;

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
	 * Die aktuellen Kategorien
	 *
	 * @var array
	 */
	var $categories = null;

	/**
	 * Datei fuer die Keywords
	 *
	 * @var string
	 */
	var $keywordList = '/keywords.txt';

	/**
	 * Konstruktor der Klasse
	 */
	function izioSeo()
	{
		$this->php5 = $this->checkPHP5();

		$this->getWordpressVersion();
		$this->setLenght();
		$this->activateLog(get_option('izioseo_log', true) > 0);
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
	 * setzen der Laenge fuer Beschreibung und Keywords
	 */
	function setLenght()
	{
		$this->descrLen = get_option('izioseo_lenght_description', true);
		$this->keywordLen = get_option('izioseo_lenght_keywords', true);
		$this->minDescrLen = get_option('izioseo_lenght_description_min', true);
	}

	/**
	 * das Logsystem aktivieren und den Logfile setzen
	 *
	 * @param boolean $use soll das Log-System verwendet werden?
	 */
	function activateLog($use = false)
	{
		if ($this->useLog = $use)
		{
			$this->logFile = dirname(__FILE__) . '/' . trim($this->logFile, '/');
		}
	}

	/**
	 * die Funktion fuer den Headerbereich
	 */
	function wp_head()
	{
		$header = '';
		$post = $this->getCurPost(); // aktuellen Post holen

		// Feeds ausschliessen
		if (is_feed())
		{
			return;
		}

		$webmastertools = $this->getWebmasterTools(); // Webmastertools
		$analytics = $this->getAnalyticsCode(); // Analytics Code generieren

		// Wenn die METAs fuer die Seite/den Post deaktiviert sind
		if ((is_single() || is_page()) && (get_post_meta($post->ID, 'izioseo_post_disable', true) == 'on' || get_post_meta($post->ID, 'aiosp_disable', true) == 'on'))
		{
			if (! empty($webmastertools) && strlen(trim($webmastertools)))
			{
				$header .= "\t<meta name=\"verify-v1\" content=\"" . $webmastertools . "\" />\r\n";
			}
			if (! empty($webmastertools) && strlen(trim($webmastertools)))
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
			return;
		}

		// Titel umschreiben
		if (get_option('izioseo_rewrite_titles', true) == 'on')
		{
			if (function_exists('ob_list_handlers'))
			{
				$handlers = ob_list_handlers();
			}
			else
			{
				$handlers = array();
			}
			if (sizeof($handlers) > 0 && strtolower($handlers[count($handlers) - 1]) == strtolower('izioSeo::outputCallbackForTitle'))
			{
				ob_end_flush();
			}
			else
			{
				$this->log('error', 'another plugin interfering');
				$this->ob_start_detected = true;
				if (function_exists('ob_list_handlers'))
				{
					foreach (ob_list_handlers() as $handler)
					{
						$this->log('attention', 'detected output handler "' . $handler . '"');
					}
				}
			}
		}

		$description = $this->getDescription(); // Description holen
		$keywords = $this->getKeywords(); // Keywords holen
		$robots = $this->getRobots(); // Robots holen
		$noodp = $this->getNoOdp(); // Open Directory Project Robots
		$noydir = $this->getNoYDir(); // Yahoo Directory Robots
		$lang = $this->getLangId(); // Language der Seite holen
		if ($noodp)
		{
			$robots .= ',' . $noodp;
		}
		if ($noydir)
		{
			$robots .= ',' . $noydir;
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
		if (! empty($lang) && strlen(trim($lang)))
		{
			$header .= "\t<meta name=\"language\" content=\"" . $lang . "\" />\r\n";
		}
		if (! empty($webmastertools) && strlen(trim($webmastertools)))
		{
			$header .= "\t<meta name=\"verify-v1\" content=\"" . $webmastertools . "\" />\r\n";
		}
		if (! empty($webmastertools) && strlen(trim($webmastertools)))
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
	}

	/**
	 * umschreiben des Titels
	 */
	function template_redirect()
	{
		$post = $this->getCurPost();
		if (is_feed())
		{
			return;
		}
		if (get_option('izioseo_rewrite_titles', true) == 'on')
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
		if (empty($this->post) || $reload)
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
			$format = get_option('izioseo_format_title_post');
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
			$format = get_option('izioseo_format_title_search');
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
			$format = get_option('izioseo_format_title_category');
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
			$format = get_option('izioseo_format_title_page');
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
				$format = get_option('izioseo_format_title_tag');
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
					$format = get_option('izioseo_format_title_tag');
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
				$format = get_option('izioseo_format_title_tag');
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
			$format = get_option('izioseo_format_title_archive');
			$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
			$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
			$title = str_replace('%date%', $date, $title);
			$title = $this->getPagedTitle($title);
			return $this->replaceTitle($header, $title);
		}
		elseif (is_404()) // 404 Fehlerseite
		{
			$format = get_option('izioseo_format_title_404');
			$title = str_replace('%blog_title%', get_bloginfo('name'), $format);
			$title = str_replace('%blog_description%', get_bloginfo('description'), $title);
			$title = str_replace('%request_url%', $_SERVER['REQUEST_URI'], $title);
			$title = str_replace('%request_words%', $this->requestAsWords($_SERVER['REQUEST_URI']), $title);
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
			$part = get_option('izioseo_format_title_paged');
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
		$text = preg_replace('/[^0-9a-zA-Z-&.,;#!?\/\' \x80-\xFF]/', ' ', $text);
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
	}

	/**
	 * entfernt aus einem Text die Stopwords
	 *
	 * @param string $string komplette Text (in ISO-8859-1)
	 * @param boolean $lowercase
	 * @return string Text ohne Stopwords und wird als ISO-8859-1 wieder ausgegeben
	 */
	function stripStopwords($string, $lowercase = true)
	{
		$this->loadStopwords();
		if ($lowercase)
		{
			$string = strtolower($string);
		}
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
		}
		return $string;
	}

	/**
	 * laden der Stopwordsliste
	 *
	 * @param boolean $utf8encode
	 */
	function loadStopwords($utf8encode = false)
	{
		if ((empty($this->stopwords) || ! count($this->stopwords)) && file_exists(dirname(__FILE__) . '/stopwords.txt'))
		{
			$raw = file(dirname(__FILE__) . '/stopwords.txt');
			foreach ($raw as $word)
			{
				if (! in_array(trim($word), $this->stopwords))
				{
					$this->stopwords[] = trim($utf8encode ? utf8_encode($word) : $word);
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
			error_log('[' . date('Y-m-d H:i:s', time()) . '][' . $type . '] ' . $msg . "\n", 3, $this->logFile);
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
					if (function_exists('get_the_tags') && get_option('izioseo_use_tags'))
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
					if (get_option('izioseo_use_categories') && ! is_page())
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
					// autometa
					$autometa = stripcslashes(get_post_meta($post->ID, "autometa", true));
					if (isset($autometa) && ! empty($autometa))
					{
						$autometa = explode(' ', $autometa);
						foreach ($autometa as $keyword)
						{
							$keywords[] = $keyword;
						}
					}
				}
			}
		}
		// wenn keine Keywords vorhanden sind, wie sich izioSeo verhalten soll bzw. wenn zu wenige vorhanden sind
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
	 * vergleicht alle gesammelten Keywords und holt sich nur einmal jedes Keyword
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
			$small[] = utf8_encode($word);
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
			$clear = $this->stripStopwords(utf8_decode($this->stripHtml($text)));
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
			arsort($reg);
			$all = array_sum($reg);
			foreach ($reg as $word => $count)
			{
				if ($count > 1 && ! preg_match('/^[0-9]+$/', $word) && strlen(trim($word)) > 3)
				{
					$return[] = preg_replace('/[^0-9a-zA-Z-, \x80-\xFF]/', '', trim($word, ','));
				}
			}
			if (get_option('izioseo_collect_keywords', true) == 'on' && is_array($return))
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
				$file[] = $keyword;
			}
		}
		$hdl = @fopen($this->keywordList, 'w+');
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
			$join = implode('. ', $description);
			if (strlen(trim($sentence)))
			{
				$description[] = trim(trim($sentence, '.'));
			}
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
		$file = dirname(__FILE__) . '/acronyms.txt';
		if (file_exists($file))
		{
			$this->acronyms = file($file);
			foreach ($this->acronyms as $key => $value)
			{
				$this->acronyms[$key] = trim($value);
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
		$description = str_replace('"', '', $description);
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
		$format = get_option('izioseo_format_description');
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
				$robots = get_option('izioseo_robots_home', true);
			}
			elseif (is_single())
			{
				$robots = get_option('izioseo_robots_post', true);
			}
			elseif (is_page())
			{
				$robots = get_option('izioseo_robots_page', true);
			}
			elseif (is_search())
			{
				$robots = get_option('izioseo_robots_search', true);
			}
			elseif (is_category())
			{
				$robots = get_option('izioseo_robots_category', true);
			}
			elseif (function_exists('is_tag') && is_tag())
			{
				$robots = get_option('izioseo_robots_tag', true);
			}
			elseif (is_archive())
			{
				$robots = get_option('izioseo_robots_archive', true);
			}
			elseif (is_404())
			{
				$robots = get_option('izioseo_robots_404', true);
			}
			else
			{
				$robots = 'noindex,follow';
			}
		}
		return strtolower($robots);
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
	 * hole die Robots fuer das Yahoo! Directory
	 *
	 * @return string
	 */
	function getNoYDir()
	{
		$post = $this->getCurPost();
		if ((is_object($post) && isset($post->ID) && get_post_meta($post->ID, 'izioseo_post_noydir', true) == 'on') || get_option('izioseo_robots_noydir', true) == 'on')
		{
			return 'noydir';
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
		$title = str_replace('%request_url%', $_SERVER['REQUEST_URI'], $title);
		$title = str_replace('%request_words%', $this->requestAsWords($_SERVER['REQUEST_URI']), $title);
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
		$trackingId = get_option('izioseo_analytics_tracking_id', true);
		if (! empty($trackingId) && preg_match('/UA-(.*)-(.*)/', $trackingId))
		{
			$type = strtolower(get_option('izioseo_analytics_type', true));
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
		$trackingId = trim(get_option('izioseo_wptools', true));
		if (strlen($trackingId) >= 44)
		{
			return $trackingId;
		}
	}

	/**
	 * holen der Sprache
	 *
	 * @return string
	 */
	function getLangId()
	{
		return get_option('izioseo_lang_id', true);
	}

	/**
	 * Initialisiert die Multisprachfaehigkeit
	 */
	function init()
	{
		load_plugin_textdomain('izioSeo', PLUGINDIR . '/' . dirname(plugin_basename(__FILE__)) . '/lang');
	}

	/**
	 * verknuepft die Einstellungsseite von izioSeo mit dem Adminmenu
	 */
	function adminMenu()
	{
		add_submenu_page('options-general.php', __('izioSEO', 'izioSeo'), __('izioSEO', 'izioSeo'), 10, __FILE__, array($this, 'options'));
	}

	/**
	 * Die Seite mit den Optionen
	 */
	function options()
	{
		if (isset($_POST['izioseo']))
		{
			$message = $this->saveOptions($_POST['izioseo']);
		}
		elseif (isset($_POST['merge']))
		{
			$message = $this->mergeFiles($_POST['merge']);
		}
		elseif (isset($_POST['robotstxt']))
		{
			$message = $this->writeRobotsTxt($_POST['robotstxt']);
		}
		$data = array(
			'izioseo_rewrite_titles' => htmlspecialchars(stripcslashes(get_option('izioseo_rewrite_titles', true))),
			'izioseo_title' => htmlspecialchars(stripcslashes(get_option('izioseo_title', true))),
			'izioseo_keywords' => htmlspecialchars(stripcslashes(get_option('izioseo_keywords', true))),
			'izioseo_description' => htmlspecialchars(stripcslashes(get_option('izioseo_description', true))),
			'izioseo_lang_id' => htmlspecialchars(stripcslashes(get_option('izioseo_lang_id', true))),
			'izioseo_analytics_type' => htmlspecialchars(stripcslashes(get_option('izioseo_analytics_type', true))),
			'izioseo_analytics_tracking_id' => htmlspecialchars(stripcslashes(get_option('izioseo_analytics_tracking_id', true))),
			'izioseo_wptools' => htmlspecialchars(stripcslashes(get_option('izioseo_wptools', true))),
			'izioseo_google_adsection' => htmlspecialchars(stripcslashes(get_option('izioseo_google_adsection', true))),
			'izioseo_noindex_rssfeed' => htmlspecialchars(stripcslashes(get_option('izioseo_noindex_rssfeed', true))),
			'izioseo_lenght_description' => htmlspecialchars(stripcslashes(get_option('izioseo_lenght_description', true))),
			'izioseo_lenght_description_min' => htmlspecialchars(stripcslashes(get_option('izioseo_lenght_description_min', true))),
			'izioseo_lenght_keywords' => htmlspecialchars(stripcslashes(get_option('izioseo_lenght_keywords', true))),
			'izioseo_use_default' => htmlspecialchars(stripcslashes(get_option('izioseo_use_default', true))),
			'izioseo_use_tags' => htmlspecialchars(stripcslashes(get_option('izioseo_use_tags', true))),
			'izioseo_use_categories' => htmlspecialchars(stripcslashes(get_option('izioseo_use_categories', true))),
			'izioseo_format_title_post' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_post', true))),
			'izioseo_format_title_page' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_page', true))),
			'izioseo_format_title_search' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_search', true))),
			'izioseo_format_title_category' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_category', true))),
			'izioseo_format_title_paged' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_paged', true))),
			'izioseo_format_title_tag' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_tag', true))),
			'izioseo_format_title_archive' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_archive', true))),
			'izioseo_format_title_404' => htmlspecialchars(stripcslashes(get_option('izioseo_format_title_404', true))),
			'izioseo_format_description' => htmlspecialchars(stripcslashes(get_option('izioseo_format_description', true))),
			'izioseo_robots_home' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_home', true))),
			'izioseo_robots_post' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_post', true))),
			'izioseo_robots_page' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_page', true))),
			'izioseo_robots_search' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_search', true))),
			'izioseo_robots_category' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_category', true))),
			'izioseo_robots_archive' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_archive', true))),
			'izioseo_robots_tag' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_tag', true))),
			'izioseo_robots_404' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_404', true))),
			'izioseo_robots_noodp' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_noodp', true))),
			'izioseo_robots_noydir' => htmlspecialchars(stripcslashes(get_option('izioseo_robots_noydir', true))),
			'izioseo_log' => htmlspecialchars(stripcslashes(get_option('izioseo_log', true))),
			'izioseo_collect_keywords' => htmlspecialchars(stripcslashes(get_option('izioseo_collect_keywords', true))),
			'izioseo_nofollow_categories' => htmlspecialchars(stripcslashes(get_option('izioseo_nofollow_categories', true))),
			'izioseo_nofollow_bookmarks' => htmlspecialchars(stripcslashes(get_option('izioseo_nofollow_bookmarks', true))),
			'izioseo_nofollow_tags' => htmlspecialchars(stripcslashes(get_option('izioseo_nofollow_tags', true))),
			'izioseo_collect_keywords' => htmlspecialchars(stripcslashes(get_option('izioseo_collect_keywords', true))),
			'izioseo_redirect_permalink' => htmlspecialchars(stripcslashes(get_option('izioseo_redirect_permalink', true)))
		);
		$robotsTxt = $this->loadRobotsTxt();
		$data = $this->aiospLoadGlobals($data);
		if (get_option('izioseo_collect_keywords', true) == 'on')
		{
			$this->loadKeywords(true);
			$this->loadStopwords(true);
			$this->loadAcronyms();
			$merge = array(
				'file_keywords' => htmlspecialchars(stripcslashes(implode("\r\n", $this->keywords))),
				'file_stopwords' => htmlspecialchars(stripcslashes(implode("\r\n", $this->stopwords))),
				'file_acronyms' => htmlspecialchars(stripcslashes(implode("\r\n", $this->acronyms)))
			);
		}
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
		$php5 = $this->php5;
		require_once (dirname(__FILE__) . '/templates/option-panel.tpl.php');
	}

	/**
	 * laedt die gesammelten Keywords in das Plugin
	 *
	 * @params boolean $utf8encode
	 */
	function loadKeywords($utf8encode = false)
	{
		if ((empty($this->keywords) || ! count($this->keywords)) && file_exists(dirname(__FILE__) . '/' . trim($this->keywordList, '/')))
		{
			$raw = file(dirname(__FILE__) . '/' . trim($this->keywordList, '/'));
			foreach ($raw as $word)
			{
				if (! in_array(trim($word), $this->keywords))
				{
					$this->keywords[] = trim(($utf8encode ? utf8_encode($word) : $word));
				}
			}
		}
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
			$data['izioseo_robots_noodp'] = isset($data['izioseo_robots_noodp']) && $data['izioseo_robots_noodp'] == 'on' ? 'on' : 'off';
			$data['izioseo_robots_noydir'] = isset($data['izioseo_robots_noydir']) && $data['izioseo_robots_noydir'] == 'on' ? 'on' : 'off';
			$data['izioseo_nofollow_categories'] = isset($data['izioseo_nofollow_categories']) && $data['izioseo_nofollow_categories'] == 'on' ? 'on' : 'off';
			$data['izioseo_nofollow_bookmarks'] = isset($data['izioseo_nofollow_bookmarks']) && $data['izioseo_nofollow_bookmarks'] == 'on' ? 'on' : 'off';
			$data['izioseo_nofollow_tags'] = isset($data['izioseo_nofollow_tags']) && $data['izioseo_nofollow_tags'] == 'on' ? 'on' : 'off';
			$data['izioseo_collect_keywords'] = isset($data['izioseo_collect_keywords']) && $data['izioseo_collect_keywords'] == 'on' ? 'on' : 'off';
			$data['izioseo_redirect_permalink'] = isset($data['izioseo_redirect_permalink']) && $data['izioseo_redirect_permalink'] == 'on' ? 'on' : 'off';
			foreach ($data as $key => $value)
			{
				update_option($key, trim($value));
			}
			if (function_exists('wp_cache_flush'))
			{
				wp_cache_flush();
			}
			return 'settings';
		}
	}

	/**
	 * speichert die Stopword-, Keyword- und Acronymlisten ab und verschmelzt diese
	 *
	 * @param array $data
	 */
	function mergeFiles($data)
	{
		$files = array('file_keywords' => dirname(__FILE__) . '/' . trim($this->keywordList, '/'), 'file_stopwords' => dirname(__FILE__) . '/stopwords.txt', 'file_acronyms' => dirname(__FILE__) . '/acronyms.txt');
		foreach ($data as $key => $value)
		{
			$data[$key] = array_unique(explode('<br />', nl2br($data[$key])));
		}
		$data['file_stopwords'] = $this->mergeArrays($data['file_stopwords'], $data['file_keywords']);
		$data['file_stopwords'] = $this->mergeArrays($data['file_stopwords'], $data['file_acronyms']);
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
			$hdl = @fopen($file, 'w+');
			if ($hdl)
			{
				fputs($hdl, implode("\r\n", $data[$key]));
				fclose($hdl);
			}
			unset($hdl);
		}
		return 'merge';
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
				'use' => htmlspecialchars(stripcslashes(get_post_meta($post->ID, 'izioseo_post_use', true)))
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
				'use' => get_option('izioseo_use_default', true)
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
		require_once (dirname(__FILE__) . '/templates/tag-panel.tpl.php');
	}

	/**
	 * Speichern der META-Tags
	 *
	 * @param integer $id
	 */
	function saveMetaTags($id)
	{
		$data = isset($_POST['izioseo']) && is_array($_POST['izioseo']) ? $_POST['izioseo'] : null;
		$data['izioseo_post_disable'] = !isset($data['izioseo_post_disable']) || $data['izioseo_post_disable'] == 'off' ? 'on' : 'off';
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
		$post = $this->getCurPost();
		if ((is_object($post) && isset($post->ID) && get_post_meta($post->ID, 'izioseo_post_google_adsection', true) == 'on') || get_option('izioseo_google_adsection', true) == 'on')
		{
			return "\n<!-- google_ad_section_start -->\n" . trim($data) . "\n<!-- google_ad_section_end -->\n";
		}
		return $data;
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
		$hdl = @fopen($file, 'w+');
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
		$hdl = fopen($file, 'w+');
		if ($hdl)
		{
			fputs($hdl, $content);
			fclose($hdl);

			return 'robots';
		}
		return false;
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
	 * Pruefen der aktuellen PHP Version, ob diese mit PHP 5 kompatibel ist
	 *
	 * @ignore
	 * @return boolean
	 */
	function checkPHP5()
	{
		return version_compare($this->requirePHPVersion, phpversion(), '<');
	}

	/**
	 * Weiterleiten von Permalinks
	 */
	function redirectPermalink()
	{
		if (is_404())
		{
		 	$url = basename($_SERVER['REQUEST_URI']);
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
	 	global $wpdb;

	 	return $wpdb->get_var('SELECT ID FROM ' . $wpdb->posts . ' WHERE post_name="' . $url . '" AND post_status="publish" ');
	}

}
