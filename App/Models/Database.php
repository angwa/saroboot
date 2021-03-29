<?php
namespace App\Models;
use Config;

class Database extends Config
{
	public $conn;
	private static $_instance = null;

	public function __construct()
	{ 
         parent::__construct();
         $env = json_decode(json_encode($this->env),true);   
		try{
			$this->conn = new \PDO("mysql:host=".$env['hostname'].";dbname=". $env['database']. "", $env['username'], $env['password']);
		    // seting PDO error mode to exception
		    $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		    {
		    echo "Could not connect to database: " . $e->getMessage();
		    }
	}

	public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function query($sql, $params = array())
    {
        $this->_error = false;
        if ($this->_query = $this->conn->prepare($sql)) {
            $k = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($k, $param);
                    $k++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(\PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }
        return $this;
    }

    private function action($action, $table, $where = array())
    {
        if (count($where) === 3) {
            $operators = array('=', '<', '>', '<=', '>=');

            $field         = $where[0];
            $operator     = $where[1];
            $value         = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM users WHERE {$field} {$operator} ?";
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }

        return false;
    }

    public function get($table, $where)
    {
        return $this->action("SELECT *", $table, $where);
    }

    public function error()
    {
        return $this->_error;
    }

    public function count()
    {
        return $this->_count;
    }

    public function pdo()
    {
        return $this->_pdo;
    }





}

