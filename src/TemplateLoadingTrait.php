<?php

namespace JPB\WP\Dev;

use UnexpectedValueException;

trait TemplateLoadingTrait {

	protected $templateDirectory;

	/**
	 * Sets the template directory as the root for template lookups
	 *
	 * @param string $directory
	 *
	 * @return $this
	 */
	protected function setTemplateDirectory( $directory ) {
		$this->templateDirectory = $directory;

		return $this;
	}

	/**
	 * Load a template or variant thereof with context passed in.
	 *
	 * Pass in a template variant to load a variant template if it exists. For example, if you load 'foo' with a variant
	 * of 'bar', this method first tries to load 'foo-bar.php', then 'foo.php'. Any elements in the context array will
	 * be loaded as local variables within the template. Pass in non-global variables this way. You may omit the variant
	 * and pass the context in its place as well.
	 *
	 * @param string       $template
	 * @param string|array $variant
	 * @param array        $context
	 */
	protected function loadTemplate( $template, $variant = '', $context = [] ) {
		if ( is_array( $variant ) ) {
			if ( empty( $context ) ) {
				$context = $variant;
			}
			$variant = '';
		}
		$templateDirectory = rtrim( $this->templateDirectory, '/\\' );
		$ds                = DIRECTORY_SEPARATOR;
		$__files           = [];
		if ( $variant ) {
			$files[] = "{$templateDirectory}{$ds}{$template}-$variant.php";
		}
		$__files[] = "{$templateDirectory}{$ds}{$template}.php";
		unset( $variant, $template, $templateDirectory, $ds );
		extract( $context, EXTR_SKIP );
		foreach ( $__files as $__file ) {
			if ( file_exists( $__file ) ) {
				require $__file;
				$found_template = true;
				break;
			}
		}
		if ( ! isset( $found_template ) ) {
			throw new UnexpectedValueException( 'Could not find a template' );
		}
	}

}
