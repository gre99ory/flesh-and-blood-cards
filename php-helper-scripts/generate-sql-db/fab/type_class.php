<?php

require_once('entity_class.php');

class type extends entity {
    static protected $table_name = 'types';
    static protected $json_name = 'type';

    // UNIQUE (unique_id, id)

    static protected $fields = [
        'unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL  => true,
            entity::IS_PRIMARY => true ],
        'name' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL  => true ]
        ];
}

/*
def insert(cur, unique_id, name):
    sql = """INSERT INTO types(unique_id, name)
        VALUES(%s, %s) RETURNING name;"""
    data = (unique_id, name)
    try:
        print("Inserting {} type...".format(name))

        # execute the INSERT statement
        cur.execute(sql, data)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        exit()

def generate_table_data(cur):
    print("Filling out types table from type.json...\n")

    path = Path(__file__).parent / "../../../json/english/type.json"
    with path.open(newline='') as jsonfile:
        type_array = json.load(jsonfile)

        for type in type_array:
            unique_id = type['unique_id']
            name = type['name']

            insert(cur, unique_id, name)

        print("\nSuccessfully filled types table\n")

        */