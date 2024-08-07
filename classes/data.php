<?php 
trait ALPB_Data{
    public $verification_code, $api_namespace="alpb/v1";

    public function get_client_id(){
        return get_option('_alpb_client_id');
    }

    public function get_client_secret(){
        return get_option('_alpb_client_secret');
    }

    public function update_client_id($client_id){
        update_option('_alpb_client_id', $client_id);
        return get_option('_alpb_client_id');
    }

    public function sanitize_text_or_array_field($array_or_string) {

        if( is_string($array_or_string) ){
            $array_or_string = sanitize_text_field($array_or_string);
        }elseif( is_array($array_or_string) ){
            foreach ( $array_or_string as $key => &$value ) {
                if ( is_array( $value ) ) {
                    $value = $this->sanitize_text_or_array_field($value);
                }
                else {
                    $value = sanitize_text_field( $value );
                }
            }
        }    
        return $array_or_string;
    }

}