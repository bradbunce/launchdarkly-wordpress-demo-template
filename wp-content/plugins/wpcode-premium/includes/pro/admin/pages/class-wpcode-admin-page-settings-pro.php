<?php
/**
 * Pro-specific settings admin page.
 *
 * @package WPCode
 */

/**
 * Pro-specific settings admin page.
 */
class WPCode_Admin_Page_Settings_Pro extends WPCode_Admin_Page_Settings {

	/**
	 * Add page-specific hooks.
	 *
	 * @return void
	 */
	public function page_hooks() {
		parent::page_hooks();

		add_action( 'admin_init', array( $this, 'save_access_settings' ) );

		add_filter( 'wpcode_admin_js_data', array( $this, 'add_license_strings' ) );
	}

	/**
	 * Extend the settings page with pro-specific fields.
	 *
	 * @return void
	 */
	public function output_view_general() {
		$this->metabox_row(
			__( 'License Key', 'wpcode-premium' ),
			$this->get_license_key_field(),
			'wpcode-setting-license-key'
		);

		$this->common_settings();

		wp_nonce_field( $this->action, $this->nonce_name );
	}

	/**
	 * License key field for the Pro settings page.
	 *
	 * @return false|string
	 */
	public function get_license_key_field() {
		$license      = (array) get_option( 'wpcode_license', array() );
		$key          = ! empty( $license['key'] ) ? $license['key'] : '';
		$type         = ! empty( $license['type'] ) ? $license['type'] : '';
		$is_valid_key = ! empty( $key ) &&
		                ( isset( $license['is_expired'] ) && $license['is_expired'] === false ) &&
		                ( isset( $license['is_disabled'] ) && $license['is_disabled'] === false ) &&
		                ( isset( $license['is_invalid'] ) && $license['is_invalid'] === false );

		$hide        = $is_valid_key ? '' : 'wpcode-hide';
		$account_url = wpcode_utm_url(
			'https://library.wpcode.com/account/downloads/',
			'settings-page',
			'license-key',
			'account'
		);

		ob_start();
		?>
		<span class="wpcode-setting-license-wrapper">
			<input type="password" id="wpcode-setting-license-key" value="<?php echo esc_attr( $key ); ?>" class="wpcode-input-text" <?php disabled( $is_valid_key ); ?>>
		</span>
		<button type="button" id="wpcode-setting-license-key-verify" class="wpcode-button <?php echo $is_valid_key ? 'wpcode-hide' : ''; ?>"><?php esc_html_e( 'Verify Key', 'wpcode-premium' ); ?></button>
		<button type="button" id="wpcode-setting-license-key-deactivate" class="wpcode-button <?php echo esc_attr( $hide ); ?>"><?php esc_html_e( 'Deactivate Key', 'wpcode-premium' ); ?></button>
		<button type="button" id="wpcode-setting-license-key-deactivate-force" class="wpcode-button wpcode-hide"><?php esc_html_e( 'Force Deactivate Key', 'wpcode-premium' ); ?></button>
		<p class="type <?php echo esc_attr( $hide ); ?>">
			<?php
			printf(
			/* translators: %s: the license type */
				esc_html__( 'Your license key level is %s.', 'wpcode-premium' ),
				'<strong>' . esc_html( $type ) . '</strong>'
			);
			?>
		</p>
		<p>
			<?php
			printf(
			/* translators: %1$s: opening link tag, %2$s: closing link tag */
				esc_html__( 'You can find your license key in your %1$sWPCode account%2$s.', 'wpcode-premium' ),
				'<a href="' . esc_url( $account_url ) . '" target="_blank">',
				'</a>'
			);
			?>
		</p>
		<?php

		return ob_get_clean();
	}

	/**
	 * Output the form for the access management tab.
	 *
	 * @return void
	 */
	public function output_view_access() {

		$can_access = wpcode()->license->license_can( 'pro' );

		if ( ! $can_access ) {
			echo '<div class="wpcode-blur-area">';
		}

		$this->access_view_content();

		if ( ! $can_access ) {
			echo '</div>';
			echo $this->get_access_overlay();
		} else {
			// Nonce field.
			wp_nonce_field( 'wpcode_settings_access_save', 'wpcode_settings_access_nonce' );
		}
	}

	/**
	 * Process and Save access settings if any are set.
	 *
	 * @return void
	 */
	public function save_access_settings() {
		if ( ! isset( $_POST['wpcode_settings_access_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['wpcode_settings_access_nonce'] ), 'wpcode_settings_access_save' ) ) {
			return;
		}

		if ( ! current_user_can( 'wpcode_activate_snippets' ) ) {
			return;
		}

		$capabilities = array_keys( $this->get_capabilites() );

		foreach ( $capabilities as $capability ) {
			if ( isset( $_POST[ 'wpcode_capability_' . $capability ] ) ) {
				$roles = array_map( 'sanitize_key', $_POST[ 'wpcode_capability_' . $capability ] );
				wpcode()->settings->update_option( $capability, $roles );
			} else {
				wpcode()->settings->update_option( $capability, array() );
			}
		}

		if ( isset( $_POST['completely_disable_php'] ) ) {
			wpcode()->settings->update_option( 'completely_disable_php', true );
		} else {
			wpcode()->settings->update_option( 'completely_disable_php', false );
		}

		wp_safe_redirect( $this->get_page_action_url() );
		exit;
	}

	/**
	 * Show the PHP setting if PHP is not disabled.
	 *
	 * @return void
	 */
	public function php_setting() {
		if ( ! defined( 'WPCODE_DISABLE_PHP' ) || ! WPCODE_DISABLE_PHP ) {
			parent::php_setting();
		}
	}

	/**
	 * Get the capabilities for the access settings page.
	 *
	 * @return array[]
	 */
	public function get_capabilites() {
		$capabilities = WPCode_Access::capabilities();
		if ( WPCode_Access::php_disabled() ) {
			// If PHP is disabled, don't show the capability to edit php setting.
			unset( $capabilities['wpcode_edit_php_snippets'] );
		}

		return $capabilities;
	}

	/**
	 * Access control overlay.
	 *
	 * @return string
	 */
	public function get_access_overlay() {
		$text = sprintf(
		// translators: %1$s and %2$s are <u> tags.
			'<p>' . __( 'Improve the way you and your team manage your snippets with the WPCode Access Control settings. Enable other users on your site to manage different types of snippets or configure Conversion Pixels settings and update configuration files. This feature is available on the %1$sWPCode Pro%2$s plan or higher.', 'wpcode-premium' ) . '</p>',
			'<u>',
			'</u>'
		);

		return self::get_upsell_box(
			__( 'Access Control is not available on your plan', 'wpcode-premium' ),
			$text,
			array(
				'text' => __( 'Upgrade Now', 'wpcode-premium' ),
				'url'  => wpcode_utm_url( 'https://library.wpcode.com/account/downloads/', 'settings', 'tab-' . $this->view, 'upgrade-to-pro' ),
			),
			array(),
			array(
				__( 'Save time and improve website management with your team', 'wpcode-premium' ),
				__( 'Delegate snippet management to other users with full control', 'wpcode-premium' ),
				__( 'Enable other users to set up ads & 3rd party services', 'wpcode-premium' ),
				__( 'Choose if PHP snippets should be enabled on the site', 'wpcode-premium' ),
			)
		);
	}

	/**
	 * Add license strings to the JS object for the Pro settings page.
	 *
	 * @param string[] $data The translation strings.
	 *
	 * @return string[]
	 */
	public function add_license_strings( $data ) {
		$data['license_error_title'] = __( 'We encountered an error activating your license key', 'wpcode-premium' );

		return $data;
	}
}
