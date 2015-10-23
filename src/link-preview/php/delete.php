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

$data = json_decode($_POST["data"]);
$delete = array(
    "id" => $data->id,
);

Database::delete($delete);

echo mysql_error();



