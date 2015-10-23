<?php
/**
 * Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */

/** This class is for database connection. It's just an example, neither security is being handled here nor mysql errors that might be occurred. */

include_once "Highlight.php";

class Database
{

    static function insert($save)
    {
        $conn = Database::connect();

        $query =
            "INSERT INTO
              `linkpreview`.`linkpreview`
              (`id`, `text`, `image`, `title`, `canonicalUrl`, `url`, `pageUrl`, `description`, `iframe`)
              VALUES (NULL, '" . $save->text . "', '" . $save->image . "', '" . $save->title . "', '" . $save->canonicalUrl . "',
              '" . $save->url . "', '" . $save->pageUrl . "', '" . $save->description . "', '" . $save->videoIframe . "')";

        mysqli_query($conn, $query);

        $id = mysqli_insert_id($conn);

        Database::close($conn);

        return $id;
    }

    static function delete($delete)
    {
        $conn = Database::connect();

        $query = "DELETE FROM `linkpreview`.`linkpreview` WHERE `id` = '" . $delete["id"] . "'";

        mysqli_query($conn, $query);

        Database::close($conn);
    }

    static function connect()
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $database = "linkpreview";

        if (!($connection = mysqli_connect($host, $user, $password, $database))) ;

        mysqli_query($connection, "SET character_set_results=utf8");
        mb_language('uni');
        mb_internal_encoding('UTF-8');
        mysqli_query($connection, "set names 'utf8'");

        return $connection;
    }

    static function close($conn)
    {
        mysqli_close($conn);
    }

    static function select()
    {
        $conn = Database::connect();

        $sth = mysqli_query($conn, "SELECT * FROM `linkpreview` ORDER BY id DESC");

        $rows = array();
        while ($r = mysql_fetch_assoc($sth)) {

            $r["text"] = Highlight::url($r["text"]);
            $r["description"] = Highlight::url($r["description"]);

            $rows[] = $r;
        }

        return $rows;
    }


}
