<?php

include "DwarfRunes.php";

$dr = new DwarfRunes;

$size = 32;
$theme = 'light';

$text = "Stand by the \n"
	."grey stone \n"
	."when thrush \n"
	."knocks and \n"
	."the setting \n"
	."sun with the \n"
	."last light of \n"
	."Durins Day \n"
	."will shine \n"
	."upon the key\n"
	."hole.\n";
	
$signature = "[TH]";

$dr->wrapper_class = 'dr';
$dr->theme_class_light = 'l';
$dr->theme_class_dark = 'd';
$dr->letter_class_prefix = '';
$dr->size_class_prefix = 's';
$dr->addSelectableText = true;
$dr->addToolTips = true;


$css = $dr->generateCss(true, true, array($size), $theme);
$textRunes = $dr->encode($text, $size, $theme);
$signatureRunes = $dr->encode($signature, $size, $theme);

?><!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<title>Stand by the grey stone...</title>
	
<!-- This is a demo page of the PHP class DwarfRunes -->
<!-- All CSS class names are fully configurable, minification is optional -->
<?= $css ?>
	
</head>

<body style="background: black;">

	<div style="display: block; width: 420px; margin: 40px auto;">
		<p style="text-align: left;"><?=$textRunes?></p>
		<p style="text-align: right;padding-right: 20px;"><?=$signatureRunes?></p>
	</div>

</body>

</html>