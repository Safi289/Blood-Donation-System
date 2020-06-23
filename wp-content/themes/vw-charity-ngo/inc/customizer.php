<?php
/**
 * VW Charity NGO Theme Customizer
 *
 * @package VW Charity NGO
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_charity_ngo_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_charity_ngo_custom_controls' );

function vw_charity_ngo_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_charity_ngo_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-charity-ngo' ),
	    'description' => __( 'Description of what this panel does.', 'vw-charity-ngo' ),
	) );

	$wp_customize->add_section( 'vw_charity_ngo_left_right', array(
    	'title'      => __( 'General Settings', 'vw-charity-ngo' ),
		'priority'   => 30,
		'panel' => 'vw_charity_ngo_panel_id'
	) );

	$wp_customize->add_setting('vw_charity_ngo_width_option',array(
        'default' => __('Full Width','vw-charity-ngo'),
        'sanitize_callback' => 'vw_charity_ngo_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Charity_NGO_Image_Radio_Control($wp_customize, 'vw_charity_ngo_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-charity-ngo'),
        'description' => __('Here you can change the width layout of Website.','vw-charity-ngo'),
        'section' => 'vw_charity_ngo_left_right',
        'choices' => array(
            'Full Width' => get_template_directory_uri().'/images/full-width.png',
            'Wide Width' => get_template_directory_uri().'/images/wide-width.png',
            'Boxed' => get_template_directory_uri().'/images/boxed-width.png',
    ))));

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_charity_ngo_theme_options',array(
        'default' => __('Right Sidebar','vw-charity-ngo'),
        'sanitize_callback' => 'vw_charity_ngo_sanitize_choices'	        
	) );
	$wp_customize->add_control('vw_charity_ngo_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-charity-ngo'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-charity-ngo'),
        'section' => 'vw_charity_ngo_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-charity-ngo'),
            'Right Sidebar' => __('Right Sidebar','vw-charity-ngo'),
            'One Column' => __('One Column','vw-charity-ngo'),
            'Three Columns' => __('Three Columns','vw-charity-ngo'),
            'Four Columns' => __('Four Columns','vw-charity-ngo'),
            'Grid Layout' => __('Grid Layout','vw-charity-ngo')
        ),
	));

	$wp_customize->add_setting('vw_charity_ngo_page_layout',array(
        'default' => __('One Column','vw-charity-ngo'),
        'sanitize_callback' => 'vw_charity_ngo_sanitize_choices'
	));
	$wp_customize->add_control('vw_charity_ngo_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-charity-ngo'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-charity-ngo'),
        'section' => 'vw_charity_ngo_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-charity-ngo'),
            'Right Sidebar' => __('Right Sidebar','vw-charity-ngo'),
            'One Column' => __('One Column','vw-charity-ngo')
        ),
	) );

	//Topbar section
	$wp_customize->add_section('vw_charity_ngo_topbar',array(
		'title'	=> __('Topbar Section','vw-charity-ngo'),
		'description'	=> __('Add TopBar Content here','vw-charity-ngo'),
		'priority'	=> null,
		'panel' => 'vw_charity_ngo_panel_id',
	));
	
	$wp_customize->add_setting('vw_charity_ngo_address',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_charity_ngo_address',array(
		'label'	=> __('Add Location','vw-charity-ngo'),
		'section'	=> 'vw_charity_ngo_topbar',
		'setting'	=> 'vw_charity_ngo_address',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_charity_ngo_contact',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_charity_ngo_contact',array(
		'label'	=> __('Add Contact Details','vw-charity-ngo'),
		'section'	=> 'vw_charity_ngo_topbar',
		'setting'	=> 'vw_charity_ngo_contact',
		'type'		=> 'text'
	));	

	$wp_customize->add_setting('vw_charity_ngo_email',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_charity_ngo_email',array(
		'label'	=> __('Add Email Address','vw-charity-ngo'),
		'section'	=> 'vw_charity_ngo_topbar',
		'setting'	=> 'vw_charity_ngo_email',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_charity_ngo_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_charity_ngo_text',array(
		'label'	=> __('Button Text','vw-charity-ngo'),
		'section'	=> 'vw_charity_ngo_topbar',
		'setting'	=> 'vw_charity_ngo_text',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('vw_charity_ngo_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_charity_ngo_link',array(
		'label'	=> __('Button Link','vw-charity-ngo'),
		'section'	=> 'vw_charity_ngo_topbar',
		'setting'	=> 'vw_charity_ngo_link',
		'type'		=> 'text'
	));

	//Slider
	$wp_customize->add_section( 'vw_charity_ngo_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-charity-ngo' ),
		'priority'   => null,
		'panel' => 'vw_charity_ngo_panel_id'
	) );

	$wp_customize->add_setting( 'vw_charity_ngo_slider_hide_show',
       array(
          'default' => 1,
          'transport' => 'refresh',
          'sanitize_callback' => 'vw_charity_ngo_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Charity_NGO_Toggle_Switch_Custom_control( $wp_customize, 'vw_charity_ngo_slider_hide_show',
       array(
          'label' => esc_html__( 'Show / Hide Slider','vw-charity-ngo' ),
          'section' => 'vw_charity_ngo_slidersettings'
    )));

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_charity_ngo_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_charity_ngo_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_charity_ngo_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vw-charity-ngo' ),
			'description' => __('Slider image size (1500 x 765)','vw-charity-ngo'),
			'section'  => 'vw_charity_ngo_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//content layout
	$wp_customize->add_setting('vw_charity_ngo_slider_content_option',array(
        'default' => __('Left','vw-charity-ngo'),
        'sanitize_callback' => 'vw_charity_ngo_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Charity_NGO_Image_Radio_Control($wp_customize, 'vw_charity_ngo_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-charity-ngo'),
        'section' => 'vw_charity_ngo_slidersettings',
        'choices' => array(
            'Left' => get_template_directory_uri().'/images/slider-content1.png',
            'Center' => get_template_directory_uri().'/images/slider-content2.png',
            'Right' => get_template_directory_uri().'/images/slider-content3.png',
    ))));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_charity_ngo_slider_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_charity_ngo_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-charity-ngo' ),
		'section'     => 'vw_charity_ngo_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_charity_ngo_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Opacity
	$wp_customize->add_setting('vw_charity_ngo_slider_opacity_color',array(
      'default'              => 0.5,
      'sanitize_callback' => 'vw_charity_ngo_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_charity_ngo_slider_opacity_color', array(
	'label'       => esc_html__( 'Slider Image Opacity','vw-charity-ngo' ),
	'section'     => 'vw_charity_ngo_slidersettings',
	'type'        => 'select',
	'settings'    => 'vw_charity_ngo_slider_opacity_color',
	'choices' => array(
      '0' =>  esc_attr('0','vw-charity-ngo'),
      '0.1' =>  esc_attr('0.1','vw-charity-ngo'),
      '0.2' =>  esc_attr('0.2','vw-charity-ngo'),
      '0.3' =>  esc_attr('0.3','vw-charity-ngo'),
      '0.4' =>  esc_attr('0.4','vw-charity-ngo'),
      '0.5' =>  esc_attr('0.5','vw-charity-ngo'),
      '0.6' =>  esc_attr('0.6','vw-charity-ngo'),
      '0.7' =>  esc_attr('0.7','vw-charity-ngo'),
      '0.8' =>  esc_attr('0.8','vw-charity-ngo'),
      '0.9' =>  esc_attr('0.9','vw-charity-ngo')
	),
	));

	//Scholarship
	$wp_customize->add_section( 'vw_charity_ngo_scholarship' , array(
    	'title'      => __( 'Scholarship Section', 'vw-charity-ngo' ),
		'priority'   => null,
		'panel' => 'vw_charity_ngo_panel_id'
	) );

	for ( $count = 1; $count <= 3; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_charity_ngo_scholarship_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_charity_ngo_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_charity_ngo_scholarship_page' . $count, array(
			'label'    => __( 'Select Scholarship Page', 'vw-charity-ngo' ),
			'section'  => 'vw_charity_ngo_scholarship',
			'type'     => 'dropdown-pages'
		) );
	}

	//Scholarship excerpt
	$wp_customize->add_setting( 'vw_charity_ngo_scholarship_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_charity_ngo_scholarship_excerpt_number', array(
		'label'       => esc_html__( 'Scholarship Excerpt length','vw-charity-ngo' ),
		'section'     => 'vw_charity_ngo_scholarship',
		'type'        => 'range',
		'settings'    => 'vw_charity_ngo_scholarship_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//What We Do
	$wp_customize->add_section( 'vw_charity_ngo_what_do' , array(
    	'title'      => __( 'What we do Section', 'vw-charity-ngo' ),
		'priority'   => null,
		'panel' => 'vw_charity_ngo_panel_id'
	) );

	$wp_customize->add_setting('vw_charity_ngo_what_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_charity_ngo_what_title',array(
		'label'	=> __('Section Title','vw-charity-ngo'),
		'section'	=> 'vw_charity_ngo_what_do',
		'setting'	=> 'vw_charity_ngo_what_title',
		'type'		=> 'text'
	));

	for ( $count = 1; $count <= 3; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_charity_ngo_what_do_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_charity_ngo_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_charity_ngo_what_do_page' . $count, array(
			'label'    => __( 'Select What we do Page', 'vw-charity-ngo' ),
			'section'  => 'vw_charity_ngo_what_do',
			'type'     => 'dropdown-pages'
		) );
	}

	//What We Do excerpt
	$wp_customize->add_setting( 'vw_charity_ngo_what_we_do_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_charity_ngo_what_we_do_excerpt_number', array(
		'label'       => esc_html__( 'What We Do Excerpt length','vw-charity-ngo' ),
		'section'     => 'vw_charity_ngo_what_do',
		'type'        => 'range',
		'settings'    => 'vw_charity_ngo_what_we_do_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog Post
	$wp_customize->add_section('vw_charity_ngo_blog_post',array(
		'title'	=> __('Blog Post Settings','vw-charity-ngo'),
		'panel' => 'vw_charity_ngo_panel_id',
	));	

	$wp_customize->add_setting( 'vw_charity_ngo_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_charity_ngo_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Charity_NGO_Toggle_Switch_Custom_control( $wp_customize, 'vw_charity_ngo_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-charity-ngo' ),
        'section' => 'vw_charity_ngo_blog_post'
    )));

    $wp_customize->add_setting( 'vw_charity_ngo_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_charity_ngo_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Charity_NGO_Toggle_Switch_Custom_control( $wp_customize, 'vw_charity_ngo_toggle_author',array(
		'label' => esc_html__( 'Author','vw-charity-ngo' ),
		'section' => 'vw_charity_ngo_blog_post'
    )));

    $wp_customize->add_setting( 'vw_charity_ngo_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_charity_ngo_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Charity_NGO_Toggle_Switch_Custom_control( $wp_customize, 'vw_charity_ngo_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-charity-ngo' ),
		'section' => 'vw_charity_ngo_blog_post'
    )));

    $wp_customize->add_setting( 'vw_charity_ngo_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_charity_ngo_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-charity-ngo' ),
		'section'     => 'vw_charity_ngo_blog_post',
		'type'        => 'range',
		'settings'    => 'vw_charity_ngo_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Content Creation
	$wp_customize->add_section( 'vw_charity_ngo_content_section' , array(
    	'title' => __( 'Customize Home Page Settings', 'vw-charity-ngo' ),
		'priority' => null,
		'panel' => 'vw_charity_ngo_panel_id'
	) );

	$wp_customize->add_setting('vw_charity_ngo_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new VW_Charity_NGO_Content_Creation( $wp_customize, 'vw_charity_ngo_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-charity-ngo' ),
		),
		'section' => 'vw_charity_ngo_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-charity-ngo' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_charity_ngo_footer',array(
		'title'	=> __('Footer','vw-charity-ngo'),
		'description'=> __('This section will appear in the footer','vw-charity-ngo'),
		'panel' => 'vw_charity_ngo_panel_id',
	));	
	
	$wp_customize->add_setting('vw_charity_ngo_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_charity_ngo_footer_text',array(
		'label'	=> __('Copyright Text','vw-charity-ngo'),
		'section'=> 'vw_charity_ngo_footer',
		'setting'=> 'vw_charity_ngo_footer_text',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('vw_charity_ngo_scroll_top_alignment',array(
        'default' => __('Right','vw-charity-ngo'),
        'sanitize_callback' => 'vw_charity_ngo_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Charity_NGO_Image_Radio_Control($wp_customize, 'vw_charity_ngo_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-charity-ngo'),
        'section' => 'vw_charity_ngo_footer',
        'settings' => 'vw_charity_ngo_scroll_top_alignment',
        'choices' => array(
            'Left' => get_template_directory_uri().'/images/layout1.png',
            'Center' => get_template_directory_uri().'/images/layout2.png',
            'Right' => get_template_directory_uri().'/images/layout3.png'
    ))));
}

add_action( 'customize_register', 'vw_charity_ngo_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Charity_Ngo_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_Charity_NGO_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new VW_Charity_NGO_Customize_Section_Pro($manager,'example_1',array(
			'priority'   => 1,
			'title'    => esc_html__( 'VW Charity NGO Pro', 'vw-charity-ngo' ),
			'pro_text' => esc_html__( 'Upgrade Pro', 'vw-charity-ngo' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/premium-charity-wordpress-theme/'),
		)));

		$manager->add_section(new VW_Charity_NGO_Customize_Section_Pro($manager,'example_2',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Documentation', 'vw-charity-ngo' ),
			'pro_text' => esc_html__( 'Docs', 'vw-charity-ngo' ),
			'pro_url'  => admin_url( 'themes.php?page=vw_charity_ngo_guide' ),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-charity-ngo-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-charity-ngo-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Charity_Ngo_Customize::get_instance();