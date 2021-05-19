<?php

class Db {
	private static $instance;
	private static $connect;
	private $config;

	protected function __construct($config){
		$this->config = $config;
		$this->connect();
	}

	public function connect(){
		if(!self::$connect){
			self::$connect = new mysqli($this->config['host'],$this->config['user'],$this->config['password'],$this->config['dbName'],$this->config['port']); 
		}
	}

	static function getInstance($config){
		self::$instance = self::$instance ? : new self($config); 
		return self::$instance;
	}

	public function query($sql){
		$res = self::$connect->query($sql);
		if(!$res){
			die('错误');
		}else{
			return $res->fetch_assoc();
		}
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
$db = Db::getInstance($config);
var_dump($db);
print_r($db->query('select * from user'));