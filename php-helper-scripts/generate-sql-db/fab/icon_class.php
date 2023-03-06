<?php

require_once('entity_class.php');

class icon extends entity {
    static protected $table_name = 'icons';
    static protected $json_name = 'icon';

    static protected $fields = [
        'icon' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::IS_PRIMARY => true ],
        'description' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL  => true ],
        ];
}


/*
def insert(cur, icon, description):
    sql = """INSERT INTO icons(icon, description)
             VALUES(%s, %s) RETURNING icon;"""
    data = (icon, description)

    try:
        print("Inserting {} icon...".format(icon))

        # execute the INSERT statement
        cur.execute(sql, data)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        exit()

def generate_table_data(cur):
    print("Filling out icons table from icon.json...\n")

    path = Path(__file__).parent / "../../../json/english/icon.json"
    with path.open(newline='') as jsonfile:
        icon_array = json.load(jsonfile)

        for icon_entry in icon_array:
            icon = icon_entry['icon']
            description = icon_entry['description']

            insert(cur, icon, description)

        print("\nSuccessfully filled icons table\n")
        */