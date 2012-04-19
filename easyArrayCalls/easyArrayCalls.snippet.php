<?php
/* easyArrayCalls - Landing page call to action helper snippet for ModX Revolution
	By Ian Parr - http://weare2020.com

	array in format:
		id||title||description||image url
*/

// get the correct template. Thanks to Everet on the MX forums: http://forums.modx.com/index.php?topic=60242.0
$id = $modx->resource->get('id'); // This page's ID
$tv = $modx->getObject('modTemplateVar',array('name'=>'easyLandingCalls')); // Name of the TV to pull values from
$source = $tv->getValue($id);

// check to see if array has been created
if (!isset($source)) {

	echo 'no array found';

} else {

	$arr = array();
	$output = null;
	$twitterPresent = 0;
	$finalOutput = '<!-- No valid easy array information provided-->';

	// more reliable than explode
	$elems = preg_split( '/\r\n|\r|\n/', $source );

	// to count through valid array entries
	$j = 0;

	// loop through each element supplied
	for($i=0; $i < sizeof($elems); $i++) {
		$elem = explode('||',$elems[$i]);
//		print_r($elem);

		// invoke Twitter widget if twitter variable supplied correctly
		if ($elem[0] == 'twitter') {
			if (sizeof($elem) == 2) {
				$output[$j] ='<li class="twitter">
						<h2><a href="http://www.twitter.com/castrolfootball">Castrol Football on Twitter</a></h2>
						[[tweetCache? &username=`' . $elem[1] . '`]]
					</li>
				';
				$j++;
			} else {
				echo('<!-- twitter call invalid on item #' . $i . ' -->
				');
			}
			// let us know that Twitter is present
			$twitterPresent = 1;
		// if element supplied does not match pattern of 4 distinct values, then do not output markup
		} else if (sizeof($elem) != 4) {
			echo('<!-- input corrupted on item #' . $i . ' -->
			');
		// if element correctly formed, construct HTML
		} else {
			// check to see if the link is a conventional link, or an id to a ModX resource
			$suppliedLink = strip_tags($elem[0]);
			if (is_numeric ($suppliedLink)) {
				$link = '[[~' . $suppliedLink . ']]';
			} else {
				$link = $suppliedLink;
			};
			// on every 2n+3 add a clear class for IE/older browsers
			$output[$j] = '<li' . ( ($j % 2 == 0 && $j != 0) ? ' class="nthChild2n3Fix"' : '') . '>
					<h2>
						<a href="' . $link . '">
							<img src="' . $elem[3] . '" alt="' . $elem[1] . '" />
						' . $elem[1] . '
						</a>
					</h2>
					<p>' . $elem[2] . '</p>
				</li>';
			$j++;
		};

	};

	// determine whether to use one column, or two - basically if we're using the Twitter widget or not
	if($twitterPresent == 1) {
		$finalOutput = '<ul class="landingCalls">';
		for($k=0; $k < sizeof($output); $k++) {
			if ($k % 2 == 0) {
				$finalOutput .= $output[$k];
			}
		}
		$finalOutput .= '</ul>
			<ul class="landingCalls">';
		for($k=0; $k < sizeof($output); $k++) {
			if ($k % 2 != 0) {
				$finalOutput .= $output[$k];
			}
		}
		$finalOutput .= '</ul>';
	// no twitter, use one column
	} else {
		$finalOutput = '<ul id="landingCalls">';
		for($k=0; $k < sizeof($output); $k++) {
			$finalOutput .= $output[$k];
		}
		$finalOutput .= '</ul>';
	}

//	print_r($output);

	echo($finalOutput);

};