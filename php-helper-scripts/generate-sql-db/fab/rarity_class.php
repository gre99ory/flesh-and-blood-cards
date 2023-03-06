<?php

require_once('entity_class.php');

class rarity extends entity {
    static protected $table_name = 'rarities';
    static protected $json_name = 'rarity';

    static protected $fields = [
        'id' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::IS_PRIMARY => true ],
        'description' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL  => true ],
        ];
}

/*
def insert(cur, id, description):
    sql = """INSERT INTO rarities(id, description)
             VALUES(%s, %s) RETURNING id;"""
    data = (id, description)

    try:
        print("Inserting {} rarity...".format(id))

        # execute the INSERT statement
        cur.execute(sql, data)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        exit()

def generate_table_data(cur):
    print("Filling out rarities table from rarity.json...\n")

    path = Path(__file__).parent / "../../../json/english/rarity.json"
    with path.open(newline='') as jsonfile:
        rarity_array = json.load(jsonfile)

        for rarity in rarity_array:
            id = rarity['id']
            description = rarity['description']

            insert(cur, id, description)

        print("\nSuccessfully filled rarities table\n")
        */