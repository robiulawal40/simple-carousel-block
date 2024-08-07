<?php 

if( !class_exists("ALPB_Send_Email") ):

    class ALPB_Send_Email{
        use ALPB_Data;

        public $order_id, $order;

        public function __construct($order_id){
            // add_action( 'rest_api_init', array($this,'register_url') );
            // $this->request = new ALPB_API();
            $this->error = new WP_Error();      
            $this->order= wc_get_order($order_id);
            $this->order_id = $order_id;      
        }

        public function log_errors(){
            if( $this->error->has_errors() ){
                $rand = rand(1, 100);
                foreach ( (array) $this->error->errors as $code => $messages ) {
                    Log_Error::log($rand." Error_Code:".$code. "; Error_Message:". $messages[0], "a", "email");
                }
                
            }
        }

        public function replace_shortcode($input){
            $output= preg_replace_callback_array([
                "/{([a-zA-Z-_]+)}/i"=> function($match){
                    if("order_id" == $match[1]){
                        return $this->order_id;
                    }
                    //if("order_key" == $match[1]){
                        // echo $this->order->get_order_key();
                        $method_name= "get_".sanitize_text_field($match[1]);
                        if( method_exists($this->order, $method_name) ){
                            return $this->order->{$method_name}();
                        }
                    //}
                    // print_r($match);
                    // return "+++++++++++++++++++++++";
                }
            ], $input);
            return $output;
        }
        public function set_test_email($email){
            $this->test_email= $email;
            return $this;
        }
        public function email_1_send(){
            if(isset($this->test_email) && $this->test_email ){
                $to = $this->replace_shortcode($this->test_email);
            }else{
                $to = $this->replace_shortcode(get_option('wotb_email_1_to'));
            }
            $subject = $this->replace_shortcode(get_option('wotb_email_1_subject'));
            $message = $this->replace_shortcode(__(html_entity_decode(get_option('wotb_email_1_content'))));
            $headers = array('Content-Type: text/html; charset=UTF-8');
            return wp_mail($to, $subject, $message, $headers);
        }

        public function email_2_send(){
            if(isset($this->test_email) && $this->test_email ){
                $to = $this->replace_shortcode($this->test_email);
            }else{
                $to = $this->replace_shortcode(get_option('wotb_email_2_to'));
            }
            
            $subject = $this->replace_shortcode(get_option('wotb_email_2_subject'));
            $message = $this->replace_shortcode(__(html_entity_decode(get_option('wotb_email_2_content'))));
            $headers = array('Content-Type: text/html; charset=UTF-8');
            return wp_mail($to, $subject, $message, $headers);
        }

        public function send(){
            if( $this->email_1_send() && $this->email_2_send() ){
                return true;
            }
            $this->error->add("error in sending email", "error in sending email order id:". $this->order_id);
            $this->log_errors();
            return false;
            // var_dump( $this->email_1_send() );
            // // print_r($replaced_content);
            // echo $this->order_id;
        }
    }

   
    add_action('init', function(){
        if( $_SERVER['NODE'] ):
         $order_action = new ALPB_Order_Actions(1212);

         (new ALPB_Send_Email(1212))->send();

         // if( !$order_action->run_for_basecamp() ){
         //     create_schedule_event(1212);
         // }
         // print_r($order_action->get_designer());
         // print_r($order_action->select_project_type());
        //  $order_action->run_for_basecamp();
         // print_r($order_action->get_from_basecamp());
         // $order_action->get_user_from_basecamp_project();
         // echo $order_action->get_project_id();
         // $order_action->delete_basecamp_project();
         // echo "<br>";
         // echo get_option('_wotb_access_token');
         // echo "</br>";
         endif;
     });
endif;