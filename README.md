# CC_Service-php
PHP Wrapper Class to communicate with the RESTful Closure Compiler Service API.

This package is intended for use of request compiled JavaScript source code from the Closure Compiler service, by providing methods to send HTTP POST Requests to the Closure Compiler's RESTful Service API.

## What is the Closure Compiler?

The Closure Compiler is a tool, developed by Google, for making JavaScript run faster. The clue: Unlike similar tools, it doesn't only shrink the input code. It compiles from JavaScript to better JavaScript.

It parses your JavaScript, analyzes it, removes dead code and rewrites and minimizes what's left. It also checks syntax, variable references, and types, and warns about common JavaScript pitfalls.

More information about the Closure Compiler Service can be found here: https://developers.google.com/closure/compiler/

## Usage

### Brief example of use
```php
<?php
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
catch (CC_Service_Exception $e)
{
  die($e->getMessage());
}
```

### Service interface
The request parameter defaults are set to use the API's defaults. They are explained and can be changed in the class interface https://github.com/eyecatchup/CC_Service-php/blob/master/CC_Service.php#L76
