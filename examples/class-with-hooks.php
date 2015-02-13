<?php

use JPB\WP\Dev\Hooks;

class SampleClassWithHooks {

	/**
	 * Hooks is a trait that adds the ability to add methods from a
	 * class as WordPress hooks. The methods you need to know about
	 * are addFilter(), addAction(), removeFilter(), and
	 * removeAction(). All of these methods have the same arguments
	 * as the core WordPress functions with only one slight change:
	 * the function argument is only the method name, not an array
	 * with the object and the method.
	 *
	 * This can only be used to hook methods native to the current
	 * class.
	 */
	use Hooks;

	public function setup() {
		// Add your public methods like normal
		$this->addFilter( 'the_content', 'contentFilter' );
		// Add your protected methods too!
		$this->addAction( 'wp_enqueue_scripts', 'addScripts' );
		// And private methods!
		$this->addAction( 'wp_loaded', 'privacyPlease' );
	}

	/**
	 * Reverses the content
	 *
	 * @param string $content
	 *
	 * @return string
	 */
	public function contentFilter( $content ) {
		return strrev( $content );
	}

	protected function addScripts() {
		wp_enqueue_script( 'harlem-shake', 'https://raw.githubusercontent.com/moovweb/harlem_shaker/master/harlem-shake-script.js' );
	}

	private function privacyPlease() {
		// do something secret
	}

}

// Create your object
$obj = new SampleClassWithHooks();
// Start adding your hooks
$obj->setup();
