<?php

/**
 * Klasse fuer die Statistiken der Suchmaschine
 *
 * @author Mathias Schmidt <united20@united20.de>
 */
class IzioStatistics
{

	/**
	 * Datenbank von Wordpress
	 *
	 * @var IzioDB
	 */
	var $db = null;

	/**
	 * Konstruktor
	 * 
	 * @return IzioStatistics
	 */
	function IzioStatistics()
	{
		require_once(dirname(__FILE__) . '/DB.class.php');
		$this->db = new IzioDB();
	}

	/**
	 * Holt die Anzahl der Suchanfragen ueber die verschiedenen Suchmaschinen
	 *
	 * @return array
	 */
	function getSearchengines()
	{
		$all = $this->numReferers('searchengines');
		$res = $this->db->fetchResults('SELECT referer_searchengine, COUNT(referer_id) AS referer_searchengine_count FROM #izioseo_referers GROUP BY referer_searchengine ORDER BY referer_searchengine_count DESC, referer_searchengine ASC');
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
		$num = $this->db->fetchOne('SELECT COUNT(referer_id) FROM #izioseo_referers' . $where);
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
		return $this->db->fetchOne('SELECT COUNT(DISTINCT referer_keyword) FROM #izioseo_referers_keywords');
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
		$res = $this->db->fetchResults('SELECT referer_request, referer_url, COUNT(referer_url) AS referer_count FROM #izioseo_referers WHERE referer_searchengine!="" AND referer_request!="" GROUP BY referer_url ORDER BY referer_count DESC' . ($limit ? ' LIMIT ' . addslashes($limit) : ''));
		foreach ($res as $entry)
		{
			$return[] = array(
				'referer_request' => utf8_decode($entry->referer_request),
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
		$res = $this->db->fetchResults('SELECT post_url, referer_request, referer_searchengine, referer_url, COUNT(referer_url) AS referer_count FROM #izioseo_referers WHERE referer_searchengine!="" AND referer_request!="" GROUP BY referer_url ORDER BY post_url ASC, referer_count ASC');
		foreach ($res as $entry)
		{
			$return[] = array(
				'post_url' => trim($baseUrl, '/') . $entry->post_url,
				'referer_request' => $this->utf8Decode($entry->referer_request),
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
		$res = $this->db->fetchResults('SELECT referer_keyword, COUNT(referer_keyword) AS keyword_count FROM #izioseo_referers_keywords WHERE referer_keyword!="" GROUP BY referer_keyword ORDER BY keyword_count DESC' . ($limit ? ' LIMIT ' . addslashes($limit) : ''));
		foreach ($res as $entry)
		{
			$return[] = array(
				'referer_keyword' => utf8_decode($entry->referer_keyword),
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
		$res = $this->db->fetchResults('SELECT r.post_url, k.referer_keyword, COUNT(k.referer_keyword) AS keyword_count FROM goizio__izioseo_referers_keywords AS k JOIN goizio__izioseo_referers AS r ON r.referer_id=k.referer_id WHERE k.referer_keyword!="" GROUP BY k.referer_keyword ORDER BY post_url ASC, keyword_count ASC');
		foreach ($res as $entry)
		{
			$return[] = array(
				'post_url' => trim($baseUrl, '/') . $entry->post_url,
				'referer_keyword' => $this->utf8Decode($entry->referer_keyword),
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
		$res = $this->db->fetchResults('SELECT referer_url, COUNT(referer_url) AS referer_count FROM #izioseo_referers WHERE referer_searchengine="" AND referer_request="" GROUP BY referer_url ORDER BY referer_count DESC' . ($limit ? ' LIMIT ' . addslashes($limit) : ''));
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
		$res = $this->db->fetchResults('SELECT post_url, referer_url, COUNT(referer_url) AS referer_count FROM #izioseo_referers WHERE referer_searchengine="" AND referer_request="" GROUP BY referer_url ORDER BY post_url ASC, referer_count ASC');
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

	/**
	 * holt alle externen Links
	 * 
	 * @param integer $limit
	 * @return array
	 */
	function getPopularLinks($limit = 100)
	{
		$return = array();
		$res = $this->db->fetchResults('SELECT link_url, link_hits FROM #izioseo_anonym_links ORDER BY link_hits DESC, link_url ASC' . ($limit ? ' LIMIT ' . addslashes($limit) : ''));
		foreach ($res as $entry)
		{
			$return[] = array(
				'link_url' => $entry->link_url,
				'link_hits' => $entry->link_hits
			);
		}
		return $return;
	}

	/**
	 * Dekodiert einen String solange UTF-8 bis es passt
	 *
	 * @param string $string
	 * @return string
	 */
	function utf8Decode($string)
	{
		$tmp = $string;
		$count = 0;
		while (mb_detect_encoding($tmp) == 'UTF-8')
		{
			$tmp = utf8_decode($tmp);
			$count++;
		}
		for ($i = 0; $i < $count-1 ; $i++)
		{
			$string = utf8_decode($string);
		}
		return $string;
	}

}
