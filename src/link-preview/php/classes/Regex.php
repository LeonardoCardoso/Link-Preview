<?php

/**
 * Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */
class Regex
{

    //$URL_REGEX = "((https?|ftp)\:\/\/)?"; // SCHEME
    //$URL_REGEX .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
    //$URL_REGEX .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP
    //$URL_REGEX .= "(\:[0-9]{2,5})?"; // Port
    //$URL_REGEX .= "(\/([a-z0-9+\$_\-~@\(\)\%]\.?)+)*\/?"; // Path
    //$URL_REGEX .= "(\?[a-z+&\$_.-][a-z0-9;:@&#%=+\/\$_.-]*)?"; // GET Query
    //$URL_REGEX .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor

    public static $URL_REGEX = "/((https?|ftp)\:\/\/)?([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?([a-z0-9-.]*)\.([a-z]{2,3})(\:[0-9]{2,5})?(\/([a-z0-9+\$_\-~@\(\)\%]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@&#%=+\/\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?/i";
    public static $IMAGE_REGEX = "/<img(.*?)src=(\"|\')(.+?)(gif|jpg|png|bmp)(.*?)(\"|\')(.*?)(\/)?>(<\/img>)?/";
    public static $IMAGE_PREFIX_REGEX = "/\.(jpg|png|gif|bmp)$/i";
    public static $SRC_REGEX = '/src=(\"|\')(.+?)(\"|\')/i';
    public static $HTTP_REGEX = "/https?\:\/\//i";
    public static $CONTEXT_REGEX_1 = '/content="(.*?)"/i';
    public static $CONTENT_REGEX_2 = "/content='(.*?)'/i";
    public static $META_REGEX = '/<meta(.*?)>/i';
    public static $TITLE_REGEX = "/<title(.*?)>(.*?)<\/title>/i";
    public static $SCRIPT_REGEX = "/<script(.*?)>(.*?)<\/script>/i";

}
