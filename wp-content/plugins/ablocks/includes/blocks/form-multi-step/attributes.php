<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$attributes = [
	'block_id' => array(
		'type' => 'string',
		'default' => ''
	),
];

$attributes = array_merge(
	$attributes,
);

return $attributes;
