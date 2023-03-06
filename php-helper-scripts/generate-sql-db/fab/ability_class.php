<?php

require_once('entity_class.php');

class ability extends entity {

    static protected $table_name = 'abilities';
    static protected $json_name = 'ability';


    static protected $fields = [
        'unique_id' => [ 
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL   => true, 
            entity::IS_PRIMARY => true ],
        'name' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL   => true ],    
    ];
}
