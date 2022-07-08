<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{

    public function getNews(){

        if(!Session::get('id')){
            return 0;
        }

        $key = "0c0c6dd7d20f4395adc4bb8d275c7b0d"; 

        $curl = curl_init();

        $request = request();
        $country = $request['country'];

        curl_setopt($curl, CURLOPT_URL,
        "https://newsapi.org/v2/top-headlines?country=$country&category=general&page=1&apiKey=$key");
    
        $config['useragent'] = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0';

        curl_setopt($curl, CURLOPT_USERAGENT, $config['useragent']);
        curl_setopt($curl, CURLOPT_REFERER, 'https://www.domain.com/');
    
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;

    }

}

?>