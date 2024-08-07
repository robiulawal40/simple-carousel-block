<?php 
if(!class_exists("ALPB_Order_Actions") ):
    class ALPB_Order_Actions{
        use ALPB_Order_Trait;
        public $order_id, $order, $type, $project_name, $project_details, $users;

        public function __construct($order_id){
            $this->error = new WP_Error();
            $this->order= wc_get_order($order_id);
            $this->set_order_id($order_id);
            $this->basecamp_connection = new ALPB_Connect_BaseCamp();
        }

        public function log_errors(){
            if( $this->error->has_errors() ){
                $rand = rand(1, 100);
                foreach ( (array) $this->error->errors as $code => $messages ) {
                    // $all_messages = array_merge( $all_messages, $messages );
                    Log_Error::log($rand." Error_Code:".$code. "; Error_Message:". $messages[0], "a", "order_actions");
                }
                
            }
        }

        public function handle_error(){
            if($this->request->the_response)
            print_r($this->request->the_response);
            $this->error->errors = array_merge($this->error->errors, $this->request->error->errors);            
            $this->log_errors();
        }

        public function set_order_id($order_id){
            $this->order_id= $order_id;
            return $this;
        }

        public function get_item_name(){
            $line_items = $this->order->get_items( 'line_item' );
            if( is_array($line_items) ){   
                foreach( $line_items as $item_id => $item ){
                    $this->item = $item;
                    return $item->get_name();
                }
            }
            return __("no item found", "wotb");
        }

        public function get_item_project_name(){
            $line_items = $this->order->get_items( 'line_item' );
            // print_r($line_items);
            if( is_array($line_items) ){   
                foreach( $line_items as $item_id => $item ){
                    $project_name = wc_get_order_item_meta($item_id, 'Project Name ', true);
                    if($project_name){                        
                        return $project_name;
                    }
                    break;
                }
            }
            return __("Project Name Not Set", "wotb");
        }

        /*
        * div, h1, br, strong, em, strike, a (with an href attribute), pre, ol, ul, li, and blockquote
        */
        public function get_project_details(){
            $item_title= $this->get_item_name();
            $details = wp_strip_all_tags($this->item->get_product()->get_description());
           return $details;
        }

        public function prepare_project_name(){
            $this->project_name= "N".$this->order_id." - ".$this->get_item_project_name();

            $this->project_details = $this->get_project_details();

            return $this;
        }

        public function prepare_pro_title($title){
            $_title= explode(",", $title);
            $__title= array_map("trim", $_title);
                //  print_r($_title);
            return $__title;

        }

        public function select_project_type(){
            $item_name = $this->get_item_name();
            $designer_pro_title = $this->prepare_pro_title(get_option("designer_product_title"));
            $developer_pro_title = $this->prepare_pro_title(get_option("developer_product_title"));


            // if( preg_match("/Beanie/", $item_name) || preg_match("/E-mail template HTML/", $item_name) ){
            if( stripos(json_encode($designer_pro_title),$item_name) != false ){
                $type =  "design";
            }elseif(stripos(json_encode($developer_pro_title),$item_name) != false){
                $type= "development";
            }
            $this->type= $type;
            // return $this->type;
            return $this;
        }

        public function process_user_name_email($designer){
            $f_designers = [];
            if(!empty($designer)){
             $_designers = explode(",", $designer);
             if(is_array($_designers) ){
                 foreach( $_designers as $_designer ){
                     $__designer = explode(":", $_designer);
                     $f_designer = array_map("trim", $__designer);
                     $ff_designer['name'] =$f_designer[0]; 
                     $ff_designer['email_address'] =$f_designer[1]; 
                     if( !empty($ff_designer['name']) && !empty($ff_designer['email_address']) ){
                         $f_designers[] = $ff_designer;
                     }
                 }
             }
            //  print_r($f_designers);
             return $f_designers;
            }
        }

        public function get_designer(){

           $designer =  get_option("designer_name_email");
            $create_designer = $this->process_user_name_email($designer);

            return array(
                'create' =>$create_designer
            );
            // return array(
            //     //'revoke' =>[37922700],
            //     'create' =>array(
            //         array(
            //             "name" => "Designer 1",
            //             "email_address" => "designer1@gmail.com",
            //             // "title" => "Prankster",
            //             // "company_name" => "Hancho Design 2",
            //             // "client"=> "1",
            //         ),
            //         array(
            //             "name" => "Designer 2",
            //             "email_address" => "Designer2@gmail.com",
            //          )
            //      )
            // );
        }

        public function get_developer(){
            $developer =  get_option("developer_name_email");
            $create_developer = $this->process_user_name_email($developer);

            return array(
                'create' =>$create_developer
            );
            // return array(
            //     //'revoke' =>[37922700],
            //     'create' =>array(
            //         array(
            //             "name" => "Developer 1",
            //             "email_address" => "Developer1@gmail.com",
            //             // "title" => "Prankster",
            //             // "company_name" => "Hancho Design 2",
            //             // "client"=> "1",
            //         ),
            //         array(
            //             "name" => "Developer 2",
            //             "email_address" => "Developer2@gmail.com",
            //          )
            //      )
            // );
        }

        public function select_users(){
            if($this->type== "design"){
                $this->users = $this->get_designer();
            }elseif( $this->type=="development" ){
                $this->users = $this->get_developer();
            }
            return $this;
        }

        public function set_basecamp_project_id($project_id){
            $this->set_project_id($project_id);
            return $this;
        }

        public function get_basecamp_project_id(){
           return $this->get_project_id();
        }

        // public function get_create_message_status(){
        //     return true;
        // }

        public function update_create_message_status($val){
            update_post_meta($this->order_id, "_basecamp_message_status", $val );
            return $this;
        }

        public function get_create_message_status(){
           return get_post_meta($this->order_id, "_basecamp_message_status", true );
        }

        public function update_email_status($val){
            update_post_meta($this->order_id, "_basecamp_email_status", $val );
            return $this;
        }

        public function get_email_status(){
           return get_post_meta($this->order_id, "_basecamp_email_status", true );
        }

        public function set_basecamp_project_url($project_url){
            // update_post_meta($this->order_id, "_basecamp_project_url", $project_url );
            $this->set_project_url($project_url);
            return $this;
        }

        public function get_basecamp_project_url(){
           return $this->get_project_url();                      
        }

        public function update_user_submitted($val){
            update_post_meta($this->order_id, "_basecamp_user_submitte", $val );
            return $this;
        }

        public function get_user_submitted(){
           return get_post_meta($this->order_id, "_basecamp_user_submitte", true );
        }

        public function reconnect(){
            // $this->set_basecamp_project_id("");
            // $this->set_basecamp_project_url("");
            $this->reset_order_meta();
            $this->reconnect = true;
            return $this;
        }

        public function previous_success(){
            if( !empty( $this->get_basecamp_project_id() ) && !empty( $this->get_basecamp_project_url() ) ){
                return true;
            }else{
                return false;
            }
        }

        public function submit_api(){
            if( ! $this->previous_success() ){
                $response = $this->basecamp_connection->set_order_id($this->order_id)->create_project($this->project_name, $this->project_details);
           if(!$response){
               //echo "error";
               $this->error->add("error in creating project","There is a problem creating this project");
               $this->handle_error();
               return false;
           }else{
            //    print_r($response);
               $this->set_basecamp_project_id($response["id"]);
               $this->set_basecamp_project_url($response["url"]);
               return true;
           }
        }else{
            // echo "Previously success";
        }
            return true;
        }

        public function add_users(){
            $this->prepare_project_name()->select_project_type()->select_users();
            $users = $this->users;
            if( $this->get_user_submitted() == 1 && !isset( $this->reconnect) ){
                // echo "Previously user Submitted";
                return true;
            }
            if($this->basecamp_connection->set_order_id($this->order_id)->update_project_users($users)){
                $this->update_user_submitted(1);
                return true;
            }else{
                return false;
            }
        }

        public function set_init_message(){
            $init_subject = "N".$this->order_id." - ".$this->get_item_project_name();;

            $item_html = "<div>\n";
            // echo "<pre>";
            // print_r( $this->order->get_address('billing') );
            $item_formatted_meta = $this->item->get_formatted_meta_data(); 
            
            // Item Meta
            if( is_array($item_formatted_meta) and count($item_formatted_meta) > 0 ){
                $item_html .="<div><strong>".__('Order Details', 'wotb').":</strong></div>";
                foreach( $item_formatted_meta as $meta_id => $meta_data ){
                    $item_html .="<strong>";                    
                    if($meta_data->display_key)
                    $item_html .= $meta_data->display_key.":";
                    $item_html .="</strong>";
                    if("External Link " == $meta_data->display_key || "Project file(s) " == $meta_data->display_key){
                        $url = preg_match('/href=["\']?([^"\'>]+)["\']?/', $meta_data->display_value, $match);
                        $item_html .= $match[1];
                    }else{
                        $item_html .= $meta_data->display_value;
                    }
                    $item_html .="<br/>";
                }
            }

            // Order Edit Url 
            $item_html .="<div><strong>".__('Check Order', 'wotb').":</strong>";                    
            $order_edit_url = get_edit_post_link( $this->order_id );
            $item_html .= "<a href=".$order_edit_url.">".$order_edit_url."</a>";
            $item_html .="</a>";            
            $item_html .="</div><br />";            

            // Client Details 
            $billing_address = $this->order->get_address('billing');
            $item_html .="<div><strong>".__('Client Details', 'wotb')."</strong></div>";  
            $item_html .= "<div><strong>Country:</strong>".$billing_address['country']."</div>";
            $item_html .= "<div><strong>E-mail:</strong>".$billing_address['email']."</div>";
            $item_html .= "<div><strong>Phone:</strong>".$billing_address['phone']."</div>";
            $item_html .= "<div>".$this->order->get_formatted_billing_address()."</div><br />";

            $item_html .="<div><strong>".__('Client Notes', 'wotb').":</strong></div>"; 
            // print_r( $this->order->get_customer_note() ); 
            $item_html .= "<div>".$this->order->get_customer_note()."</div>";
            
            // print_r( $item_formatted_meta );
            $item_html .= "</div>";
            // echo "<textarea readonly='readonly' style='width: 100%; display: block; height: auto; min-height:500px'>";
            // echo $item_html;
            // echo "</textarea>";
            // print_r($item_formatted_meta);
            // echo "</pre>";


            $message = $item_html;
            if( $this->get_create_message_status() == 1 && !isset($this->reconnect) ){
                return true;
            }
            if($this->basecamp_connection->set_order_id($this->order_id)->create_message( $init_subject, $message)){
                $this->update_create_message_status(1);
                return true;
            }else{
                return false;
            }
        }

        public function send_email(){
            if( $this->get_email_status() == 1 && !isset($this->reconnect) ){
                return true;
            }
            if((new ALPB_Send_Email($this->order_id))->send()){
                $this->update_email_status(1);
                return true;
            }else{
                return false;
            }
        }

        public function run_for_basecamp(){
            if($this->prepare_project_name()->select_project_type()->select_users()->submit_api()){
                if( $this->add_users() && $this->set_init_message() && $this->send_email() ){
                    return true;
                }
                return false;
            }else{
                return false;
            }
        }


        public function delete_from_basecamp(){
            return true;
        }

        public function get_from_basecamp(){
        //  echo   $this->get_project_url();
           $project = $this->basecamp_connection->get_project( $this->get_project_id() );
           return $project;
           //print_r($project);
        }

        public function get_user_from_basecamp_project(){
            //  echo   $this->get_project_url();
               $people = $this->basecamp_connection->get_project_people( $this->get_project_id() );
            //    print_r($people);
               return $people;
            }
        
        public function reset_order_meta(){
            $this->set_basecamp_project_id("");
            $this->set_basecamp_project_url("");
            $this->update_user_submitted(0);
            $this->update_create_message_status(0);
            $this->update_email_status(0);
        }
        
        public function delete_basecamp_project(){
            //  echo   $this->get_project_url();
                $deleted = $this->basecamp_connection->delete_project( $this->get_project_id() );
                if($deleted){
                    $this->reset_order_meta();
                }else{
                    $project_status = $this->get_from_basecamp();
                    if( isset( $project_status['status']) && $project_status['status'] == "trashed" ){
                        $this->reset_order_meta();
                    }
                }
                return $deleted;
            }

    }
// add_action('init', function(){
//    if( $_SERVER['NODE'] ):
//     $order_action = new ALPB_Order_Actions(1212);
//     // if( !$order_action->run_for_basecamp() ){
//     //     create_schedule_event(1212);
//     // }
//     // print_r($order_action->get_designer());
//     // print_r($order_action->select_project_type());
//     $order_action->run_for_basecamp();
//     // print_r($order_action->get_from_basecamp());
//     // $order_action->get_user_from_basecamp_project();
//     // echo $order_action->get_project_id();
//     // $order_action->delete_basecamp_project();
//     // echo "<br>";
//     // echo get_option('_wotb_access_token');
//     // echo "</br>";
//     endif;
// });

endif;