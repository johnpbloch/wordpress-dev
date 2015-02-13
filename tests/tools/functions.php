<?php

namespace JPB\WP\Dev {

	function add_filter( $hook, $callback, $priority = 10, $argCount = 1 ) {
		return \add_filter( $hook, $callback, $priority, $argCount );
	}

}
