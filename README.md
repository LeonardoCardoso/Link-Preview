Facebook-Like Link Preview
==========================

[Build Status] ...

Developed by <a href='https://github.com/LeonardoCardoso' target='_blank'>@LeonardoCardoso</a>. 

Follow <a href='https://twitter.com/lc_link_preview' target='_blank'>@lc_link_preview</a> on Twitter to get updates of what sites the people are successfully previewing around the globe.

## How this works

The algorithm keeps tracking what you are typing in the status field and through regular expressions identifies a url. Thereafter, the text is in the field is passed to PHP that does all the work to analyze all the source code of the url found. If you enter more than one url, it will consider that the first one is the more relevant and it will create a preview.
Once the source code of the url is obtained, regular expressions begin to seek out and capture relevant informations on it. These informations is basically the title page, the images contained therein, and a brief description of the content covered in the page.

For mode details, visit http://lab.leocardz.com/link-preview/ ... [In progress]

![Link Preview](https://dl.dropboxusercontent.com/s/ocp2epovlj0w6w2/linkPreviewImageTimeLapse.png)

=======

## HTTP Server

- Apache (must support mod_php)


## How to added to your project

1 &bull; Scripts

... [In progress]

2 &bull; Stylesheets

... [In progress]

3 &bull; Configuration

... [In progress]

4 &bull; Database

To custom your database configurations, you just need to change the following values in [php/classes/Database.php](https://github.com/LeonardoCardoso/Facebook-Link-Preview/blob/master/php/classes/Database.php)

		$host = "localhost";
        $user = "";
        $password = "";
        $database = "linkpreview";
        
Make sure your columns are the same as those ones in [linkpreview.sql](https://github.com/LeonardoCardoso/Link-Preview/blob/master/linkpreview.sql).        



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


Contact
=================================

Twitter: <a href='https://twitter.com/theleocardz' target='_blank'>@TheLeoCardz</a>

Email: contact@leocardz.com


License
=================================

	Copyright (c) 2014 Leonardo Cardoso (http://leocardz.com)
	Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
	and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
