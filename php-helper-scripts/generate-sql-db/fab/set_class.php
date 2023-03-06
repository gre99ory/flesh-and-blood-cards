<?php

require_once('entity_class.php');

class set extends entity {
    static protected $table_name = 'sets';
    static protected $json_name = 'set';

    // UNIQUE (unique_id, id)

    static protected $fields = [
        'unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL  => true,
            entity::IS_PRIMARY => true ],
        'id' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL  => true,
            entity::IS_PRIMARY => true ],
        'name' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL  => true ],
        'start_card_id' => [
            entity::FIELD_TYPE => db_type::VC15,
            entity::NOT_NULL  => true ],
        'end_card_id' => [
            entity::FIELD_TYPE => db_type::VC15,
            entity::NOT_NULL  => true ],
        ];

    static protected function exists_record( $record )
    {
        $row = DB::fetchRow( 
            "SELECT unique_id, start_card_id, end_card_id FROM ".static::_prefix()."sets WHERE unique_id = :unique_id",
            [ ':unique_id' => $record['unique_id'] ]
        );
        if ( !$row ) return false;
        
        if ( $row['start_card_id'] != $record['start_card_id'] 
            ||
            $row['end_card_id'] != $record['end_card_id'] )            
            die("There was a mismatch of card id start/end numbers for ".
                "set with unique_id {$record['unique_id']}: ".
                "{$row['start_card_id']}/{$row['end_card_id']} vs ".
                "{$record['start_card_id']}/{$record['end_card_id']}");

        return true;
    }
}


/*
def insert(cur, unique_id, id, name, start_card_id, end_card_id):
    def check_if_set_exists():
        select_sql = """SELECT unique_id, start_card_id, end_card_id FROM sets WHERE unique_id = %s;"""
        select_data = (unique_id,)

        try:
            cur.execute(select_sql, select_data)
            selected_data = cur.fetchone()

            if selected_data is not None:
                # Verify there weren't data entry issues with the card ids across languages
                if selected_data[1] != start_card_id or selected_data[2] != end_card_id:
                    raise Exception(f"There was a mismatch of card id start/end numbers for set with unique_id {unique_id}: {selected_data[1]}/{selected_data[2]} vs {start_card_id}/{end_card_id}")

                return True

            return False
        except (Exception, psycopg2.DatabaseError) as error:
            print(error)
            exit()

    if check_if_set_exists():
        print(f"Set {id} with unique_id {unique_id} already exists, skipping")
        return

    sql = """INSERT INTO sets(unique_id, id, name, start_card_id, end_card_id)
             VALUES(%s, %s, %s, %s, %s);"""
    data = (unique_id, id, name, start_card_id, end_card_id)

    try:
        print("Inserting {} set with unique ID {}...".format(id, unique_id))

        # execute the INSERT statement
        cur.execute(sql, data)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        exit()

def generate_table_data(cur, language):
    print(f"Filling out sets table from {language} set.json...\n")

    path = Path(__file__).parent / f"../../../json/{language}/set.json"
    with path.open(newline='') as jsonfile:
        set_array = json.load(jsonfile)

        for set in set_array:
            unique_id = set['unique_id']
            id = set['id']
            name = set['name']
            start_card_id = set['start_card_id']
            end_card_id = set['end_card_id']

            insert(cur, unique_id, id, name, start_card_id, end_card_id)

        print(f"\nSuccessfully filled sets table with {language} data\n")
        */