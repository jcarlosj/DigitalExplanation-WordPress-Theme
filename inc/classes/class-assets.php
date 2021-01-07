<?php
/** Enqueue Theme Assets
 * @package DigitalExplanation
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Assets {
    use Singleton;

    protected function __construct() {
        // wp_die( 'Class Assets' );

        //  Cargamos Clases.
        $this -> setup_hooks();
    }

    protected function setup_hooks() {
        /** Actions */
		add_action( 'wp_enqueue_scripts', [ $this, 'storefront_parent_theme_enqueue_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ] );

    }

	/** Estilos de puesta en cola del tema principal Storefront */
    public function storefront_parent_theme_enqueue_styles() {
		wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'digitalexplanation-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( 'storefront-style' )
		);

	}

	public function register_styles() {
		/** Register Styles */
		wp_register_style( 'main', THEME_BUILD_CSS_URI . '/main.css', [], filemtime( THEME_BUILD_CSS_DIR_PATH .'/main.css' ), 'all' );    //  main.css

		/** Enqueue Styles */
		wp_enqueue_style( 'main' );
	}

	public function register_scripts() {
		wp_enqueue_script( 'main', THEME_BUILD_JS_URI . '/main.js', [], filemtime( THEME_BUILD_JS_DIR_PATH .'/main.js' ), true );
	}

}
