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
	'customName' => [
		'type' => 'string',
		'default' => '',
	],
	'label' => [
		'type' => 'string',
		'default' => 'Name'
	],
	'helperText' => [
		'type' => 'string',
		'default' => ''
	],
	'errorMsg' => [
		'type' => 'string',
		'default' => 'This field is required',
	],
	'name' => [
		'type' => 'string',
		'default' => 'first_name'
	],
	'placeholder' => [
		'type' => 'string',
		'default' => 'name'
	],
	'inputType' => [
		'type' => 'string',
		'default' => 'text'
	],
	'emailType' => [
		'type' => 'string',
		'default' => 'email'
	],
	'isRequired' => [
		'type' => 'boolean',
		'default' => true
	],
	'showIcon' => [
		'type' => 'boolean',
		'default' => false
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
		'defaultValue' => 12,
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
