<?php

// NOTE that ng-bind-html variables here are different from link-preview-*.html files.
// Here they are part of the object, while there they are part of the scope of each directive tag
// The same works for the vars showIframe,

?>
<div ng-controller="MyControllerDatabase">

    <div class="lp-outer-posted" ng-repeat="post in databasePosts">

        <div class="clearfix col-md-12 lp-posted lp-bottom">

            <span class="col-sm-12 lp-span lp-posted-text" ng-bind-html="post.textHTML"></span>

            <div class="col-sm-12 lp-posted-image lp-bottom" ng-click="imageAction(post)"
                 ng-class="{'lg-display-hide': post.image == ''}">

                <img ng-src="{{post.image}}" ng-class="{'lg-display-hide': post.showIframe == true}">

            <span><i class="fa fa-play lp-play lp-bottom"
                     ng-class="{'lg-display-hide': hidePlay(post)}"></i></span>

            <span ng-bind-html="post.videoIframeHTML"
                  ng-class="{'lg-display-hide': post.showIframe == false}"></span>

            </div>

            <a href="{{post.pageUrl}}" target="_blank">

                <div class="lp-posted-wrap col-sm-12">
                    <div class="col-sm-12 lp-posted-title lp-bottom">{{post.title}}</div>

                    <div class="col-sm-12 lp-posted-canonical-url lp-bottom">{{post.canonicalUrl}}</div>

                    <div class="col-sm-12 lp-posted-description lp-bottom" ng-bind-html="post.descriptionHTML"></div>
                </div>

            </a>

                <span class="col-sm-12 lp-span">

                    <span class="pull-right lp-posted-close" ng-click="deletePosted(post, $index)">
                        <i class="fa fa-close"></i>
                    </span>

                </span>

        </div>

    </div>
</div>