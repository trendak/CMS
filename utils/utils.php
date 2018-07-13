<?php

function dump($var)
{
	echo '<pre>';
print_r($var);
echo '</pre>';
}
function dd($var){
	dump($var);
	die;
}