<?php

namespace JPB\WP\Dev\Plugin;

use JPB\WP\Dev\Hooks;

abstract class AbstractPlugin implements PluginInterface {

	use Hooks;

	/** @var string */
	protected $directory;

	/** @var string */
	protected $url;

	/**
	 * Run the plugin's main initialization routine
	 *
	 * @return PluginInterface Returns itself for easier method chaining
	 */
	public function run() {
		$this->addAction( 'plugins_loaded', 'pluginsLoaded' );

		return $this;
	}

	public function disable() {
		$this->removeAction( 'plugins_loaded', 'pluginsLoaded' );
	}

	/**
	 * Get the plugin directory path
	 *
	 * @return string
	 */
	public function getDirectory() {
		return $this->directory;
	}

	/**
	 * Set the plugin's directory path
	 *
	 * @param string $directory
	 *
	 * @return $this Returns itself for easier method chaining
	 */
	public function setDirectory( $directory ) {
		$this->directory = $directory;

		return $this;
	}

	/**
	 * Get the plugin's url
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Set the plugin's url
	 *
	 * @param string $url
	 *
	 * @return $this Returns itself for easier method chaining
	 */
	public function setUrl( $url ) {
		$this->url = $url;

		return $this;
	}

	protected abstract function pluginsLoaded();

}
