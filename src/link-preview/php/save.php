<?php
/**
 * Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */

include_once "classes/Database.php";
include_once "classes/SetUp.php";

SetUp::headers();

$data = json_decode(urldecode(base64_decode($_POST["data"])));
$dataToSave = $data->data;
$dataToSave->text = $data->text;

$dataToSave->url = urldecode(base64_decode($dataToSave->url));
$dataToSave->pageUrl = urldecode(base64_decode($dataToSave->pageUrl));
$dataToSave->canonicalUrl = urldecode(base64_decode($dataToSave->canonicalUrl));

$id = Database::insert($dataToSave);
if ($id === null || $id === "") {
    echo mysql_error();
} else {
    echo $id;
}



