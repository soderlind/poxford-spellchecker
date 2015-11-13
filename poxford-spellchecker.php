<?php
/*
Plugin Name: Project Oxford Spell Check for TinyMCE
Plugin URI: https://github.com/soderlind/poxford-spellchecker
Description: Uses  Microsoft’s state-of-the-art cloud-based spelling algorithms to detect and recognize a wide variety of spelling errors.
Author: Per Soderlind
Version: 0.1.0
Author URI: http://soderlind.no
GitHub Plugin URI: soderlind/poxford-spellchecker
Credits: https://www.projectoxford.ai/doc/spellcheck/overview

Read about the spell check API: https://www.projectoxford.ai/spellcheck

The free offer provides access to the Spell Check APIs to detect and recognize a range of spelling errors.
With this free plan, calling to the Spell Check APIs is limited to 7 transactions per minute and 5,000 transactions per month.

Don't forget to set your API key in poxford-spellchecker-rpc.php

*/

if ( !defined( 'ABSPATH' ) ) {
	die( 'Cheating, are we?' );
}

function poxford_tiny_mce_settings( $tinyMCESettings ) {

	//$self_url = plugins_url(basename(__FILE__),__FILE__);
	$url = plugins_url('poxford-spellchecker-rpc.php',__FILE__);
	$tinyMCESettings['spellchecker_rpc_url'] =  $url;
	$tinyMCESettings['spellchecker_languages'] = 'All'; // 'All' is unrecognized and hence the language dropdown is removed ;)

	return $tinyMCESettings;

}
add_filter( 'tiny_mce_before_init', 'poxford_tiny_mce_settings' );

function poxford_add_spellchecker_again($tiny_mce_external_plugins) {
	$tiny_mce_external_plugins['spellchecker'] = plugins_url( 'tinymce/plugins/spellchecker/plugin.min.js', __FILE__ );
	return $tiny_mce_external_plugins;
}
add_filter('mce_external_plugins', 'poxford_add_spellchecker_again');

