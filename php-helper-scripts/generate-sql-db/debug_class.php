<?php 

class DEBUG {

    static private $state = 'off';

    static public function on() {
        return ( static::$state == 'on' );        
    }
    static public function off() {
        return ( static::$state == 'off' );        
    }

    static public function set_on() {
        static::$state = 'on';        
        return true;        
    }

    static public function set_off() {
        static::$state = 'off';        
        return false;        
    }
}