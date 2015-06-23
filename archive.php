<?php

$str = file_get_contents('archive/2015.html');
for ($i = 2016; $i <= 2020; $i++) {
	$str2 = str_replace('2015', $i, $str);
	file_put_contents("archive/$i.html", $str2);
}