<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



$attributes = [
	'block_id' => [
		'type' => 'string',
	],
	'rowColor' => [
		'type' => 'string',
		'default' => '',
	],
	'rowColorH' => [
		'type' => 'string',
		'default' => '',
	],
];

return $attributes;
