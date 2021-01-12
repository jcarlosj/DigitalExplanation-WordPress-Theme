<?php
/** Enqueue Theme Hooks
 * @package DigitalExplanation
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Hooks {
    use Singleton;

    protected function __construct() {
        // wp_die( 'Class Hooks' );

        //  Cargamos Clases.
		$this -> setup_hooks();
		$this -> setup_hooks_storefront();
    }

    protected function setup_hooks() {
        /** Actions */
		//add_action( 'storefront_header', [ $this, 'notification_bar' ] );		//	Engancha función a una acción específica
	}

	protected function setup_hooks_storefront() {
		add_action( 'storefront_header', [ $this, 'change_position_product_search' ] );
		add_action( 'storefront_header', [ $this, 'change_position_header_card' ] );
	}

	public function notification_bar(){

		$template_path = 'template-parts/notification-bar';

		ob_start();         //  Activa el almacenamiento en búfer de la salida

		get_template_part( $template_path );
		$template_content = ob_get_contents();     //  Devuelve contenido del búfer de salida

		ob_end_clean();     //  Limpiar (eliminar) el búfer de salida

		echo $template_content;
	}

	public function change_position_product_search() {
		remove_action( 'storefront_header', 'storefront_product_search', 40);
		add_action( 'storefront_header', 'storefront_product_search', 39 );

	}

	public function change_position_header_card() {
		remove_action( 'storefront_header', 'storefront_header_cart', 60);
		add_action( 'storefront_header', 'storefront_header_cart', 40);
	}

}
