<?php
$WD = __DIR__ . DIRECTORY_SEPARATOR;

require_once $WD . 'CC_Service.php';
try {
  // name for the final script file
  $filename   = $WD . sprintf('scripts.min.%s.js', date('Ymd'));

  // define local JavaScript resource(s) to be compiled (use absolute paths!)
  $localFiles = array(
    '/var/www/project/static/js/script1.js',
    '/var/www/project/static/js/script2.js',
    '/var/www/project/static/js/script3.js',
  );

  // create new instance
  $cc = new CC_Service();

  // merge and upload the local files (to pastebin) to be available for the compiler
  $code_url = $cc->getTempUrl($localFiles);

  if ($code_url) {
    $cc->addScript($code_url);
    file_put_contents($filename, $cc->postService());
    print "Saved compiled script(s) to {$filename}\n";
  }
}
catch (CC_Service_Exception $e) {
  die($e->getMessage());
}
