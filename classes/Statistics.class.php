<?php

/**
 * Klasse fuer die Statistiken der Suchmaschine
 *
 * @author Mathias Schmidt <united20@united20.de>
 */
class Statistics
{

	/**
	 * Datenbank von Wordpress
	 *
	 * @var object
	 */
	var $db = null;

	/**
	 * Konstruktor
	 */
	function Statistics()
	{
		$this->initWpDB();
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
	 * Holt die Anzahl der Suchanfragen ueber die verschiedenen Suchmaschinen
	 *
	 * @return array
	 */
	function getSearchengines()
	{
		$all = $this->numReferers('searchengines');
		$res = $this->fetchResults('SELECT referer_searchengine, COUNT(referer_id) AS referer_searchengine_count FROM #izioseo_referers GROUP BY referer_searchengine ORDER BY referer_searchengine_count DESC, referer_searchengine ASC');
		$data = array();
		foreach ($res as $se)
		{
			$data[$se->referer_searchengine] = array(
				'hits' => $se->referer_searchengine_count,
				'percent' => $se->referer_searchengine_count / $all * 100
			);
		}
		return $data;
	}

	/**
	 * Gibt die Anzahl aller im System vorhandenen Referer zurueck
	 *
	 * @param string $type
	 * @return integer
	 */
	function numReferers($type = null)
	{
		$where = '';
		if ($type == 'searchengines')
		{
			$where = ' WHERE referer_searchengine!=""';
		}
		elseif ($type == 'other')
		{
			$where = ' WHERE referer_searchengine=""';
		}
		$num = $this->fetchOne('SELECT COUNT(referer_id) FROM #izioseo_referers' . $where);
		if (empty($num))
		{
			return 0;
		}
		return $num;
	}

	/**
	 * gibt die Anzahl aller Keywords im System zurueck
	 *
	 * @return integer
	 */
	function numKeywords()
	{
		return $this->fetchOne('SELECT COUNT(DISTINCT referer_keyword) FROM #izioseo_referers_keywords');
	}

	/**
	 * Holt die Top Suchanfragen
	 *
	 * @param integer $limit
	 * @return array
	 */
	function getRequests($limit = 100)
	{
		$return = array();
		$res = $this->fetchResults('SELECT referer_request, referer_url, COUNT(referer_url) AS referer_count FROM #izioseo_referers WHERE referer_searchengine!="" AND referer_request!="" GROUP BY referer_url ORDER BY referer_count DESC' . ($limit ? ' LIMIT ' . addslashes($limit) : ''));
		foreach ($res as $entry)
		{
			$return[] = array(
				'referer_request' => $entry->referer_request,
				'referer_url' => $entry->referer_url,
				'referer_count' => $entry->referer_count
			);
		}
		return $return;
	}

	/**
	 * Holt die Suchanfragen zu den jeweiligen Url's
	 *
	 * @param string $baseUrl
	 * @return array
	 */
	function getRequestsToUrls($baseUrl)
	{
		$return = array();
		$res = $this->fetchResults('SELECT post_url, referer_request, referer_searchengine, referer_url, COUNT(referer_url) AS referer_count FROM #izioseo_referers WHERE referer_searchengine!="" AND referer_request!="" GROUP BY referer_url ORDER BY post_url ASC, referer_count ASC');
		foreach ($res as $entry)
		{
			$return[] = array(
				'post_url' => trim($baseUrl, '/') . $entry->post_url,
				'referer_request' => $entry->referer_request,
				'referer_searchengine' => $entry->referer_searchengine,
				'referer_url' => $entry->referer_url,
				'referer_count' => $entry->referer_count
			);
		}
		return $return;
	}

	/**
	 * Holt die Top Keywords
	 *
	 * @param integer $limit
	 * @return array
	 */
	function getKeywords($limit = 100)
	{
		$return = array();
		$res = $this->fetchResults('SELECT referer_keyword, COUNT(referer_keyword) AS keyword_count FROM #izioseo_referers_keywords WHERE referer_keyword!="" GROUP BY referer_keyword ORDER BY keyword_count DESC' . ($limit ? ' LIMIT ' . addslashes($limit) : ''));
		foreach ($res as $entry)
		{
			$return[] = array(
				'referer_keyword' => $entry->referer_keyword,
				'keyword_count' => $entry->keyword_count
			);
		}
		return $return;
	}

	/**
	 * Holt alle Keywords zu ihren jeweiligen Url's
	 *
	 * @param string $baseUrl
	 * @return array
	 */
	function getKeywordsToUrls($baseUrl)
	{
		$return = array();
		$res = $this->fetchResults('SELECT r.post_url, k.referer_keyword, COUNT(k.referer_keyword) AS keyword_count FROM goizio__izioseo_referers_keywords AS k JOIN goizio__izioseo_referers AS r ON r.referer_id=k.referer_id WHERE k.referer_keyword!="" GROUP BY k.referer_keyword ORDER BY post_url ASC, keyword_count ASC');
		foreach ($res as $entry)
		{
			$return[] = array(
				'post_url' => trim($baseUrl, '/') . $entry->post_url,
				'referer_keyword' => $entry->referer_keyword,
				'keyword_count' => $entry->keyword_count
			);
		}
		return $return;
	}

	/**
	 * Holt die verlinkenden Seiten
	 *
	 * @param integer $limit
	 * @return array
	 */
	function getReferers($limit = 100)
	{
		$return = array();
		$res = $this->fetchResults('SELECT referer_url, COUNT(referer_url) AS referer_count FROM #izioseo_referers WHERE referer_searchengine="" AND referer_request="" GROUP BY referer_url ORDER BY referer_count DESC' . ($limit ? ' LIMIT ' . addslashes($limit) : ''));
		foreach ($res as $entry)
		{
			$return[] = array(
				'referer_url' => $entry->referer_url,
				'referer_count' => $entry->referer_count
			);
		}
		return $return;
	}

	/**
	 * Holt die verlinkenden Seiten zu den ejweiligen Blogseiten
	 *
	 * @param string $baseUrl
	 * @return array
	 */
	function getReferersToUrls($baseUrl)
	{
		$return = array();
		$res = $this->fetchResults('SELECT post_url, referer_url, COUNT(referer_url) AS referer_count FROM #izioseo_referers WHERE referer_searchengine="" AND referer_request="" GROUP BY referer_url ORDER BY post_url ASC, referer_count ASC');
		foreach ($res as $entry)
		{
			$return[] = array(
				'post_url' => trim($baseUrl, '/') . $entry->post_url,
				'referer_url' => $entry->referer_url,
				'referer_count' => $entry->referer_count
			);
		}
		return $return;
	}

}