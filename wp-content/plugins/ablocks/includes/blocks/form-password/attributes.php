<?php
namespace ABlocks\Blocks\FormBuilder;

use ABlocks\Controls\Icon;
use ABlocks\Controls\Border;
use ABlocks\Controls\Range;
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
		'default' => ''
	],
	'name' => [
		'type' => 'string',
		'default' => 'password'
	],
	'placeholder' => [
		'type' => 'string',
		'default' => '*******'
	],
	'inputType' => [
		'type' => 'string',
		'default' => 'password'
	],
	'isRequired' => [
		'type' => 'boolean',
		'default' => true
	],
	'isPasswordVisible' => [
		'type' => 'boolean',
		'default' => false
	],
	'showIcon' => [
		'type' => 'boolean',
		'default' => true
	],
	'iconColor' => [
		'type' => 'string',
		'default' => ''
	],
];

$attributes = array_merge(
	$attributes,
	Border::get_attribute( 'border', true ),
	Icon::get_attribute( '', false ),
	Icon::get_attribute( 'passwordShow', false ),
	Icon::get_attribute( 'passwordHide', false ),
	Range::get_attribute( [
		'attributeName' => 'passwordShowHideIconSize',
		'isResponsive' => false,
		'defaultValue' => 18,
	] ),
	Range::get_attribute( [
		'attributeName' => 'inputIconSize',
		'isResponsive' => false,
		'defaultValue' => 28,
	] ),
	Range::get_attribute( [
		'attributeName' => 'inputIconSpace',
		'isResponsive' => false,
		'defaultValue' => 38,
	] ),
);

return $attributes;
