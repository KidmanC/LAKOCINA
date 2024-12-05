<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use ABlocks\Controls\Border;
use ABlocks\Controls\Dimensions;
use ABlocks\Controls\Typography;
use ABlocks\Controls\TextShadow;
use ABlocks\Controls\Alignment;
use ABlocks\Controls\Link;
use ABlocks\Helper;
use ABlocks\Controls\BoxShadow;
use ABlocks\Controls\Icon;
use ABlocks\Controls\Range;

$attributes = [
	'block_id' => [
		'type' => 'string',
		'default' => '',
	],
	'text' => [
		'type' => 'string',
		'default' => 'Click here',
	],
	'buttonType' => [
		'type' => 'string',
		'default' => '#ddd',
	],
	'buttonSize' => [
		'type' => 'string',
		'default' => 'small',
	],
	'textColor' => [
		'type' => 'string',
		'default' => '#000000',
	],
	'textColorH' => [
		'type' => 'string',
		'default' => '',
	],
	'background' => [
		'type' => 'string',
		'default' => '',
	],
	'backgroundH' => [
		'type' => 'string',
		'default' => '',
	],
	'transition' => [
		'type' => 'number',
		'default' => '',
	],
	'iconPosition' => [
		'type' => 'string',
		'default' => 'left',
	],

];


$attributes = array_merge(
	$attributes,
	Icon::get_attribute( '', false, 'icon', [ 'size' => '16' ] ),
	Link::get_attribute( 'link' ),
	Border::get_attribute( 'border', true ),
	Dimensions::get_attribute( 'padding', true ),
	Typography::get_attribute( 'typography', true ),
	TextShadow::get_attribute( 'textShadow' ),
	Alignment::get_attribute( 'alignment', true, [ 'value' => 'left' ] ),
	Helper::get_icon_picker_attribute( 'icon', [ 'className' => '' ] ),
	BoxShadow::get_attribute( '_boxShadow', true ),
	BoxShadow::get_attribute( 'boxShadow', true ),
	Range::get_attribute([
		'attributeName' => 'iconSpace',
		'attributeObjectKey' => 'value',
		'isResponsive' => true,
		'defaultValue' => 10,
		'defaultValueTablet' => 10,
		'defaultValueMobile' => 10,
		'hasUnit' => true,
		'unitDefaultValue' => 'px',
	]),
);

return $attributes;
