<?php
namespace ABlocks\Blocks\PriceMenuItem;

use ABlocks\Classes\BlockBaseAbstract;
use ABlocks\Classes\CssGenerator;
use ABlocks\Controls\Icon;
use ABlocks\Controls\Alignment;
use ABlocks\Controls\Typography;
use ABlocks\Controls\TextShadow;
use ABlocks\Controls\TextStroke;

class Block extends BlockBaseAbstract {
	protected $parent_block_name = 'price-menu';
	protected $block_name = 'price-menu-item';

	public function build_css( $attributes ) {

		$css_generator = new CssGenerator( $attributes, $this->block_name );
		// Icon Style
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-icon-wrap',
			Icon::get_wrapper_css( $attributes ),
			Icon::get_wrapper_css( $attributes, 'Tablet' ),
			Icon::get_wrapper_css( $attributes, 'Mobile' )
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-icon-wrap img.ablocks-image-icon',
			Icon::get_element_image_css( $attributes )
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-icon-wrap svg.ablocks-svg-icon',
			Icon::get_element_css( $attributes ),
		);
		// TitleText CSS
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-price-menu-item-details-title',
			$this->get_title_text_css( $attributes, '' ),
			$this->get_title_text_css( $attributes, 'Tablet' ),
			$this->get_title_text_css( $attributes, 'Mobile' ),
		);
		// DescriptionText CSS
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-price-menu-item-details-des',
			$this->get_description_text_css( $attributes, '' ),
			$this->get_description_text_css( $attributes, 'Tablet' ),
			$this->get_description_text_css( $attributes, 'Mobile' ),
		);
		// SeparatorText CSS
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-price-menu-divider__pattern-' . ( $attributes['dividerType'] === 'mask-style' ? 'mask' : 'css' ),
			$this->get_divider_css( $attributes, '' ),
			$this->get_divider_css( $attributes, 'Tablet' ),
			$this->get_divider_css( $attributes, 'Mobile' ),
		);
		// PriceText CSS
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-price-menu-item-price',
			$this->get_price_text_css( $attributes, '' ),
			$this->get_price_text_css( $attributes, 'Tablet' ),
			$this->get_price_text_css( $attributes, 'Mobile' ),
		);

		return $css_generator->generate_css();
	}

	public function get_title_text_css( $attributes, $device = '' ) {
		$css = [];
		$title_color = isset( $attributes['titleColor'] ) ? $attributes['titleColor'] : '';

		if ( isset( $attributes['titleColor'] ) ) {
			$css['color'] = $title_color;
		}

		return array_merge(
			$css,
			isset( $attributes['titleTypography'] ) ? Typography::get_css( $attributes['titleTypography'], '', $device ) : [],
			isset( $attributes['titleTextStroke'] ) ? TextStroke::get_css( $attributes['titleTextStroke'], '', $device ) : [],
			isset( $attributes['titleTextShadow'] ) ? TextShadow::get_css( $attributes['titleTextShadow'], '', $device ) : [],
			isset( $attributes['titleAlignment'] ) ? Alignment::get_css( $attributes['titleAlignment'], 'text-align', $device ) : [],
		);
	}
	public function get_description_text_css( $attributes, $device = '' ) {
		$css = [];
		$description_color = isset( $attributes['descriptionColor'] ) ? $attributes['descriptionColor'] : '';

		if ( isset( $attributes['descriptionColor'] ) ) {
			$css['color'] = $description_color;
		}

		return array_merge(
			$css,
			isset( $attributes['descriptionTypography'] ) ? Typography::get_css( $attributes['descriptionTypography'], '', $device ) : [],
			isset( $attributes['descriptionTextStroke'] ) ? TextStroke::get_css( $attributes['descriptionTextStroke'], '', $device ) : [],
			isset( $attributes['descriptionTextShadow'] ) ? TextShadow::get_css( $attributes['descriptionTextShadow'], '', $device ) : [],
			isset( $attributes['descriptionAlignment'] ) ? Alignment::get_css( $attributes['descriptionAlignment'], 'text-align', $device ) : [],
		);
	}
	public function get_divider_css( $attributes, $device = '' ) {
		$css = [];
		$divider_width = isset( $attributes['width'][ 'value' . $device ] ) ? $attributes['width'][ 'value' . $device ] : 60;
		$divider_color = isset( $attributes['color'] ) ? $attributes['color'] : '#000000';
		$default_Unit = $attributes['allowDescription'] === true ? '%' : 'px';

		if ( ! empty( $attributes['width'][ 'value' . $device ] ) ) {
			if ( $default_Unit === '%' && $divider_width > 100 ) {
				$css['width'] = 100 . $default_Unit;
			} else {
				if ( $attributes['allowDescription'] === false && $device === 'Mobile' && $divider_width > 114 ) {
					$css['width'] = $divider_width . $default_Unit;
				} else {
					$css['width'] = $divider_width . $default_Unit;
				}
			}
		}
		if ( ! empty( $attributes['color'] ) ) {
			$css['--ablocks-divider-pattern-color'] = $divider_color;
		}

		if ( isset( $attributes['dividerType'] ) && $attributes['dividerType'] === 'mask-style' && isset( $attributes['size'] ) && ! empty( $attributes['size'] ) ) {
			$css['--ablocks-divider-pattern-height'] = $attributes['size'] . 'px';
		} else {
			if ( isset( $attributes['weight'] ) && ! empty( $attributes['weight'] ) ) {
				$css['--ablocks-divider-pattern-weight'] = $attributes['weight'] . 'px';
			}
		}

		if ( ! empty( $attributes['dividerPatternUrl'] ) ) {
			if ( $attributes['dividerType'] === 'mask-style' ) {
				$css['--ablocks-divider-pattern-url'] = 'url(' . $attributes['dividerPatternUrl'] . ')';
			} else {
				$css['--ablocks-divider-pattern-style'] = $attributes['dividerPatternUrl'];
			}
		}

		return $css;
	}
	public function get_price_text_css( $attributes, $device = '' ) {
		$css = [];
		$price_color = isset( $attributes['priceColor'] ) ? $attributes['priceColor'] : '';

		if ( isset( $attributes['priceColor'] ) ) {
			$css['color'] = $price_color;
		}

		return array_merge(
			$css,
			isset( $attributes['priceTypography'] ) ? Typography::get_css( $attributes['priceTypography'], '', $device ) : [],
			isset( $attributes['priceTextStroke'] ) ? TextStroke::get_css( $attributes['priceTextStroke'], '', $device ) : [],
			isset( $attributes['priceTextShadow'] ) ? TextShadow::get_css( $attributes['priceTextShadow'], '', $device ) : [],
			isset( $attributes['priceAlignment'] ) ? Alignment::get_css( $attributes['priceAlignment'], 'text-align', $device ) : [],
		);
	}
}
