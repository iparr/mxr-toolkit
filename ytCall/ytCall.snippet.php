<?php
/*	ytCall - YouTube embed assistant snippet for ModX Revolution
	By Ian Parr - http://devolute.net */

	// break if no YouTube ID
	if ($id == null) { return '<span style="color:red;">Flickr id malformed</span>'; }

	// defaults
	$color = $modx->getOption('color',$scriptProperties,null);
	if($color === null) { $color = 'white'; }

	$theme = $modx->getOption('theme',$scriptProperties,null);
	if($theme === null) { $theme = 'dark'; }

	$width = $modx->getOption('width',$scriptProperties,null);
	if($width === null) { $width = '549'; }

	$widescreen = $modx->getOption('widescreen',$scriptProperties,null);
	if($widescreen === null || $widescreen === 'true') { $widescreen = round(($width/16)*9); }
	elseif($widescreen === 'false') { $widescreen = round(($width/4)*3); }

	$divClass = $modx->getOption('divClass',$scriptProperties,null);
	if($divClass === null) { $divClass = 'youtubeEmbed'; }

	$output = '<div class="' . $divClass . '">
		<object width="' . $width . '" height="' . $widescreen . '"
				data="http://www.youtube.com/v/' . $id . '?version=3&amp;hl=en_US&amp;rel=0&amp;showinfo=0&amp;color=' . $color . '&amp;autohide=1&amp;theme=' . $theme . '"
				type="application/x-shockwave-flash">
			<param name="allowFullScreen" value="true" />
			<param name="allowscriptaccess" value="always" />
			<param name="src"
				value="http://www.youtube.com/v/' . $id . '?version=3&amp;hl=en_US&amp;rel=0&amp;showinfo=0&amp;color=' . $color . '&amp;autohide=1&amp;theme=' . $theme . '" />
			<param name="allowfullscreen" value="true" />
		</object>
	</div>';

	return $output;
?>