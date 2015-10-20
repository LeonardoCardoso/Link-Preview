<?php
/**
 * Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 */

include_once "classes/Database.php";
include_once "classes/SetUp.php";

SetUp::headers();

$save = array(
    "text" => strip_tags($_POST["text"]),
    "image" => strip_tags($_POST["image"]),
    "title" => strip_tags($_POST["title"]),
    "canonicalUrl" => strip_tags($_POST["canonicalUrl"]),
    "url" => strip_tags($_POST["url"]),
    "description" => strip_tags($_POST["description"]),
    "iframe" => $_POST["iframe"],
);

$id = Database::insert($save);
if ($id === null || $id === "") {
    echo mysql_error();
} else {
    echo $id;
}



