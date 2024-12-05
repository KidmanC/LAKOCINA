<?php
use ABlocks\Controls\Range;

$attributes = [];

return array_merge(
	$attributes,
	Range::get_attribute([
		'attributeName' => 'width',
		'attributeObjectKey' => 'value',
		'isResponsive' => true,
		'defaultValue' => 100,
		'defaultValueTablet' => 100,
		'defaultValueMobile' => 100,
		'hasUnit' => true,
		'unitDefaultValue' => '%',
	]),
	Range::get_attribute([
		'attributeName' => 'positionX',
		'attributeObjectKey' => 'value',
		'isResponsive' => true,
		'defaultValue' => 0,
	]),
	Range::get_attribute([
		'attributeName' => 'positionY',
		'attributeObjectKey' => 'value',
		'isResponsive' => true,
		'defaultValue' => 0,
	])
);
