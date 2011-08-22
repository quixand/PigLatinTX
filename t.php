<?php

// =======================
// = random junk testing =
// =======================
// print '<h1>testing</h1><br /><br />';
// 

// shitf+cmd+return wow!

require_once('piglatinTX.class.php');
$onfigscay = array (
	// 'prefix' => 'vanilla'
	'prefix' => 'hyphenated',
	// 'prefix' => 'random',
	);
// $obj = new piglatinTX($onfigscay);
$obj = new piglatinTX();

function afunction($word='')
{
	$reg = '/^(.*)([\!\?]+)(.*)$/i';
	return preg_replace($reg, "$1$3$2", $word);
}


print '<p>->';


print afunction('hel?lo');


print '</p>';




?>