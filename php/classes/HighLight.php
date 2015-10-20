<?php
/**
 * Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 */

/**
 * This class is only to hightlight the urls.
 * So, it has nothing bound directly to LinkPreview class
 */

include_once "Regex.php";

class HighLight {

    static function url($text){
        $text = " " . str_replace("\n", " ", $text);
        if (preg_match_all(Regex::$urlRegex, $text, $matches)) {
            for ($i = 0; $i < count($matches[0]); $i++) {
                $currentUrl = $matches[0][$i];
                if ($currentUrl[0] == " ")
                    $currentUrl = "http://" . substr($currentUrl, 1);
                $text = str_replace($matches[0][$i], "<a href='" . $currentUrl . "' target='_blank'>" . $matches[0][$i] . "</a>", $text);
            }
        }
        return $text;
    }

}
