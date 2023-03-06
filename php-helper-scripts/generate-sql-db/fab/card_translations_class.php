<?php

require_once('entity_class.php');

class card_translations extends entity {
    static protected $table_name = 'card_translations';
    static protected $json_name = 'card';

    // UNIQUE (unique_id, card_id, edition, art_variation)

    static protected $fields = [
        'card_unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL => true,
            entity::IS_PRIMARY => true,
            entity::IS_FOREIGN => "cards ( unique_id )" ],
        'language' => [
            entity::FIELD_TYPE => db_type::VC10,
            entity::NOT_NULL => true,
            entity::IS_PRIMARY => true ],
        'name' => [
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL => true ],
        'pitch' => [
            entity::FIELD_TYPE => db_type::VC10,
            entity::NOT_NULL => true,
            entity::COLLATE => db_type::NUMERIC ],
        'types' => [ 
            entity::FIELD_TYPE => db_type::VC255, //[],
            entity::IS_ARRAY   => true,
            entity::NOT_NULL   => true ],
        'card_keywords' => [ 
            entity::FIELD_TYPE => db_type::VC255, //[],
            entity::IS_ARRAY   => true,
            entity::NOT_NULL   => true ],
        'abilities_and_effects' => [ 
            entity::FIELD_TYPE => db_type::VC255, //[],
            entity::IS_ARRAY   => true,
            entity::NOT_NULL   => true ],
        'ability_and_effect_keywords' => [ 
            entity::FIELD_TYPE => db_type::VC255, //[],
            entity::IS_ARRAY   => true,
            entity::NOT_NULL   => true ],
        'granted_keywords' => [ 
            entity::FIELD_TYPE => db_type::VC255, //[],
            entity::IS_ARRAY   => true,
            entity::NOT_NULL   => true ],
        'functional_text' => [ 
            entity::FIELD_TYPE => db_type::VC10000,
            entity::NOT_NULL  => true ],
        'functional_text_plain' => [ 
            entity::FIELD_TYPE => db_type::VC10000,
            entity::NOT_NULL  => true ],
        'flavor_text' => [ 
            entity::FIELD_TYPE => db_type::VC10000,
            entity::NOT_NULL  => true ],
        'flavor_text_plain' => [ 
            entity::FIELD_TYPE => db_type::VC10000,
            entity::NOT_NULL  => true ],
        'type_text' => [ 
            entity::FIELD_TYPE => db_type::VC1000,
            entity::NOT_NULL  => true ],
        ];

        static protected function handle_record($record,$language)
        {
            $record['card_unique_id'] = $record['unique_id'];
            unset( $record['unique_id'] );
            $record['language'] = $language;

            return $record;
        }
}

/*
def insert(cur, card_unique_id, language, name, pitch, types, card_keywords, abilities_and_effects, ability_and_effect_keywords,
        granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text):
    sql = """INSERT INTO card_translations(card_unique_id, language, name, pitch, types, card_keywords, abilities_and_effects, ability_and_effect_keywords,
                granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text)
            VALUES(%s, %s, %s, %s, %s, %s, %s, %s,
                %s, %s, %s, %s, %s, %s);"""
    data = (card_unique_id, language, name, pitch, types, card_keywords, abilities_and_effects, ability_and_effect_keywords,
        granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text)

    try:
        print("Inserting {0} printing for card {1} ({2} - {3})...".format(
            language,
            card_unique_id,
            name,
            pitch
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

def generate_table_data(cur, language):
    print(f"Filling out cards table from {language} card.json...\n")

    path = Path(__file__).parent / f"../../../json/{language}/card.json"
    with path.open(newline='') as jsonfile:
        card_array = json.load(jsonfile)

        for card in card_array:
            card_unique_id = card['unique_id']
            name = card['name']
            pitch = card['pitch']

            types = card['types']
            card_keywords = card['card_keywords']
            abilities_and_effects = card['abilities_and_effects']
            ability_and_effect_keywords = card['ability_and_effect_keywords']
            granted_keywords = card['granted_keywords']
            functional_text = card['functional_text']
            functional_text_plain = card['functional_text_plain']
            flavor_text = card['flavor_text']
            flavor_text_plain = card['flavor_text_plain']
            type_text = card['type_text']

            insert(cur, card_unique_id, language, name, pitch, types, card_keywords, abilities_and_effects, ability_and_effect_keywords,
                granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text)

        print(f"\nSuccessfully filled cards table with {language} data\n")
        */