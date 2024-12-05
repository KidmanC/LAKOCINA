<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
use ABlocks\Controls\Border;
$attributes = [
	'block_id' => [
		'type' => 'string',
	],
	'rowOddColor' => [
		'type' => 'string',
		'default' => ''
	],
	'rowOddColorH' => [
		'type' => 'string',
		'default' => ''
	],
	'rowEvenColor' => [
		'type' => 'string',
		'default' => ''
	],
	'rowEvenColorH' => [
		'type' => 'string',
		'default' => ''
	],
	'bodyBg' => [
		'type' => 'string',
	],
	'bodyBgH' => [
		'type' => 'string',
	],
	'headerColor' => [
		'type' => 'string',

		'default' => '',
	],
	'headerColorH' => [
		'type' => 'string',
		'default' => ''
	],
	'footerColor' => [
		'type' => 'string',

		'default' => '',
	],
	'footerColorH' => [
		'type' => 'string',
		'default' => ''
	],
	'borderCollapse' => [
		'type' => 'string',
		'default' => 'collapse'
	]
];
$attributes = array_merge(
	$attributes,
	Border::get_attribute( 'border', true ),
);

return $attributes;
