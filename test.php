<?php

$linelen = 5;
$content = "abcdef\ng";

$findme   = "\n";
$pos = strpos($content, $findme);
while ($pos != false)
{
    $str_to_insert = str_repeat("&nbsp;", ($linelen-($pos%$linelen)));
    $content = substr_replace($content, $str_to_insert, $pos, 0);
    $pos = strpos($content, $findme);
}

$content = str_replace(' ', '&nbsp;', $content);

echo $content;
?>