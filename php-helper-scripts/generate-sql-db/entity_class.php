<?php
/* Abstract db enitity class Wrapper */

require_once('db_class.php');
require_once('db_type_class.php');

abstract class entity {

    const FIELD_TYPE = 'type';
    // const EXTRA = 'extra';
    const IS_PRIMARY = 'is_primary';
    const IS_FOREIGN = 'is_foreign';
    const IS_ARRAY = 'is_array';
    const COLLATE = 'collate'; 
    const DEFAULT = 'default'; 
    const NULL = 'null';
    const NOT_NULL = 'not_null';

    static protected $table_name = null;
    static protected $json_name  = null;
    static protected $fields     = null;

    static public function create_table()
    {
        $sql = "CREATE TABLE `".static::_table_name()."` ( ".
            static::_fields_definitions();
        $keys = static::_keys_definitions();
        
        if ( isset($keys[entity::IS_PRIMARY]) )
            $sql .= ", ".$keys[entity::IS_PRIMARY];
            
        if ( isset($keys[entity::IS_FOREIGN]) )
            $sql .= ", ".$keys[entity::IS_FOREIGN];

        $sql .= ")";

        print("Creating ".static::_table_name()." table...\n");

        print("{$sql}\n");

        DB::execute($sql);
    }

    static public function drop_table()
    {
        $sql = "DROP TABLE IF EXISTS `".static::_table_name()."`";
        
        print("Dropping ".static::_table_name()." table...\n");

        DB::execute($sql);
    }


    static public function generate_table_data($language='english')
    {
        if ( static::$json_name === null ) static::$json_name = static::_table_name();

        print("Filling out ".static::_table_name()." table from {$language}/".static::$json_name.".json...\n");        
        $path = __DIR__ ."/../../json/{$language}/".static::$json_name.".json";

        $jsonfile = file_get_contents( $path );

        $record_array = json_decode( $jsonfile, true );
        foreach ( $record_array as $record )
        {
            if ( method_exists( static::class, 'handle_record' )) 
            {
                $record = static::handle_record( $record, $language );
            }
            if ( method_exists( static::class, 'exists_record' )) 
            {
                if ( static::exists_record( $record ) ) continue;
            }
            static::insert( $record );
        }

        print("Successfully filled ".static::_table_name()." table\n\n");
    }

    static public function insert($record)
    {        
        $field_list = [];
        $place_list = [];
        $param_list = [];

        foreach ( static::$fields as $field => $props )
        {
            if ( DEBUG::on() ) echo "Checking $field => ";

            if ( !isset( $record[$field] )) continue;

            if ( DEBUG::on() ) echo " ok\n";

            if ( isset( $props[entity::IS_ARRAY])) 
            {
                // die('IS ARRAY:'.print_r( $record[$field], true ));
                $value = json_encode($record[$field]);
            }
            else
            {
                $value = $record[$field];
            }

            $field_list[] = "`{$field}`";
            $place_list[] = ":{$field}";
            $param_list[":{$field}"] = $value;
        }

        

        $sql = "INSERT INTO `".static::_table_name()."` ( ". 
                implode( ',', $field_list ).
               " ) VALUES ( ".
                implode( ',', $place_list ).
               " ) ";
        DB::execute( $sql, $param_list );
    }

    /**
     *  PROTECTED
     */
    static protected function _prefix()
    {
        global $database_prefix;
        if ( $database_prefix ) return $database_prefix.'_';
        return '';
    }

    static protected function _table_name()
    {
        return static::_prefix().static::$table_name;
    }

    /**
     *  PRIVATE
     */
    static private function _fields_definitions()
    {
        $definitions = [];
        foreach ( static::$fields as $field => $props )
        {
            // Name and Type
                // Mysql uses JSON column type to store arrays
            if ( isset( $props[entity::IS_ARRAY]))
                $definition = "`{$field}` ".db_type::JSON;
            else
                $definition = "`{$field}` ".$props[entity::FIELD_TYPE];

            // NULL
            if ( isset($props[entity::NULL]) && $props[entity::NULL]) 
                $definition .= " ".db_type::NULL;
            // NOT NULL
            if ( isset($props[entity::NOT_NULL]) && $props[entity::NOT_NULL]) 
                $definition .= " ".db_type::NOT_NULL;

            // DEFAULT
            if ( isset( $props[entity::DEFAULT] )) 
                $definition .= " DEFAULT ".$props[entity::DEFAULT];

            $definitions[] = $definition;
        }

        return implode( ', ', $definitions );
    }


    static private function _keys_definitions()
    {
        $primaries = [];
        $foreigns  = [];

        foreach ( static::$fields as $field => $props )
        {
            if ( isset( $props[entity::IS_PRIMARY] ) && $props[entity::IS_PRIMARY] ) 
                $primaries[] = "`{$field}`";
            
            if ( isset( $props[entity::IS_FOREIGN] ) && $props[entity::IS_FOREIGN] ) 
                $foreigns[] = "FOREIGN KEY ( `{$field}` ) ".
                              "REFERENCES ".static::_prefix().$props[entity::IS_FOREIGN];
        }

        if ( count( $primaries))
            $primary = "PRIMARY KEY ( ".implode( ', ', $primaries ).") ";
        else
            $primary = null;

        if ( count($foreigns))
            $foreign = implode( ', ', $foreigns );
        else
            $foreign = null;

        return [ 
            entity::IS_PRIMARY => $primary,
            entity::IS_FOREIGN => $foreign ];
    }
    
}
