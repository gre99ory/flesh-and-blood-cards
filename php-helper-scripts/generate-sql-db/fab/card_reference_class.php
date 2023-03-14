<?php

require_once('entity_class.php');

class card_reference extends entity {

    static protected $table_name = 'card_reference';
    static protected $json_name = 'card-reference';

    static protected $fields = [
        'card_unique_id' => [ 
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL => true,
            entity::IS_FOREIGN => 'cards ( unique_id )'],
        'referenced_card_unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL => true,
            entity::IS_FOREIGN => 'cards ( unique_id )'],
    ];
}
