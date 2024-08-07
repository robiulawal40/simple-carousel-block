<?php

if ( ! class_exists( 'ALPB_Rest_Endpoints' ) ) :

	class ALPB_Rest_Endpoints {
		// use ALPB_Data;
		public $error, $api_namespace;

		public function __construct() {
			add_action( 'rest_api_init', array( $this, 'register_url' ) );
			$this->api_namespace = 'alpb';
			$this->error         = new WP_Error();
		}

		public function log_errors() {
			if ( $this->error->has_errors() ) {
				$rand = rand( 1, 100 );
				foreach ( (array) $this->error->errors as $code => $messages ) {
					Log_Error::log( $rand . ' Error_Code:' . $code . '; Error_Message:' . $messages[0], 'a', 'webhook' );
				}
			}
		}

		public function handle_error() {
			$this->error->errors = array_merge( $this->error->errors, array() );
			$this->log_errors();
		}

		public function register_url() {
			// ?code=cd7fdf5b  =(?P<code>\d+) WP_REST_Server::CREATABLE
			register_rest_route(
				$this->api_namespace,
				'/message',
				array(
					array(
						'methods'             => WP_REST_Server::CREATABLE,
						'callback'            => array( $this, 'callback' ),
						'permission_callback' => array( $this, 'permission_callback' ),
					),
					array(
						'methods'             => WP_REST_Server::READABLE,
						'callback'            => array( $this, 'get_callback' ),
						'permission_callback' => array( $this, 'permission_callback' ),
					),
				)
			);

		}

		public function callback( WP_REST_Request $request ) {
			$parameters = $request->get_params();

			$parameters = $request->get_params();
			$data       = $this->prepare_response( $parameters );
			return wp_json_encode( $data );

		}

		public function get_callback( WP_REST_Request $request ) {
			$parameters = $request->get_params();
			$data       = $this->prepare_response( $parameters );
			return wp_json_encode( $data );
		}

		public function prepare_response( $parameters ) {

			$data['initial_message_text']    = get_option( 'initial_message_text' );
			$data['designer_product_title']  = get_option( 'designer_product_title' );
			$data['designer_name_email']     = get_option( 'designer_name_email' );
			$data['developer_product_title'] = get_option( 'developer_product_title' );
			$data['developer_name_email']    = get_option( 'developer_name_email' );

			$data['parameters'] = $parameters;
			return $data;
		}

		public function permission_callback() {
			if ( ! current_user_can( 'manage_options' ) ) {
				return new WP_Error( 'rest_forbidden', esc_html__( 'OMG you can not view private data.', 'wotb' ), array( 'status' => 401 ) );
			}
			return true;
		}
	}
endif;