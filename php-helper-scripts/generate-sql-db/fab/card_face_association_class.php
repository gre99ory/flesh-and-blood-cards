<?php

require_once('entity_class.php');

class card_face_association extends entity {

    static protected $table_name = 'card_face_association';
    static protected $json_name = 'card-face-association';

    static protected $fields = [
        'front_unique_id' => [ 
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL => true,
            entity::IS_FOREIGN => 'cards ( unique_id )'],
        'back_unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL => true,
            entity::IS_FOREIGN => 'cards ( unique_id )'],
        'is_DFC' => [
            entity::FIELD_TYPE => db_type::BOOLEAN ],    
    ];
}
