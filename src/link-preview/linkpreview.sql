# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.21)
# Database: linkpreview
# Generation Time: 2015-10-23 14:19:17 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table linkpreview
# ------------------------------------------------------------

DROP TABLE IF EXISTS `linkpreview`;

CREATE TABLE `linkpreview` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `image` text NOT NULL,
  `title` text NOT NULL,
  `canonicalUrl` varchar(300) NOT NULL,
  `url` varchar(500) NOT NULL,
  `pageUrl` varchar(500) NOT NULL,
  `description` text NOT NULL,
  `videoIframe` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `linkpreview` WRITE;
/*!40000 ALTER TABLE `linkpreview` DISABLE KEYS */;

INSERT INTO `linkpreview` (`id`, `text`, `image`, `title`, `canonicalUrl`, `url`, `pageUrl`, `description`, `videoIframe`)
VALUES
	(90,'http://www.imdb.com/list/ls015186022/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=2248695062&pf_rd_r=03S3DKWA4WBJZY9Q8Z2X&pf_rd_s=center-1&pf_rd_t=15061&pf_rd_i=homepage&ref_=hm_osc_cr_hd&pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=2248695062&pf_rd_r=03S3DKWA4WBJZY9Q8Z2X&pf_rd_s=center-1&pf_rd_t=15061&pf_rd_i=homepage#1','http://ia.media-imdb.com/images/M/MV5BMTgyNDk2NTE0MV5BMl5BanBnXkFtZTYwMDQ1NDg0._V1._SX266_SY400_.jpg','IMDb: Six Facts You Might Not Know About Oscars Host Chris Rock - a list by IMDb-Editors','www.imdb.com','http://www.imdb.com/list/ls015186022/?pf_rd_m=A2FGELUUNOQJNL','http://www.imdb.com/list/ls015186022/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=2248695062&pf_rd_r=03S3DKWA4WBJZY9Q8Z2X&pf_rd_s=center-1&pf_rd_t=15061&pf_rd_i=homepage&ref_=hm_osc_cr_hd&pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=2248695062&pf_rd_r=03S3DKWA4WBJZY9Q8Z2X&pf_rd_s=center-1&pf_rd_t=15061&pf_rd_i=homepage','Chris Rock has been named host of the 88th Annual Academy Awards™, airing Sunday, Feb. 28, 2016. Rock is best known for his stand-up comedy and acting. He is also a writer, producer, and director — which gives him experience in numerous Academy Awards™ categories. His background as a filmmaker makes him well-qualified to host the movie industry\'s biggest night. Here are a half-dozen facts you might not know about Chris Rock\'s career. — Sara Bibel',''),
	(91,'http://web.media.mit.edu/~mres/','','Mitchel Resnick','web.media.mit.edu','http://web.media.mit.edu/~mres/','http://web.media.mit.edu/~mres/','To support my work, please consider making a donation to the Code-to-Learn Foundation or the Resnick Teacher Scholarship Fund.',''),
	(92,'http://25.media.tumblr.com/076d514bbf5a5387f24a5896c26805af/tumblr_mlhc0rjpIc1rp499go2_400.gif','http://25.media.tumblr.com/076d514bbf5a5387f24a5896c26805af/tumblr_mlhc0rjpIc1rp499go2_400.gif','Just a minion gif!','25.media.tumblr.com','http://25.media.tumblr.com/076d514bbf5a5387f24a5896c26805af/tumblr_mlhc0rjpIc1rp499go2_400.gif','http://25.media.tumblr.com/076d514bbf5a5387f24a5896c26805af/tumblr_mlhc0rjpIc1rp499go2_400.gif',':D',''),
	(93,'http://www.nationalgallery.org.uk/','http://www.nationalgallery.org.uk/upload/img/N-6589-homepage_208x184.jpg','The National Gallery, London','www.nationalgallery.org.uk','http://www.nationalgallery.org.uk/','http://www.nationalgallery.org.uk/','The National Gallery houses one of the greatest collections of paintings in the world. Enjoy free entrance 361 days a year.',''),
	(94,'','https://i.kinja-img.com/gawker-media/image/upload/s--OqAhAoNZ--/c_fill,fl_progressive,g_center,h_200,q_80,w_200/u0939doeuioaqhspkjyc.png','Lifehacker - Tips and downloads for getting things done','lifehacker.com','http://lifehacker.com/','http://lifehacker.com/','Tips and downloads for getting things done',''),
	(95,'Youtube >> http://www.youtube.com/watch?v=cv2mjAgFTaI','http://i2.ytimg.com/vi/cv2mjAgFTaI/hqdefault.jpg','Mutemath - Blood Pressure [Official Music Video]','www.youtube.com','https://www.youtube.com/watch?v=cv2mjAgFTaI','https://www.youtube.com/watch?v=cv2mjAgFTaI','Â© 2011 Teleprompt/Warner Bros. Records Inc. \"Blood Pressure\" by Mutemath from Odd Soul, available now. Written, directed, and filmed in less than 24 hours du...','<div class=\"embed-responsive embed-responsive-16by9\"><iframe id=\"20151023121242cv2mjAgFTaI\" class=\"embed-responsive-item\" width=\"499\" height=\"368\" src=\"http://www.youtube.com/embed/cv2mjAgFTaI\" frameborder=\"0\" allowfullscreen></iframe></div>'),
	(96,'http://www.warnerchannel.com/br/series/','http://cdn.warnerestrenos.com/img/share/shared_link_series_por.jpg','Series | Warner Channel','www.warnerchannel.com','http://www.warnerchannel.com/br/series/','http://www.warnerchannel.com/br/series/','As melhores séries só pra você. Porque #WarnerEstreia',''),
	(97,'My own url with no thumb! http://lab.leocardz.com/facebook-link-preview-php--jquery/','','Facebook Link Preview: PHP + jQuery • Lab • LeoCardz','lab.leocardz.com','http://lab.leocardz.com/facebook-link-preview-php--jquery/','http://lab.leocardz.com/facebook-link-preview-php--jquery/','All of us know about the big phenomenon that Facebook is. And since they have always to keep inovating, new super interesting features appear. And the liking of Facebook Link Preview is almost ...',''),
	(98,'http://theverge.com/','https://cdn2.vox-cdn.com/uploads/network/placeholder_image/2/default-new.12.jpg','The Verge','www.theverge.com','http://www.theverge.com/','http://www.theverge.com/','The Verge was founded in 2011 in partnership with Vox Media, and covers the intersection of technology, science, art, and culture. Its mission is to offer in-depth reporting and long-form feature stories, breaking news coverage, product information, and community content in a unified and cohesive manner. The site is powered by Vox Media\'s Chorus platform, a modern media stack built for web-native news in the 21st century.',''),
	(99,'http://mashable.com/2015/10/22/instagram-boomerang/#h27f1ql3Uaq4','http://rack.1.mshcdn.com/media/ZgkyMDE1LzEwLzIyLzA5L1NjcmVlblNob3QyLjMwNTZmLnBuZwpwCXRodW1iCTEyMDB4NjI3IwplCWpwZw/9073089e/1c1/Screen-Shot-2015-10-22-at-10.18.38-AM.jpg','Instagram launches Boomerang, an app for 1-second videos','mashable.com','http://mashable.com/2015/10/22/instagram-boomerang/','http://mashable.com/2015/10/22/instagram-boomerang/','Instagram has blessed the world with its version of short, looping videos. And it\'s serious about short.',''),
	(100,'Tech news...','http://cdn1.tnwcdn.com/wp-content/blogs.dir/1/files/2015/10/Screen-Shot-2015-10-22-at-10.21.45-AM.png','The Next Web - International technology news, business and culture','thenextweb.com','http://thenextweb.com/','http://thenextweb.com/','The Next Web is one of the worldâs largest online publications that delivers an international perspective on the latest news about Internet technology, business and culture.',''),
	(101,'A Vimeo video: https://vimeo.com/141041381','http://i.vimeocdn.com/video/540550689_640.jpg','DARKLIGHT - 4K Full Film by Sweetgrass Productions','vimeo.com','https://vimeo.com/141041381','https://vimeo.com/141041381','Presented by Philips Ambilight TV In Association with Specialized and TomTom Bandit ActionCam Supported by Freefly Systems (MOVI), Bike Magazine, and CLIF Bar…','<div class=\"embed-responsive embed-responsive-16by9\"><iframe id=\"20151023121213141041381\" class=\"embed-responsive-item\" width=\"499\" height=\"280\" src=\"http://player.vimeo.com/video/141041381\" width=\"654\" height=\"368\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowFullScreen ></iframe></div>');

/*!40000 ALTER TABLE `linkpreview` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
