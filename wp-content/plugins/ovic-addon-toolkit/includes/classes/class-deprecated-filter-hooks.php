<?php
/**
 * Deprecated filter hooks
 *
 * @package Ovic\Abstracts
 * @since   3.0.0
 * @version 3.3.0
 */
defined( 'ABSPATH' ) || exit;

/**
 * Handles deprecation notices and triggering of legacy filter hooks
 */
class Ovic_Deprecated_Filter_Hooks extends Ovic_Deprecated_Hooks
{
	/**
	 * Array of deprecated hooks we need to handle.
	 * Format of 'new' => 'old'.
	 *
	 * @var array
	 */
	protected $deprecated_hooks = array(
		'ovic_override_footer_template' => 'ovic_overide_footer_template',
	);
	/**
	 * Array of versions on each hook has been deprecated.
	 *
	 * @var array
	 */
	protected $deprecated_version = array(
		'ovic_overide_footer_template' => '1.2.2',
	);

	/**
	 * Hook into the new hook so we can handle deprecated hooks once fired.
	 *
	 * @param string $hook_name Hook name.
	 */
	public function hook_in( $hook_name )
	{
		add_filter( $hook_name, array( $this, 'maybe_handle_deprecated_hook' ), -1000, 8 );
	}

	/**
	 * If the old hook is in-use, trigger it.
	 *
	 * @param  string $new_hook New hook name.
	 * @param  string $old_hook Old hook name.
	 * @param  array $new_callback_args New callback args.
	 * @param  mixed $return_value Returned value.
	 * @return mixed
	 */
	public function handle_deprecated_hook( $new_hook, $old_hook, $new_callback_args, $return_value )
	{
		if ( has_filter( $old_hook ) ) {
			$this->display_notice( $old_hook, $new_hook );
			$return_value = $this->trigger_hook( $old_hook, $new_callback_args );
		}

		return $return_value;
	}

	/**
	 * Fire off a legacy hook with it's args.
	 *
	 * @param  string $old_hook Old hook name.
	 * @param  array $new_callback_args New callback args.
	 * @return mixed
	 */
	protected function trigger_hook( $old_hook, $new_callback_args )
	{
		return apply_filters_ref_array( $old_hook, $new_callback_args );
	}
}
