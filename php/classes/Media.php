<?php
/**
 * Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.3.0
 */

/**
 *  This class mounts the iframe embed code for the video services below
 * */
class Media
{

    /** Return iframe code for Youtube videos */
    static function mediaYoutube($url)
    {
        $media = array();
        if (preg_match("/(.*?)v=(.*?)($|&)/i", $url, $matching)) {
            $vid = $matching[2];
            array_push($media, "http://i2.ytimg.com/vi/$vid/hqdefault.jpg");
            array_push($media, '<iframe id="' . date("YmdHis") . $vid . '" style="display: none; margin-bottom: 5px;" width="499" height="368" src="http://www.youtube.com/embed/' . $vid . '" frameborder="0" allowfullscreen></iframe>');
        } else {
            array_push($media, "", "");
        }
        return $media;
    }

    /** Return iframe code for Vine videos */
    static function mediaVine($url)
    {
        $url = str_replace("https://", "", $url);
        $url = str_replace("http://", "", $url);
        $breakUrl = explode("/", $url);
        $media = array();
        if ($breakUrl[2] != "") {
            $vid = $breakUrl[2];
            array_push($media, Media::mediaVineThumb($vid));
            array_push($media, '<iframe id="' . date("YmdHis") . $vid . '" class="vine-embed" src="https://vine.co/v/' . $vid . '/embed/simple" width="499" height="499" frameborder="0"></iframe><script async src="//platform.vine.co/static/scripts/embed.js" charset="utf-8"></script>');
        } else {
            array_push($media, "", "");
        }
        return $media;
    }

    static function mediaVineThumb($id)
    {
        $vine = file_get_contents("http://vine.co/v/{$id}");
        preg_match('/property="og:image" content="(.*?)"/', $vine, $matches);

        return ($matches[1]) ? $matches[1] : false;
    }

    /** Return iframe code for Vimeo videos */
    static function mediaVimeo($url)
    {
        $url = str_replace("https://", "", $url);
        $url = str_replace("http://", "", $url);
        $breakUrl = explode("/", $url);
        $media = array();
        if ($breakUrl[1] != "") {
            $imgId = $breakUrl[1];
            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgId.php"));
            array_push($media, $hash[0]['thumbnail_large']);
            array_push($media, '<iframe id="' . date("YmdHis") . $imgId . '" style="display: none; margin-bottom: 5px;" width="499" height="280" src="http://player.vimeo.com/video/' . $imgId . '" width="654" height="368" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen ></iframe>');
        } else {
            array_push($media, "", "");
        }
        return $media;
    }

    /** Return iframe code for Metacafe videos */
    static function mediaMetacafe($url)
    {
        $media = array();
        preg_match('|metacafe\.com/watch/([\w\-\_]+)(.*)|', $url, $matching);
        if ($matching[1] != "") {
            $vid = $matching[1];
            $vtitle = trim($matching[2], "/");
            array_push($media, "http://s4.mcstatic.com/thumb/{$vid}/0/6/videos/0/6/{$vtitle}.jpg");
            array_push($media, '<iframe id="' . date("YmdHis") . $vid . '" style="display: none; margin-bottom: 5px;" width="499" height="368" src="http://www.metacafe.com/embed/' . $vid . '" allowFullScreen frameborder=0></iframe>');
        } else {
            array_push($media, "", "");
        }
        return $media;
    }

    /** Return iframe code for Dailymotion videos */
    static function mediaDailymotion($url)
    {
        $media = array();
        $id = strtok(basename($url), '_');
        if ($id != "") {
            //$hash = file_get_contents("http://www.dailymotion.com/services/oembed?format=json&url=http://www.dailymotion.com/embed/video/$id");
            //$hash=json_decode($hash,true);
            //array_push($media, $hash['thumbnail_url']);

            array_push($media, "http://www.dailymotion.com/thumbnail/160x120/video/$id");
            array_push($media, '<iframe id="' . date("YmdHis") . $id . '" style="display: none; margin-bottom: 5px;" width="499" height="368" src="http://www.dailymotion.com/embed/video/' . $id . '" allowFullScreen frameborder=0></iframe>');
        } else {
            array_push($media, "", "");
        }
        return $media;
    }

    /** Return iframe code for College Humor videos */
    static function mediaCollegehumor($url)
    {
        $media = array();
        preg_match('#(?<=video/).*?(?=/)#', $url, $matching);
        $id = $matching[0];
        if ($id != "") {
            $hash = file_get_contents("http://www.collegehumor.com/oembed.json?url=http://www.dailymotion.com/embed/video/$id");
            $hash = json_decode($hash, true);
            array_push($media, $hash['thumbnail_url']);
            array_push($media, '<iframe id="' . date("YmdHis") . $id . '" style="display: none; margin-bottom: 5px;" width="499" height="368" src="http://www.collegehumor.com/e/' . $id . '" allowFullScreen frameborder=0></iframe>');
        } else {
            array_push($media, "", "");
        }
        return $media;

    }

    /** Return iframe code for Blip videos */
    static function mediaBlip($url)
    {
        $media = array();
        if ($url != "") {
            $hash = file_get_contents("http://blip.tv/oembed?url=$url");
            $hash = json_decode($hash, true);
            preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $hash['html'], $matching);
            $src = $matching[1];
            array_push($media, $hash['thumbnail_url']);
            array_push($media, '<iframe id="' . date("YmdHis") . 'blip" style="display: none; margin-bottom: 5px;" width="499" height="368" src="' . $src . '" allowFullScreen frameborder=0></iframe>');
        } else {
            array_push($media, "", "");
        }
        return $media;
    }

    /** Return iframe code for Funny or Die videos */
    static function mediaFunnyordie($url)
    {
        $media = array();
        if ($url != "") {
            $hash = file_get_contents("http://www.funnyordie.com/oembed.json?url=$url");
            $hash = json_decode($hash, true);
            preg_match('/<iframe.*src=\"(.*)\".*><\/iframe>/isU', $hash['html'], $matching);
            $src = $matching[1];
            array_push($media, $hash['thumbnail_url']);
            array_push($media, '<iframe id="' . date("YmdHis") . 'funnyordie" style="display: none; margin-bottom: 5px;" width="499" height="368" src="' . $src . '" allowFullScreen frameborder=0></iframe>');
        } else {
            array_push($media, "", "");
        }
        return $media;

    }

}
