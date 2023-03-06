<?php

require_once('entity_class.php');

class foiling extends entity {
    static protected $table_name = 'foilings';
    static protected $json_name = 'foiling';

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
    sql = """INSERT INTO foilings(id, name)
             VALUES(%s, %s) RETURNING id;"""
    data = (id, name)

    try:
        print("Inserting {} foiling...".format(id))

        # execute the INSERT statement
        cur.execute(sql, data)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        exit()

def generate_table_data(cur):
    print("Filling out foilings table from foiling.json...\n")

    path = Path(__file__).parent / "../../../json/english/foiling.json"
    with path.open(newline='') as jsonfile:
        foiling_array = json.load(jsonfile)

        for foiling in foiling_array:
            id = foiling['id']
            name = foiling['name']

            insert(cur, id, name)

        print("\nSuccessfully filled foilings table\n")
        */