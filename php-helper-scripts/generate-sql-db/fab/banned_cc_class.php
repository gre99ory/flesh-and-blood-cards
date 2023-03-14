<?php

require_once('entity_class.php');

class banned_cc extends entity {

    static protected $table_name = 'banned_cc';
    static protected $json_name = 'banned-cc';

    static protected $fields = [
        'unique_id' => [ 
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL   => true, 
            entity::IS_PRIMARY => true ],
        'card_unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL => true,
            entity::IS_FOREIGN => 'cards ( unique_id )'],
        'status_active' => [
            entity::FIELD_TYPE => db_type::BOOLEAN ],    
        'date_announced' => [
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'date_in_effect' => [
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'legality_article' => [
            entity::FIELD_TYPE => db_type::VC1000 ],
    ];
}
