<?php 
if(!class_exists("ALPB_Order_Meta") ):
    class ALPB_Order_Meta{
        public function __construct(){
            add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
        }
        public function register_meta_boxes() {
            add_meta_box( 'wotb-box-id', __( ALPB_NAME, 'wotb' ), array($this,'callback'), 'shop_order' );
        }

        public function callback(){
            global $post;
           // echo $post->ID;
           //$order=  wc_get_order($post->ID);
          // $line_items = $order->get_items( 'line_item' );
           //echo "<pre>";

          // $order_action = new ALPB_Order_Actions($post->ID);
           // if( !$order_action->run_for_basecamp() ){
           //     create_schedule_event(1212);
           // }
           // print_r($order_action->get_designer());
           // print_r($order_action->select_project_type());
           //$order_action->run_for_basecamp();

        //    if( is_array($line_items) ){   
        //     foreach( $line_items as $item_id => $item ){
        //         $result = $item->get_formatted_meta_data(); 
        //         // print_r($result);
        //     //   print_r( $item->get_meta_data('Project Name '));           
        //     }
        // }
                 //print_r( get_post_meta($post->ID, "", true) );
           // echo "</pre>";
            echo '<div class="wrap">
                        <div id="the_view"></div>
        </div>';
        }
    }
new ALPB_Order_Meta();
endif;
