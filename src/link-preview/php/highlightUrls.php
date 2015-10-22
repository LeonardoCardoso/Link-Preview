<?php
/**
 * Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */

/**
 * This file is only to hightlight the urls that are found shown when post is already posted. :)
 * So, it has nothing bound directly to LinkPreview class
 */
include_once "classes/SetUp.php";
include_once "classes/Highlight.php";

SetUp::init();

$data = json_decode(urldecode(base64_decode($_POST["data"])));

$text = $data->text;
$description = $data->description;

$answer = array("text" => Highlight::url($text), "description" => Highlight::url($description));

echo json_encode($answer);
