<?php

include "DwarfRunes.php";

$dr = new DwarfRunes;

echo $dr->generateCss(false, true, array(8,10,12,16,24,32,36,48,64,72,96,128), 'both');