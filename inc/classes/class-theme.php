<?php
/** Boostraps the Theme
 * @package DigitalExplanation
 */

namespace THEME\Inc;

use THEME\Inc\Traits\Singleton;

class Theme {
    use Singleton;

    protected function __construct() {
		// wp_die( 'THEME!' );

		//  Cargamos Clases.
		Assets :: get_instance();
		Hooks :: get_instance();

	}

}
