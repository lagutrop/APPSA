<?php
/**
 * Created by Tiago.
 * Date: 11-01-2018
 * Time: 20:47
 */

class Database
{
    protected static $connection;

    /**
     * Insert in database
     * @param $table
     * @param $query
     * @param $bind_params
     * @param $values
     * @return string
     */
    public function insert($table, $query, $bind_params, $values)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $connection = $this->connect();
        $statement = $connection->prepare("INSERT INTO " . $table . " VALUES" . $query);
        $statement->bind_param($bind_params, ...$values);
        $statement->execute();
        return true;
    }

    /**
     * Connection to the database
     * @return bool|mysqli
     */
    function connect()
    {
        if (!isset(self::$connection)) {
            $config = parse_ini_file('config.ini');
            // Create connection
            self::$connection = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
            // Check connection
            if (self::$connection->connect_error) {
                echo 'Erro no servidor. Por favor tente mais tarde.';
            }
        }
        return self::$connection;
    }

    /**
     * Prepared statement that builds a select query
     * @param $columns
     * @param $table
     * @param $where
     * @param $bind_params
     * @param $values
     * @return bool|mysqli_result
     */
    public function select($columns, $table, $where, $bind_params = null, $values = null)
    {
        $connection = $this->connect();
        $statement = $connection->prepare("SELECT " . $columns . " FROM " . $table . " WHERE " . $where);
        if (!is_null($bind_params) || !is_null($values)) {
            $statement->bind_param($bind_params, ...$values);
        }
        $statement->execute();
        $result = $statement->get_result();
        return $result;
    }

    /**
     * Prepared statement that builds an update query
     * @param $table
     * @param $set
     * @param $where
     * @param $bind_params
     * @param $values
     */
    public function update($table, $set, $where, $bind_params, $values)
    {
        $connection = $this->connect();
        $statement = $connection->prepare("UPDATE " . $table . " SET " . $set . " WHERE " . $where . "");
        $statement->bind_param($bind_params, ...$values);
        $statement->execute();
    }

    /**
     * Prepared statement that builds a delete query
     * @param $table
     * @param $where
     * @param null $bind_params
     * @param null $values
     * @return int
     */
    public function delete($table, $where, $bind_params = null, $values = null)
    {
        $connection = $this->connect();
        $statement = $connection->prepare("DELETE FROM " . $table . " WHERE " . $where);
        if (!is_null($bind_params) || !is_null($values)) {
            $statement->bind_param($bind_params, ...$values);
        }
        $statement->execute();
        return $statement->affected_rows;
    }

    /**
     * Return modified rows after query
     * @return int
     */
    public function affectedRows()
    {
        $connection = $this->connect();
        return $connection->affected_rows;
    }

    /**
     * Escapes input to prevent sql injection
     * @param $value
     * @return string
     */
    public function escape($value)
    {
        $connection = $this->connect();
        $escaped_value = mysqli_real_escape_string($connection, $value);
        return $escaped_value;
    }
}