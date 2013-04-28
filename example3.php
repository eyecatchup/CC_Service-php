<?php
$WD = __DIR__ . DIRECTORY_SEPARATOR;
require_once $WD . 'CC_Service.php';
try {
  // define local JavaScript resource(s) to be compiled (use absolute paths!)
  $localFiles = array(
    '/var/www/project/static/js/script1.js',
    '/var/www/project/static/js/script2.js',
    '/var/www/project/static/js/script3.js',
  );

  // create new instance
  $cc = new CC_Service();

  // merge local files and create a temorarily public available resource
  $code_url = $cc->getTempUrl($localFiles);

  if ($code_url) {
    $cc->addScript($code_url);
	
    // save the compiled script(s) to a local file
    $filename = sprintf('scripts.min.%s.js', date('Ymd'));
    file_put_contents($WD . $filename, $cc->postService());

    print "Saved compiled script(s) to {$WD}{$filename}\n";
  }
}
catch (CC_Service_Exception $e) {
  die($e->getMessage());
}
