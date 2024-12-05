<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use ABlocks\Controls\Alignment;
use ABlocks\Controls\Typography;
use ABlocks\Controls\TextShadow;
use ABlocks\Controls\TextStroke;
use ABlocks\Controls\Link;
use ABlocks\Controls\Range;
use ABlocks\Controls\Border;
use ABlocks\Controls\Dimensions;

$attributes = [
	'block_id' => array(
		'type' => 'string',
		'default' => '',
	),
	'hotspotId' => array(
		'type' => 'number',
		'default' => 0,
	),
	'backgroundColor' => array(
		'type' => 'string',
		'default' => '',
	),
];

$attributes = array_merge(
	$attributes,
	Range::get_attribute([
		'attributeName' => 'contentWidth',
		'attributeObjectKey' => 'value',
		'isResponsive' => true,
		'defaultValue' => '',
		'hasUnit' => true,
		'unitDefaultValue' => 'px',
	]),
	Border::get_attribute( 'contentBorder', true ),
	Dimensions::get_attribute( 'contentPadding', true ),
);

return $attributes;
