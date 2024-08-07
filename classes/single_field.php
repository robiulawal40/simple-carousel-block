<?php
if( ! class_exists('ALPB_Single_Field') ):
class ALPB_Single_Field {

    public $field_name;

    public function __construct() {
        $this->field_name= "_first_name";
    }

    public function set_field_name($name){
        $this->field_name = $name;
        return $this;
    }

    public function get_default(){
        return [
            "label" => "First name",
        ];
    }

    public function get_field_setting(){
       return get_option("_ALPB".$this->field_name, false);
    }

    public function set_field_setting($settings){
        $new_settings = array_merge( $this->get_default() , $settings);
        update_option("_ALPB".$this->field_name, $new_settings);
    }

}
endif;