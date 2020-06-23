<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Charity_Ngo_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-charity-ngo' ),
				'family'      => esc_html__( 'Font Family', 'vw-charity-ngo' ),
				'size'        => esc_html__( 'Font Size',   'vw-charity-ngo' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-charity-ngo' ),
				'style'       => esc_html__( 'Font Style',  'vw-charity-ngo' ),
				'line_height' => esc_html__( 'Line Height', 'vw-charity-ngo' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-charity-ngo' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-charity-ngo-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-charity-ngo-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-charity-ngo' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-charity-ngo' ),
        'Acme' => __( 'Acme', 'vw-charity-ngo' ),
        'Anton' => __( 'Anton', 'vw-charity-ngo' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-charity-ngo' ),
        'Arimo' => __( 'Arimo', 'vw-charity-ngo' ),
        'Arsenal' => __( 'Arsenal', 'vw-charity-ngo' ),
        'Arvo' => __( 'Arvo', 'vw-charity-ngo' ),
        'Alegreya' => __( 'Alegreya', 'vw-charity-ngo' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-charity-ngo' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-charity-ngo' ),
        'Bangers' => __( 'Bangers', 'vw-charity-ngo' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-charity-ngo' ),
        'Bad Script' => __( 'Bad Script', 'vw-charity-ngo' ),
        'Bitter' => __( 'Bitter', 'vw-charity-ngo' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-charity-ngo' ),
        'BenchNine' => __( 'BenchNine', 'vw-charity-ngo' ),
        'Cabin' => __( 'Cabin', 'vw-charity-ngo' ),
        'Cardo' => __( 'Cardo', 'vw-charity-ngo' ),
        'Courgette' => __( 'Courgette', 'vw-charity-ngo' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-charity-ngo' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-charity-ngo' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-charity-ngo' ),
        'Cuprum' => __( 'Cuprum', 'vw-charity-ngo' ),
        'Cookie' => __( 'Cookie', 'vw-charity-ngo' ),
        'Chewy' => __( 'Chewy', 'vw-charity-ngo' ),
        'Days One' => __( 'Days One', 'vw-charity-ngo' ),
        'Dosis' => __( 'Dosis', 'vw-charity-ngo' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-charity-ngo' ),
        'Economica' => __( 'Economica', 'vw-charity-ngo' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-charity-ngo' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-charity-ngo' ),
        'Francois One' => __( 'Francois One', 'vw-charity-ngo' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-charity-ngo' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-charity-ngo' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-charity-ngo' ),
        'Handlee' => __( 'Handlee', 'vw-charity-ngo' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-charity-ngo' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-charity-ngo' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-charity-ngo' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-charity-ngo' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-charity-ngo' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-charity-ngo' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-charity-ngo' ),
        'Kanit' => __( 'Kanit', 'vw-charity-ngo' ),
        'Lobster' => __( 'Lobster', 'vw-charity-ngo' ),
        'Lato' => __( 'Lato', 'vw-charity-ngo' ),
        'Lora' => __( 'Lora', 'vw-charity-ngo' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-charity-ngo' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-charity-ngo' ),
        'Merriweather' => __( 'Merriweather', 'vw-charity-ngo' ),
        'Monda' => __( 'Monda', 'vw-charity-ngo' ),
        'Montserrat' => __( 'Montserrat', 'vw-charity-ngo' ),
        'Muli' => __( 'Muli', 'vw-charity-ngo' ),
        'Marck Script' => __( 'Marck Script', 'vw-charity-ngo' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-charity-ngo' ),
        'Open Sans' => __( 'Open Sans', 'vw-charity-ngo' ),
        'Overpass' => __( 'Overpass', 'vw-charity-ngo' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-charity-ngo' ),
        'Oxygen' => __( 'Oxygen', 'vw-charity-ngo' ),
        'Orbitron' => __( 'Orbitron', 'vw-charity-ngo' ),
        'Patua One' => __( 'Patua One', 'vw-charity-ngo' ),
        'Pacifico' => __( 'Pacifico', 'vw-charity-ngo' ),
        'Padauk' => __( 'Padauk', 'vw-charity-ngo' ),
        'Playball' => __( 'Playball', 'vw-charity-ngo' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-charity-ngo' ),
        'PT Sans' => __( 'PT Sans', 'vw-charity-ngo' ),
        'Philosopher' => __( 'Philosopher', 'vw-charity-ngo' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-charity-ngo' ),
        'Poiret One' => __( 'Poiret One', 'vw-charity-ngo' ),
        'Quicksand' => __( 'Quicksand', 'vw-charity-ngo' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-charity-ngo' ),
        'Raleway' => __( 'Raleway', 'vw-charity-ngo' ),
        'Rubik' => __( 'Rubik', 'vw-charity-ngo' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-charity-ngo' ),
        'Russo One' => __( 'Russo One', 'vw-charity-ngo' ),
        'Righteous' => __( 'Righteous', 'vw-charity-ngo' ),
        'Slabo' => __( 'Slabo', 'vw-charity-ngo' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-charity-ngo' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-charity-ngo'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-charity-ngo' ),
        'Sacramento' => __( 'Sacramento', 'vw-charity-ngo' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-charity-ngo' ),
        'Tangerine' => __( 'Tangerine', 'vw-charity-ngo' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-charity-ngo' ),
        'VT323' => __( 'VT323', 'vw-charity-ngo' ),
        'Varela Round' => __( 'Varela Round', 'vw-charity-ngo' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-charity-ngo' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-charity-ngo' ),
        'Volkhov' => __( 'Volkhov', 'vw-charity-ngo' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-charity-ngo' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-charity-ngo' ),
			'100' => esc_html__( 'Thin',       'vw-charity-ngo' ),
			'300' => esc_html__( 'Light',      'vw-charity-ngo' ),
			'400' => esc_html__( 'Normal',     'vw-charity-ngo' ),
			'500' => esc_html__( 'Medium',     'vw-charity-ngo' ),
			'700' => esc_html__( 'Bold',       'vw-charity-ngo' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-charity-ngo' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'normal'  => esc_html__( 'Normal', 'vw-charity-ngo' ),
			'italic'  => esc_html__( 'Italic', 'vw-charity-ngo' ),
			'oblique' => esc_html__( 'Oblique', 'vw-charity-ngo' )
		);
	}
}
