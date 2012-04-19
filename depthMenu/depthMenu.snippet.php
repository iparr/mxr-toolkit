<?php
/*
	depthMenu - Invokes a WayFinder call but only at appropriate levels

	WIP - Variables could be used to:
		* select different depth at which a menu should be called (default is level 3)
		* supply with chunks containing the WayFinder snippets themselves

	By Ian Parr - http://devolute.net
*/

$id = $modx->resource->get('id');
$levelcount = count($modx->getParentIds($id));

// at this level resource needs to be part of a 
if ($levelcount == 3) {

//	$parent = $resource->get('parent');

	// Deep enough so will need a menu
	$output = '<ul id="navTabs">';
	$output .= $modx->runSnippet('Wayfinder', array(
		'startId' => $modx->resource->get('parent'),
		'displayStart' => 'TRUE',
		'level' => '4',
		'outerTpl' => 'wfTplOuterEmpty',
		'rowTpl' => 'wfTplRow',
		'selfClass' => 'active',
		'startItemTpl' => 'wfTplRowStart'
	));
	$output .= '</ul>';
	
	return $output;

} else {

	// First fetch all the children of the current resource
	$children = $modx->resource->getMany('Children');
	// Check if there are any children
	if ($children) {
		$output = '<ul id="navTabs">';
		$output .= $modx->runSnippet('Wayfinder', array(
			'displayStart' => 'TRUE',
			'hideSubMenus' => 'TRUE',
			'level' => '3',
			'outerTpl' => 'wfTplOuterEmpty',
			'rowTpl' => 'wfTplRow',
			'selfClass' => 'active',
			'startItemTpl' => 'wfTplRowStartSelf'
		));
		$output .= '</ul>';
		
		return $output;
	}

}

?>
