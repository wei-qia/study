<?php
interface Connection{
	public function connect();
	public function query($sql);
}

class mysqliConn implements Connection {
	private $connect;
	private $config;

	public function __construct($config){
		$this->config = $config;
		$this->connect();
	}

	public function connect(){
		if(!$this->connect){
			$this->connect = new mysqli($this->config['host'],$this->config['user'],$this->config['password'],$this->config['dbName'],$this->config['port']); 
		}
	}

	public function query($sql){
		$res = $this->connect->query($sql);
		if(!$res){
			die('错误');
		}else{
			return $res->fetch_assoc();
		}
	}
}

class pdoConn implements Connection {
	private $connect;
	private $config;

	public function __construct($config){
		$this->config = $config;
		$this->connect();
	}

	public function connect(){
		if(!$this->connect){
			$this->connect = new PDO("mysql:host=" . $this->config['host'] . ";dbname=" . $this->config['dbName'], $this->config['user'], $this->config['password']);
		}
	}

	public function query($sql){
		$res = $this->connect->query($sql);
		if(!$res){
			die('错误');
		}else{
			return $$res->fetch()->info();
		}
	}
}

class Db {
	public $connection;

	public function __construct(Connection $connection){
		$this->connection = $connection;
	}

}


$config = array(
	'host'=>'127.0.0.1',  
    'user'=>'root',  
    'password'=>'123456',//因为测试，我就不设置密码，实际开发中，必须建立新的用户并设置密码  
    'dbName'=>'test',  
    'charSet'=>'utf8',  
    'port'=>'3306' 
);
$Db = new Db(new mysqliConn($config));
var_dump($Db->connection->query('select * from user'));