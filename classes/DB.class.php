<?php

/**
 * Datenbankklasse fuer izioSEO
 *
 * @author Mathias Schmidt <united20@united20.de>
 */
class IzioDB
{

	/**
	 * Datenbankobjekt von Wordpress
	 * 
	 * @var object
	 */
	var $db = null;

	/**
	 * Klassenkonstruktor
	 * 
	 * @return IzioDB
	 */
	function IzioDB()
	{
		global $wpdb;
		$this->db = $wpdb;
		if (! defined('DB_PREFIX'))
		{
			define('DB_PREFIX', $this->db->prefix);
		}
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
	 * Leeren einer Datenbanktabelle
	 *
	 * @param string $table
	 * @return integer
	 */
	function truncate($table)
	{
		return $this->query('TRUNCATE ' . $table);
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
	
	function fetchAssoc($query)
	{
		return $this->db->get_row($this->replacePrefix($query), ARRAY_A);
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

}
