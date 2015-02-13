<?php

/*
 * Plugin Name: Sample Plugin
 * Version: 0.1.0
 */

// For the sake of simplicity, I'm including the file directly here. I
// strongly recommend using Composer for the autoloading features.
require_once __DIR__ . '/sample-plugin-class.php';

// Instantiate the plugin
$sample_plugin = new SamplePluginClass();
$sample_plugin
	// Set up the plugin's directory ...
	->setDirectory( plugin_dir_path( __FILE__ ) )
	// ... and url ...
	->setUrl( plugins_url( '', __FILE__ ) )
	// ... and run the plugin!
	->run();

// The plugin's run() method just adds a hook for the plugin's real loader,
// pluginsLoaded(). This is so that other plugins can disable your plugin
// without too much hassle. All they have to do is...
//
// $sample_plugin->disable();
//
// before the plugins_loaded action fires and your plugin won't initialize.
// Of course, this can be overridden in your implementation of the abstract
// plugin class, but that's up to you.
