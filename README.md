Link Preview (In Development)
==========================

Developed by <a href='https://github.com/LeonardoCardoso' target='_blank'>@LeonardoCardoso</a>. 

Follow <a href='https://twitter.com/lc_link_preview' target='_blank'>@lc_link_preview</a> on Twitter to get updates of what sites the people are successfully previewing around the globe.

## How this works

The algorithm keeps tracking what you are typing in the status field and through regular expressions identifies a url. Thereafter, the text is in the field is passed to PHP that does all the work to analyze all the source code of the url found. If you enter more than one url, it will consider that the first one is the more relevant and it will create a preview.
Once the source code of the url is obtained, regular expressions begin to seek out and capture relevant informations on it. These informations is basically the title page, the images contained therein, and a brief description of the content covered in the page.

For mode details, visit http://lab.leocardz.com/link-preview/

=======

## HTTP Server

- Apache (must support mod_php)


## How to add it to your project

<b>1 &bull; Scripts</b>

	<script src="https://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js" type="text/javascript"></script>
        
	<script src="src/link-preview/js/link-preview.js" type="text/javascript"></script>


<b>2 &bull; Stylesheets</b>

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    	
	<link rel="stylesheet" type="text/css" href="src/link-preview/css/link-preview.css" />
	

<b>3 &bull; Configuration</b>

Add the link preview module as a dependency to your application module:

	var app = angular.module('App', ['linkpreview'])
	

Add the directive inside your controller html:

	<link-preview placeholder="What's in your mind?" />
	

Attributes

|     att       |    	  var         |    default value    |           			  possible values         		    |
|:-------------:|:-------------------:|:-------------------:|:---------------------------------------------------------:|		
|     type  	|        type         |       right         |      			right, left, top, bottom // TO-DO  			|
|    amount		|     imageAmount     |         -1          |    						 any integer   		   	   	    |
|  	 btext		|       buttonText    |       Post          |    						 any string   		   	   	    |
| 	 bclass 	|       buttonClass   |       primary       |  default, primary, success, info, warning, danger, link 	|
|  	 ltext		|    loadingText      |       Loading       |    						 any string   		   	   	    |
| 	 limage 	|    loadingImage     |   	 empty.png      |         					any image url 					|
|  placeholder  |      placeholder    |   an empty string   |    						 any string   		   	   	    |
| 	 ttext 		|    thumbnailText    | Choose a thumbnail  |         					any string 		     			|
| 	 nttext 	|   noThumbnailText   | 	No thumbnail  	|         					any string 		     			|
|  	 tpage  	| thumbnailPagination |      %N of %N       |   any string, %N is the number reference of pagination    |
|  	 dtitle  	| 	 defaultTitle	  | 	Enter a title	|         					any string 		     			|
| ddescription  |  defaultDescription | Enter a description |         					any string 		     			|

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
			dtitle="" 
			ddescription="" />



<b>5 &bull; Database</b>

To custom your database configurations, you just need to change the following values in [php/classes/Database.php](https://github.com/LeonardoCardoso/Facebook-Link-Preview/blob/master/php/classes/Database.php)

		$host = "localhost";
        $user = "";
        $password = "";
        $database = "linkpreview";
        
Make sure your columns are the same as those ones in [linkpreview.sql](https://github.com/LeonardoCardoso/Link-Preview/blob/master/linkpreview.sql) or customize them.        


## Result Format

```json
	{  
	   "title":"title",
	   "url":"original url",
	   "pageUrl":"page url",
	   "canonicalUrl":"cannonical url",
	   "description":"description",
	   "images": "array of images",
	   "image": "first image of images",
	   "video":"yes|no",
	   "videoIframe":"video iframe if it is video"
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

Also where there is 'src/link-preview/' as part of a path of a <b>Javascript, CSS or image</b> file, 
you must change to the path on your server.


Examples
=================================

![Preview](/demo/img/preview.gif?raw=true "Preview")

![Preview Gallery](/demo/img/preview_gallery.gif?raw=true "Preview Gallery")

![Preview Video](/demo/img/preview_video.gif?raw=true "Preview Video")


Contact
=================================

Twitter: <a href='https://twitter.com/theleocardz' target='_blank'>@TheLeoCardz</a>

Email: contact@leocardz.com


License
=================================

	Copyright (c) 2015 Leonardo Cardoso (http://leocardz.com)
	Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
	and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
