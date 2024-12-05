<?php
namespace ABlocks\Blocks\Search;

use ABlocks\Classes\BlockBaseAbstract;
use ABlocks\Classes\CssGenerator;
use ABlocks\Controls\Icon;
use ABlocks\Controls\Alignment;
use ABlocks\Controls\Typography;
use ABlocks\Controls\TextShadow;
use ABlocks\Controls\TextStroke;
use ABlocks\Controls\Dimensions;
use ABlocks\Controls\Border;
use WP_Query;

class Block extends BlockBaseAbstract {
	protected $block_name = 'search';

	public function build_css( $attributes ) {
		$css_generator = new CssGenerator( $attributes, $this->block_name );

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--search-form',
			$this->get_SearchBar_css( $attributes ),
			$this->get_SearchBar_css( $attributes, 'Tablet' ),
			$this->get_SearchBar_css( $attributes, 'Mobile' )
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--search-input',
			$this->get_Input_css( $attributes ),
			$this->get_Input_css( $attributes, 'Tablet' ),
			$this->get_Input_css( $attributes, 'Mobile' )
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--search-input::placeholder',
			$this->get_Input_css( $attributes ),
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--search-button > span',
			$this->get_Button_css( $attributes ),
			$this->get_Button_css( $attributes, 'Tablet' ),
			$this->get_Button_css( $attributes, 'Mobile' )
		);

		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--search-button > span > svg',
			$this->get_Icon_css( $attributes ),
			$this->get_Icon_css( $attributes, 'Tablet' ),
			$this->get_Icon_css( $attributes, 'Mobile' )
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--search-result',
			$this->get_search_result_list( $attributes ),
			$this->get_search_result_list( $attributes, 'Tablet' ),
			$this->get_search_result_list( $attributes, 'Mobile' )
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--search-result:hover',
			$this->get_search_result_list_hover( $attributes ),
			$this->get_search_result_list_hover( $attributes, 'Tablet' ),
			$this->get_search_result_list_hover( $attributes, 'Mobile' )
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--search-result__list',
			$this->get_search_result_item( $attributes ),
			$this->get_search_result_item( $attributes, 'Tablet' ),
			$this->get_search_result_item( $attributes, 'Mobile' )
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--search-result__list:hover',
			$this->get_search_result_item_hover( $attributes ),
			$this->get_search_result_item_hover( $attributes, 'Tablet' ),
			$this->get_search_result_item_hover( $attributes, 'Mobile' )
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-block--search-result__list-thumbnail',
			$this->get_search_result_img_css( $attributes ),
			$this->get_search_result_img_css( $attributes, 'Tablet' ),
			$this->get_search_result_img_css( $attributes, 'Mobile' )
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} a.ablocks-block--search-result__list-title',
			$this->get_search_result_title_css( $attributes ),
			$this->get_search_result_title_css( $attributes, 'Tablet' ),
			$this->get_search_result_title_css( $attributes, 'Mobile' )
		);
		$css_generator->add_class_styles(
			'{{WRAPPER}} .ablocks-search-block__spin',
			$this->get_loading_spinner_css( $attributes ),
			$this->get_loading_spinner_css( $attributes, 'Tablet' ),
			$this->get_loading_spinner_css( $attributes, 'Mobile' )
		);

		return $css_generator->generate_css();
	}
	public function get_SearchBar_css( $attributes, $device = '' ) {
		$css = [];
		$gap_items = isset( $attributes['gap'][ 'value' . $device ] ) ? $attributes['gap'][ 'value' . $device ] : '';
		$unit = ! empty( $attributes['gap'][ 'valueUnit' . $device ] ) ? $attributes['gap'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['gap'] ) && ! empty( $attributes['gap'] ) ) {
			$css['gap'] = $gap_items . $unit;
		}

		return array_merge(
			$css,
			isset( $attributes['fullscreenButtonAlignment'] ) ? Alignment::get_css( $attributes['fullscreenButtonAlignment'], 'justify-content', $device ) : [],
		);
	}

	public function get_Input_css( $attributes, $device = '' ) {
		$css = [];
		$input_color = isset( $attributes['inputTextColor'] ) ? $attributes['inputTextColor'] : '';

		if ( isset( $attributes['inputTextColor'] ) && ! empty( $attributes['inputTextColor'] ) ) {
			$css['color'] = $input_color;
		}

		return array_merge(
			$css,
			isset( $attributes['inputTypography'] ) ? Typography::get_css( $attributes['inputTypography'], $device ) : [],
			isset( $attributes['inputTextStroke'] ) ? TextStroke::get_css( $attributes['inputTextStroke'], $device ) : [],
			isset( $attributes['inputTextShadow'] ) ? TextShadow::get_css( $attributes['inputTextShadow'], $device ) : [],
		);
	}
	public function get_loading_spinner_css( $attributes, $device = '' ) {
		$css = [];
		$loadingSpinnerColor = isset( $attributes['loadingSpinnerColor'] ) ? $attributes['loadingSpinnerColor'] : '';

		if ( isset( $attributes['loadingSpinnerColor'] ) && ! empty( $attributes['loadingSpinnerColor'] ) ) {
			$css['color'] = $loadingSpinnerColor;
		}

		return array_merge(
			$css,
		);
	}
	public function get_search_result_title_css( $attributes, $device = '' ) {
		$css = [];
		$searchResTColor = isset( $attributes['searchResTColor'] ) ? $attributes['searchResTColor'] : '';

		if ( isset( $attributes['searchResTColor'] ) && ! empty( $attributes['searchResTColor'] ) ) {
			$css['color'] = $searchResTColor;
		}

		return array_merge(
			$css,
			isset( $attributes['searchResTypography'] ) ? Typography::get_css( $attributes['searchResTypography'], $device ) : [],
		);
	}
	public function get_search_result_list( $attributes, $device = '' ) {
		$css = [];
		$defaultUnit = 'px';
		$width_items = isset( $attributes['listWidth'][ 'value' . $device ] ) ? $attributes['listWidth'][ 'value' . $device ] : '';
		$unit = ! empty( $attributes['listWidth'][ 'valueUnit' . $device ] ) ? $attributes['listWidth'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['listWidth'] ) && ! empty( $attributes['listWidth'] ) ) {
			$css['width'] = $width_items . $unit;
		}

		$gap = isset( $attributes['listGap'][ 'value' . $device ] ) ? $attributes['listGap'][ 'value' . $device ] : '';
		$unit_gap = ! empty( $attributes['listGap'][ 'valueUnit' . $device ] ) ? $attributes['listGap'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['listGap'] ) && ! empty( $attributes['listGap'] ) ) {
			$css['gap'] = $gap . $unit_gap;
		}

		 // Set the position property
		if ( ! empty( $attributes['position'] ) ) {
			$css['position'] = $attributes['position'];
		}

		// Horizontal alignment (left or right)
		if ( ! empty( $attributes['horizontalAlignment'] ) ) {
			$offsetX = ! empty( $attributes['horizontalOffset'][ 'value' . $device ] )
			? $attributes['horizontalOffset'][ 'value' . $device ]
			: 0;
			$unitX = ! empty( $attributes['horizontalOffset'][ 'valueUnit' . $device ] )
			? $attributes['horizontalOffset'][ 'valueUnit' . $device ]
			: $defaultUnit;

			if ( $attributes['horizontalAlignment'] === 'left' ) {
				$css['left'] = $offsetX . $unitX;
			} elseif ( $attributes['horizontalAlignment'] === 'right' ) {
				$css['right'] = $offsetX . $unitX;
			}
		}

		// Vertical alignment (top or bottom)
		if ( ! empty( $attributes['verticalAlignment'] ) ) {
			$offsetY = ! empty( $attributes['verticalOffset'][ 'value' . $device ] )
			? $attributes['verticalOffset'][ 'value' . $device ]
			: 0;
			$unitY = ! empty( $attributes['verticalOffset'][ 'valueUnit' . $device ] )
			? $attributes['verticalOffset'][ 'valueUnit' . $device ]
			: $defaultUnit;

			if ( $attributes['verticalAlignment'] === 'top' ) {
				$css['top'] = $offsetY . $unitY;
			} elseif ( $attributes['verticalAlignment'] === 'bottom' ) {
				$css['bottom'] = $offsetY . $unitY;
			}
		}

		// Ensure offsets only apply when the position is not "default"
		if ( ! empty( $attributes['position'] ) && $attributes['position'] === 'default' ) {
			unset( $css['left'], $css['right'], $css['top'], $css['bottom'] );
		}
		return array_merge(
			$css,
			isset( $attributes['listPadding'] ) ? Dimensions::get_css( $attributes['listPadding'], 'padding', $device ) : [],
			isset( $attributes['listBorder'] ) ? Border::get_css( $attributes['listBorder'], '', $device ) : [],
		);
	}
	public function get_search_result_list_hover( $attributes, $device = '' ) {
		$css = [];

		return array_merge(
			$css,
			isset( $attributes['listBorder'] ) ? Border::get_hover_css( $attributes['listBorder'], $device ) : [],
		);
	}

	public function get_search_result_item( $attributes, $device = '' ) {
		$css = [];
		$width_items = isset( $attributes['itemWidth'][ 'value' . $device ] ) ? $attributes['itemWidth'][ 'value' . $device ] : '';
		$unit = ! empty( $attributes['itemWidth'][ 'valueUnit' . $device ] ) ? $attributes['itemWidth'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['itemWidth'] ) && ! empty( $attributes['itemWidth'] ) ) {
			$css['width'] = $width_items . $unit;
		}

		$gap = isset( $attributes['itemGap'][ 'value' . $device ] ) ? $attributes['itemGap'][ 'value' . $device ] : '';
		$unit_gap = ! empty( $attributes['itemGap'][ 'valueUnit' . $device ] ) ? $attributes['itemGap'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['itemGap'] ) && ! empty( $attributes['itemGap'] ) ) {
			$css['gap'] = $gap . $unit_gap;
		}

		return array_merge(
			$css,
			isset( $attributes['itemPadding'] ) ? Dimensions::get_css( $attributes['itemPadding'], 'padding', $device ) : [],
			isset( $attributes['itemBorder'] ) ? Border::get_css( $attributes['itemBorder'], '', $device ) : [],
		);
	}

	public function get_search_result_item_hover( $attributes, $device = '' ) {
		$css = [];

		return array_merge(
			$css,
			isset( $attributes['itemBorder'] ) ? Border::get_hover_css( $attributes['itemBorder'], '', $device ) : [],
		);
	}

	public function get_search_result_img_css( $attributes, $device = '' ) {
		$css = [];

		$width_items = isset( $attributes['thumbnailWidth'][ 'value' . $device ] ) ? $attributes['thumbnailWidth'][ 'value' . $device ] : '';
		$unitW = ! empty( $attributes['thumbnailWidth'][ 'valueUnit' . $device ] ) ? $attributes['thumbnailWidth'][ 'valueUnit' . $device ] : 'px';
		$height_items = isset( $attributes['thumbnailHeight'][ 'value' . $device ] ) ? $attributes['thumbnailHeight'][ 'value' . $device ] : '';
		$unitH = ! empty( $attributes['thumbnailHeight'][ 'valueUnit' . $device ] ) ? $attributes['thumbnailHeight'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['thumbnailWidth'] ) && ! empty( $attributes['thumbnailWidth'] ) ) {
			$css['width'] = $width_items . $unitW;
		}
		if ( isset( $attributes['thumbnailWidth'] ) && ! empty( $attributes['thumbnailWidth'] ) ) {
			$css['height'] = $height_items . $unitH;
		}

		return array_merge(
			$css,
		);
	}

	public function get_Button_css( $attributes, $device = '' ) {
		$css = [];
		$button_color = isset( $attributes['buttonTextColor'] ) ? $attributes['buttonTextColor'] : '';

		if ( isset( $attributes['buttonTextColor'] ) && ! empty( $attributes['buttonTextColor'] ) ) {
			$css['color'] = $button_color;
		}

		return array_merge(
			$css,
			isset( $attributes['buttonTypography'] ) ? Typography::get_css( $attributes['buttonTypography'], $device ) : [],
			isset( $attributes['buttonTextStroke'] ) ? TextStroke::get_css( $attributes['buttonTextStroke'], $device ) : [],
			isset( $attributes['buttonTextShadow'] ) ? TextStroke::get_css( $attributes['buttonTextShadow'], $device ) : [],
		);
	}


	public function get_Icon_css( $attributes, $device = '' ) {
		$css = [];
		$width_items = isset( $attributes['iconWidth'][ 'value' . $device ] ) ? $attributes['iconWidth'][ 'value' . $device ] : '';
		$unit = ! empty( $attributes['iconWidth'][ 'valueUnit' . $device ] ) ? $attributes['iconWidth'][ 'valueUnit' . $device ] : 'px';

		if ( isset( $attributes['iconWidth'] ) && ! empty( $attributes['iconWidth'] ) ) {
			$css['width'] = $width_items . $unit;
		}

		return $css;
	}



	public function render_block_content( $attributes, $content, $block_instance ) {

		$currentPostID = $attributes['currentPostID'] ?? '';
		$source = $attributes['source'] ?? '';
		$placeholder = $attributes['placeholder'] ?? 'Write anything.......';
		$variant = $attributes['variant'] ?? 'classic';
		$isIcon = $attributes['isIcon'] ?? 'icon';
		$buttonText = $attributes['buttonText'] ?? 'Search';
		$buttonAlignment = $attributes['buttonAlignment']['value'] ?? 'left';

		ob_start();
		?>
		<div class="ablocks-block--search-bar <?php echo esc_attr( $variant ); ?>">
			<form method="post" class="ablocks-block--search-form <?php echo esc_attr( ( $isIcon === 'both' || $isIcon === 'text' ) ? $isIcon : '' ); ?>">
				<?php if ( $buttonAlignment === 'left' && $variant != 'classic' ) : ?>
					<button type="button" class="ablocks-block--search-button <?php echo esc_attr( ( $isIcon === 'both' || $isIcon === 'text' ) ? $isIcon : '' ); ?>">
					<span class="button-content">
						<?php echo $this->render_button( $isIcon, $buttonText ); ?>
					</span>
					<span class="loading-spinner">
						<?php echo $this->loading_spinner(); ?>
					</span>
					</button>
				<?php endif; ?>

				<input class="ablocks-block--search-input <?php echo esc_attr( ( $isIcon === 'both' || $isIcon === 'text' ) ? $isIcon : '' ); ?>" type="text" placeholder="<?php echo esc_attr( $placeholder ); ?>" value=""/>

				<?php if ( $buttonAlignment === 'right' || $variant === 'classic' ) : ?>
					<button type="button" class="ablocks-block--search-button <?php echo esc_attr( ( $isIcon === 'both' || $isIcon === 'text' ) ? $isIcon : '' ); ?>">
						<span class="button-content">
							<?php echo $this->render_button( $isIcon, $buttonText ); ?>
						</span>
						<span class="loading-spinner" >
							<?php echo $this->loading_spinner(); ?>
						</span>
					</button>
				<?php endif; ?>
				<input type="hidden" class="ablocks-block--search-source" value="<?php echo esc_attr( $source ); ?>"/>
				<input type="hidden" class="ablocks-block--search__current-post-id" value="<?php echo esc_attr( $currentPostID ); ?>"/>
			</form>
			<ul class="ablocks-block--search-result ablocks-block--search-empty-result">
				<!-- Search results will go here -->
			</ul>
		</div>
		<?php
		return ob_get_clean();
	}

	private function render_button( $isIcon, $buttonText ) {
		$search_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
							<circle cx="11" cy="11" r="8"></circle>
							<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
						</svg>';
		if ( $isIcon === 'icon' ) {
			return $search_icon;
		} elseif ( $isIcon === 'text' ) {
			return '<span>' . esc_html( $buttonText ) . '</span>';
		} else {
			return $search_icon . '<span>' . esc_html( $buttonText ) . '</span>';
		}
	}

	private function loading_spinner() {
		$spinner = '<svg viewBox="0 0 800 800" xmlns="http://www.w3.org/2000/svg">
			<circle class="ablocks-search-block__spin" cx="400" cy="400" fill="none"
				r="200" stroke-width="50" stroke="currentColor"
				stroke-dasharray="700 1400"
				stroke-linecap="round" />
			</svg>';
			return $spinner;
	}








}

