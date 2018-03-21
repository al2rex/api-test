<?php
$base = __DIR__.'/../app/';

$folder = [
	'lib',
	'model',
	'middleware',
	'validation',
	'route',
];

foreach($folder as $f){
	foreach(glob($base . "$f/*.php") as $k => $filename){
		require_once $filename;
	}
}