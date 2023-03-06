<?php

require_once('fab/ability_class.php');
require_once('fab/ability_translations_class.php');
require_once('fab/artist_class.php');
require_once('fab/card_class.php');
require_once('fab/card_printing_class.php');
require_once('fab/card_translations_class.php');
require_once('fab/edition_class.php');
require_once('fab/foiling_class.php');
require_once('fab/icon_class.php');
require_once('fab/keyword_class.php');
require_once('fab/keyword_translations_class.php');
require_once('fab/rarity_class.php');
require_once('fab/set_class.php');
require_once('fab/set_edition_class.php');
require_once('fab/type_class.php');
require_once('fab/type_translations_class.php');

function create_tables()
{
    print("Creating tables...\n");
    // cur = conn.cursor()

    ability::create_table();
    ability_translations::create_table();
    artist::create_table();
    set::create_table();
    set_edition::create_table();
    card::create_table();
    card_printing::create_table();
    card_translations::create_table();
    edition::create_table();
    foiling::create_table();
    icon::create_table();
    keyword::create_table();
    keyword_translations::create_table();
    rarity::create_table();
    type::create_table();
    type_translations::create_table();

    // cur.close()
    print("Finished creating tables\n");
}


function drop_tables()
{
    print("Dropping tables...\n");
    // cur = conn.cursor()


    // DB::execute( "SET SESSION foreign_key_checks = 1" );
    card_printing::drop_table();        // <= cards, set_editions

    ability_translations::drop_table(); // <= abilities
    card_translations::drop_table();    // <= cards
    keyword_translations::drop_table(); // <= keywords
    set_edition::drop_table();          // <= sets
    type_translations::drop_table();    // <= types
    
    ability::drop_table();
    artist::drop_table();
    card::drop_table();
    edition::drop_table();
    foiling::drop_table();
    icon::drop_table();
    keyword::drop_table();
    rarity::drop_table();
    set::drop_table();
    type::drop_table();

    // cur.close()
    print("Finished dropping tables\n");
}


function generate_all_table_data($url_for_images = null)
{
    
    function generate_non_english_table_data($language)
    {
        ability_translations::generate_table_data($language);
        artist::generate_table_data($language);
        card_translations::generate_table_data($language);
        keyword_translations::generate_table_data($language);
        set::generate_table_data($language);
        set_edition::generate_table_data($language);
        type_translations::generate_table_data($language);
    }

    print("Generating table data...\n");

    ability::generate_table_data();
    artist::generate_table_data("english");
    card::generate_table_data();
    edition::generate_table_data();
    foiling::generate_table_data();
    icon::generate_table_data();
    keyword::generate_table_data();
    rarity::generate_table_data();
    set::generate_table_data("english");
    type::generate_table_data();

    set_edition::generate_table_data("english");
    
    card_printing::generate_table_data('english',$url_for_images);
    
    generate_non_english_table_data("french");
    generate_non_english_table_data("german");
    generate_non_english_table_data("italian");
    generate_non_english_table_data("spanish");

    print("Finished generating table data\n");
}