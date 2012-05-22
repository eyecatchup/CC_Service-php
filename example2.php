<?php
require('CC_Service.php');
try {
  // define a new JavaScript resource to be compiled
  $filename = 'jquery.js';
  $code_url = "http://ajax.googleapis.com/ajax/libs/jquery/1/$filename";
  
  // create a new instance of CC_Service
  $cc = new CC_Service($code_url);

  // request compiled JS from the API and save it to a local file
  $savefile = str_replace('.js', '.min.'.time().'.js', $filename); 
  file_put_contents(trim($savefile), $cc->postService());
  
  print "Saved compiled version of '$code_url' to '$savefile'.";
}
catch (CC_Service_Exception $e) {
  die($e->getMessage());
}