<?php

require_once('entity_class.php');

class keyword extends entity {
    static protected $table_name = 'keywords';
    static protected $json_name = 'keyword';

    // unique name

    static protected $fields = [
        'unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL  => true,
            entity::IS_PRIMARY => true ],
        'name' => [
            entity::FIELD_TYPE => db_type::VC255 ],
        'description' => [
            entity::FIELD_TYPE => db_type::VC1000,
            entity::NOT_NULL  => true ],
        ];
}


/*
def insert(cur, unique_id, name, description):
    sql = """INSERT INTO keywords(unique_id, name, description)
             VALUES(%s, %s, %s) RETURNING name;"""
    data = (unique_id, name, description)

    try:
        print("Inserting {} keyword...".format(name))

        # execute the INSERT statement
        cur.execute(sql, data)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        exit()

def generate_table_data(cur):
    print("Filling out keywords table from english keyword.json...\n")

    path = Path(__file__).parent / "../../../json/english/keyword.json"
    with path.open(newline='') as jsonfile:
        keyword_array = json.load(jsonfile)

        for keyword_entry in keyword_array:
            unique_id = keyword_entry['unique_id']
            name = keyword_entry['name']
            description = keyword_entry['description']

            insert(cur, unique_id, name, description)

        print("\nSuccessfully filled keywords table\n")

        */

        