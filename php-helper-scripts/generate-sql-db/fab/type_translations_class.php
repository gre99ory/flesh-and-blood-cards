<?php

require_once('entity_class.php');

class type_translations extends entity {
    static protected $table_name = 'type_translations';
    static protected $json_name = 'type';

    static protected $fields = [
        'type_unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL  => true,
            entity::IS_PRIMARY => true,
            entity::IS_FOREIGN => 'types ( unique_id )' ],
        'language' => [
            entity::FIELD_TYPE => db_type::VC10,
            entity::NOT_NULL  => true,
            entity::IS_PRIMARY => true ],
        'name' => [
            entity::FIELD_TYPE => db_type::VC255 ]
        ];


    static protected function handle_record($record,$language)
    {
        $record['type_unique_id'] = $record['unique_id'];
        unset( $record['unique_id'] );
        $record['language'] = $language;

        return $record;
    }
}


/*
def insert(cur, type_unique_id, language, name):
    sql = """INSERT INTO type_translations(type_unique_id, language, name)
             VALUES(%s, %s, %s) RETURNING name;"""
    data = (type_unique_id, language, name)

    try:
        print("Inserting {0} translation for type {1} ({2})...".format(
            language,
            type_unique_id,
            name
        ))

        # execute the INSERT statement
        cur.execute(sql, data)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        exit()

def generate_table_data(cur, language):
    print(f"Filling out type_translations table from {language} type.json...\n")

    path = Path(__file__).parent / f"../../../json/{language}/type.json"
    with path.open(newline='') as jsonfile:
        type_array = json.load(jsonfile)

        for type_entry in type_array:
            unique_id = type_entry['unique_id']
            name = type_entry['name']

            insert(cur, unique_id, language, name)

        print(f"\nSuccessfully filled type_translations table with {language} data\n")
        */