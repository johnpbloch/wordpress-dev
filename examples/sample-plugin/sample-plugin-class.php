<?php

use JPB\WP\Dev\AbstractPlugin;

class SamplePluginClass extends AbstractPlugin {

	/**
	 * This method is hooked into the plugins_loaded action
	 */
	protected function pluginsLoaded() {
		$this->addAction( 'init', 'init' );
		$this->addAction( 'admin_init', 'adminInit' );
	}

	protected function init() {
		// initialize some things for your plugin
	}

	protected function adminInit() {
		// Add admin menus, etc.
	}

}
