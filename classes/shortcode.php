<?php 

if( !class_exists('ALPB_Shortcode') ):

    class ALPB_Shortcode{
        function __construct() {    
            
            add_shortcode( 'display_score', array($this, 'shortcode') );
        }

        public function get_args(){
            $td_date = date('Y-m-d' , current_time( 'timestamp', 0));
            $yt_data = date('Y-m-d', strtotime($td_date.' -1days') );
    
            //echo $yt_data;
    
            
            $args = array(
                'post_type'=> 'score',
                'post_status' => 'publish',
                'orderby'   => 'meta_value',
                'meta_key'  => 'eih_score_date',
                'posts_per_page' => -1,
                'order'   => 'ASC'
            );
            
            return $args;
        }

        public function prepare_list(){
            ob_start();
            wp_reset_postdata();
            $result = new WP_Query($this->get_args()); 
            if ( $result->posts ) {
                foreach($result->posts as $key => $post_obj) {
                    $id = $post_obj->ID;
                    $eih_score_date  = get_post_meta( $id, 'eih_score_date', true );
                    $eih_team_a_name  = get_post_meta( $id, 'eih_team_a_name', true );
                    $eih_team_b_name  = get_post_meta( $id, 'eih_team_b_name', true );
                    $eih_score  = get_post_meta( $id, 'eih_score', true );
                    $eih_odds  = get_post_meta( $id, 'eih_odds', true );
                    $_date = explode("-",$eih_score_date);
                    // echo "<pre>";
                        //  print_r($eih_score_date);
                        //  echo "<br>";
                        //  print_r(date('Y-m-d', current_time("timestamp")));
                        //  print_r( date("Y-m-d", strtotime($eih_score_date)) );
                        //  print_r( date_i18n("F", strtotime($eih_score_date)) );

                         // echo [2];
                         // exit;
                         if( date("Y-m-d", strtotime($eih_score_date)) == date('Y-m-d', current_time("timestamp")) ){
                             $this->custom_start = $key;
                            //  echo "custome Start:".$this->custom_start;
                            }
                            // echo "</pre>";
                    
                    ?>
                    <li class="splide__slide">
                        <div class="single_score">
                            <div class="sc_head">
                                <p>Match Simple</p>
                            </div>
                            <div class="sc_body">
                                <div class="sc_body_left">
                                    <div class="sc_content">
                                        <h4><?php echo $eih_team_a_name; ?> - <?php echo $eih_team_b_name; ?></h4>
                                        <p>Score exact:<?php echo $eih_score; ?> </p>
                                    </div>
                                </div>
                                <div class="sc_body_right">
                                        <div class="calender">
                                            <div class="ca_month"><?php echo date_i18n("F", strtotime($eih_score_date)); ?></div>
                                            <div class="ca_date"><?php echo date("d", strtotime($eih_score_date));; ?></div>
                                        </div>
                                </div>
                            </div>
                            <div class="sc_foot">
                                <div class="sc_foot_left">Prediction Validee</div>
                                <div class="sc_foot_right">Cote:<?php echo $eih_odds; ?>&nbsp;  <i class="fas fa-check-circle"></i></div>
                            </div>
                        </div>
                    </li>
                    <?php 
                }
            }
            wp_reset_postdata();
            $contents = ob_get_clean();
            return $contents;
        }

        public function shortcode() {
            // $this->get_scores();
            ob_start();
            $lists = $this->prepare_list();

            ?>
        <div class="carousal_content">
        <div class="splide" data-splide='{"customStart":<?php echo $this->custom_start ?>}'>

        <div class="splide__arrows">
            <button class="splide__arrow splide__arrow--prev" type="button"
                aria-label="Go to last slide" aria-controls="rewind-speed-example-track">
                <svg
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40">
                    <path d="m13.5 7.01 13 13m-13 13 13-13"></path>
                </svg>
            </button>
            <button class="splide__arrow splide__arrow--next" type="button" aria-label="Next slide"
                aria-controls="rewind-speed-example-track"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40"
                    width="40" height="40">
                    <path d="m13.5 7.01 13 13m-13 13 13-13"></path>
                </svg>
            </button>
        </div>

        <div class="splide__track">
                <ul class="splide__list">
                    <?php echo $lists ?>
                </ul>
        </div>
        </div>
        </div>
        <?php
		$contents = ob_get_clean();
		return $contents;
        }
    }
endif;
