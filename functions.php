<?php
/**
 * Digital Explanation Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package digitalexplanation
 */

//	Obtiene PATH del Tema Hijo
$storefront_dir_path  = untrailingslashit( get_template_directory() );
$new_storefront_dir_path = str_replace( [ 'storefront' ], [ 'digitalexplanation' ], $storefront_dir_path );

/** Debugging Code */
// echo '<pre>';   print_r( $new_storefront_dir_path ); wp_die();

if( ! defined( 'THEME_DIR_PATH' ) ) {
    define(
        'THEME_DIR_PATH',
        $new_storefront_dir_path     // WP Func: Elimina las barras inclinadas hacia adelante y hacia atrás si existen.
    );
}

/** Debugging Code */
// echo '<pre>';   print_r( THEME_DIR_PATH ); wp_die();

require_once THEME_DIR_PATH. '/inc/helpers/autoloader.php';    //  Incluirá automáticamente todas las clases que definamos

function digitalexplanation_get_theme_instance() {
	\THEME\Inc\Theme::get_instance();
}

digitalexplanation_get_theme_instance();


// function notification_bar_function(){

// 	$template_path = 'template-parts/notification-bar';

// 	ob_start();         //  Activa el almacenamiento en búfer de la salida

// 	get_template_part( $template_path );
// 	$template_content = ob_get_contents();     //  Devuelve contenido del búfer de salida

// 	ob_end_clean();     //  Limpiar (eliminar) el búfer de salida

//     echo $template_content;
// }
// add_action( 'storefront_header', 'notification_bar_function' );		//	Engancha función a una acción específica
