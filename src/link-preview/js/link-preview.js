/**
 * Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
 * Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
 * and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
 *
 * Version: 1.0.0
 */
app.directive('linkPreview', ['$compile', '$http', function ($compile, $http) {

    var URL_REGEX = /((https?|ftp)\:\/\/)?([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?([a-z0-9-.]*)\.([a-z]{2,3})(\:[0-9]{2,5})?(\/([a-z0-9+\$_\-~@\(\)\%]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?/i;

    var trim = function (str) {
        return str.replace(/\s+/g, ' ').trim();
    };

    var hasUrl = function ($text) {
        return URL_REGEX.test($text);
    };

    var currentImageIndex = 1;
    var $mainTextArea;

    var linker = function (scope, element, attrs) {

        $mainTextArea = element.find('textarea')[0];
        $($mainTextArea).bind({ // Main textarea
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

        currentImageIndex = 1;

        if ($mainTextArea !== null && $mainTextArea !== undefined && $mainTextArea.value !== undefined) {
            $mainTextArea.value = "";
        }

        $scope.preview = {
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
                            data: "data=" + jsonData,
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).success(function (data, status, headers, config) {
                            console.log(data);
                            $scope.preview = data;

                            $scope.hasEmptyInfo($scope);

                            $scope.hidePreview = false;

                            $scope.hideLoading = true;

                            $scope.isFetching = false;

                            $scope.allowPosting = true;

                            $scope.enablePagination($scope);

                            $scope.updatePagination($scope, currentImageIndex);

                            // $compile(element.contents())(scope);
                        });

                    }
                }
                // $compile(element.contents())(scope);
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
                $scope.noThumbnail = $scope.preview.image === "";
                $scope.noImage = $scope.preview.image === "";
                $scope.leftArrowDisabled = $scope.preview.images.length == 1;
                $scope.rightArrowDisabled = $scope.preview.images.length == 1;
            };

            $scope.updatePagination = function ($scope, current) {
                var pagination = $scope.thumbnailPagination;
                pagination = pagination.replace("%N", current);
                pagination = pagination.replace("%N", $scope.preview.images.length);
                $scope.thumbnailPaginationText = pagination;

                $scope.leftArrowDisabled = current == 1;
                $scope.rightArrowDisabled = current == $scope.preview.images.length;
            };

            $scope.previousImage = function () {
                if (currentImageIndex != 1) {
                    currentImageIndex--;
                    $scope.setNewPreviewImage(currentImageIndex);
                }
            };

            $scope.nextImage = function () {
                if (currentImageIndex != $scope.preview.images.length) {
                    currentImageIndex++;
                    console.log(currentImageIndex);
                    $scope.setNewPreviewImage(currentImageIndex);
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

        },
        // do not remove lp-* classes, you can customize them though
        templateUrl: 'src/link-preview/template/link-preview.html'
    };
}]);