<?php

namespace JPB\WP\Dev\Plugin;

interface PluginInterface {

	/**
	 * Run the plugin's main initialization routine
	 *
	 * @return PluginInterface Returns itself for easier method chaining
	 */
	public function run();

	/**
	 * Get the plugin directory path
	 *
	 * @return string
	 */
	public function getDirectory();

	/**
	 * Set the plugin's directory path
	 *
	 * @param string $directory
	 *
	 * @return $this Returns itself for easier method chaining
	 */
	public function setDirectory( $directory );

	/**
	 * Get the plugin's url
	 *
	 * @return string
	 */
	public function getUrl();

	/**
	 * Set the plugin's url
	 *
	 * @param string $url
	 *
	 * @return $this Returns itself for easier method chaining
	 */
	public function setUrl( $url );

}
