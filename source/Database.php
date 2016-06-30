<?php

class Database {
    /*
     * DB conect information
     */

    private $host = DB_HOST;
    private $db = DB_NAME;
    private $charset = DB_CHARSET;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $connect;
    private $statement;

    /*
     * connect to DB
     */

    public function __construct() {
	$dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
	$opt = array(
	    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	);
	try {
	    $this->connect = new PDO($dsn, $this->user, $this->pass, $opt);
	} catch (PDOException $e) {
	    throw new Exception('Connection to DB corrupted: '.$e->getMessage());
	}
    }

    /*
     * prepare query
     */

    public function query($query) {
	$this->statement = $this->connect->prepare($query);
    }

    /*
     * bind params to query
     */

    public function bind($param, $value, $type = null) {
	if (is_null($type)) {
	    switch (true) {
		case is_int($value):
		    $type = PDO::PARAM_INT;
		    break;
		case is_bool($value):
		    $type = PDO::PARAM_BOOL;
		    break;
		case is_null($value):
		    $type = PDO::PARAM_NULL;
		    break;
		default:
		    $type = PDO::PARAM_STR;
	    }
	}
	$this->statement->bindValue($param, $value, $type);
    }

    /*
     * execute query
     */

    public function execute($params = null) {
	return $this->statement->execute($params);
    }

    /*
     * get all records
     */

    public function findAll() {
	$this->execute();
	return $this->statement->fetchAll();
    }

    /*
     * get single record
     */

    public function find() {
	$this->execute();
	return $this->statement->fetch();
    }

}
