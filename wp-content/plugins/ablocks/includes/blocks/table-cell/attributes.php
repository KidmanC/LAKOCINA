<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use ABlocks\Controls\Alignment;

$attributes = [
	'block_id' => [
		'type' => 'string',
	],
	'cellColor' => [
		'type' => 'string',
		'default' => ''
	],
	'cellColorH' => [
		'type' => 'string',
		'default' => ''
	],
	Alignment::get_attribute( 'textAlignment', true, [ 'value' => 'left' ] ),
];

return $attributes;
