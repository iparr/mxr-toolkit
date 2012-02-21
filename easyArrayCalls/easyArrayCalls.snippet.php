<?php
/* easyArrayCalls - Landing page call to action helper snippet for ModX Revolution
	By Ian Parr - http://weare2020.com */
	
//	THIS IS CURRENTLY TOTALLY SCREWED - NOT FOR USE

// array in format:
// title||description||image url||id of referenced resource

$input = '1cake1||2banana2||111
<h1>21cake1alt</h1>||22banana2||2323||222
31cake1||32banana2||3223||http://www.google.com
1cake1||2banana2||111
<h1>21cake1alt</h1>||22banana2||2323||222
31cake1||32banana2||3223||http://www.google.com';

// check to see if array has been created
if (!isset($input)) {

	echo 'no array found';

} else {

	$arr = array();

	// more reliable than explode
	$elems = preg_split( '/\r\n|\r|\n/', $input );

	// loop through each element supplied
	for($i=0; $i < sizeof($elems); $i++) {
		$elem = explode('||',$elems[$i]);
//		print_r($elem2);

		// if element supplied does not match pattern of 4 distinct values, then do not output markup
		if (sizeof($elem) == 3) {
			// remove from array?
			print_r($elems);
//			$elems = array_diff($elems, array($elems[$i]));
			echo('
				<!-- input corrupted  -->
			');
		// if element correctly formed, construct HTML
		} else {
			// check to see if the link is a conventional link, or an id to a ModX resource
			$suppliedLink = strip_tags($elem[3]);
			if (is_numeric ($suppliedLink)) {
				$link = '[[~' . $suppliedLink . ']]';
			} else {
				$link = $suppliedLink;
			};
			// on every 2n+3 add a clear class for IE
//			$output = '<li' . ( (($i % 3 == 0) && ($i != 0)) ? ' class="nthChild2n3Fix"' : '') . '>
			$output = '<li>
									<h2>
										'. $i .'
										<a href="' . $link . '">
											<img src="' . $elem[2] . '" alt="' . strip_tags($elem[0]) . '" />
										' . strip_tags($elem[0]) . '
										</a>
									</h2>
									<p>' . $elem[1] . '</p>
								</li>';
			echo $output;
		};
	};
};

?>