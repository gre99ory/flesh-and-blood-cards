<?php

require_once('entity_class.php');

class card_printing extends entity {
    static protected $table_name = 'card_printings';
    static protected $json_name = 'card';

    // UNIQUE (unique_id, card_id, edition, art_variation)

    static protected $fields = [
        'unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL => true,
            entity::IS_PRIMARY => true ],
        'card_unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL => true,
            entity::IS_FOREIGN => 'cards ( unique_id )'],
        'set_edition_unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL => true,
            entity::IS_FOREIGN => 'set_editions ( unique_id )'],
        'card_id' => [
            entity::FIELD_TYPE => db_type::VC15,
            entity::NOT_NULL => true,
            entity::COLLATE => db_type::NUMERIC ],
        'set_id' => [
            entity::FIELD_TYPE => db_type::VC15,
            entity::NOT_NULL => true,
            entity::COLLATE => db_type::NUMERIC ],
        'edition' => [
            entity::FIELD_TYPE => db_type::VC15,
            entity::NOT_NULL => true ],
        'foilings' => [
            entity::FIELD_TYPE => db_type::VC15, //[]
            entity::IS_ARRAY   => true,
            entity::NOT_NULL   => true ],
        'rarity' => [
            entity::FIELD_TYPE => db_type::VC15,
            entity::NOT_NULL => true ],
        'artist' => [
            entity::FIELD_TYPE => db_type::VC1000,
            entity::NOT_NULL => true ],
        'art_variation' => [
            entity::FIELD_TYPE => db_type::VC15,
            entity::NOT_NULL => true ],
        'image_url' => [
            entity::FIELD_TYPE => db_type::VC1000,
            entity::NOT_NULL => true ]
        ];

    static public function generate_table_data($language='english',$url_for_images = null)
    {
        print("Filling out ".static::_table_name()." table from ".static::$json_name.".json...\n");        
        $path = __DIR__ ."/../../../json/{$language}/".static::$json_name.".json";

        $jsonfile = file_get_contents( $path );

        $record_array = json_decode( $jsonfile, true );
        foreach ( $record_array as $record )
        {
            // $record['card_unique_id'] = $record['unique_id'];
            
            foreach ( $record['printings'] as $printing )
            {
                $printing['card_unique_id'] = $record['unique_id'];

                // unique_id = printing['unique_id']
                // set_edition_unique_id = printing['set_edition_unique_id']
                // card_id = printing['id']
                $printing['card_id'] = $printing['id'];
                // set_id = printing['set_id']
                // edition = printing['edition']
                // foilings = printing['foilings']
                // rarity = printing['rarity']
                // artist = printing['artist']
                // art_variation = printing['art_variation']
                // image_url = printing['image_url']
        
                /*
                        if url_for_images is not None and image_url is not None:
                            image_url = image_url.replace("https://storage.googleapis.com/fabmaster/media/images/", url_for_images)
                            image_url = image_url.replace("https://storage.googleapis.com/fabmaster/cardfaces/", url_for_images)
        
                        if art_variation is None:
                            art_variation = ""
                        if image_url is None:
                            image_url = ""
        
                            insert(cur, unique_id, card_unique_id, set_edition_unique_id, card_id, set_id, edition, foilings, rarity, artist, art_variation, image_url)
                            */
                static::insert( $printing );
            }
        }
        print("\nSuccessfully filled ".static::_table_name()." table\n");
    }
        
}


/*
def insert(cur, unique_id, card_unique_id, set_edition_unique_id, card_id, set_id, edition, foilings, rarity, artist, art_variation, image_url):
    sql = """INSERT INTO card_printings(unique_id, card_unique_id, set_edition_unique_id, card_id, set_id, edition, foilings, rarity, artist, art_variation, image_url)
            VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);"""
    data = (unique_id, card_unique_id, set_edition_unique_id, card_id, set_id, edition, foilings, rarity, artist, art_variation, image_url)

    try:
        print("Inserting {0} - {1} - {2} printing for card {3} ({4})...".format(
            edition,
            rarity,
            art_variation if art_variation != '' else 'null',
            card_id,
            card_unique_id
        ))

        # execute the INSERT statement
        cur.execute(sql, data)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        exit()
        raise error

def treat_blank_string_as_boolean(field, value=True):
    if field == '':
        return value

    return field

def treat_blank_string_as_none(field):
    if field == '':
        return 'NULL'

    return "'" + field + "'"

def generate_table_data(cur, url_for_images = None):
    print("Filling out card_printings table from english card.json...\n")

    path = Path(__file__).parent / "../../../json/english/card.json"
    with path.open(newline='') as jsonfile:
        card_array = json.load(jsonfile)

        for card in card_array:



            card_unique_id = card['unique_id']

            for printing in card['printings']:
                unique_id = printing['unique_id']
                set_edition_unique_id = printing['set_edition_unique_id']
                card_id = printing['id']
                set_id = printing['set_id']
                edition = printing['edition']
                foilings = printing['foilings']
                rarity = printing['rarity']
                artist = printing['artist']
                art_variation = printing['art_variation']
                image_url = printing['image_url']

                if url_for_images is not None and image_url is not None:
                    image_url = image_url.replace("https://storage.googleapis.com/fabmaster/media/images/", url_for_images)
                    image_url = image_url.replace("https://storage.googleapis.com/fabmaster/cardfaces/", url_for_images)

                if art_variation is None:
                    art_variation = ""
                if image_url is None:
                    image_url = ""

                insert(cur, unique_id, card_unique_id, set_edition_unique_id, card_id, set_id, edition, foilings, rarity, artist, art_variation, image_url)

        print("\nSuccessfully filled card_printings table\n")

        */