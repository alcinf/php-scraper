<?php

    require 'functions.php';
    require 'vendor/autoload.php';


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){ //Abram: Take the parameters according to the request's type 
        if(!isset($_POST['url'])){
            header("Location: .");
            die();
        }
    }else{
        header("Location: .");
        die();
    }



    use Goutte\Client;
    
    $client = new Client();
    
    $url = $_POST['url'];
    
    init_file($urls_file);
    
    $main_urls = load_csv($urls_file);
    
    $urls = scrapePage($url, $client);
    
    $main_urls = add_url($urls, $main_urls, $urls_file);
    
    header("Location: .");
    die();


?>
