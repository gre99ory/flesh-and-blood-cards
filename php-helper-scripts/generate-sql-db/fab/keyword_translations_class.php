<?php

require_once('entity_class.php');

class keyword_translations extends entity {
    static protected $table_name = 'keyword_translations';
    static protected $json_name = 'keyword';

    static protected $fields = [
        'keyword_unique_id' => [
            entity::FIELD_TYPE => db_type::VC21,
            entity::NOT_NULL  => true,
            entity::IS_PRIMARY => true,
            entity::IS_FOREIGN => "keywords ( unique_id )" ],
        'language' => [
            entity::FIELD_TYPE => db_type::VC10,
            entity::NOT_NULL  => true,
            entity::IS_PRIMARY => true ],
        'name' => [
            entity::FIELD_TYPE => db_type::VC255 ],
        'description' => [
            entity::FIELD_TYPE => db_type::VC1000,
            entity::NOT_NULL  => true ],
        ];


    static protected function handle_record($record,$language)
    {
        $record['keyword_unique_id'] = $record['unique_id'];
        unset( $record['unique_id'] );
        $record['language'] = $language;

        return $record;
    }

}


/*
def insert(cur, keyword_unique_id, language, name, description):
    sql = """INSERT INTO keyword_translations(keyword_unique_id, language, name, description)
            VALUES(%s, %s, %s, %s);"""
    data = (keyword_unique_id, language, name, description)

    try:
        print("Inserting {0} translation for keyword {1} ({2})...".format(
            language,
            keyword_unique_id,
            name
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
    print(f"Filling out keywords table from {language} card.json...\n")

    path = Path(__file__).parent / f"../../../json/{language}/keyword.json"
    with path.open(newline='') as jsonfile:
        keyword_array = json.load(jsonfile)

        for keyword in keyword_array:
            keyword_unique_id = keyword['unique_id']
            name = keyword['name']
            description = keyword['description']

            insert(cur, keyword_unique_id, language, name, description)

        print(f"\nSuccessfully filled keywords table with {language} data\n")
        */