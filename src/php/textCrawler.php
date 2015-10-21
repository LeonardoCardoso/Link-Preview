<?php
/**
 * Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */
include_once "classes/LinkPreview.php";

SetUp::init();

$text = $_POST["text"];
$imageQuantity = $_POST["imagequantity"];
$text = " " . str_replace("\n", " ", $text);
$header = "";

$linkPreview = new LinkPreview();
$answer = $linkPreview->crawl($text, $imageQuantity, $header);

echo $answer;

SetUp::finish();

