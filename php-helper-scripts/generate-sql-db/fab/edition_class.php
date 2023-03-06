<?php

require_once('entity_class.php');

class edition extends entity {
    static protected $table_name = 'editions';
    static protected $json_name = 'edition';

    static protected $fields = [
        'id' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::IS_PRIMARY => true ],
        'name' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL  => true ],
        ];
}


/*
def insert(cur, id, name):
    sql = """INSERT INTO editions(id, name)
             VALUES(%s, %s) RETURNING id;"""
    data = (id, name)

    try:
        print("Inserting {} edition...".format(id))
        # execute the INSERT statement
        cur.execute(sql, data)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        exit()

def generate_table_data(cur):
    print("Filling out editions table from edition.json...\n")

    path = Path(__file__).parent / "../../../json/english/edition.json"
    with path.open(newline='') as jsonfile:
        edition_array = json.load(jsonfile)

        for edition in edition_array:
            id = edition['id']
            name = edition['name']

            insert(cur, id, name)

        print("\nSuccessfully filled editions table\n")
        */