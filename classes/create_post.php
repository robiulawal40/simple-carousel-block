<?php 
if( !class_exists('ALPB_Create_Post') ):

    class ALPB_Create_Post{

        public function __construct()
        {
            global $alpb_error;
            $this->error = $alpb_error;
        }

        public function set_data($data){
            // Gather post data.
            $this->my_post = array(
                'post_title'    => $data['D11']." - ".$data['D13'],
                'post_content'  => '',
                'post_status'   => 'publish',
                'post_type'     => 'prediction',
                'meta_input'   => array(
                    'prediction_date' => str_replace("/", "-",  $data['D9']),
                    'prediction_time'      =>  $data['D10'],
                    'prediction_teama'     =>  $data['D11'],
                    'prediction_teamaicon' =>  $data['D12'],
                    'prediction_teamb'     =>  $data['D13'],
                    'prediction_teambicon' =>  $data['D14'],
                    'prediction_homewin'   =>  $data['D15'],
                    'prediction_equality' =>  $data['D16'],
                    'prediction_awaywin' =>  $data['D17'],
                    'prediction_homednb' =>  $data['D18'],
                    'prediction_awaydnb' =>  $data['D19'],
                    'prediction_homeyes' =>  $data['D20'],
                    'prediction_awayno' =>  $data['D21'],
                    'prediction_ponefive' =>  $data['D22'],
                    'prediction_nonefive' =>  $data['D23'],
                    'prediction_ptwofive' =>  $data['D24'],
                    'prediction_ntwofive' =>  $data['D25'],
                    'prediction_pthreefive' =>  $data['D26'],
                    'prediction_nthreefive' =>  $data['D27'],
                    'prediction_scoreone' =>  $data['D28'],
                    'prediction_scoretwo' =>  $data['D29'],
                    'prediction_ultrasafeavis' =>  $data['D30'],
                    'prediction_country' =>  $data['D31'],
                    'prediction_league' =>  $data['D32'],
                    'prediction_marques1' =>  $data['D33'],
                    'prediction_concedes1' =>  $data['D34'],
                    'prediction_gagne1' =>  $data['D35'],
                    'prediction_nul1' =>  $data['D36'],
                    'prediction_perdu1' =>  $data['D37'],
                    'prediction_rlt_p151' =>  $data['D38'],
                    'prediction_rlt_p251' =>  $data['D39'],
                    'prediction_rlt_p351' =>  $data['D40'],
                    'prediction_marques2' =>  $data['D41'],
                    'prediction_concedes2' =>  $data['D42'],
                    'prediction_gagne2' =>  $data['D43'],
                    'prediction_nul2' =>  $data['D44'],
                    'prediction_perdu2' =>  $data['D45'],
                    'prediction_rlt_p152' =>  $data['D46'],
                    'prediction_rlt_p252' =>  $data['D47'],
                    'prediction_rlt_p352' =>  $data['D48'],
                    'prediction_avissafe1' =>  $data['D49'],
                    'prediction_avissafe2' =>  $data['D50'],
                    'prediction_avissafe3' =>  $data['D51'],
                    'alpb_a' =>  get_option('alpb_a'),
                    'alpb_x' =>  get_option('alpb_x'),
                    'alpb_b' =>  get_option('alpb_b'),
                ),
            );
                       
            return $this;
        }

        
        public function set_hockey_data($data){
            // Gather post data.

            // $alpb_team_a = get_option('alpb_hockey_team_a');
            // $alpb_team_b = get_option('alpb_hockey_team_b');

            $this->my_post = array(
                'post_title'    =>$data['D11']." - ".$data['D13'],
                'post_content'  => '',
                'post_status'   => 'publish',
                'post_type'     => 'bprediction',
                'meta_input'   => array(
                    'bprediction_date' => str_replace("/", "-",  $data['D9']),
                    'bprediction_time'      =>  $data['D10'],
                    'bprediction_teama'     =>  $data['D11'],
                    'bprediction_teamaicon' =>  $data['D12'],
                    'bprediction_teamb'     =>  $data['D13'],
                    'bprediction_teambicon' =>  $data['D14'],
                    'bprediction_homewin'   =>  $data['D15'], 
                    'bprediction_awaywin' =>  $data['D16'],
                    'bprediction_homeyes' =>  $data['D17'], 
                    'bprediction_awayno' =>  $data['D18'],
                    'bprediction_ponefive' =>  $data['D19'],
                    'bprediction_nonefive' =>  $data['D20'],
                    'bprediction_ptwofive' =>  $data['D21'],
                    'bprediction_ntwofive' =>  $data['D22'],
                    'bprediction_pthreefive' =>  $data['D23'],
                    'bprediction_nthreefive' =>  $data['D24'],
                    'bprediction_ultrasafeavis' =>  $data['D25'], 
                    'bprediction_country' =>  $data['D26'],
                    'bprediction_league' =>  $data['D27']
                ),
            );
                       
            return $this;
        }

        public function submit(){
            $post_id = wp_insert_post( $this->my_post );
            if(!is_wp_error($post_id)){
                $this->post_id = $post_id;
                return true;
            }else{
                $this->error->add( $post_id->get_error_message() );
            }
            return false;
        }

        public function get_post_id(){
            return  $this->post_id;
        }
    }
endif;