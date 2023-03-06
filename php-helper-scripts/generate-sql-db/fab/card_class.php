<?php

require_once('entity_class.php');

class card extends entity {
    static protected $table_name = 'cards';
    static protected $json_name = 'card';
    
     // UNIQUE (name, pitch)

    static protected $fields = [
        'unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL  => true,
            entity::IS_PRIMARY => true ],
        'name' => [ 
            entity::FIELD_TYPE => db_type::VC255,
            entity::NOT_NULL  => true ],
        'pitch' => [ 
            entity::FIELD_TYPE => db_type::VC10,
            entity::COLLATE => db_type::NUMERIC,
            entity::NOT_NULL  => true ],
        'power' => [ 
            entity::FIELD_TYPE => db_type::VC10,
            entity::COLLATE => db_type::NUMERIC,
            entity::NOT_NULL  => true ],
        'defense' => [ 
            entity::FIELD_TYPE => db_type::VC10,
            entity::COLLATE => db_type::NUMERIC,
            entity::NOT_NULL  => true ],
        'health' => [ 
            entity::FIELD_TYPE => db_type::VC10,
            entity::COLLATE => db_type::NUMERIC,
            entity::NOT_NULL  => true ],
        'intelligence' => [ 
            entity::FIELD_TYPE => db_type::VC10,
            entity::COLLATE => db_type::NUMERIC,
            entity::NOT_NULL  => true ],
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
        'played_horizontally' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::FALSE ],
        'blitz_legal' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::TRUE ],
        'cc_legal' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::TRUE ],
        'commoner_legal' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::TRUE ],
        'blitz_living_legend' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::FALSE ],
        'blitz_living_legend_start' => [ 
            entity::FIELD_TYPE => db_type::TIMESTAMP ],
        'cc_living_legend' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::FALSE ],
        'cc_living_legend_start' => [ 
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'blitz_banned' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::FALSE ],
        'blitz_banned_start' => [ 
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'cc_banned' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::FALSE ],
        'cc_banned_start' => [ 
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'upf_banned' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::FALSE ],
        'upf_banned_start' => [ 
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'commoner_banned' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::FALSE ],
        'commoner_banned_start' => [ 
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'blitz_suspended' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::FALSE ],
        'blitz_suspended_start' => [ 
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'blitz_suspended_end' => [ 
            entity::FIELD_TYPE => db_type::VC1000 ],
        'cc_suspended' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::FALSE ],
        'cc_suspended_start' => [ 
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'cc_suspended_end' => [ 
            entity::FIELD_TYPE => db_type::VC1000 ],
        'commoner_suspended' => [ 
            entity::FIELD_TYPE => db_type::BOOLEAN,
            entity::NOT_NULL  => true,
            entity::DEFAULT => db_type::FALSE ],
        'commoner_suspended_start' => [ 
            entity::FIELD_TYPE => db_type::TIMESTAMP,
            entity::NULL  => true,
            entity::DEFAULT => db_type::NULL ], // GG Added
        'commoner_suspended_end' => [ 
            entity::FIELD_TYPE => db_type::VC1000 ],
        ];

        static public function __generate_table_data($language='english')
        {
            return;
        }
}


/*
def insert(cur, unique_id, name, pitch, cost, power, defense, health, intelligence, types, card_keywords, abilities_and_effects,
            ability_and_effect_keywords, granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text,
            played_horizontally, blitz_legal, cc_legal, commoner_legal, blitz_living_legend, blitz_living_legend_start, cc_living_legend, cc_living_legend_start,
            blitz_banned, blitz_banned_start, cc_banned, cc_banned_start, commoner_banned, commoner_banned_start, upf_banned, upf_banned_start,
            blitz_suspended, blitz_suspended_start, blitz_suspended_end, cc_suspended, cc_suspended_start, cc_suspended_end,
            commoner_suspended, commoner_suspended_start, commoner_suspended_end):
    sql = """INSERT INTO cards(unique_id, name, pitch, cost, power, defense, health, intelligence, types, card_keywords, abilities_and_effects,
            ability_and_effect_keywords, granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text,
            played_horizontally, blitz_legal, cc_legal, commoner_legal, blitz_living_legend, blitz_living_legend_start, cc_living_legend, cc_living_legend_start,
            blitz_banned, blitz_banned_start, cc_banned, cc_banned_start, commoner_banned, commoner_banned_start, upf_banned, upf_banned_start,
            blitz_suspended, blitz_suspended_start, blitz_suspended_end, cc_suspended, cc_suspended_start, cc_suspended_end,
            commoner_suspended, commoner_suspended_start, commoner_suspended_end)
            VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,
            %s, %s, %s, %s, %s, %s, %s,
            %s, %s, %s, %s, %s, %s, %s, %s,
            %s, %s, %s, %s, %s, %s, %s, %s,
            %s, %s, %s, %s, %s, %s,
            %s, %s, %s);"""
    data = (unique_id, name, pitch, cost, power, defense, health, intelligence, types, card_keywords, abilities_and_effects,
            ability_and_effect_keywords, granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text,
            played_horizontally, blitz_legal, cc_legal, commoner_legal, blitz_living_legend, blitz_living_legend_start, cc_living_legend, cc_living_legend_start,
            blitz_banned, blitz_banned_start, cc_banned, cc_banned_start, commoner_banned, commoner_banned_start, upf_banned, upf_banned_start,
            blitz_suspended, blitz_suspended_start, blitz_suspended_end, cc_suspended, cc_suspended_start, cc_suspended_end,
            commoner_suspended, commoner_suspended_start, commoner_suspended_end)
    try:
        print("Inserting {0} - {1} card with unique id {2}...".format(name, pitch, unique_id))

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

def generate_table_data(cur):
    print("Filling out cards table from card.json...\n")

    path = Path(__file__).parent / "../../../json/english/card.json"
    with path.open(newline='') as jsonfile:
        card_array = json.load(jsonfile)

        for card in card_array:
            unique_id = card['unique_id']
            name = card['name']
            pitch = card['pitch']
            cost = card['cost']
            power = card['power']
            defense = card['defense']
            health = card['health']
            intelligence = card['intelligence']
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
            played_horizontally = card['played_horizontally']
            blitz_legal = card['blitz_legal']
            cc_legal = card['cc_legal']
            commoner_legal = card['commoner_legal']
            blitz_living_legend = card['blitz_living_legend']
            blitz_living_legend_start = card.get('blitz_living_legend_start')
            cc_living_legend = card['cc_living_legend']
            cc_living_legend_start = card.get('cc_living_legend_start')
            blitz_banned = card['blitz_banned']
            blitz_banned_start = card.get('blitz_banned_start')
            cc_banned = card['cc_banned']
            cc_banned_start = card.get('cc_banned_start')
            commoner_banned = card['commoner_banned']
            commoner_banned_start = card.get('commoner_banned_start')
            upf_banned = card['upf_banned']
            upf_banned_start = card.get('upf_banned_start')
            blitz_suspended = card['blitz_suspended']
            blitz_suspended_start = card.get('blitz_suspended_start')
            blitz_suspended_end = card.get('blitz_suspended_end')
            cc_suspended = card['cc_suspended']
            cc_suspended_start = card.get('cc_suspended_start')
            cc_suspended_end = card.get('cc_suspended_end')
            commoner_suspended = card['commoner_suspended']
            commoner_suspended_start = card.get('commoner_suspended_start')
            commoner_suspended_end = card.get('commoner_suspended_end')

            insert(cur, unique_id, name, pitch, cost, power, defense, health, intelligence, types, card_keywords, abilities_and_effects,
            ability_and_effect_keywords, granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text,
            played_horizontally, blitz_legal, cc_legal, commoner_legal, blitz_living_legend, blitz_living_legend_start, cc_living_legend, cc_living_legend_start,
            blitz_banned, blitz_banned_start, cc_banned, cc_banned_start, commoner_banned, commoner_banned_start, upf_banned, upf_banned_start,
            blitz_suspended, blitz_suspended_start, blitz_suspended_end, cc_suspended, cc_suspended_start, cc_suspended_end,
            commoner_suspended, commoner_suspended_start, commoner_suspended_end)

        print("\nSuccessfully filled cards table\n")
        */