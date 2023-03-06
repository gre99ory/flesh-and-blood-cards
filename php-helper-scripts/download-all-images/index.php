<?php

$images_dir_path = "images/";
$set_id_to_download = null;

function download_images_from_language_data($language)
{
    global $set_id_to_download;

    # Download the images
    $path = __DIR__ ."/../../json/{$language}/card.json";

    $jsonfile = file_get_contents( $path );

    $card_array = json_decode( $jsonfile, true );

    foreach ( $card_array as $card )
    {
        foreach ( $card['printings'] as $printing )
        {
            $image_url = $printing['image_url'];
            $set_id = $printing['set_id'];

            if ( $image_url && ( $set_id_to_download == null || $set_id == $set_id_to_download )) 
            {
                download_image_from_url($image_url);
            }
        }
    }
}


function download_image_from_url($image_url)
{
    $cleaned_up_image_url = str_replace("https://storage.googleapis.com/fabmaster/media/images/", "",$image_url);
    $cleaned_up_image_url = str_replace("https://storage.googleapis.com/fabmaster/cardfaces/", "",$cleaned_up_image_url);
    $cleaned_up_image_url = str_replace("https://dhhim4ltzu1pj.cloudfront.net/media/images/", "",$cleaned_up_image_url);

    // Use http
    $image_url = str_replace("https://","http://", $image_url);

    $file_name = "images/".$cleaned_up_image_url;
    if ( file_exists($file_name) ) 
    {        
        print( $file_name . " already exists, skipping\n");
        return;
    }

    $dirs = explode("/",$file_name);
    array_pop( $dirs );
    $file_dir = join( "/",$dirs );

    if ( !file_exists($file_dir)) 
    {
        print($file_dir . " does not exist, creating it\n");
        make_dirs($file_dir);
    }
    print("Downloading " . $image_url . " to " . $file_name . "\n");

    $handle_url = fopen( $image_url, "r");
    if ( $handle_url === false )
    {
        die("Echec lors de l'ouverture du flux vers l'URL");
    }

    $handle_file = fopen( $file_name, "w" );
    if ( $handle_file === false )
    {
        die("Echec lors de l'ouverture du flux vers le fichier {$file_name}");
    }

    $img_data = stream_get_contents($handle_url);
    fclose($handle_url);

    fwrite($handle_file,$img_data);
    fclose($handle_file);
}

/*
# Parse command line flags
try:
    opts, args = getopt.getopt(sys.argv[1:], "hs:")
except getopt.GetoptError:
    print('main.py -s <set-id>')
    sys.exit(2)
for opt, arg in opts:
    if opt == '-h':
        print ('main.py -s <set-id>')
        sys.exit()
    elif opt in ("-s", "--set-id"):
        set_id_to_download = arg
        print("Downloading only", set_id_to_download, "images")

if not exists(images_dir_path):
    print(images_dir_path + " does not exist, creating it")
    makedirs(images_dir_path)
*/

function make_dirs( $dirs )
{
    if (!mkdir( "./".$dirs, 0777, true )) 
    {
        die("Impossible de créer l'arborescence vers {$dirs}");
    }
}

download_images_from_language_data("french");
download_images_from_language_data("german");
download_images_from_language_data("italian");
download_images_from_language_data("spanish");
download_images_from_language_data("english");

die('TERMINE');
