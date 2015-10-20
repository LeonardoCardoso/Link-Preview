<?php
/**
 * Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 */

/** This class is for database connection. It's just an example, neither security is being handled here nor mysql errors that might be occurred. */

include_once "HighLight.php";

class Database
{

    static function insert($save)
    {
        $conn = Database::connect();

        $save = array_map("mysql_real_escape_string", $save);

        $query = "INSERT INTO `linkpreview`.`linkpreview` (`id`, `text`, `image`, `title`, `canonicalUrl`, `url`, `description`, `iframe`)
                        VALUES (NULL, '" . $save["text"] . "', '" . $save["image"] . "', '" . $save["title"] . "', '" . $save["canonicalUrl"] . "', '" . $save["url"] . "', '" . $save["description"] . "', '" . $save["iframe"] . "')";

        mysql_query($query);

        $id = mysql_insert_id($conn);

        Database::close($conn);

        return $id;
    }

    static function delete($delete)
    {
        $conn = Database::connect();

        $delete = array_map("mysql_real_escape_string", $delete);

        $query = "DELETE FROM `linkpreview`.`linkpreview` WHERE `id` = '" . $delete["id"] . "'";

        mysql_query($query);

        Database::close($conn);
    }

    static function connect()
    {

        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "linkpreview";

        if (!($connection = mysql_connect($host, $user, $password))) ;

        mysql_query("SET character_set_results=utf8", $connection);
        mb_language('uni');
        mb_internal_encoding('UTF-8');

        if (!($db = mysql_select_db($database, $connection))) ;

        mysql_query("set names 'utf8'", $connection);

        return $connection;
    }

    static function close($conn)
    {
        mysql_close($conn);
    }

    static function select()
    {
        Database::connect();

        $sth = mysql_query("SELECT * FROM `linkpreview` ORDER BY id DESC");

        $rows = array();
        while ($r = mysql_fetch_assoc($sth)) {

            $r["text"] = HighLight::url($r["text"]);
            $r["description"] = HighLight::url($r["description"]);

            array_push($rows, $r);
        }

        return $rows;
    }


}
