<?php
require('CC_Service.php');
try {
  // create a new instance of CC_Service
  $cc = new CC_Service();

  // define a new JavaScript resource to be compiled
  $code_url = 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js';
  $cc->addScript($code_url);

  // optionally, define other request parameters, than defaults
  $cc->setParam('compilation_level', 'WHITESPACE_ONLY');
  $cc->setParam('formatting', 'pretty_print');

  // request compiled the JavaScript from the API
  $compiledJs = $cc->postService();

  header("Content-Type: application/javascript;");
  print($compiledJs);
  // prints the compiled JavaScript
}
catch (CC_Service_Exception $e) {
  die($e->getMessage());
}