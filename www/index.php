<?php

define('USER', 'root');
define('PSSW', 'secret');
define('DB_NAME', 'api');
define('HOST', 'db');

class DataBase
{
    private static $db = null;
    private $pdo;

    public static function DB_connect($host, $db, $charset, $user, $pass)
    {
        if (self::$db == null) self::$db = new DataBase($host, $db, $charset, $user, $pass);
        return self::$db;
    }
    public function __construct($host, $db, $charset, $user, $pass)
    {
        $dsn = "mysql:host=$host; dbname=$db; charset=$charset";
        $opt = array(
                        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    );
        $this->pdo = new PDO($dsn, $user, $pass, $opt);
    }
    private function __clone () {}
    private function __wakeup () {}

    public function insert($sql, $args = false)
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($args);
        if ($sth) return $this->pdo->lastInsertId();
        else return false;
    }

    public function select($sql, $args = false)
    {
        $sth = $this->pdo->prepare($sql);
        $sth->execute($args);
        if ($sth->rowCount() != 1) return false;
        else return $sth->fetch();
    }
}

$method = $_SERVER['REQUEST_METHOD'];

$url = $_GET['request'] ?? '';
$url = explode('/', rtrim($url, '/'));

if ($method === 'GET') $formData = $url[2];
else if ($method === 'POST') $formData = $_POST;

$router = $url[1];

if (file_exists($router.'.php')) include_once $router.'.php';
else
{
    header('HTTP/1.0 400 Bad Request');
    echo json_encode( array('error' => 'Bad Request') );
    return;
}

route($method, $formData);
