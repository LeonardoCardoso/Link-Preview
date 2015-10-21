/**
 * Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */
app.directive('linkPreview', ['$compile', function ($compile) {

    var URL_REGEX = /((https?|ftp)\:\/\/)?([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?([a-z0-9-.]*)\.([a-z]{2,3})(\:[0-9]{2,5})?(\/([a-z0-9+\$_\-~@\(\)\%]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?/i;

    var trim = function (str) {
        return str.replace(/\s+/g, ' ').trim();
    };

    var hasUrl = function ($text) {
        return URL_REGEX.test($text);
    };

    var linker = function (scope, element, attrs) {

        element.bind({
            paste: function () {
                setTimeout(function () {
                    scope.textCrawling(trim(element.find('textarea')[0].value), scope, element, $compile);
                }, 100);
            },
            keyup: function (e) {
                if ((e.which === 13 || e.which === 32 || e.which === 17)) {
                    scope.textCrawling(trim(element.find('textarea')[0].value), scope, element, $compile);
                }
            }
        });

        scope.$watchGroup(
            ['userTyping', 'hideLoading', 'hidePreview', 'allowPost', 'preview', 'isFetching', 'posts'],
            function (newValues, oldValues, scope) {
                scope.userTyping = newValues[0];
                scope.hideLoading = newValues[1];
                scope.hidePreview = newValues[2];
                scope.allowPost = newValues[3];
                scope.preview = newValues[4];
                scope.isFetching = newValues[5];
                scope.posts = newValues[6];

                $compile(element.contents())(scope);
            });


    };

    return {
        restrict: 'E',
        scope: {
            type: '@type',
            placeholder: '@placeholder',
            imageAmount: '@iamount',
            buttonClass: '@bclass',
            buttonText: '@btext',
            loadingText: '@ltext',
            loadingImage: '@limage',
            thubmnailText: '@ttext',
            noThubmnailText: '@nttext',
            thumbnailPagination: '@tpage',
            userTyping: '='
        },
        link: linker,
        controller: function ($scope) {
            $scope.preview = {
                "title": "",
                "url": "",
                "pageUrl": "",
                "canonicalUrl": "",
                "description": "",
                "images": "",
                "video": "",
                "videoIframe": ""
            };

            $scope.hidePreview = true;

            $scope.hideLoading = true;

            $scope.isFetching = false;

            $scope.allowPost = false;

            $scope.type = angular.isDefined($scope.type) ? $scope.type : 'right';
            $scope.imageAmount = angular.isDefined($scope.imageAmount) ? $scope.imageAmount : -1;
            $scope.buttonClass = angular.isDefined($scope.buttonClass) ? $scope.buttonClass : 'primary';
            $scope.buttonText = angular.isDefined($scope.buttonText) ? $scope.buttonText : 'Post';
            $scope.loadingText = angular.isDefined($scope.loadingText) ? $scope.loadingText : 'Loading';
            $scope.loadingImage = angular.isDefined($scope.loadingImage) ? $scope.loadingImage : 'src/link-preview/img/empty.png';
            $scope.thubmnailText = angular.isDefined($scope.thubmnailText) ? $scope.thubmnailText : 'Choose a thumbnail';
            $scope.noThubmnailText = angular.isDefined($scope.noThubmnailText) ? $scope.noThubmnailText : 'No thumbnail';
            $scope.thumbnailPagination = angular.isDefined($scope.thumbnailPagination) ? $scope.thumbnailPagination : '%N of %N';

            $scope.textCrawling = function ($text, scope, element, $compile) {
                if (!$scope.isFetching) {
                    console.log($text, hasUrl($text));
                    if (hasUrl($text)) {
                        $scope.hidePreview = true;
                        $scope.hideLoading = false;
                        $scope.isFetching = true;
                    }
                }
                $compile(element.contents())(scope);
            };

        },
        // do not remove lp-* classes, you can customize them though
        templateUrl: 'src/link-preview/template/link-preview.html'
    };
}]);