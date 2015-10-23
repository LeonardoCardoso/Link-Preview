/**
 * Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */
app.directive('linkPreview', ['$compile', '$http', '$sce', function ($compile, $http, $sce) {

    var URL_REGEX = /((https?|ftp)\:\/\/)?([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?([a-z0-9-.]*)\.([a-z]{2,3})(\:[0-9]{2,5})?(\/([a-z0-9+\$_\-~@\(\)\%]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@&#%=+\/\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?/i;

    var trim = function (str) {
        return str.replace(/\s+/g, ' ').trim();
    };

    var hasUrl = function ($text) {
        return URL_REGEX.test($text);
    };

    var linker = function (scope, element, attrs) {

        $(element.find('textarea')[0]).bind({ // Main textarea
            paste: function () {
                setTimeout(function () {
                    scope.textCrawling(element.find('textarea')[0].value, scope, element, $compile);
                }, 100);
            },
            keyup: function (e) {
                if ((e.which == 13 || e.which == 32 || e.which == 17)) {
                    scope.textCrawling(element.find('textarea')[0].value, scope, element, $compile);
                }
            }
        });

        $(element.find('input')[0]).bind({ // Preview title
            keyup: function (e) {
                if (e.which == 13) {
                    scope.previewTitleEditing = false;
                    $compile(element.find('input')[0])(scope);
                }
            }
        });


        $(element.find('textarea')[1]).bind({ // Preview description
            keyup: function (e) {
                if (e.which == 13) {
                    scope.previewDescriptionEditing = false;
                    $compile(element.find('textarea')[1])(scope);
                }
            }
        });

        scope.$watchGroup(
            ['hideLoading', 'hidePreview', 'allowPosting', 'preview', 'isFetching', 'posts', 'noThumbnail', 'noImage'],
            function (newValues, oldValues, scope) {
                scope.hideLoading = newValues[0];
                scope.hidePreview = newValues[1];
                scope.allowPosting = newValues[2];
                scope.preview = newValues[3];
                scope.isFetching = newValues[4];
                scope.posts = newValues[5];
                scope.noThumbnail = newValues[6];
                scope.noImage = newValues[7];
            });
    };

    var defaultValues = function ($scope) {

        $scope.currentImageIndex = 1;

        $scope.preview = {
            "text": "",
            "title": "",
            "url": "",
            "pageUrl": "",
            "canonicalUrl": "",
            "description": "",
            "image": "",
            "images": [],
            "video": "",
            "videoIframe": ""
        };

        $scope.showIframe = false;

        $scope.hidePreview = true;

        $scope.hideLoading = true;

        $scope.isFetching = false;

        $scope.allowPosting = false;

        $scope.rightArrowDisabled = true;

        $scope.leftArrowDisabled = true;

        $scope.noThumbnail = false;

        $scope.noImage = false;

        $scope.previewTitleEditing = false;

        $scope.previewDescriptionEditing = false;

        $scope.type = angular.isDefined($scope.type) ? $scope.type : 'right';
        $scope.imageAmount = angular.isDefined($scope.imageAmount) ? $scope.imageAmount : -1;
        $scope.buttonClass = angular.isDefined($scope.buttonClass) ? $scope.buttonClass : 'primary';
        $scope.buttonText = angular.isDefined($scope.buttonText) ? $scope.buttonText : 'Post';
        $scope.cancelButtonClass = angular.isDefined($scope.cancelButtonClass) ? $scope.cancelButtonClass : 'danger';
        $scope.cancelButtonText = angular.isDefined($scope.cancelButtonText) ? $scope.cancelButtonText : 'Cancel';
        $scope.loadingText = angular.isDefined($scope.loadingText) ? $scope.loadingText : 'Loading';
        $scope.loadingImage = angular.isDefined($scope.loadingImage) ? $scope.loadingImage : 'src/link-preview/img/empty.png';
        $scope.thubmnailText = angular.isDefined($scope.thubmnailText) ? $scope.thubmnailText : 'Choose a thumbnail';
        $scope.noThubmnailText = angular.isDefined($scope.noThubmnailText) ? $scope.noThubmnailText : 'No thumbnail';
        $scope.thumbnailPagination = angular.isDefined($scope.thumbnailPagination) ? $scope.thumbnailPagination : '%N of %N';
        $scope.defaultTitle = angular.isDefined($scope.defaultTitle) ? $scope.defaultTitle : 'Enter a title';
        $scope.defaultDescription = angular.isDefined($scope.defaultDescription) ? $scope.defaultDescription : 'Enter a description';
    };

    return {
        restrict: 'E',
        scope: {
            type: '@type',
            placeholder: '@placeholder',
            imageAmount: '@iamount',
            buttonClass: '@bclass',
            buttonText: '@btext',
            cancelButtonClass: '@cbclass',
            cancelButtonText: '@cbtext',
            loadingText: '@ltext',
            loadingImage: '@limage',
            thubmnailText: '@ttext',
            noThubmnailText: '@nttext',
            thumbnailPagination: '@tpage',
            defaultTitle: '@dtitle',
            defaultDescription: '@ddescription'
        },
        link: linker,
        controller: function ($scope) {

            $scope.posts = [];

            defaultValues($scope);

            $scope.textCrawling = function ($text, scope, element, $compile) {
                if (!$scope.isFetching && $text !== "") {
                    if (hasUrl($text)) {
                        $scope.hidePreview = true;
                        $scope.hideLoading = false;
                        $scope.isFetching = true;
                        $scope.allowPosting = false;

                        var url = 'src/link-preview/php/textCrawler.php';
                        var jsonData = angular.toJson({
                            text: $text,
                            imageAmount: $scope.imageAmount
                        });

                        $http({
                            url: url,
                            method: "POST",
                            data: "data=" + window.btoa(encodeURIComponent(jsonData)),
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).success(function (data, status, headers, config) {

                            $scope.preview = data;

                            if ($scope.preview.video) {
                                $scope.preview.videoIframe = $sce.trustAsHtml(data.videoIframe);
                            }

                            $scope.hasEmptyInfo($scope);

                            $scope.hidePreview = false;

                            $scope.hideLoading = true;

                            $scope.allowPosting = true;

                            $scope.enablePagination($scope);

                            $scope.updatePagination($scope);
                        });

                    }
                }
            };

            $scope.hasEmptyInfo = function ($scope) {
                if ($scope.preview.title == "") {
                    $scope.preview.title = $scope.defaultTitle;
                }
                if ($scope.preview.description == "") {
                    $scope.preview.description = $scope.defaultDescription;
                }
            };

            $scope.enablePagination = function ($scope) {
                var hasPreviewImage = $scope.preview.image === "" || $scope.preview.image === null;

                $scope.noThumbnail = hasPreviewImage;
                $scope.noImage = hasPreviewImage;

                $scope.leftArrowDisabled = $scope.preview.images.length == 1;
                $scope.rightArrowDisabled = $scope.preview.images.length == 1;
            };

            $scope.updatePagination = function ($scope) {
                var pagination = $scope.thumbnailPagination;
                pagination = pagination.replace("%N", $scope.currentImageIndex);
                pagination = pagination.replace("%N", $scope.preview.images.length);
                $scope.thumbnailPaginationText = pagination;

                $scope.leftArrowDisabled = $scope.currentImageIndex == 1;
                $scope.rightArrowDisabled = $scope.currentImageIndex == $scope.preview.images.length;
            };

            $scope.previousImage = function () {
                if ($scope.currentImageIndex != 1) {
                    $scope.currentImageIndex--;
                    $scope.setNewPreviewImage($scope.currentImageIndex);
                }
            };

            $scope.nextImage = function () {
                if ($scope.currentImageIndex != $scope.preview.images.length) {
                    $scope.currentImageIndex++;
                    $scope.setNewPreviewImage($scope.currentImageIndex);
                }
            };

            $scope.setNewPreviewImage = function ($index) {
                $scope.preview.image = $scope.preview.images[$index - 1];
                $scope.updatePagination($scope, $index);
            };

            $scope.editPreviewTitle = function () {
                $scope.previewTitleEditing = true;
            };

            $scope.editPreviewDescription = function () {
                $scope.previewDescriptionEditing = true;
            };

            $scope.resetPreview = function () {
                defaultValues($scope);
            };

            $scope.post = function (preview) {
                if ($scope.allowPosting) {

                    var url = 'src/link-preview/php/highlightUrls.php';
                    var jsonData = angular.toJson({
                        text: $scope.userTyping,
                        description: $scope.preview.description
                    });

                    $http({
                        url: url,
                        method: "POST",
                        data: "data=" + window.btoa(encodeURIComponent(jsonData)),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).success(function (data, status, headers, config) {

                        if ($scope.noThumbnail || $scope.noImage) {
                            $scope.preview.image = "";
                        }
                        $scope.preview.text = $sce.trustAsHtml(data.text);
                        $scope.preview.description = $sce.trustAsHtml(data.description);
                        $scope.userTyping = "";
                        $scope.posts.unshift(preview);
                        defaultValues($scope);
                    });
                }
            };

            $scope.deletePosted = function (post, $index) {
                $scope.posts.splice($index, 1);
            };

            $scope.imageAction = function (post) {

                if (post.video == false) {
                    window.open(post.pageUrl, '_blank');
                } else {
                    $scope.showIframe = true;
                }

            };

            $scope.hidePlay = function (post) {
                return post.video == false || $scope.showIframe == true;
            };

        },
        templateUrl: function (elem, attrs) {
            var file = attrs.type || 'right';
            return 'src/link-preview/template/link-preview-' + file + '.html'
        }
    };
}]);