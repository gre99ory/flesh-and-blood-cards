<?php

require_once('entity_class.php');

class set_edition extends entity {
    static protected $table_name = 'set_editions';
    static protected $json_name = 'set';

    // UNIQUE (set_unique_id, language, edition)

    static protected $fields = [
        'unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL  => true ,
            entity::IS_PRIMARY => true ],
        'set_unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL  => true ,
            entity::IS_FOREIGN => "sets ( unique_id )" ],
        'language' => [
            entity::FIELD_TYPE => db_type::VC10,
            entity::NOT_NULL  => true ],
        'edition' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL  => true ],
        'initial_release_date' => [
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'out_of_print_date' => [
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'product_page' => [
            entity::FIELD_TYPE => db_type::VC1000 ],
        'collectors_center' => [
            entity::FIELD_TYPE => db_type::VC1000 ],
        'card_gallery' => [
            entity::FIELD_TYPE => db_type::VC1000 ],
        ];

        static public function generate_table_data($language='english')
        {
            print("Filling out ".static::_table_name()." table from ".static::$json_name.".json...\n");        
            $path = __DIR__ ."/../../../json/{$language}/".static::$json_name.".json";

            $jsonfile = file_get_contents( $path );

            $record_array = json_decode( $jsonfile, true );
            foreach ( $record_array as $record )
            {
                // $record['set_unique_id'] = $record['unique_id'];

                foreach ( $record['editions'] as $edition )
                {
                    $edition['set_unique_id'] = $record['unique_id'];

                        // unique_id = edition_entry['unique_id']
                        // edition = edition_entry['edition']
                        // initial_release_date = edition_entry['initial_release_date'] #.lower().replace("null", "infinity") # Uses infinity instead of null because some parsers break parsing timestamp arrays with null
                        // out_of_print_date = edition_entry['out_of_print_date'] #.lower().replace("null", "infinity") # Uses infinity instead of null because some parsers break parsing timestamp arrays with null
                        // product_page = edition_entry['product_page']
                        // collectors_center = edition_entry['collectors_center']
                        // card_gallery = edition_entry['card_gallery']
        
                        // insert(cur, unique_id, set_unique_id, language, edition, initial_release_date, out_of_print_date, product_page, collectors_center, card_gallery)
                    static::insert( $edition );
                }
            }
            print("\nSuccessfully filled ".static::_table_name()." table\n");
        }
}

/*
def insert(cur, unique_id, set_unique_id, language, edition, initial_release_date, out_of_print_date, product_page, collectors_center, card_gallery):
    sql = """INSERT INTO set_editions(unique_id, set_unique_id, language, edition, initial_release_date, out_of_print_date, product_page, collectors_center, card_gallery)
             VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s);"""
    data = (unique_id, set_unique_id, language, edition, initial_release_date, out_of_print_date, product_page, collectors_center, card_gallery)

    try:
        print("Inserting {0} printing for {1} set {2}...".format(
            edition,
            language,
            unique_id
        ))

        # execute the INSERT statement
        cur.execute(sql, data)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        exit()

def generate_table_data(cur, language):
    print(f"Filling out set_editions table from {language} set.json...\n")

    path = Path(__file__).parent / f"../../../json/{language}/set.json"
    with path.open(newline='') as jsonfile:
        set_array = json.load(jsonfile)

        for set in set_array:
            set_unique_id = set['unique_id']

            for edition_entry in set['editions']:
                unique_id = edition_entry['unique_id']
                edition = edition_entry['edition']
                initial_release_date = edition_entry['initial_release_date'] #.lower().replace("null", "infinity") # Uses infinity instead of null because some parsers break parsing timestamp arrays with null
                out_of_print_date = edition_entry['out_of_print_date'] #.lower().replace("null", "infinity") # Uses infinity instead of null because some parsers break parsing timestamp arrays with null
                product_page = edition_entry['product_page']
                collectors_center = edition_entry['collectors_center']
                card_gallery = edition_entry['card_gallery']

                insert(cur, unique_id, set_unique_id, language, edition, initial_release_date, out_of_print_date, product_page, collectors_center, card_gallery)

        print("\nSuccessfully filled set_editions table\n")
        */