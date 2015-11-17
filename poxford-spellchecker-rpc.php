<?php
/*

Read about the spell check API: https://www.projectoxford.ai/spellcheck

The free offer provides access to the Spell Check APIs to detect and recognize a range of spelling errors. With this free plan, calling to the Spell Check APIs is limited to 7 transactions per minute and 5,000 transactions per month.

 */
define('POXFORD_SPELLCHECK_KEY','your-api-key'); // subscribe to get your key: https://www.projectoxford.ai/spellcheck


//http://www.tinymce.com/wiki.php/Configuration:spellchecker_rpc_url
if (isset($_POST['method'])) {

	$content = $_POST['text'];

	// This sample uses the Apache HTTP client from HTTP Components (http://hc.apache.org/httpcomponents-client-ga/)
	// added using `pear install HTTP_Request2`
	require_once 'HTTP/Request2.php';

	$request = new Http_Request2('http://api.projectoxford.ai/text/v1.0/spellcheck');
	$url = $request->getUrl();

	$headers = array(
	    // Request headers
	    'Content-Type' => 'application/x-www-form-urlencoded',
	    'Ocp-Apim-Subscription-Key' => POXFORD_SPELLCHECK_KEY,
	);

	$request->setHeader($headers);

	$parameters = array(
	    // Request parameters
	    'mode' => 'proof',
	    //'text' => $content
	);
	$url->setQueryVariables($parameters);
	$request->setMethod(HTTP_Request2::METHOD_POST);
	// Request body
	$request->setBody('Text=' . urlencode($content) );

	try {
	    $response = $request->send();
	    $r = $response->getBody();  // returns json
	    $a = json_decode($r, true); // convert json to an associative array

	    //convert the result to something tinymce spellchecker understands,
	    //see http://www.tinymce.com/wiki.php/Configuration:spellchecker_rpc_url
	    if (isset($a['spellingErrors'])) {
		    $ret['words'] = array();
		    foreach ($a['spellingErrors'] as $value) {
		    	foreach ($value['suggestions'] as $suggestion) {
		    		$ret['words'][$value['token']][] = $suggestion['token'];
	 	    	}
		    }
		    echo json_encode($ret);
		} elseif ( isset($a['statusCode']) && isset($a['message']) ) {
			printf('{"error": "%s: %s"}',$a['statusCode'], $a['message'] );
		}
	}
	catch (HttpException $ex) {
	    printf('{"error": "%s"}', $ex);
	}
}


