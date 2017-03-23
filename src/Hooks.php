<?php

namespace JPB\WP\Dev;

trait Hooks {

	/**
	 * Internal property to track closures attached to WordPress hooks
	 *
	 * @var array
	 */
	protected $__filterMap = [];

	/**
	 * Add a WordPress filter
	 *
	 * @param string   $hook
	 * @param callable $method
	 * @param int      $priority
	 * @param int      $argCount
	 */
	protected function addFilter( $hook, $method, $priority = 10, $argCount = 1 ) {
		add_filter(
			$hook,
			$this->mapFilter( $this->getWpFilterId( $hook, $method, $priority ), $method, $argCount ),
			$priority,
			$argCount
		);
	}

	/**
	 * Add a WordPress action
	 *
	 * This is just an alias of addFilter()
	 *
	 * @param string   $hook
	 * @param callable $method
	 * @param int      $priority
	 * @param int      $argCount
	 */
	protected function addAction( $hook, $method, $priority = 10, $argCount = 1 ) {
		$this->addFilter( $hook, $method, $priority, $argCount );
	}

	/**
	 * Remove a WordPress filter
	 *
	 * @param string   $hook
	 * @param callable $method
	 * @param int      $priority
	 * @param int      $argCount
	 */
	protected function removeFilter( $hook, $method, $priority = 10, $argCount = 1 ) {
		remove_filter(
			$hook,
			$this->mapFilter( $this->getWpFilterId( $hook, $method, $priority ), $method, $argCount ),
			$priority,
			$argCount
		);
	}

	/**
	 * Remove a WordPress action
	 *
	 * This is just an alias of removeFilter()
	 *
	 * @param string   $hook
	 * @param callable $method
	 * @param int      $priority
	 * @param int      $argCount
	 */
	protected function removeAction( $hook, $method, $priority = 10, $argCount = 1 ) {
		$this->removeFilter( $hook, $method, $priority, $argCount );
	}

	/**
	 * Run do_action
	 *
	 * @param string $action  The action to run
	 * @param array  ...$args Any extra arguments to pass to do_action
	 */
	protected function doAction( $action, ...$args ) {
		do_action( $action, ...$args );
	}

	/**
	 * Run apply_filters
	 *
	 * @param string $filter  The filter to run
	 * @param string $value   The value to filter
	 * @param array  ...$args Any extra values to send through the filter
	 *
	 * @return mixed|void
	 */
	protected function applyFilters( $filter, $value, ...$args ) {
		return apply_filters( $filter, $value, ...$args );
	}

	/**
	 * Get a unique ID for a hook based on the internal method, hook, and priority
	 *
	 * @param string $hook
	 * @param string $method
	 * @param int    $priority
	 *
	 * @return bool|string
	 */
	protected function getWpFilterId( $hook, $method, $priority ) {
		return _wp_filter_build_unique_id( $hook, [ $this, $method ], $priority );
	}

	/**
	 * Map a filter to a closure that inherits the class' internal scope
	 *
	 * This allows hooks to use protected and private methods
	 *
	 * @param $id
	 * @param $method
	 * @param $argCount
	 *
	 * @return \Closure The callable actually attached to a WP hook
	 */
	protected function mapFilter( $id, $method, $argCount ) {
		if ( empty( $this->__filterMap[ $id ] ) ) {
			$this->__filterMap[ $id ] = function ( ...$args ) use ( $method, $argCount ) {
				return $this->{$method}( ...array_slice( $args, 0, $argCount ) );
			};
		}

		return $this->__filterMap[ $id ];
	}

}
