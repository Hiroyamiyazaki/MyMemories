<?php

$dsn = 'mysql:dbname=MyMemorieds;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

