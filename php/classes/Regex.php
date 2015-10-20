<?php

/**
 * Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 */
class Regex
{

    //$urlRegex = "((https?|ftp)\:\/\/)?"; // SCHEME
    //$urlRegex .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass
    //$urlRegex .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP
    //$urlRegex .= "(\:[0-9]{2,5})?"; // Port
    //$urlRegex .= "(\/([a-z0-9+\$_\-~@\(\)\%]\.?)+)*\/?"; // Path
    //$urlRegex .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query
    //$urlRegex .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor

    public static $urlRegex = "/((https?|ftp)\:\/\/)?([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?([a-z0-9-.]*)\.([a-z]{2,3})(\:[0-9]{2,5})?(\/([a-z0-9+\$_\-~@\(\)\%]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?/i";
    public static $imageRegex = "/<img(.*?)src=(\"|\')(.+?)(gif|jpg|png|bmp)(.*?)(\"|\')(.*?)(\/)?>(<\/img>)?/";
    public static $imagePrefixRegex = "/\.(jpg|png|gif|bmp)$/i";
    public static $srcRegex = '/src=(\"|\')(.+?)(\"|\')/i';
    public static $httpRegex = "/https?\:\/\//i";
    public static $contentRegex1 = '/content="(.*?)"/i';
    public static $contentRegex2 = "/content='(.*?)'/i";
    public static $metaRegex = '/<meta(.*?)>/i';
    public static $titleRegex = "/<title(.*?)>(.*?)<\/title>/i";
    public static $scriptRegex = "/<script(.*?)>(.*?)<\/script>/i";

}
