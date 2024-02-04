<?php
/**
 *  CLASSE Query -> faz as consultas em banco a partir das variaveis dos formularios
 */
class Conn
{    
	public static function mysql()
	{
        $conn = mysqli_connect($host, $username, $password, $database);
        if (!$conn) die('Deu errado a conexao!');

        return $conn;
    }

    /**
     *To connect on sqlite3 DB you must uncomment sqlite3 extension on php.ini
     */
    public static function sqlite3()
	{  
        $conn = new SQLite3('hub.sqlite');
    	if (!$conn) die('Deu errado a conexao!');

    	return $conn;
    }

    /**
     *$database must be compose by a IP/database, exemple "127.0.0.1/pas"
     * 
     * To connect on ora11g you must add an extension to .ddl file, that show to php how to communicate to the db using OCI connect
     */
    public static function oracle()
	{
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');

        $conn = oci_connect($username, $password, $database);

        return $conn;
    }
}