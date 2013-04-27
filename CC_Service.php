<?php
/** CC_Service
 *
 *  PHP Wrapper Class to communicate with the RESTful Closure Compiler Service API.
 *  (c) Copyright 2012 Stephan Schmitz <eyecatchup@gmail.com>.
 *
 *  This package is intended for use of request compiled JavaScript source code
 *  from the Closure Compiler service, by providing methods to send HTTP POST
 *  Requests to the Closure Compiler's RESTful Service API.
 *
 *  What is the Closure Comiler?
 *
 *  The Closure Compiler is a tool, developed by Google, for making JavaScript
 *  run faster. The clue: Unlike similar tools, it doesn't only shrink the
 *  input code. It compiles from JavaScript to better JavaScript.
 *
 *  It parses your JavaScript, analyzes it, removes dead code and rewrites and
 *  minimizes what's left. It also checks syntax, variable references,
 *  and types, and warns about common JavaScript pitfalls.
 *
 *  The Closure Compiler can be used as:
 *  [*] An open source Java application that you can run from the command line:
 *      http://code.google.com/p/closure-compiler
 *      http://closure-compiler.googlecode.com/files/compiler-latest.zip
 *  [*] A simple web application:
 *      http://closure-compiler.appspot.com/home
 *  [*] A RESTful API
 *      https://developers.google.com/closure/compiler/docs/gettingstarted_api
 *
 *  More information about the Closure Compiler Service can be found here:
 *      https://developers.google.com/closure/compiler/
 *
 *  @category
 *  @package     CC_Service
 *  @author      Stephan Schmitz <eyecatchup@gmail.com>
 *  @copyright   2012 Stephan Schmitz
 *  @version     CVS: $Id: CC_Service.php,v 1.0.0 2012/05/22 17:01:17 ssc Exp $
 *  @license     http://eyecatchup.mit-license.org
 *  @link        https://github.com/eyecatchup/CC_Service-php/
 *
 *  LICENSE: Permission is hereby granted, free of charge, to any person
 *  obtaining a copy of this software and associated documentation files
 *  (the "Software"), to deal in the Software without restriction, including
 *  without limitation the rights to use, copy, modify, merge, publish, distribute,
 *  sublicense, and/or sell copies of the Software, and to permit persons to whom
 *  the Software is furnished to do so, subject to the following conditions:
 *
 *  The above copyright notice and this permission notice shall be included in all
 *  copies or substantial portions of the Software.
 *
 *  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 *  INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 *  PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 *  HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 *  OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 *  SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


/**  CC_Service_INI                 Set Service Defaults
 *
 *  To request compiled code or other information from the Closure Compiler service,
 *  you must send an HTTP POST request to the URL
 *      http://closure-compiler.appspot.com/compile.
 *  The body of the request must contain some required request parameters, and it can
 *  also contain a few optional parameters.
 *
 *  Those request parameters are explained and can be set as defaults below.
 *  NOTE: There is one required parameter that defines the JavaScript to be compiled.
 *  This parameter - 'code_url' - is NOT listed below, since it is no constant value.
 *
 *  @package     CC_Service
 *  @author      Stephan Schmitz <eyecatchup@gmail.com>
 *  @see         https://developers.google.com/closure/compiler/docs/api-ref
 */
interface CC_Service_INI
{
    #########################################################
    ## REQUIRED REQUEST PARAMETERS (OTHER THAN 'code_url')
    #########################################################

    #########################################################
    ##  compilation_level
    #########################################################
    ##  The degree of compression and optimization to apply to your JavaScript.
    ##  The compilation_level parameter defaults to a value 2 (SIMPLE_OPTIMIZATIONS).
    ##
    ##  @see    https://developers.google.com/closure/compiler/docs/api-ref#level
    ##
    ##  There are three possible compilation levels:

    /*  WHITESPACE_ONLY
     *  Just removes whitespace and comments from your JavaScript.
     */
    #const compilation_level = 'WHITESPACE_ONLY';

    /*  SIMPLE_OPTIMIZATIONS
     *  Performs compression and optimization that does not interfere
     *  with the interaction between the compiled JavaScript and other JavaScript.
     *  This level renames only local variables.
     */
    const compilation_level = 'SIMPLE_OPTIMIZATIONS';

    /*  ADVANCED_OPTIMIZATIONS
     *  Achieves the highest level of compression by renaming symbols in your JavaScript.
     *  When using ADVANCED_OPTIMIZATIONS compilation you must perform extra steps to
     *  preserve references to external symbols.
     *  @see    https://developers.google.com/closure/compiler/docs/api-tutorial3
     */
    #const compilation_level = 'ADVANCED_OPTIMIZATIONS';

    #########################################################
    ##  output_format
    #########################################################
    ##  The format for the Closure Compiler service's output.
    ##
    ##  @see    https://developers.google.com/closure/compiler/docs/api-ref#out
    ##
    ##  There are three possible output formats:

    /*  xml
     *  The xml output format wraps the requested information in valid XML.
     */
    #const output_format = 'xml';

    /*  json
     *  The json output format wraps the requested information in a JSON string.
     *  Evaluation of this string as JavaScript returns a JavaScript Object.
     */
    #const output_format = 'json';

    /*  text
     *  The text output format returns raw text without tags or JSON brackets.
     *  If the output_info includes compiled_code, the text contains JavaScript.
     *  If the output_info includes warnings, the text contains warning messages.
     *  If the output_info includes statistics, the text contains statistics.
     */
    const output_format = 'text';

    #########################################################
    ##  output_info
    #########################################################
    ##  Indicates the kind of output you want from the compiler.
    ##  The output_info parameter defaults to a value of compiled_code.
    ##
    ##  @see    https://developers.google.com/closure/compiler/docs/api-ref#output_info
    ##
    ##  There are four possible output formats:

    /*  compiled_code
     *    A compressed and optimized version of your input JavaScript.
     */
    const output_info = 'compiled_code';

    /*  warnings
     *    Messages that indicate possible bugs in your JavaScript.
     */
    #const output_info = 'warnings';

    /*  errors
     *     Messages that indicate syntax errors or other errors in your JavaScript.
     */
    #const output_info = 'errors';

    /*  statistics
     *    Information about the degree of compression that the Closure Compiler achieves.
     */
    #const output_info = 'statistics';


    #########################################################
    ## OPTIONAL REQUEST PARAMETERS
    #########################################################

    const js_externs = '';
    const externs_url = '';
    const exclude_default_externs = '';
    const output_file_name = '';
    const formatting = '';
    const use_closure_library = '';
    const warning_level = '';
	
    #########################################################
    ## PASTEBIN.COM API KEY
    #########################################################

	/*
	 * The closure compiler can receive Javascript as a string or as public URL. 
	 * Since the string option is limited in length, we prefer the code_url-method. 
	 * However, since we want to compile local scripts, that don't have a public URL,
	 * we use pastebin.com's API to create a temporarily, public available URL for 
	 * our scripts by creating a temp paste and passing the raw paste URL to the compiler.
	 * Therefore, you need an API key, which is freely available at pastebin.com.
	 */
    const pastebin_apikey = '';
}

/**  CC_Service                     Access Closure Compiler API
 *
 *  Brief example of use:
 *
 *  <code>
 *  // create a new instance of CC_Service
 *  $cc = new CC_Service();
 *
 *  // define a new JavaScript resource to be compiled
 *  $code_url = 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js';
 *  $cc->addScript($code_url);
 *
 *  // optionally, define other request parameters, than defaults
 *  $cc->setParam('compilation_level', 'WHITESPACE_ONLY');
 *  $cc->setParam('formatting', 'pretty_print');
 *
 *  // request compiled the JavaScript from the API
 *  $compiledJs = $cc->postService();
 *
 *  header("Content-Type: application/javascript;");
 *  print($compiledJs);
 *  // prints the compiled JavaScript
 *
 *  </code>
 *
 *  @category
 *  @package     CC_Service
 *  @author      Stephan Schmitz <eyecatchup@gmail.com>
 *  @copyright   2012 Stephan Schmitz
 *  @version     CVS: $Id: CC_Service.php,v 1.0.0 2012/05/22 17:01:17 ssc Exp $
 *  @license     http://eyecatchup.mit-license.org
 *  @link        https://github.com/eyecatchup/CC_Service-php/
 */
class CC_Service implements CC_Service_INI
{
    const CC_POST_URL = 'http://closure-compiler.appspot.com/compile';
    private $Service_URL, $pastebinApiKey;
    public  $Request_Params;
    protected $Valid_Params;

    /*  __constructor
     *  @access public
     */
    public function __construct($a=NULL) {
        $this->Service_URL    = CC_Service::CC_POST_URL;
        $this->Request_Params = self::initRequestParams();
        $this->Valid_Params   = self::getValidParams();
        $this->pastebinApiKey = CC_Service_INI::pastebin_apikey;

        self::setParam('compilation_level',
                CC_Service_INI::compilation_level);
        self::setParam('output_format',
                CC_Service_INI::output_format);
        self::setParam('output_info',
                CC_Service_INI::output_info);

        if (NULL !== $a)
            self::setParam('code_url', $a);
    }

    // addScript ($val)                Public setter for script resources to be compiled.
    public function addScript ($val) {
        // check if we got a single url as a string?
        if (is_string($val) AND strlen($val) > 0) :
            // check if the string is actualy pointing to a public available JS file.
            if (TRUE===self::_verifyScript($val)) :
                return self::_addScript($val);
            else :
                return FALSE;
            endif;
        // check if we got multiple urls given as an array?
        elseif (is_array($val) AND sizeof($val) > 0) :
            foreach($val AS $str) :
                // check if the string is actualy pointing to a public available JS file.
                if (TRUE===self::_verifyScript($str))
                    self::_addScript($str);
            endforeach;
        endif;
    }
	
    /*  postService ()                 Triggers a POST data request to the compiler.
     */
    public function postService () {
        return self::_postService ();
    }
    /*  setParam ($param, $val)        Public setter for request parameters
     *  @access public
     *  @uses            _setParam
     *  @param  String   $param        The parameter name
     *  @param  Mixed    $val          The parameter value as a string value. An
     *                                 array of strings may be given for 'code_url'.
     *  @return Bool                   Returns true if parameter value was set.
     */
    public function setParam ($param, $val) {
        return (bool) self::_setParam ($param, $val);
    }
	
	public function getTempUrl($data) {
	    return self::_getTempUrl($data);
	}

    /* _addScript ($str)               Private setter for script resources to be compiled.
     */
    private function _addScript ($str) {
        $code_url = $this->Request_Params['Required']['code_url'];
        if ($code_url == '') : // on init
            $this->Request_Params['Required']['code_url'] = Array($str);
        elseif (is_array($code_url)) :
            if (in_array($str, $code_url)) :
                // already exists
                return FALSE;
                // add the item to the existing array and re-asign
            else :
                $code_url[] = $str;
				//print "adding code url: $str\n";
            endif;
            $this->Request_Params['Required']['code_url'] = $code_url;
			//print_r($code_url);
            return TRUE;
        else :
            // unknown error
            return FALSE;
        endif;
    }
	
	private static function _getTempUrl($data) {
		if (!is_array($data)) {
			return false;
		}
		else {		
			// merge all scripts into a single string
			$scriptData = '';  
			foreach ($data as $script) {
				$localFile = str_replace('/', DIRECTORY_SEPARATOR, $script);
				if (file_exists($localFile)) {
					$scriptData .= trim(file_get_contents($localFile));
				}
			}
			
			// temporarily save the combined string online to be available for the compiler
			$pb = HttpRequest::sendPostDataArray('http://pastebin.com/api/api_post.php', array(
				'api_dev_key'           => $this->getPastebinApiKey(),			// your dev key
				'api_option'            => 'paste',                   			// action to perform
				'api_paste_code'        => utf8_decode($scriptData),    		// the paste text
				'api_paste_private'     => '1',     							// 0=public 1=unlisted 2=private
				'api_paste_expire_date' => '1H',    							// paste expires in 1h
			));

			if (is_array($pb) && isset($pb['error'])) {
				return false;
			}
			else {
				// return the temp paste url (which can now be used as value for the 'code_url' parameter.
				return str_replace('m/', 'm/raw.php?i=', $pb);
			}				
		}
	}
	
    /*  _postService ()                Checks params and sends POST data request to the compiler.
     */
    private function _postService () {
        $missing=$postDataArray=Array();
        $requiredParams=$this->Request_Params['Required'];
        foreach ($requiredParams AS $k => $v) :
            if ($k != 'code_url') :
                if (strlen($v) == 0) :
                    $missing[]=$k;
                else :
                    $postDataArray[$k] = urlencode($v);
                endif;
            elseif ($k == 'code_url') :
                if (is_array($v) AND sizeof($v) > 0) :
                    foreach ($v AS $code_url) :
                        $postDataArray['code_url'][] = $code_url;
                    endforeach;
                else :  $missing[] = 'code_url';
                endif;
            endif;
        endforeach;
        if (sizeof($missing) > 0) :
            $err = "Required fields missing: '" . implode("', '", $missing) ."'";
            throw new CC_Service_Exception($err);
        else :
            $optionalParams=$this->Request_Params['Optional'];
            foreach($optionalParams AS $k => $v) :
                if (is_string($v) AND strlen($v) > 0) :
                    $postDataArray[$k] = urlencode($v);
                endif;
            endforeach;
            return HttpRequest::sendPostDataArray(self::CC_POST_URL, $postDataArray);
        endif;
    }
	
    /*  _setParam ($param, $val)       Private setter for request parameters
     *  @access public
     *  @param  String    $param       The parameter name
     *  @param  Mixed     $val         The parameter value AS a string value. An
     *                                 array of strings may be given for 'code_url'.
     *  @return Bool                   Returns true if parameter value was set.
     */
    private function _setParam ($param, $val) {
        // code_url parameter is set seperately
        if ($param == 'code_url') :
            return self::addScript($val);
        // check if it's another required parameter name than code_url?
        elseif ( array_key_exists($param, $this->Valid_Params['Required']) ) :
            if ( in_array($val, $this->Valid_Params['Required'][$param] )) :
                // if value for parameter is valid, set it.
                $this->Request_Params['Required'][$param] = $val;
                return TRUE;
            else : // if required parameter name exist, but value is invalid.
                CC_Service_Exception::invalidValue($param,
                    $this->Valid_Params['Required'][$param]);
            endif;
        // check if it's an optional parameter name?
        elseif ( array_key_exists($param, $this->Valid_Params['Optional']) ) :
            $ak = $this->Valid_Params['Optional'][$param];
            if ( is_array($ak) AND in_array($val, $ak)) :
                // if value for parameter is valid, set it.
                $this->Request_Params['Optional'][$param] = $val;
                return TRUE;
                /**
                 * TODO: FIX THAT !!!
                 */
            elseif ( !is_array($ak) ) :
                $this->Request_Params['Optional'][$param] = $val;
                return TRUE;
            else : // if optional parameter name exist, but value is invalid.
                CC_Service_Exception::invalidValue($param,
                    $this->Valid_Params['Optional'][$param]);
            endif;
        // if we're here, the given parameter name is not valid, so exit.
        else : throw new CC_Service_Exception("Parameter $param doesn't exist.");
        endif;
    }
	
    /* _verifyScript ($str)            Checks if the input string is a valid script resource.
     */
    private function _verifyScript ($str) {
        // sanitize the url to help PHP' parse_url to match the url parts.
        $str = 'http://'. preg_replace('#^https?://#', '', $str);
        $ck = @parse_url($str);
        if (!isset($ck['host']) OR !isset($ck['path'])) :
            return FALSE;
        else :
            // check the path key for JS file type by pattern
            if (!preg_match('#.js$#', $ck['path'])) :
                return FALSE;
            else :
                // check if resource is actualy available online
                unset($ck['query']);
                $script_url = 'http://' . $ck['host'] . $ck['path'];
                $httpCode = HttpRequest::getHttpCode($script_url);
                return (bool) ($httpCode == 200);
            endif;
        endif;
    }
	
	private function getPastebinApiKey() 
	{
		if (32 !== strlen($this->pastebinApiKey)) {
			$e = 'Invalid "pasebin_apikey" constant in CC_Service_INI interface (see inline documentation).';
			throw new CC_Service_Exception($e);
			die(0);
		}
		else {
			return $this->pastebinApiKey;
		}
	}

    /* initRequestParams ()            Load default parameter values from interface.
     */
    private function initRequestParams () {
        return array(
            'Required' => array(
                'code_url' => '',
                'compilation_level' => '',
                'output_format' => '',
                'output_info' => ''
            ),
            'Optional' => array(
                'js_externs' => '',
                'externs_url' => '',
                'exclude_default_externs' => '',
                'output_file_name' => '',
                'formatting' => '',
                'use_closure_library' => '',
                'warning_level' => ''
            )
        );
    }
	
    /* getValidParams ()               Get an array conatining all valid parameter values.
     */
    public function getValidParams () {
        return array(
            'Required' => array(
                'compilation_level' => array('WHITESPACE_ONLY','SIMPLE_OPTIMIZATIONS','ADVANCED_OPTIMIZATIONS'),
                'output_format' => array('xml','json','text'),
                'output_info' => array('compiled_code','warnings','errors','statistics')
            ),
            'Optional' => array(
                'js_externs' => '',
                'externs_url' => '',
                'exclude_default_externs' => '',
                'output_file_name' => '',
                'formatting' => array('pretty_print','print_input_delimiter'),
                'use_closure_library' => array('true','false'),
                'warning_level' => array('QUIET','DEFAULT','VERBOSE')
            )
        );
    }
}

/**  HttpRequest                     HTTP Request Helper
 */
class HttpRequest extends CC_Service
{
    public static function sendPostDataArray($a, $b) {
        $postUrl     = $a;
        // Parameter key value pair array expected
        // eg array('param' => 'value', 'filter' => 'none')
        $postRequest  = http_build_query($b);
		$fixedRequest = preg_replace('/url%5B\d%5D/', 'url', $postRequest);
		#print $fixedRequest;
		
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $postUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fixedRequest);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        if($info['http_code'] == 200) {
            return $output;
        }
        else { return array('error' => $info); }
    }

    /**
     * HTTP HEAD request with curl.
     *
     * @access        private
     * @param         string        $url        String, containing the
     *                                          initialized object URL.
     * @return        intval                    Returns a HTTP status code.
     */
    public static function getHttpCode($url) {
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_USERAGENT,'' );
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_NOBODY,1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
        $str = curl_exec($ch);
        $int = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        curl_close($ch);

        return intval($int);
    }
}

/**  CC_Service_Exception             Exception Helper
 */
class CC_Service_Exception extends Exception
{
    public static function invalidValue($k, $a) {
        $err = "Invalid value for parameter $k defined.";
        $err .= "Value must be one of: '" . substr(implode("', '", $a),0,-1) ."'.";
        throw new CC_Service_Exception($err);
        exit();
    }
}
