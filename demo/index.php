<?php

/**
 * main index page, controller
 *
 * @author Nick Fox
 */

require_once('../piglatinTX.class.php');

/**
 * store any errors
 *
 * @author NickMBP
 */
$errormsg = '';
$translated = '';
$showErrorStyle = '';
// =================================================
// = Configure this array for styles of conversion =

$onfigscay = array (
	'prefix' => 'vanilla',
	// 'prefix' => 'hyphenated',
	// 'prefix' => 'random',
	);
// =================================================

if( isset($_GET['tx']) ){
	try{
		$obj = new piglatinTX($onfigscay);
		// $obj = new piglatinTX();

		$input = explode(' ', $_GET['tx']);
		foreach(  $input as &$word ){
			$word = $obj->translate($word);
		}
		$translated = implode(' ', $input);
		print $translated;
		exit;
	} catch (Exception $e) {
		$errormsg = $e;
		$showErrorStyle = '#warningBar{display:block;}';
	}
}




?>

<!DOCTYPE html>
<html>
	<head>
		<title>PigLatinTX</title>
		<link href="../css/piggy.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.9.custom.min.js"></script>
		<script type="text/javascript" src="../js/jquery.ui.button.js"></script>
		<script type="text/javascript" src="../js/piggy.js"></script>
        <style type="text/css">
			<?php print $showErrorStyle; ?>
        </style>
	</head>
	<body>
		<div id="header">
			<div id="warningBar"><?php print $errormsg; ?></div>
			<div id="menubar"><ul><li>Nick Fox - quixand@gmail.com</li></ul></div>
			<div id="title">
				<h1>Pig Latin Translator</h1>
				<!-- img src="images/title_crap.png" -->
			</div>			
		</div>
		<div id="txform">
			<form action="" method="post">
				<h2>You type, i'll translate...</h2>

				<textarea name="txTextarea" id="txTextarea"style="height:20px">yellow</textarea>
				<input type="button" class="txbuttons" id="txbutton" name="submit" value="Translate" />
				<input type="button" class="txbuttons" id="txclearbutton" onclick="$("txTextarea").value('')" value="Clear" />
			</form>
		</div>
		<div id="resultlayer">
			<h2>Translated Text...</h2>
			<span id="txText"></span>
		</div>
	</body>
</html>