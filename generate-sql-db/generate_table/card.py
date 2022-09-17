import csv
import psycopg2
from pathlib import Path
from markdown_patch import unmark

def create_table(cur):
    command = """
        CREATE TABLE cards (
            unique_id VARCHAR(21) NOT NULL,
            ids VARCHAR(15)[] NOT NULL COLLATE numeric,
            set_ids VARCHAR(15)[] NOT NULL COLLATE numeric,
            name VARCHAR(255) NOT NULL,
            pitch VARCHAR(10) COLLATE numeric,
            cost VARCHAR(10) COLLATE numeric,
            power VARCHAR(10) COLLATE numeric,
            defense VARCHAR(10) COLLATE numeric,
            health VARCHAR(10) COLLATE numeric,
            intelligence VARCHAR(10) COLLATE numeric,
            rarities VARCHAR(255)[] NOT NULL,
            types VARCHAR(255)[] NOT NULL,
            card_keywords VARCHAR(255)[],
            abilities_and_effects VARCHAR(255)[],
            ability_and_effect_keywords VARCHAR(255)[],
            granted_keywords VARCHAR(255)[],
            functional_text VARCHAR(10000),
            functional_text_plain VARCHAR(10000),
            flavor_text VARCHAR(10000),
            flavor_text_plain VARCHAR(10000),
            type_text VARCHAR(1000),
            artists VARCHAR(1000)[] NOT NULL,
            played_horizontally BOOLEAN NOT NULL DEFAULT FALSE,
            blitz_legal BOOLEAN NOT NULL DEFAULT TRUE,
            cc_legal BOOLEAN NOT NULL DEFAULT TRUE,
            commoner_legal BOOLEAN NOT NULL DEFAULT TRUE,
            blitz_living_legend TIMESTAMP,
            cc_living_legend TIMESTAMP,
            blitz_banned TIMESTAMP,
            cc_banned TIMESTAMP,
            commoner_banned TIMESTAMP,
            blitz_suspended_start TIMESTAMP,
            blitz_suspended_end VARCHAR(1000),
            cc_suspended_start TIMESTAMP,
            cc_suspended_end VARCHAR(1000),
            commoner_suspended_start TIMESTAMP,
            commoner_suspended_end VARCHAR(1000),
            variations VARCHAR(255)[] NOT NULL,
            image_urls VARCHAR(1000)[] NOT NULL
        )
        """

    try:
        print("Creating cards table...")

        # create table
        cur.execute(command)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)

def drop_table(cur):
    command = """
        DROP TABLE IF EXISTS cards
        """

    try:
        print("Dropping cards table...")

        # drop table
        cur.execute(command)
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)

def insert(cur, unique_id, ids, set_ids, name, pitch, cost, power, defense, health, intelligence, rarities, types, card_keywords, abilities_and_effects,
            ability_and_effect_keywords, granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text,
            artists, played_horizontally, blitz_legal, cc_legal, commoner_legal, blitz_living_legend, cc_living_legend, blitz_banned, cc_banned,
            commoner_banned, blitz_suspended_start, blitz_suspended_end, cc_suspended_start, cc_suspended_end, commoner_suspended_start,
            commoner_suspended_end, variations, image_urls):
    sql = """INSERT INTO cards(unique_id, ids, set_ids, name, pitch, cost, power, defense, health, intelligence, rarities, types, card_keywords, abilities_and_effects,
            ability_and_effect_keywords, granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text,
            artists, played_horizontally, blitz_legal, cc_legal, commoner_legal, blitz_living_legend, cc_living_legend, blitz_banned, cc_banned,
            commoner_banned, blitz_suspended_start, blitz_suspended_end, cc_suspended_start, cc_suspended_end, commoner_suspended_start,
            commoner_suspended_end, variations, image_urls)
            VALUES('{0}', '{{{1}}}', '{{{2}}}', '{3}', '{4}', '{5}', '{6}', '{7}', '{8}', '{9}', '{{{10}}}', '{{{11}}}', '{{{12}}}', '{{{13}}}',
            '{{{14}}}', '{{{15}}}', '{16}', '{17}', '{18}', '{19}', '{20}',
            '{{{21}}}', '{22}', '{23}', '{24}', '{25}', {26}, {27}, {28}, {29},
            {30}, {31}, {32}, {33}, {34}, {35},
            {36}, '{{{37}}}', '{{{38}}}');"""
    try:
        print("Inserting {0} - {1} card with unique id {2}...".format(name, pitch, unique_id))

        # execute the INSERT statement
        cur.execute(sql.format(unique_id, ids, set_ids, name, pitch, cost, power, defense, health, intelligence, rarities, types, card_keywords, abilities_and_effects,
            ability_and_effect_keywords, granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text,
            artists, played_horizontally, blitz_legal, cc_legal, commoner_legal, blitz_living_legend, cc_living_legend, blitz_banned, cc_banned,
            commoner_banned, blitz_suspended_start, blitz_suspended_end, cc_suspended_start, cc_suspended_end, commoner_suspended_start,
            commoner_suspended_end, variations, image_urls))
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
        raise error

def treat_blank_string_as_boolean(field, value=True):
    if field == '':
        return value

    return field

def treat_blank_string_as_none(field):
    if field == '':
        return 'NULL'

    return "'" + field + "'"

def generate_table(cur, url_for_images = None):
    print("Filling out cards table from english/card.csv...\n")

    path = Path(__file__).parent / "../../csvs/english/card.csv"
    with path.open(newline='') as csvfile:
        reader = csv.reader(csvfile, delimiter='\t', quotechar='"')
        next(reader)

        for row in reader:
            unique_id = row[0]
            ids = row[1]
            set_ids = row[2]
            name = row[3]
            pitch = row[4]
            cost = row[5]
            power = row[6]
            defense = row[7]
            health = row[8]
            intelligence = row[9]
            rarities = row[10]
            types = row[11]
            card_keywords = row[12]
            abilities_and_effects = row[13]
            ability_and_effect_keywords = row[14]
            granted_keywords = row[15]
            functional_text = row[16]
            flavor_text = row[17]
            type_text = row[18]
            artists = row[19]
            played_horizontally = row[20]
            blitz_legal = treat_blank_string_as_boolean(row[21])
            cc_legal = treat_blank_string_as_boolean(row[22])
            commoner_legal = treat_blank_string_as_boolean(row[23])
            blitz_living_legend = treat_blank_string_as_none(row[24])
            cc_living_legend = treat_blank_string_as_none(row[25])
            blitz_banned = treat_blank_string_as_none(row[26])
            cc_banned = treat_blank_string_as_none(row[27])
            commoner_banned = treat_blank_string_as_none(row[28])
            blitz_suspended_start = treat_blank_string_as_none(row[29])
            blitz_suspended_end = treat_blank_string_as_none(row[30])
            cc_suspended_start = treat_blank_string_as_none(row[31])
            cc_suspended_end = treat_blank_string_as_none(row[32])
            commoner_suspended_start = treat_blank_string_as_none(row[33])
            commoner_suspended_end = treat_blank_string_as_none(row[34])
            variations = row[35]
            image_urls = row[36]

            if played_horizontally == '':
                played_horizontally = False
            if blitz_legal == '':
                blitz_legal = True
            if cc_legal == '':
                cc_legal = True
            if commoner_legal == '':
                commoner_legal = True

            functional_text_plain = unmark(functional_text)
            flavor_text_plain = unmark(flavor_text)

            functional_text = functional_text.replace("'", "''")
            functional_text_plain = functional_text_plain.replace("'", "''")
            flavor_text = flavor_text.replace("'", "''")
            flavor_text_plain = flavor_text_plain.replace("'", "''")

            if url_for_images is not None:
                image_urls = image_urls.replace("https://storage.googleapis.com/fabmaster/media/images/", url_for_images)
                image_urls = image_urls.replace("https://storage.googleapis.com/fabmaster/cardfaces/", url_for_images)

            insert(cur, unique_id, ids, set_ids, name, pitch, cost, power, defense, health, intelligence, rarities, types, card_keywords, abilities_and_effects,
            ability_and_effect_keywords, granted_keywords, functional_text, functional_text_plain, flavor_text, flavor_text_plain, type_text,
            artists, played_horizontally, blitz_legal, cc_legal, commoner_legal, blitz_living_legend, cc_living_legend, blitz_banned, cc_banned,
            commoner_banned, blitz_suspended_start, blitz_suspended_end, cc_suspended_start, cc_suspended_end, commoner_suspended_start,
            commoner_suspended_end, variations, image_urls)

            # print(', '.join(row))

        print("\nSuccessfully filled cards table\n")