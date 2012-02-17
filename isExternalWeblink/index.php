<?php
/*	isExternalWeblink - Check if a weblink is an internal or external one
	By Ian Parr - http://devolute.net */

	// break if no field supplied
	if ($field == null) { return '<span style="color:red;">No link to evaluate</span>'; }

	$theLink = $field;

	// check if link is prefixed with an http
	if (strpos($theLink, 'http://') !== false) {
		// add rel=external to link
		return ' rel="external"';
	}
?>