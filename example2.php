<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'CC_Service.php';
try {
  // define a new public JavaScript resource to be compiled
  $filename = 'jquery.js';
  $code_url = "http://ajax.googleapis.com/ajax/libs/jquery/1/$filename";
  
  // create a new instance of CC_Service
  $cc = new CC_Service($code_url);
  
  // optionally, define other request parameters, than defaults
  $cc->setParam('compilation_level', 'WHITESPACE_ONLY');
  $cc->setParam('formatting',        'pretty_print');

  // get the compiled JavaScript and save it to a local file
  $savefile = str_replace('.js', '.min.'.time().'.js', $filename); 
  file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . $savefile, $cc->postService());
  
  print "Saved compiled version of '{$code_url}' to '{$savefile}'.";
}
catch (CC_Service_Exception $e) {
  die($e->getMessage());
}