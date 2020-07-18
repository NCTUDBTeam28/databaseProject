---
title: 'Readme'
disqus: hackmd
---

NVTU Database Project Team28
===
![downloads](https://img.shields.io/github/downloads/atom/atom/total.svg)
![build](https://img.shields.io/appveyor/ci/:user/:repo.svg)
![chat](https://img.shields.io/discord/:serverId.svg)

## Table of Contents


## Introdution
I am student major in EECS in NCTU.
I love jav.
Here I use simple example to show that how to create your own jav website.
(Due to some regulation, there is no adult video contained in this project.)
(Due to the fact that the original dataset was lack of casts of each viedo, 
I crawl on www.javhoo.com to find out the main characters of those videos via Beautifulsoup4.)

##
How to issue an simple av website?
website = Database + server + Domain name


##STEP 1:Database(MariaDB)
Fulfill query you want.
You just have to know how to use SQL lnaguage.

Here I create database using MariaDB in phpmyadmin.

Set account in phpmyadmin config.(config.inc.php)
'''
$cfg['Servers'][$i]['controluser'] = 'ben';
$cfg['Servers'][$i]['controlpass'] = '00000000';
'''

Create database
'''
CREATE DATABASE av;
USE av;
'''

load tables
'''
LOAD DATA LOCAL INFILE 'htdocs/data/actress.csv' 
INTO TABLE actress FIELDS 
TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\r\n';
'''
'''
LOAD DATA LOCAL INFILE 'htdocs/data/actress_censored_revised.csv' 
INTO TABLE actress_censored_revised FIELDS 
TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\r\n';
'''
'''
LOAD DATA LOCAL INFILE 'htdocs/data/censored.csv' 
INTO TABLE censored FIELDS 
TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY '\r\n';
'''

Create index on table
To optimize query, you have to create index 
'''
ALTER TABLE `actress` ADD INDEX ( `name` );
'''
'''
ALTER TABLE `actress_censored_revised` ADD INDEX ( `fanhao`, `actress`);
'''
'''
ALTER TABLE `censored` ADD INDEX ( `fanhao` );

'''
Drop table (if necessary)
'''
DROP TABLE 'censored';
'''

Drop index (if necessary)
'''
ALTER TABLE actress_censored_revised DROP fanhao;
'''

If you find the column name is COL 1, COL 2 .....etc, remember to modify them.
You can do that in either CMD or phpmyadmin GUI.

## STEP 2: Server(apache)
Fulfill query by webpage interface
You have to design both frontend(html) and backend(php) to define webpage behavior.

Here I establish connection using apache in phpmyadmin

In 

In php:
'''
  $serve = 'localhost';
  $username = 'ben';
  $password = '00000000';
  $dbname = 'av';
'''

Write your own html and php code
html: for website design. (here I to assigh method = "post")
php: for website behavior.

##STEP 3: Domain name(ngrok)
Let your website accessable by other terminals.
You have to apply for a domain name, manage ip problem, and some secure stuff like ssh connection.
Here I use ngrok to automatically deal with domain name and ip problem.

## Introdution

<<<<<<< HEAD


=======
Due to the fact that the original dataset was lack of casts of each viedo, I crawl on www.javhoo.com to find out the main characters of those videos via Beautifulsoup4.
  




>>>>>>> cc3e23f26f7159a721a777f8699da61b0bd74ec0

## Appendix and FAQ

:::info
**Find this document incomplete?** Leave a comment!
:::

###### tags: `Porn` `JAV` `phpmyadmin` `ngrok` 
