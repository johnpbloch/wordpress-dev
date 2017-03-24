<?php

namespace JPB\WP\Dev;

use function wp_list_filter;

trait FactoryTrait {

	protected $_cached = [];

	/**
	 * Retrieve an object from a cached slot within the factory.
	 *
	 * Methods in the factory class that create objects will use some property as a unique identifier that is the key
	 * within the storage array. By default, that key is what's used for the lookup. Optionally, methods may provide a
	 * property within objects themselves that will be used for the lookup. If provided, rather than look the object up
	 * by its primary key, this method will use wp_list_pluck() to find all objects with the specified property matching
	 * the lookup value, then return the first result.
	 *
	 * @param string $slot   The internal cache slot in which to look
	 * @param mixed  $lookup The value to look up by
	 * @param bool   $key    Optional key under which to look for the value
	 *
	 * @return mixed|null
	 */
	protected function retrieveObject( $slot, $lookup, $key = false ) {
		if ( ! isset( $this->_cached[ $slot ] ) ) {
			$this->_cached[ $slot ] = [];

			return null;
		}
		if ( $key === false ) {
			return isset( $this->_cached[ $slot ][ $lookup ] ) ? $this->_cached[ $slot ][ $lookup ] : null;
		}
		$objects = wp_list_filter( $this->_cached[ $slot ], [ $key => $lookup ] );

		return $objects ? reset( $objects ) : null;
	}

	/**
	 * Store an object in an internal cache slot
	 *
	 * Returns the stored object for simpler return statements.
	 *
	 * This method can be used to bust the cache of an object, so consider only using this method in conjunction with
	 * retrieveObject to make sure you don't accidentally overwrite an existing object without meaning to.
	 *
	 * @param string $slot   The cache slot in which to store the object
	 * @param mixed  $key    The key for the object
	 * @param mixed  $object The object to store
	 *
	 * @return mixed
	 */
	protected function storeObject( $slot, $key, $object ) {
		if ( ! isset( $this->_cached[ $slot ] ) ) {
			$this->_cached[ $slot ] = [];
		}
		$this->_cached[ $slot ][ $key ] = $object;

		return $object;
	}

}
