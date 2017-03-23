<?php

namespace JPB\Tests\WP\Dev;

use JPB\Mocks\WP\Dev\Hookable;
use WP_Mock;
use WP_Mock\Tools\TestCase;

class HooksTest extends TestCase {

	public function testAddsHooks() {
		$this->mockHookFunctions();
		$expectedHook     = 'the_title';
		$expectedPriority = rand( 9, 11 );
		$expectedArgCount = rand( 1, 2 );
		WP_Mock::userFunction( 'JPB\\WP\\Dev\\add_filter', [
			'times'  => 1,
			'return' => function (
				$hook,
				$func,
				$priority,
				$argCount
			) use (
				$expectedHook,
				$expectedPriority,
				$expectedArgCount
			) {
				$this->assertEquals( $expectedHook, $hook );
				$this->assertEquals( $expectedPriority, $priority );
				$this->assertEquals( $expectedArgCount, $argCount );
				$title = 'A Title';
				$this->assertEquals( "<h2>$title</h2>", $func( $title ) );
			}
		] );

		$hookable = new Hookable();
		$hookable->addTitleFilter( $expectedPriority, $expectedArgCount );
		$this->assertConditionsMet();
	}

	public function testPrivateHooks() {
		$this->mockHookFunctions();
		WP_Mock::userFunction( 'JPB\\WP\\Dev\\add_filter', [
			'times'  => 1,
			'return' => function ( $hook, $function, $priority, $count ) {
				$this->assertEquals( 10, $priority );
				$this->assertEquals( 1, $count );
				$this->assertEquals( 'wp_footer', $hook );
				$function();
			}
		] );
		$this->expectOutputString( 'Hello World!' );

		( new Hookable() )->addPrivateAction();
		$this->assertConditionsMet();
	}

	protected function mockHookFunctions() {
		WP_Mock::userFunction( '_wp_filter_build_unique_id', [
			/*
			 * Lifted entirely (with modifications) from WordPress core itself
			 */
			'return' => function () {
				$function = func_get_arg( 1 );
				if ( is_string( $function ) ) {
					return $function;
				}

				if ( is_object( $function ) ) {
					// Closures are currently implemented as objects
					$function = array( $function, '' );
				} else {
					$function = (array) $function;
				}

				if ( is_object( $function[0] ) ) {
					// Object Class Calling
					return spl_object_hash( $function[0] ) . $function[1];
				} else {
					// Static Calling
					return $function[0] . '::' . $function[1];
				}
			}
		] );
	}

}
