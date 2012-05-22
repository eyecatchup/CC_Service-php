<?php
require('CC_Service.php');
try {
  // create a new instance of CC_Service
  $cc = new CC_Service();

  // define a new JavaScript resource to be compiled
  $filename = 'jquery.js';
  $code_url = "http://ajax.googleapis.com/ajax/libs/jquery/1/$filename";
  $cc->addScript($code_url);

  // optionally, define other request parameters, than defaults
  $cc->setParam('compilation_level', 'WHITESPACE_ONLY');
  $cc->setParam('formatting', 'pretty_print');

  // request compiled the JavaScript from the API
  $compiledJs = $cc->postService();

  $now = date("YmdHis");
  $savefile = str_replace('.js', ".min.$now.js", $filename);
  file_put_contents(trim($savefile), $compiledJs);
  // saves the compiled JavaScript to local file
  print "Saved compiled JavaScript to $savefile";
}
catch (CC_Service_Exception $e) {
  die($e->getMessage());
}