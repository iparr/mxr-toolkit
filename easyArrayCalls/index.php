<?php
/* Landing page call to action helper snippet for ModX Revolution
	By Ian Parr - http://weare2020.com */

// array in format:
// title||description||image url||id of referenced resource

$input = '1cake1||2banana2||111
<h1>21cake1alt</h1>||22banana2||2323||222
31cake1||32banana2||3223||333';

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
	//	print_r($elem2);
	
		// if element supplied does not match pattern of 4 distinct values, then do not output markup
		if (sizeof($elem) == 3) {
			echo('
				<!-- input corrupted  -->
			');
		// if element correctly formed, construct HTML
		} else {
			echo '<li' . ( ($i == '1') ? ' class="fffff"'   : '') . '>
									<h2>
										<a href="' . strip_tags($elem[3]) . '">
											<img src="' . $elem[2] . '" alt="' . strip_tags($elem[0]) . '" />
										' . strip_tags($elem[0]) . '
										</a>
									</h2>
									<p>' . $elem[1] . '</p>
								</li>';
		};
	};
};

?>