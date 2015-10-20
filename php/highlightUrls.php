<?php
/**
 * Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 */

/**
 * This file is only to hightlight the urls that are found shown when post is already posted. :)
 * So, it has nothing bound directly to LinkPreview class
 */
include_once "classes/SetUp.php";
include_once "classes/HighLight.php";

SetUp::init();

error_reporting(false);
$text = $_GET["text"];
$description = $_GET["description"];

$answer = array("urls" => HighLight::url($text), "description" => HighLight::url($description));

echo json_encode($answer);
