<?php
if ( ! class_exists( 'ALPB_Ajax' ) ) :

	class ALPB_Ajax {

		public function __construct() {
			add_action( 'wp_ajax_alpb_update_state', array( $this, 'alpb_update_state' ) );
			add_action( 'wp_ajax_nopriv_alpb_update_state', array( $this, 'alpb_update_state' ) );
		}

		public function alpb_update_state() {
			global $alpb_error;

			if ( ! wp_verify_nonce( $_POST['nonce'], 'alpb_nonce' ) ) {
				exit( 'Authenticaiton Fail' );
			}

			$data = ALPB_sanitize_text_or_array_field( $_POST['data'] );
			if ( isset( $data['update_state'] ) && $data['update_state'] ) {
				$func_name     = $data['update_state'];
				$response_data = $this->{$func_name}( $data );
			}
			wp_send_json_success( $response_data );
		}

		public function add_new_user_to_courser( $data ) {
			return $data['user_id'];
		}

	}
endif;
