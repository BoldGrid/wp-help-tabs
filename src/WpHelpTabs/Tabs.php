<?php
/**
 * BoldGrid WpHelpTabs Tabs class.
 *
 * @package Boldgrid\WpHelpTabs
 *
 * @version 1.0.0
 * @author BoldGrid <wpb@boldgrid.com>
 */
namespace Boldgrid\WpHelpTabs;

/**
 * Boldgrid WpHelpTabs Tabs class.
 *
 * This class handles adding help tabs to WordPress admin pages.
 *
 * @since 1.0.0
 */
class Tabs {
	/**
	 * Configs.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array
	 */
	private $configs;

	/**
	 * Init.
	 *
	 * User passes in an array of help tab configs, and we setup those help tabs.
	 *
	 * @since 1.0.0
	 *
	 * @param array $configs
	 */
	public function init( $configs ) {
		$this->configs = $configs;

		add_action( 'current_screen', array( $this, 'addLoadActions' ) );
	}

	/**
	 * Add tabs to the current screen.
	 *
	 * This method is hooked into the load-<screenId> action.
	 *
	 * @since 1.0.0
	 */
	public function addTabs() {
		$screen = get_current_screen();

		foreach( $this->configs['screens'][$screen->id]['tabs'] as $tabId ) {
			$screen->add_help_tab( $this->configs['tabs'][ $tabId ] );
		}
	}

	/**
	 * Add actions to the load-(page) hook.
	 *
	 * @since 1.0.0
	 */
	public function addLoadActions() {
		foreach( array_keys( $this->configs['screens'] ) as $screenId ) {
			add_action( 'load-' . $screenId, array( $this, 'addTabs' ) );
		}
	}
}