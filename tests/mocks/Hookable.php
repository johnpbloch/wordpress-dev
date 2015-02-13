<?php

namespace JPB\Mocks\WP\Dev;

use JPB\WP\Dev\Hooks;

class Hookable {

	use Hooks;

	public function addTitleFilter( $p, $c ) {
		$this->addFilter( 'the_title', 'title_header', $p, $c );
	}

	public function title_header( $title ) {
		return "<h2>$title</h2>";
	}

}
