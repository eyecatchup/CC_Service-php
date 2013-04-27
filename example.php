<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'CC_Service.php';
try {
  // create a new instance of CC_Service
  $cc = new CC_Service();

  // define a new JavaScript resource to be compiled
  $code_url = 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js';
  $cc->addScript($code_url);

  // get the compiled JavaScript
  $compiledJs = $cc->postService();

  header('Content-type: application/javascript; charset=utf-8');
  print $compiledJs;   // prints the compiled JavaScript
}
catch (CC_Service_Exception $e) {
  die($e->getMessage());
}
