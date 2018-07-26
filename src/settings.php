<?php 

// Custom Settings
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;
$config['db']['host']   = 'localhost';
$config['db']['user']   = 'root';
$config['db']['pass']   = 'Yekroh01';
$config['db']['dbname'] = 'phpslimtut';

// App is new slim app with settings from $config defined above
$app = new \Slim\App(['settings' => $config]);

?>