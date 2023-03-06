<?php

require_once('debug_class.php');
require_once('db_class.php');
require_once('tables.php');

print('<pre>');

$url_for_images = null;
$database_name = 'maindeck';
$database_prefix = 'fab';
// $user = null;
// $password = null;
// $host = null;
// $port = null;

/*
try:
    opts, args = getopt.getopt(sys.argv[1:], "hi:d:u:p:H:P:")
except getopt.GetoptError:
    print('main.py -d <database-name> -u <user> -p <password> -H <host> -P <port> -i <images-base-url>')
    sys.exit(2)
for opt, arg in opts:
    if opt == '-h':
        print ('main.py -d <database-name> -u <user> -p <password> -H <host> -P <port> -i <images-base-url>')
        sys.exit()
    elif opt in ("-i", "--images-base-url"):
        url_for_images = arg
        print("Using", url_for_images, "for images")
    elif opt in ("-d", "--database-name"):
        database_name = arg
    elif opt in ("-u", "--user"):
        user = arg
    elif opt in ("-p", "--password"):
        password = arg
    elif opt in ("-H", "--host"):
        host = arg
    elif opt in ("-P", "--port"):
        port = arg
*/


if ( $database_name === null ) 
    die("ERROR: Please provide a database name (-d, --database-name)");
/*
if ( $user === null )
    die("ERROR: Please provide a user (-u, --user)");
if ( $password === null )
    die("ERROR: Please provide a password (-p, --password)");
if ( $host === null )
    die("ERROR: Please provide a host (-H, --host)");
if ( $port === null )
    die("ERROR: Please provide a port (-P, --port)");
*/

print("Using '{$database_name}' for database name\n");

#establishing the connection to mySql
// $conn = null;

try
{
    $list_database =  DB::fetchAll( 'SHOW DATABASES' );

    // array_walk( $list_database, fn($e) => { echo $e; });
    $found = false;
    foreach ( $list_database as $database )
    {
        if ( $database_name == $database['Database'] ) 
        {
            $found = true;
            break;
        }
    }

    if ( !$found )
    {
        print("'{$database_name}' database does not exist, creating it.\n");
        DB::execute("CREATE database `{$database_name}`");
        print("'{$database_name}' database created successfully...........\n");
    }

    try {
        DB::useDatabase($database_name);
    }
    catch ( Exception $e )
    {
        var_dump( $e );
        die();
    }

    ## Add collations
    // cursor.execute("CREATE COLLATION IF NOT EXISTS numeric (provider = icu, locale = 'en@colNumeric=yes');")

    ## Drop existing tables, recreate them, and then fill them with data
    try {
        drop_tables();
    }
    catch ( Exception $e )
    {
        var_dump( $e );
        die();
    }
    // print;

    try {
        create_tables();
    }
    catch ( Exception $e )
    {
        var_dump( $e );
        die();
    }
    // print()

    try {
        generate_all_table_data($url_for_images);
    }
    catch ( Exception $e )
    {
        var_dump( $e );
        die();
    }

    // conn.commit();
}
catch ( Exception $e ) {
    print('<hr/>');
    var_dump( $e );
}
/*
finally {
    DB::close();
}
*/

print("Done creating tables from CSVs!\n");
