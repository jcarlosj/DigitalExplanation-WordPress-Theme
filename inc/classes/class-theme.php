<?php
/** Boostraps the Theme
 * @package Aquila
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Theme {
    use Singleton;

    protected function __construct() {
		// wp_die( 'THEME!' );

		//  Cargamos Clases.
        Assets :: get_instance();
	}

}