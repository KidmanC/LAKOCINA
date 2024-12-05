<?php

namespace ABlocks\Blocks\FormBuilder;

use ABlocks\Classes\BlockBaseAbstract;
use ABlocks\Classes\CssGenerator;
use ABlocks\Controls\Alignment;
use ABlocks\Controls\Typography;
use ABlocks\Controls\Dimensions;
use ABlocks\Controls\Border;

class Block extends BlockBaseAbstract {

	protected $block_name = 'form-builder';

	public function __construct() {
		parent::__construct();
		add_filter( 'ablocks/get_render_block_content', [ $this, 'render_static_block_content' ], 10, 3 );
	}

	public function render_static_block_content( $content, $attributes, $block_instance ) {
		if ( $block_instance->name === $this->namespace . '/' . $this->block_name ) {
			if ( is_user_logged_in() && ( 'login' === $attributes['formType'] || 'registration' === $attributes['formType'] ) ) {
				return '';
			}
			return $content;
		}
		return $content;
	}

	public function build_css( $attributes ) {
		$css_generator = new CssGenerator( $attributes, $this->block_name );

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__field',
			$this->get_field_css( $attributes ),
			$this->get_field_css( $attributes, 'Tablet' ),
			$this->get_field_css( $attributes, 'Mobile' ),
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__label',
			$this->get_label_css( $attributes ),
			$this->get_label_css( $attributes, 'Tablet' ),
			$this->get_label_css( $attributes, 'Mobile' ),
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__helper-text',
			$this->get_helper_text_css( $attributes ),
			$this->get_helper_text_css( $attributes, 'Tablet' ),
			$this->get_helper_text_css( $attributes, 'Mobile' ),
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__input',
			$this->get_input_css( $attributes ),
			$this->get_input_css( $attributes, 'Tablet' ),
			$this->get_input_css( $attributes, 'Mobile' ),
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__input:hover',
			$this->get_input_hover_css( $attributes ),
			$this->get_input_hover_css( $attributes, 'Tablet' ),
			$this->get_input_hover_css( $attributes, 'Mobile' ),
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__input:focus',
			$this->get_input_focus_css( $attributes ),
			$this->get_input_focus_css( $attributes, 'Tablet' ),
			$this->get_input_focus_css( $attributes, 'Mobile' ),
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__input::placeholder',
			$this->get_input_placeholder_css( $attributes ),
			$this->get_input_placeholder_css( $attributes, 'Tablet' ),
			$this->get_input_placeholder_css( $attributes, 'Mobile' ),
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__input-icon,{{WRAPPER}} .ablocks-form-builder__input-toggle-password',
			$this->get_input_position_css( $attributes ),
			$this->get_input_position_css( $attributes, 'Tablet' ),
			$this->get_input_position_css( $attributes, 'Mobile' ),
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__submit-button',
			$this->get_alignment_button_css( $attributes ),
			$this->get_alignment_button_css( $attributes, 'Tablet' ),
			$this->get_alignment_button_css( $attributes, 'Mobile' ),
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__submit-button',
			$this->get_submit_button_css( $attributes ),
			$this->get_submit_button_css( $attributes, 'Tablet' ),
			$this->get_submit_button_css( $attributes, 'Mobile' ),
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-form-builder__submit-button:hover',
			$this->get_submit_button_hover_css( $attributes ),
			$this->get_submit_button_hover_css( $attributes, 'Tablet' ),
			$this->get_submit_button_hover_css( $attributes, 'Mobile' ),
		);

		return $css_generator->generate_css();
	}

	public function get_field_css( $attributes, $device = '' ) {
		$field_css = [];
		if ( ! empty( $attributes['rowsSpacing'][ 'value' . $device ] ) ) {
			$field_css['margin-top'] = $attributes['rowsSpacing'][ 'value' . $device ] . 'px';
			$field_css['margin-bottom'] = $attributes['rowsSpacing'][ 'value' . $device ] . 'px';
		}
		return $field_css;
	}

	public function get_label_css( $attributes, $device = '' ) {
		$label_css = array_merge(
			Typography::get_css( $attributes['labelTypography'], $device ),
			Alignment::get_css( $attributes['labelAlignment'], 'text-align', $device )
		);

		if ( ! empty( $attributes['labelColor'] ) ) {
			$label_css['color'] = $attributes['labelColor'];
		}

		if ( ! empty( $attributes['labelSpacing'][ 'value' . $device ] ) ) {
			$label_css['margin-bottom'] = $attributes['labelSpacing'][ 'value' . $device ] . 'px';
		}
		if ( ! $attributes['showLabels'] ) {
			$label_css['display'] = 'none';
		}

		return $label_css;
	}
	public function get_helper_text_css( $attributes, $device = '' ) {
		$helper_text_css = array_merge(
			Alignment::get_css( $attributes['labelAlignment'], 'text-align', $device )
		);

		if ( ! $attributes['showLabels'] ) {
			$helper_text_css['display'] = 'none';
		}

		if ( ! empty( $attributes['labelSpacing'][ 'value' . $device ] ) ) {
			$helper_text_css['margin-top'] = '-' . $attributes['labelSpacing'][ 'value' . $device ] . 'px';
			$helper_text_css['margin-bottom'] = $attributes['labelSpacing'][ 'value' . $device ] . 'px';
		}

		return $helper_text_css;
	}

	public function get_input_css( $attributes, $device = '' ) {
		// Initialize the $css array before using it
		$css = array();

		// Check if the inputBorder's borderStyle is 'default' and apply default border styles
		if ( isset( $attributes['inputBorder']['borderStyle'] ) && $attributes['inputBorder']['borderStyle'] === 'default' ) {
			$css['border'] = '1px solid #A7AAAD';
			$css['border-radius'] = '5px';
		}

		// Merge the base CSS with typography, border, and padding CSS
		$input_css = array_merge(
			$css, // Include the default border styles if set
			Alignment::get_css( $attributes['inputAlignment'], 'text-align', $device ),
			Typography::get_css( $attributes['inputTypography'], $device ),
			Border::get_css( $attributes['inputBorder'], '', $device ),
			Dimensions::get_css( $attributes['inputPadding'], 'padding', $device )
		);

		// Add input text color if it's set in the attributes
		if ( ! empty( $attributes['inputColor'] ) ) {
			$input_css['color'] = $attributes['inputColor'] . '!important';
		}

		// Add background color if it's set in the attributes
		if ( ! empty( $attributes['inputBgColor'] ) ) {
			$input_css['background-color'] = $attributes['inputBgColor'];
		}

		// Ensure box-sizing is set to 'border-box'
		$input_css['box-sizing'] = 'border-box';

		return $input_css;
	}

	public function get_input_hover_css( $attributes, $device = '' ) {
		$css = array();

		// Check if the inputBorder's borderStyle is 'default' and apply default border styles
		if ( isset( $attributes['inputBorder']['borderStyle'] ) && $attributes['inputBorder']['borderStyle'] === 'default' ) {
			$css['border'] = '1px solid #A7AAAD';
			$css['border-radius'] = '5px';
		}
		// Get the border hover CSS based on inputBorder attribute
		$input_focus_css = array_merge(
			$css,
			Border::get_hover_css( $attributes['inputBorder'], '', $device )
		);

		return $input_focus_css;
	}
	public function get_input_focus_css( $attributes, $device = '' ) {
		$css = array();

		// Check if the inputBorder's borderStyle is 'default' and apply default border styles
		if ( isset( $attributes['inputBorder']['borderStyle'] ) && $attributes['inputBorder']['borderStyle'] === 'default' ) {
			$css['border'] = '1px solid #A7AAAD';
			$css['border-radius'] = '5px';
		}
		// Get the border hover CSS based on inputBorder attribute
		$input_focus_css = array_merge(
			$css,
			Border::get_hover_css( $attributes['inputBorder'], '', $device )
		);

		return $input_focus_css;
	}
	public function get_input_placeholder_css( $attributes, $device = '' ) {
		// Initialize placeholder CSS array
		$placeholder_css = array_merge(
			// Apply typography for the placeholder (font size, font family, etc.)
			Typography::get_css( $attributes['inputTypography'], $device ),
			// Apply alignment if specified
			Alignment::get_css( $attributes['inputAlignment'], 'text-align', $device )
		);
		// Check if placeholder color is defined, and apply it
		if ( ! empty( $attributes['inputPlaceholderColor'] ) ) {
			$placeholder_css['color'] = $attributes['inputPlaceholderColor'] . '!important'; // Add !important to override conflicting styles
		}
		error_log( print_r( $placeholder_css, true ) );
		return $placeholder_css;

	}
	public function get_input_position_css( $attributes, $device = '' ) {
		// Access the inputIconPosition attribute from the attributes array
		$input_icon_position = isset( $attributes['inputIconPosition'] ) ? $attributes['inputIconPosition'] : 0; // Default to 0 if not set

		// Initialize an array to hold the CSS properties
		$css = array();

		// Add the CSS for the 'top' property based on the inputIconPosition
		$css['top'] = $input_icon_position . '%';

		// Return the generated CSS array
		return $css;
	}
	public function get_alignment_button_css( $attributes, $device = '' ) {
		$button_alignment_css = array_merge(
			Alignment::get_css( $attributes['buttonAlignment'], 'text-align', $device )
		);

		return $button_alignment_css;
	}


	public function get_submit_button_css( $attributes, $device = '' ) {
		$button_css = array_merge(
			Dimensions::get_css( $attributes['buttonPadding'], 'padding', $device ),
			Border::get_css( $attributes['buttonBorder'], '', $device ),
			Typography::get_css( $attributes['buttonTypography'], $device )
		);

		if ( ! empty( $attributes['buttonColor'] ) ) {
			$button_css['color'] = $attributes['buttonColor'];
		}

		if ( ! empty( $attributes['buttonBgColor'] ) ) {
			$button_css['background-color'] = $attributes['buttonBgColor'];
		}

		return $button_css;
	}

	public function get_submit_button_hover_css( $attributes, $device = '' ) {
		$button_hover_css = Border::get_hover_css( $attributes['buttonBorder'], '', $device );

		if ( ! empty( $attributes['buttonHColor'] ) ) {
			$button_hover_css['color'] = $attributes['buttonHColor'];
		}

		if ( ! empty( $attributes['buttonBgHColor'] ) ) {
			$button_hover_css['background-color'] = $attributes['buttonBgHColor'];
		}

		return $button_hover_css;
	}
}