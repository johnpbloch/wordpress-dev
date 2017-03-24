<?php

namespace JPB\WP\Dev\Module;

use JPB\WP\Dev\Plugin\PluginInterface;

interface ModuleInterface {

	/**
	 * @return string
	 */
	public function getName();

	public function initialize( PluginInterface $plugin );

	public function shutDown();

}
