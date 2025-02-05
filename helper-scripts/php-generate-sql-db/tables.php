<?php
import generate_table_data.ability
import generate_table_data.ability_translations
import generate_table_data.artist
import generate_table_data.card
import generate_table_data.card_printing
import generate_table_data.card_translations
import generate_table_data.edition
import generate_table_data.foiling
import generate_table_data.icon
import generate_table_data.keyword
import generate_table_data.keyword_translations
import generate_table_data.rarity
import generate_table_data.set
import generate_table_data.set_edition
import generate_table_data.type
import generate_table_data.type_translations

function create_tables($conn)
{
    print("Creating tables...");

    cur = conn.cursor()

    ability::create_table()
    ability_translations::create_table()

    // generate_table_data.ability.create_table(cur)
    // generate_table_data.ability_translations.create_table(cur)
    generate_table_data.artist.create_table(cur)
    generate_table_data.set.create_table(cur)
    generate_table_data.set_edition.create_table(cur)
    generate_table_data.card.create_table(cur)
    generate_table_data.card_printing.create_table(cur)
    generate_table_data.card_translations.create_table(cur)
    generate_table_data.edition.create_table(cur)
    generate_table_data.foiling.create_table(cur)
    generate_table_data.icon.create_table(cur)
    generate_table_data.keyword.create_table(cur)
    generate_table_data.keyword_translations.create_table(cur)
    generate_table_data.rarity.create_table(cur)
    generate_table_data.type.create_table(cur)
    generate_table_data.type_translations.create_table(cur)

    cur.close()
    print("Finished creating tables")

def drop_tables(conn = None):
    print("Dropping tables...")
    cur = conn.cursor()

    generate_table_data.ability_translations.drop_table(cur)
    generate_table_data.ability.drop_table(cur)
    generate_table_data.artist.drop_table(cur)
    generate_table_data.card_translations.drop_table(cur)
    generate_table_data.card_printing.drop_table(cur)
    generate_table_data.card.drop_table(cur)
    generate_table_data.edition.drop_table(cur)
    generate_table_data.foiling.drop_table(cur)
    generate_table_data.icon.drop_table(cur)
    generate_table_data.keyword_translations.drop_table(cur)
    generate_table_data.keyword.drop_table(cur)
    generate_table_data.rarity.drop_table(cur)
    generate_table_data.set_edition.drop_table(cur)
    generate_table_data.set.drop_table(cur)
    generate_table_data.type_translations.drop_table(cur)
    generate_table_data.type.drop_table(cur)

    cur.close()
    print("Finished dropping tables")

def generate_all_table_data(conn = None, url_for_images = None):
    def generate_non_english_table_data(cur, language):
        generate_table_data.ability_translations.generate_table_data(cur, language)
        generate_table_data.artist.generate_table_data(cur, language)
        generate_table_data.set.generate_table_data(cur, language)
        generate_table_data.set_edition.generate_table_data(cur, language)
        generate_table_data.card_translations.generate_table_data(cur, language)
        generate_table_data.keyword_translations.generate_table_data(cur, language)
        generate_table_data.type_translations.generate_table_data(cur, language)

    print("Generating table data...")
    cur = conn.cursor()

    generate_table_data.ability.generate_table_data(cur)
    generate_table_data.artist.generate_table_data(cur, "english")
    generate_table_data.set.generate_table_data(cur, "english")
    generate_table_data.set_edition.generate_table_data(cur, "english")
    generate_table_data.card.generate_table_data(cur)
    generate_table_data.card_printing.generate_table_data(cur, url_for_images)
    generate_table_data.edition.generate_table_data(cur)
    generate_table_data.foiling.generate_table_data(cur)
    generate_table_data.icon.generate_table_data(cur)
    generate_table_data.keyword.generate_table_data(cur)
    generate_table_data.rarity.generate_table_data(cur)
    generate_table_data.type.generate_table_data(cur)

    generate_non_english_table_data(cur, "french")
    generate_non_english_table_data(cur, "german")
    generate_non_english_table_data(cur, "italian")
    generate_non_english_table_data(cur, "spanish")

    cur.close()
    print("Finished generating table data")