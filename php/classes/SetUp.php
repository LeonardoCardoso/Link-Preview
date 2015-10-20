<?php
/**
 * Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 */

/** This class sets the system configuration */

class SetUp {

    /** Set charset utf 8 */
    static function headers(){
        error_reporting(0);
        header("Content-Type: text/html; charset=utf-8", true);
    }

    /** Allow url fopen to crawl the code */
    static function init(){
        SetUp::headers();
        error_reporting(0);
        if (!ini_get('allow_url_fopen'))
            ini_set('allow_url_fopen', 1);
    }

    /** Close url fopen*/
    static function finish(){
        if (ini_get('allow_url_fopen'))
            ini_set('allow_url_fopen', 0);
    }

}
