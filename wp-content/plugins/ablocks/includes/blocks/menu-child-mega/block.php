<?php
namespace ABlocks\Blocks\MenuChildMega;

use ABlocks\Classes\BlockBaseAbstract;
use ABlocks\Classes\CssGenerator;

class Block extends BlockBaseAbstract {
	protected $parent_block_name = 'menu';
	protected $block_name = 'menu-child-mega';

	public function build_css( $attributes ) {

		$css_generator = new CssGenerator( $attributes, $this->block_name );
			  // Wrapper CSS
			$css_generator->add_class_styles(
				'{{WRAPPER}}',
				$this->get_wrapper_css( $attributes, '' ),
				$this->get_wrapper_css( $attributes, 'Tablet' ),
				$this->get_wrapper_css( $attributes, 'Mobile' )
			);
		return $css_generator->generate_css();
	}
	private function get_wrapper_css( $attributes, $device = '' ) {
		$css = [];
		$padding = isset( $attributes['padding'] ) ? $attributes['padding'] : '';
		$width = isset( $attributes['width'] ) ? $attributes['width'] : '';
		$positionX = isset( $attributes['positionX'] ) ? $attributes['positionX'] : '';
		$positionY = isset( $attributes['positionY'] ) ? $attributes['positionY'] : '';

		// Width
		if ( isset( $width[ 'value' . $device ] ) && ! empty( $width[ 'value' . $device ] ) ) {
			$css['width'] = $width[ 'value' . $device ] . '%';
		}

		// Position X
		if ( isset( $positionX[ 'value' . $device ] ) && ! empty( $positionX[ 'value' . $device ] ) ) {
			$css['left'] = $positionX[ 'value' . $device ] . '%';
		}

		// Position Y
		if ( isset( $positionY[ 'value' . $device ] ) && ! empty( $positionY[ 'value' . $device ] ) ) {
			$css['top'] = $positionY[ 'value' . $device ] . '%';
		}

		return array_merge(
			// Dimensions::get_css( $padding, 'padding', $device ),
			$css
		);
	}
}
