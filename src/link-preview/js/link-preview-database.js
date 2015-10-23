/**
 * Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */

app.controller('MyControllerDatabase', ['$scope', '$http', '$sce', function ($scope, $http, $sce) {

    $scope.databasePosts = [];
    $scope.retrieveFromDatabase = function () {

        // You must insert in your page a div with the posts retrieved from database. Just like the posts div
        // on template html files

        var url = 'src/link-preview/php/retrieve.php';
        $http({
            url: url,
            method: "GET",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (data, status, headers, config) {

            for (var i = 0; i < data.length; i++) {
                data[i].video = data[i].videoIframe !== "";
                data[i].showIframe = false;
                data[i].textHTML = $sce.trustAsHtml(data[i].text);
                data[i].descriptionHTML = $sce.trustAsHtml(data[i].description);
                data[i].videoIframeHTML = $sce.trustAsHtml(data[i].videoIframe);
                console.log(data[i]);
            }

            $scope.databasePosts = data;

        });

    };

    $scope.deletePosted = function (post, $index) {
        $scope.posts.splice($index, 1);
    };

    $scope.imageAction = function (post) {

        if (post.video == false) {
            window.open(post.pageUrl, '_blank');
        } else {
            post.showIframe = true;
        }

    };

    $scope.hidePlay = function (post) {
        return post.video == false || post.showIframe == true;
    };

    $scope.layoutWithoutImage = function (post) {
        return post.image == '' || post.showIframe == true;
    };

    $scope.layoutWithImage = function (post) {
        return post.image != '' || (post.video == true && post.showIframe == false);
    };

    $scope.retrieveFromDatabase();

}]);