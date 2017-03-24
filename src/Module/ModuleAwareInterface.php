<?php

namespace JPB\WP\Dev\Module;

interface ModuleAwareInterface {

	/**
	 * @param ModuleInterface $module
	 *
	 * @return $this
	 */
	public function registerModule( ModuleInterface $module );

	/**
	 * @param string $name
	 */
	public function unregisterModule( $name );

	/**
	 * @param string $name
	 *
	 * @return bool
	 */
	public function hasModule( $name );

	/**
	 * @param string $name
	 *
	 * @return ModuleInterface
	 */
	public function getModule( $name );

}
