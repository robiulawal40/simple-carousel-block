<?php 
if(!class_exists("ALPB_CPT_Meta") ):
    class ALPB_CPT_Meta{

        use ALPB_Data;

        public function __construct(){
            add_action( 'add_meta_boxes', array( $this, 'register_meta_boxes' ) );
            add_action( 'save_post', array( $this, 'save_metabox_callback') );
        }

        public function save_metabox_callback($post_id){
        //    echo "<pre>";
        //    print_r($_POST);
        //    print_r($post_id);
        //    echo "</pre>";
        //     exit;
                if ( ! isset( $_POST['_wpnonce'] ) ) {
                    return;
                }
            
                // if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'nonce_value' ) ) {
                //     return;
                // }
            
                if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                    return;
                }
            
                if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return;
                }
            
                if ( isset( $_POST['post_type'] ) && 'child_website' === $_POST['post_type'] ) {
            
                    if ( isset( $_POST['wew_child_url'] ) ) {
                        update_post_meta( $post_id, 'wew_child_url', trim( $_POST['wew_child_url'], "/" ));
                    }
                    if ( isset( $_POST['wew_child_consumer_key'] ) ) {
                        update_post_meta( $post_id, 'wew_child_consumer_key', trim( $_POST['wew_child_consumer_key']));
                    }
                    if ( isset( $_POST['wew_child_consumer_secret'] ) ) {
                        update_post_meta( $post_id, 'wew_child_consumer_secret', trim( $_POST['wew_child_consumer_secret']));
                    }
            
                }
        }

        public function register_meta_boxes() {
            add_meta_box( 'wew-child_box-id', __( ALPB_NAME, 'wew' ), array($this,'callback'), 'child_website' );
        }

        public function callback(){
            global $post;
            ?>
                  <div class="wrap">
                  <h1><?php _e("Impostazioni credenziali sito cliente", "wew"); ?></h1>

                    <table class="form-table">
                        <tr valign="top">
                        <th scope="row"><?php _e("URL sito cliente", "wew"); ?></th>
                        <td><input type="text" class="regular-text" placeholder="www.google.com" name="wew_child_url" value="<?php echo esc_attr(  get_post_meta($post->ID, "wew_child_url", true) ); ?>" /></td>
                        </tr>

                        <tr valign="top">
                        <th scope="row"><?php _e("Sito cliente Consumer Key", "wew"); ?></th>
                        <td>
                            <input type="text" class="regular-text" placeholder="ck_32k43k34k43" name="wew_child_consumer_key" value="<?php echo esc_attr( get_post_meta($post->ID, "wew_child_consumer_key", true) ); ?>" />
                            <p class="description" id="home-description">
                                <?php 
                                _e("Puoi ottenere le chiavi qui: ");
                                if(get_post_meta($post->ID, "wew_child_url", true)){
                                    $url = get_post_meta($post->ID, "wew_child_url", true);
                                    echo "<a href='".$url."/wp-admin/admin.php?page=wc-settings&tab=advanced&section=keys&create-key=1' target='_blank'>".$url."/wp-admin/admin.php?page=wc-settings&tab=advanced&section=keys&create-key=1</a>";
                                }else{
                                    $url = "www.example.com";
                                    echo "<a href='".$url."/wp-admin/admin.php?page=wc-settings&tab=advanced&section=keys&create-key=1' target='_blank'>".$url."/wp-admin/admin.php?page=wc-settings&tab=advanced&section=keys&create-key=1</a>";
                                }
                                ?></p>
                        </td>
                        </tr>                

                        <tr valign="top">
                        <th scope="row"><?php _e("Sito cliente Consumer Secret", "wew"); ?></th>
                        <td><input type="text" class="regular-text" placeholder="cs_32k43k34k43" name="wew_child_consumer_secret" value="<?php echo esc_attr( get_post_meta($post->ID, "wew_child_consumer_secret", true) ); ?>" /></td>
                        </tr>                  
                    </table>
                </div>
                <?php 

        }
    }
endif;