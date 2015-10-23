Link Preview
==========================

Developed by <a href='https://github.com/LeonardoCardoso' target='_blank'>@LeonardoCardoso</a>. 

Follow <a href='https://twitter.com/lc_link_preview' target='_blank'>@lc_link_preview</a> on Twitter to get updates of what sites the people are successfully previewing around the globe.

## How this works

The algorithm keeps tracking what you are typing in the status field and through regular expressions identifies a url. Thereafter, the text is in the field is passed to PHP that does all the work to analyze all the source code of the url found. If you enter more than one url, it will consider that the first one is the more relevant and it will create a preview.
Once the source code of the url is obtained, regular expressions begin to seek out and capture relevant informations on it. These informations is basically the title page, the images contained therein, and a brief description of the content covered in the page.

For mode details, visit http://lab.leocardz.com/link-preview/

|						     									      		|		    	  													            | 
:--------------------------------------------------------------------------:|:-----------------------------------------------------------------------------:|	
|						     									      		|		    	  													            | 
<b>Right</b>									  							| <b>Left</b>																	|
![Preview](/demo/img/preview.gif?raw=true "Preview")  						| ![Left](/demo/img/left.png?raw=true "Left")									|
<b>Bottom</b>										  						| <b>Top</b>																	|
![Bottom](/demo/img/bottom.png?raw=true "Bottom") 							| ![Top](/demo/img/top.png?raw=true "Top")										|
<b>Gallery<b> 											  					| <b>Video</b>																	|
![Preview Gallery](/demo/img/preview_gallery.gif?raw=true "Preview Gallery")| ![Preview Video](/demo/img/preview_video.gif?raw=true "Preview Video")		|


=======

## HTTP Server

- Apache (must support mod_php)


## How to add it to your project


<b>1 &bull; Stylesheets</b>

```html
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    	
	<link rel="stylesheet" type="text/css" href="src/link-preview/css/link-preview.css" />
```

<b>2 &bull; Scripts</b>

```html
	<script src="https://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js" type="text/javascript"></script>
        
	<script src="src/link-preview/js/link-preview.js" type="text/javascript"></script>
	
    <!-- Include this script below if you want to retrieve the posts inserted to database -->
    <script src="src/link-preview/js/link-preview-database.js" type="text/javascript"></script>
```
	

<b>3 &bull; Configuration</b>

Add the link preview module as a dependency to your application module:

```html
	var app = angular.module('App', ['linkpreview'])
```
	

Add the directive inside your controller html:

```html
	<link-preview placeholder="What's in your mind?" />
```
	

Attributes

|     att       |    	  var         |    default value    |           			  possible values         		    |
|:-------------:|:-------------------:|:-------------------:|:---------------------------------------------------------:|		
|     type  	|        type         |       right         |      			right, left, bottom, top (text position) 	|
|    amount		|     imageAmount     |         -1          |    						 any integer   		   	   	    |
|  	 btext		|       buttonText    |       Post          |    						 any string   		   	   	    |
|  	 bclass 	|       buttonClass   |       primary       |  default, primary, success, info, warning, danger, link 	|
| 	 cbtext		|  cancelButtonText   |       Cancel        |    						 any string   		   	   	    |
| 	 cbclass 	|  cancelButtonClass  |       danger        |  default, primary, success, info, warning, danger, link 	|
|  	 ltext		|    loadingText      |       Loading       |    						 any string   		   	   	    |
| 	 limage 	|    loadingImage     |   	 empty.png      |         					any image url 					|
|  placeholder  |      placeholder    |   an empty string   |    						 any string   		   	   	    |
| 	 ttext 		|    thumbnailText    | Choose a thumbnail  |         					any string 		     			|
| 	 nttext 	|   noThumbnailText   | 	No thumbnail  	|         					any string 		     			|
|  	 tpage  	| thumbnailPagination |      %N of %N       |   any string, %N is the number reference of pagination    |
|  	 dtitle  	| 	 defaultTitle	  | 	Enter a title	|         					any string 		     			|
| ddescription  |  defaultDescription | Enter a description |         					any string 		     			|

```html
	<link-preview 
			type="" 
			ttext="" 
			tpage="" 
			placeholder="" 
			amount="" 
			limage="" 
			ltext="" 
			btext="" 
			bclass=""
			ctext="" 
			cclass=""
			dtitle="" 
			ddescription="" />
```



<b>4 &bull; Database</b>

To custom your database configurations, you need to change the following values in [Database.php](/src/link-preview/php/classes/Database.php)

```php
		$host = "localhost";
        $user = "";
        $password = "";
        $database = "linkpreview";
```
        

Additionally, the way I used to retrieve the data was creating a controller [link-preview-database.js](/src/link-preview/js/link-preview-database.js)
which you can include the file somehow in your project or you can its content to yours.

```javascript
	app.controller('MyControllerDatabase', ['$scope', '$http', function ($scope, $http) {
    
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

    
    }]);
```
    
Also, check the file [database-template.php](src/link-preview/template/database-template.php) to see an example of how to display the data retrieved from database.    
       
Make sure your columns are the same as those ones in [linkpreview.sql](/src/link-preview/linkpreview.sql) or customize them.        


## Result Format

```json
	{  
	   "title":"title",
	   "url":"original url",
	   "pageUrl":"page url",
	   "canonicalUrl":"canonical url",
	   "description":"description",
	   "images": ["array of images"],
	   "image": "first image of images",
	   "video":"true|false",
	   "videoIframe":"video iframe, if it is a video"
	}
```

## Important
Make sure the library <b>php5-curl</b> is installed and enabled on the server, either locally or remotely. 

- Linux
```bash
$ sudo apt-get install php5-curl
$ sudo service apache2 restart
```
- Mac (via [macports](https://www.macports.org/))
```bash
$ sudo port install php5-curl 
$ sudo apachectl restart
```

Also where there is <b>'src/link-preview/'</b> as part of a path of a <b>Javascript, CSS or image</b> file, 
you must change to the path on your server.


Contact
=================================

Twitter: <a href='https://twitter.com/theleocardz' target='_blank'>@TheLeoCardz</a>

Email: contact@leocardz.com


License
=================================

	Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
	Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
	and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
