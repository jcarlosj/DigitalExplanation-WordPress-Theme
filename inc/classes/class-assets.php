<?php
/** Enqueue Theme Assets
 * @package Aquila
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

    }

	/** Estilos de puesta en cola del tema principal Storefront */
    public function storefront_parent_theme_enqueue_styles() {
		wp_enqueue_style( 'storefront-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'digitalexplanation-style',
			get_stylesheet_directory_uri() . '/style.css',
			array( 'storefront-style' )
		);

	}

}
