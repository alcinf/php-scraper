<?php

$urls_file = 'urls.csv';

function scrapePage($url, $client)
{
    $urls = [];
    
    $crawler = $client->request('GET', $url);
    
    $crawler->filter('a')->each(function ($node) use (&$urls)  {
        
        $urls[] = [$node->filter('a')->text(), $node->filter('a')->attr('href')];
        
    });
    
    try {
        $name = $crawler->filter('title')->text() ? : NULL;
    } catch (\Throwable $th) {
        $name = $url;
    }
    
    return [
         'url_title' => $name
        ,'url' => $url
        ,'urls' => $urls
    ];
}

function pp($item){
    echo '<pre>';
    print_r($item);
    exit;
}

function dd($item){
    echo '<pre>';
    var_dump($item);
    exit;
}

function save_csv($list, $file){
    $fp = fopen($file, 'a');
    
    foreach ($list as $fields) {
        fputcsv($fp, $fields);
    }
    
    fclose($fp);

}

function load_csv($file){
    $csvData = file_get_contents($file);
    $lines = explode(PHP_EOL, $csvData);
    $array = array();
    //echo '<pre>';
    //var_dump($lines);
    foreach ($lines as $line) {
        if('' != trim($line))
            $array[] = str_getcsv($line);
    }
    return $array;
}

function view_detail($url_id, $urls_file){
    $array = load_csv($url_id.'.csv');
    $main_urls = load_csv($urls_file);
    echo '<h2 align="center">'.$main_urls[$url_id-1][1].'</h2>';
    echo '<a href=".">< Back</a>';
    //$main_urls = [];
    $html = '
    
    <table class="table table-striped" >  
    <thead>  
    <tr>
     <th scope="col">Name</th>
     <th scope="col">URL</th>
    </tr>
    </thead>  
    <tbody>  ';
    foreach ($array as $url) {
        $html .= '<tr>';
        $html .= '<td scope="row">'.$url[0].'</a></td>';
        $html .= '<td>'.$url[1].'</td>';
        $html .= '</tr>';
    }
    $html .= '
    </tbody>  
    </table>    
    
    ';
    echo $html;
}

function view_main($main_urls){
    $html = '
    <table class="table table-striped" >  
    <thead>  

    <tr>
     <th scope="col">Name</th>
     <th scope="col">Total links</th>
    </tr>
    </thead>  
    <tbody>  ';
    foreach ($main_urls as $url) {
        $html .= '<tr>';
        $html .= '<td><a href="detail.php?id='.$url[0].'">'.$url[1].'</a></td>';
        $html .= '<td>'.$url[3].'</td>';
        $html .= '</tr>';
    }
    $html .= '
    </tbody>  
    </table>    
    
    ';
    echo $html;

}

function init_file($file){
    if(!file_exists($file)){
        $myfile = fopen($file, "w") or die("Unable to open file!");
        fclose($myfile);
    }
}

function add_url($urls, $main_urls, $urls_file){

    $id = count($main_urls)+1;

    $array_main = [[$id, $urls['url_title'],$urls['url'],count($urls['urls'])]];
    
    init_file($id.'.csv');
    save_csv($array_main, $urls_file);
    
    save_csv($urls['urls'], $id.'.csv');
    
    return load_csv($urls_file);
}


function view_form(){
    $html = '
    <div class="container">
        <form action="scraper.php" method="post">
            <div class="input-group mb-3">
                <input type="url" name="url" id="url" class="form-control" placeholder="Add new page" aria-label="Add new page" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Scrape</button>
            </div>		
        </form>
    </div><br/>
    ';
    echo $html;
}
