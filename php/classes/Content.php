<?php
/**
 * Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 */

/** This class handles the content analysis */

include_once "Regex.php";

class Content
{

    static function crawlCode($text)
    {
        $contentSpan = Content::getTagContent("span", $text);
        $contentParagraph = Content::getTagContent("p", $text);
        $contentDiv = Content::getTagContent("div", $text);
        if (strlen($contentParagraph) > strlen($contentSpan) && strlen($contentParagraph) >= strlen($contentDiv))
            $content = $contentParagraph;
        else if (strlen($contentParagraph) > strlen($contentSpan) && strlen($contentParagraph) < strlen($contentDiv))
            $content = $contentDiv;
        else
            $content = $contentParagraph;
        return $content;
    }

    static function getTagContent($tag, $string)
    {
        $pattern = "/<$tag(.*?)>(.*?)<\/$tag>/i";

        preg_match_all($pattern, $string, $matches);
        $content = "";
        for ($i = 0; $i < count($matches[0]); $i++) {
            $currentMatch = strip_tags($matches[0][$i]);
            if (strlen($currentMatch) >= 120) {
                $content = $currentMatch;
                break;
            }
        }
        if ($content == "") {
            preg_match($pattern, $string, $matches);
            $content = $matches[0];
        }
        return str_replace("&nbsp;", "", $content);
    }

    static function isImage($url)
    {
        if (preg_match(Regex::$imagePrefixRegex, $url))
            return true;
        else
            return false;
    }

    static function getImages($text, $url, $imageQuantity)
    {
        $content = array();
        if (preg_match_all(Regex::$imageRegex, $text, $matching)) {

            for ($i = 0; $i < count($matching[0]); $i++) {
                $src = "";
                $pathCounter = substr_count($matching[0][$i], "../");
                preg_match(Regex::$srcRegex, $matching[0][$i], $imgSrc);

                $imgSrc = Url::canonicalImgSrc($imgSrc[2]);
                if (!preg_match(Regex::$httpRegex, $imgSrc)) {
                    $src = Url::getImageUrl($pathCounter, Url::canonicalLink($imgSrc, $url));
                }
                if ($src . $imgSrc != $url) {
                    if ($src == "")
                        array_push($content, $src . $imgSrc);
                    else
                        array_push($content, $src);
                }
            }
        }

        $content = array_unique($content);
        $content = array_values($content);

        $maxImages = $imageQuantity != -1 && $imageQuantity < count($content) ? $imageQuantity : count($content);

        $images = "";
        for ($i = 0; $i < count($content); $i++) {
            if (!($size = @getimagesize($content[$i]))) {
                continue;
            }
            $size = getimagesize($content[$i]);
            if ($size[0] > 40 && $size[1] > 15) {// avoids getting very small images
                $images .= $content[$i] . "|";
                $maxImages--;
                if ($maxImages == 0)
                    break;
            }
        }

        return substr($images, 0, -1);
    }

    static function getMetaTags($contents)
    {

        $result = false;

        if (isset($contents)) {

            $list = array(
                "UTF-8",
                "EUC-CN",
                "EUC-JP",
                "EUC-KR",
                'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4', 'ISO-8859-5',
                'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8', 'ISO-8859-9', 'ISO-8859-10',
                'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'ISO-8859-16',
                'Windows-1251', 'Windows-1252', 'Windows-1254',
            );

            $encoding_check = mb_detect_encoding($contents, $list, true);
            $encoding = ($encoding_check === false) ? "UTF-8" : $encoding_check;

            $metaTags = Content::getMetaTagsEncoding($contents, $encoding);


            $result = $metaTags;
        }

        return $result;
    }

    static function getMetaTagsEncoding($contents, $encoding)
    {
        $result = false;
        $metaTags = array("url" => "", "title" => "", "description" => "", "image" => "");

        if (isset($contents)) {

            $doc = new DOMDocument('1.0', 'utf-8');
            @$doc->loadHTML($contents);

            $metas = $doc->getElementsByTagName('meta');

            for ($i = 0; $i < $metas->length; $i++) {
                $meta = $metas->item($i);
                if ($meta->getAttribute('name') == 'description')
                    $metaTags["description"] = $meta->getAttribute('content');
                if ($meta->getAttribute('name') == 'keywords')
                    $metaTags["keywords"] = $meta->getAttribute('content');
                if ($meta->getAttribute('property') == 'og:title')
                    $metaTags["title"] = $meta->getAttribute('content');
                if ($meta->getAttribute('property') == 'og:image')
                    $metaTags["image"] = $meta->getAttribute('content');
                if ($meta->getAttribute('property') == 'og:description')
                    $metaTags["og_description"] = $meta->getAttribute('content');
                if ($meta->getAttribute('property') == 'og:url')
                    $metaTags["url"] = $meta->getAttribute('content');
            }

            if (!empty($metaTags["og_description"])) {
                $metaTags["description"] = $metaTags["og_description"];
            }

            if (empty($metaTags["title"])) {
                $nodes = $doc->getElementsByTagName('title');
                $metaTags["title"] = $nodes->item(0)->nodeValue;
            }

            $result = $metaTags;
        }
        return $result;
    }

    static function separateMetaTagsContent($raw)
    {
        preg_match(Regex::$contentRegex1, $raw, $match);
        if (count($match) == 0) {
            preg_match(Regex::$contentRegex2, $raw, $match);
        }
        return $match[1];
    }

    static function extendedTrim($content)
    {
        return trim(str_replace("\n", " ", str_replace("\t", " ", preg_replace("/\s+/", " ", $content))));
    }

    static function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    static function stripIrrelevantTags($content)
    {
        $tags = array('style', 'script');
        $content = preg_replace('#<(' . implode('|', $tags) . ')>.*?</\1>#s', '', $content);
        return $content;
    }
}
