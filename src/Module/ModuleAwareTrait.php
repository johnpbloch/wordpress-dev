<?php

namespace JPB\WP\Dev\Module;

use JPB\WP\Dev\Plugin\PluginInterface;

trait ModuleAwareTrait {

	/** @var ModuleInterface[] */
	protected $modules = [];

	/**
	 * @param ModuleInterface $module
	 *
	 * @return $this
	 */
	public function registerModule( ModuleInterface $module ) {
		$this->modules[ $module->getName() ] = $module;

		return $this;
	}

	/**
	 * @param string $name
	 */
	public function unregisterModule( $name ) {
		$module = $this->getModule( $name );
		if ( $module ) {
			$module->shutDown();
			unset( $this->modules[ $name ] );
		}
	}

	/**
	 * @param string $name
	 *
	 * @return bool
	 */
	public function hasModule( $name ) {
		return isset( $this->modules[ $name ] );
	}

	/**
	 * @param string $name
	 *
	 * @return ModuleInterface
	 */
	public function getModule( $name ) {
		return $this->hasModule( $name ) ? $this->modules[ $name ] : null;
	}

	/**
	 * @param PluginInterface $plugin
	 */
	public function initModules( PluginInterface $plugin ) {
		foreach ( $this->modules as $module ) {
			$module->initialize( $plugin );
		}
	}

}
