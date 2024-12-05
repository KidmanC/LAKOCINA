<?php
namespace ABlocks\Blocks\StarRatings;

use ABlocks\Classes\BlockBaseAbstract;
use ABlocks\Classes\CssGenerator;
use ABlocks\Controls\Alignment;
use ABlocks\Controls\TextShadow;
use ABlocks\Controls\TextStroke;
use ABlocks\Controls\Typography;
use ABlocks\Controls\Icon;

class Block extends BlockBaseAbstract {
	protected $block_name = 'star-ratings';

	public function build_css( $attributes ) {

		$css_generator = new CssGenerator( $attributes, $this->block_name );

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block-container',
			$this->get_container_css( $attributes ),
			$this->get_container_css( $attributes, 'Tablet' ),
			$this->get_container_css( $attributes, 'Mobile' ),
		);
		// rating icon css
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-rating',
			$this->get_rating_css( $attributes ),
			$this->get_rating_css( $attributes, 'Tablet' ),
			$this->get_rating_css( $attributes, 'Mobile' ),
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}}  .ablocks-icon-wrap',
			Icon::get_wrapper_css( $attributes ),
			Icon::get_wrapper_css( $attributes, 'Tablet' ),
			Icon::get_wrapper_css( $attributes, 'Mobile' )
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}}  .ablocks-icon-wrap img.ablocks-image-icon',
			Icon::get_element_image_css( $attributes )
		);

		// rating icon spacing css
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-star-ratings-icons',
			$this->get_rating_icon_spacing_css( $attributes ),
			$this->get_rating_icon_spacing_css( $attributes, 'Tablet' ),
			$this->get_rating_icon_spacing_css( $attributes, 'Mobile' ),
		);

		$get_desktop_rating_number_css = $this->get_rating_number_css( $attributes );
		if ( ! empty( $attributes['ratingNumberColor'] ) ) {
			$get_desktop_rating_number_css['color'] = $attributes['ratingNumberColor'];
		}
		if ( ! empty( $attributes['ratingNumberPosition'] ) ) {
			if ( 'left' === $attributes['ratingNumberPosition'] ) {
				$get_desktop_rating_number_css['order'] = '-5';
			} else {
				$get_desktop_rating_number_css['order'] = '10';
			}
		}
		// rating number css
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-star-rating-number',
			$get_desktop_rating_number_css,
			$this->get_rating_number_css( $attributes, 'Tablet' ),
			$this->get_rating_number_css( $attributes, 'Mobile' ),
		);

		return $css_generator->generate_css();
	}


	public function get_container_css( $attributes, $device = '' ) {
		$css = [];

		$ratingNumberGap = isset( $attributes['ratingNumberGap'][ 'value' . $device ] ) ? $attributes['ratingNumberGap'][ 'value' . $device ] : '';
		$unit = ! empty( $attributes['ratingNumberGap'][ 'valueUnit' . $device ] ) ? $attributes['ratingNumberGap'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['ratingNumberGap'] ) && ! empty( $attributes['ratingNumberGap'] ) ) {
			$css['gap'] = $ratingNumberGap . $unit;
		}
		return array_merge(
			$css,
			isset( $attributes['alignment'] ) ? Alignment::get_css( $attributes['alignment'], 'justify-content', $device ) : [],
		);
	}

	public function get_rating_number_css( $attributes, $device = '' ) {
		return Typography::get_css( $attributes['ratingNumberTypography'], '', $device );
	}

	public function get_rating_css( $attributes, $device = '' ) {
		$rating_css = [];
		$size_value = $attributes['size'][ 'value' . $device ] ?? '';
		$size_unit = $attributes['size'][ 'valueUnit' . $device ] ?? 'px';
		$unit = ! empty( $attributes['gap'][ 'valueUnit' . $device ] ) ? $attributes['gap'][ 'valueUnit' . $device ] : 'px';

		if ( ! empty( $size_value ) ) {
			$rating_css['font-size'] = $size_value . $size_unit;
		}
		return $rating_css;
	}


	public function get_rating_icon_spacing_css( $attributes, $device = '' ) {
		$spacing_value = $attributes['spacing'][ 'value' . $device ] ?? '';
		$spacing_unit = ! empty( $attributes['spacing'][ 'valueUnit' . $device ] ) ? $attributes['spacing'][ 'valueUnit' . $device ] : 'px';
		$rating_icon_spacing_css = [];
		if ( $spacing_value ) {
			$rating_icon_spacing_css['gap'] = $spacing_value . $spacing_unit;
		}
		return $rating_icon_spacing_css;
	}
}
