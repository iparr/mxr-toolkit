<?php
/*	audioWidget - HTML5 audio embed assistant snippet for ModX Revolution
	By Ian Parr - http://devolute.net

	This will just produce the correct, clean markup.
	Recommend using the wonderful SoundManager 2 for javascript control & interfaceless Flash fallback
	(http://www.schillmania.com/projects/soundmanager2/)
*/

	// display error if no mp3 link provided
	if ($mp3 == null) { return '<span style="color:red;">No mp3 found</span>'; }

	// if no ogg link provided, then guess (take mp3 link, swap extension)
	$ogg = $modx->getOption('ogg',$scriptProperties,null);
	if($ogg === null) {
		$ogg = pathinfo($mp3);
		$ogg = $ogg['dirname'] . '/' . $ogg['filename'] . '.ogg';
	// Could do with a method here to see if the file exists or not and return an appropriate response?
	}

	// disable ogg - remove link to ogg alternative source
	$disableOgg = $modx->getOption('disableOgg',$scriptProperties,null);
	if($disableOgg === 'true') { $disableOgg = ''; }
	elseif($disableOgg === null || $disableOgg === 'false') { $disableOgg = '<source src="' . $ogg . '" type="audio/ogg" />'; }
	
	$class = $modx->getOption('class',$scriptProperties,null);
	if($class === null) { $class = 'oemPedalWidget'; }

	// text message on link button
	$text = $modx->getOption('text',$scriptProperties,null);
	if($text === null) { $text = 'Play audio'; }

	// class on surrounding container div
	$class = $modx->getOption('class',$scriptProperties,null);
	if($class === null) { $class = 'oemPedalWidget'; }

	// class on link
	$buttonClass = $modx->getOption('buttonClass',$scriptProperties,null);
	if($buttonClass === null) { $buttonClass = 'button'; }

	$output = '<div class="' . $class . '">
		<a class="' . $buttonClass . '" href="' . $mp3 . '">' . $text . '</a>
		<audio>
			' . $disableOgg . '
			<source src="' . $mp3 . '" type="audio/mp3" />
		</audio>
	</div>';

	return $output;
?>