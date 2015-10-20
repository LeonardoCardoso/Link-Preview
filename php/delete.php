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

$delete = array(
    "id" => $_POST["id"],
);

Database::delete($delete);

echo mysql_error();



