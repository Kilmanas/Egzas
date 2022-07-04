<?php

namespace Helper;

use PDO;

use const DB_NAME;
use const DB_PASSWORD;
use const DB_USER;
use const SERVERNAME;

class DBHelper
{
    private \PDO $conn;

    private string $sql;

    public function __construct()
    {
        $this->sql = '';

        try {
            $this->conn = new PDO("mysql:host=" . SERVERNAME . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function select(string $fields = '*') :DBHelper
    {
        $this->sql .= 'SELECT ' . $fields . ' ';
        return $this;
    }

    public function from(string $table) :DBHelper
    {
        $this->sql .= ' FROM ' . $table . ' ';
        return $this;
    }

    public function delete() :DBHelper
    {
        $this->sql .= 'DELETE ';
        return $this;
    }

    public function get(): ?array
    {
        $rez = $this->exec();
        return $rez->fetchAll();
    }

    public function exec(): ?\PDOStatement
    {
        return $this->conn->query($this->sql);
    }

    public function getOne()
    {
        $rez = $this->exec();
        $data = $rez->fetchAll();
        if (!empty($data)) {
            return $data[0];
        } else {
            return [];
        }

    }

    public function insert(string $table, array $data) :DBHelper
    {
        $this->sql .= 'INSERT INTO ' . $table .
            ' (' . implode(',', array_keys($data)) . ')
            VALUES ("' . implode('","', $data) . '")';
        return $this;
    }

    public function where(string $field,string $value, string $operator = '=') :DBHelper
    {
        $this->sql .= ' WHERE ' . $field . $operator . '"' . $value . '"';
        return $this;
    }

}