<?php
namespace ABlocks\Blocks\PriceMenu;

use ABlocks\Classes\BlockBaseAbstract;
use ABlocks\Classes\CssGenerator;
use ABlocks\Controls\Alignment;
use ABlocks\Controls\Border;
use ABlocks\Controls\Dimensions;
use ABlocks\Controls\Typography;
use ABlocks\Controls\TextShadow;
use ABlocks\Controls\TextStroke;

class Block extends BlockBaseAbstract {
	protected $block_name = 'price-menu';

	public function build_css( $attributes ) {

		$css_generator = new CssGenerator( $attributes, $this->block_name );

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block-container',
			$this->get_all_menu_css( $attributes, '' ),
			$this->get_all_menu_css( $attributes, 'Tablet' ),
			$this->get_all_menu_css( $attributes, 'Mobile' ),
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-price-menu-item, {{WRAPPER}} .ablocks-price-menu-item-details',
			$this->get_gap_around_css( $attributes, '' ),
			$this->get_gap_around_css( $attributes, 'Tablet' ),
			$this->get_gap_around_css( $attributes, 'Mobile' ),
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-price-menu-item-details-brief',
			$this->get_details_brief_css( $attributes, '' ),
			$this->get_details_brief_css( $attributes, 'Tablet' ),
			$this->get_details_brief_css( $attributes, 'Mobile' ),
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--price-menu-item',
			$this->get_item_css( $attributes, '' ),
			$this->get_item_css( $attributes, 'Tablet' ),
			$this->get_item_css( $attributes, 'Mobile' ),
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--price-menu-item:hover',
			$this->get_item_hover_css( $attributes, '' ),
			$this->get_item_hover_css( $attributes, 'Tablet' ),
			$this->get_item_hover_css( $attributes, 'Mobile' ),
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-price-menu-item',
			$this->get_inner_item_css( $attributes, '' ),
			$this->get_inner_item_css( $attributes, 'Tablet' ),
			$this->get_inner_item_css( $attributes, 'Mobile' ),
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

	public function get_item_css( $attributes, $device = '' ) {
		$css = [];

		if ( isset( $attributes['transition'] ) ) {
			$css['transition-duration'] = $attributes['transition'] . 's';
		}

		if ( isset( $attributes['itemBackground'] ) ) {
			$css['background'] = $attributes['itemBackground'];
		}
		return array_merge(
			$css,
			isset( $attributes['alignment'] ) ? Alignment::get_css( $attributes['alignment'], 'justify-content', $device ) : [],
			isset( $attributes['itemBorder'] ) ? Border::get_css( $attributes['itemBorder'], '', $device ) : [],
			isset( $attributes['itemPadding'] ) ? Dimensions::get_css( $attributes['itemPadding'], 'padding', $device ) : [],
		);
	}

	public function get_item_hover_css( $attributes, $device = '' ) {
		$css = [];
		if ( isset( $attributes['itemBackgroundH'] ) ) {
			$css['background'] = $attributes['itemBackgroundH'];
		}
		return array_merge(
			$css,
			isset( $attributes['itemBorder'] ) ? Border::get_hover_css( $attributes['itemBorder'], '', $device ) : [],
		);
	}

	public function get_inner_item_css( $attributes, $device = '' ) {
		$css = [];

		if ( isset( $attributes['itemsDirection'][ 'value' . $device ] ) ) {
			$css['flex-direction'] = $attributes['itemsDirection'][ 'value' . $device ];
		}

		if ( isset( $attributes['alignment'][ 'value' . $device ] ) ) {
			$css['align-items'] = $attributes['alignment'][ 'value' . $device ];
		}

		return $css;
	}

	public function get_gap_around_css( $attributes, $device = '' ) {
		$css = [];
		$gap_items = isset( $attributes['gap'][ 'value' . $device ] ) ? $attributes['gap'][ 'value' . $device ] : '';
		$unit = ! empty( $attributes['gap'][ 'valueUnit' . $device ] ) ? $attributes['gap'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['gap'][ 'value' . $device ] ) ) {
			$css['gap'] = $attributes['gap'][ 'value' . $device ] . $unit;
		}

		if ( isset( $attributes['alignment'][ 'value' . $device ] ) ) {
			$css['align-items'] = $attributes['alignment'][ 'value' . $device ];
		}

		return $css;
	}

	public function get_details_brief_css( $attributes, $device = '' ) {
		$css = [];
		$gap_items = isset( $attributes['gap'][ 'value' . $device ] ) ? $attributes['gap'][ 'value' . $device ] : '';
		$unit = ! empty( $attributes['gap'][ 'valueUnit' . $device ] ) ? $attributes['gap'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['gap'][ 'value' . $device ] ) ) {
			$css['gap'] = $attributes['gap'][ 'value' . $device ] . $unit;
		}

		if ( isset( $attributes['alignment'][ 'value' . $device ] ) ) {
			if ( $attributes['itemsDirection'][ 'value' . $device ] === 'row' ) {
				$css['justify-content'] = 'space-between';
			} else {
				$css['justify-content'] = $attributes['alignment'][ 'value' . $device ];
			}
		}

		return $css;
	}

	public function get_all_menu_css( $attributes, $device = '' ) {
		$css = [];
		$gap_items = isset( $attributes['columnGap'][ 'value' . $device ] ) ? $attributes['columnGap'][ 'value' . $device ] : '';
		$unit = ! empty( $attributes['columnGap'][ 'valueUnit' . $device ] ) ? $attributes['columnGap'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['columnGap'][ 'value' . $device ] ) ) {
			$css['gap'] = $gap_items . $unit;
		}

		return $css;
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

		if ( isset( $attributes['descriptionColor'] ) && isset( $attributes['descriptionColor'] ) ) {
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
		if ( isset( $attributes['color'] ) && ! empty( $attributes['color'] ) ) {
			$css['--ablocks-divider-pattern-color'] = $divider_color;
		}

		if ( isset( $attributes['dividerType'] ) && $attributes['dividerType'] === 'mask-style' && isset( $attributes['size'] ) && ! empty( $attributes['size'] ) ) {
			$css['--ablocks-divider-pattern-height'] = $attributes['size'] . 'px';
		} elseif ( isset( $attributes['dividerType'] ) && $attributes['dividerType'] === 'mask-style' && isset( $attributes['size'] ) && empty( $attributes['size'] ) ) {
			$css['--ablocks-divider-pattern-height'] = '20px';
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
