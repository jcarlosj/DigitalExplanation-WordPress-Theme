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
    }

    protected function setup_hooks() {
        /** Actions */
		add_action( 'storefront_header', [ $this, 'notification_bar' ] );		//	Engancha función a una acción específica
	}

	public function notification_bar(){

		$template_path = 'template-parts/notification-bar';

		ob_start();         //  Activa el almacenamiento en búfer de la salida

		get_template_part( $template_path );
		$template_content = ob_get_contents();     //  Devuelve contenido del búfer de salida

		ob_end_clean();     //  Limpiar (eliminar) el búfer de salida

		echo $template_content;
	}

}
