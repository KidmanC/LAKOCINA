<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$attributes = [
	'block_id' => array(
		'type' => 'string',
		'default' => ''
	),
	'inputWidth' => [
		'type' => 'number',
		'default' => 100
	],
	'label' => [
		'type' => 'string',
		'default' => 'What\'s your favorite programming lang?',
	],
	'helperText' => [
		'type' => 'string',
		'default' => '',
	],
	'name' => [
		'type' => 'string',
		'default' => 'Message',
	],
	'isRequired' => [
		'type' => 'boolean',
		'default' => true
	],
	'errorMsg' => [
		'type' => 'string',
		'default' => 'This field is required'
	],
	'radioArr' => [
		'type' => 'array',
		'default' => []
	]
];

$attributes = array_merge(
	$attributes,
);

return $attributes;
