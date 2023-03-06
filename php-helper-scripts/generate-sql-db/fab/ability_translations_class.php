<?php

require_once('entity_class.php');

class ability_translations extends entity {
    static protected $table_name = 'ability_translations';
    static protected $json_name = 'ability';


    static protected $fields = [
        'ability_unique_id' => [ 
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL  => true, 
            entity::IS_PRIMARY => true,
            entity::IS_FOREIGN => 'abilities (unique_id)' ],
        'language' => [
            entity::FIELD_TYPE => db_type::VC10,
            entity::NOT_NULL  => true,    
            entity::IS_PRIMARY => true ], 
        'name' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL  => true ],    
    ];

    // 
    static protected function handle_record($record,$language)
    {
        return [
            'ability_unique_id' => $record['unique_id'],
            'language'          => $language,
            'name'              => $record['name'],
        ];
    }

}
