<?php

namespace InstaFeed;

class Utils {

    public function getData($username)
    {
        if(!file_exists(__DIR__.'/../../json/'.$username.'.json'))
        {
            $ch = curl_init('https://www.instagram.com/'.$username);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (iPhone; CPU iPhone OS 5_0 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9A334 Safari/7534.48.3");
            curl_setopt($ch, CURLOPT_REFERER, 'https://www.instagram.com/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            $result = curl_exec($ch);
            preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
            $cookies = array();
            foreach($matches[1] as $item) {
                parse_str($item, $cookie);
                $cookies = array_merge($cookies, $cookie);
            }
    
            $data = false;

            if(strpos($result, 'window._sharedData = ') !== false)
            {
                $data = explode('window._sharedData = ',$result)[1];
                $data = explode(';</script>', $data)[0];
            }
            else
            {
                return false;
            }

            $cursor = false;

            if(strpos($result, '"end_cursor":"') !== false)
            {
                $cursor = explode('"end_cursor":"',$result)[1];
                $cursor = explode('"', $cursor)[0];
            }

            $array = array(
                'Cookies' => $cookies,
                'Cursor'  => $cursor,
                'Shared'  => json_decode($data, true)
            );

            file_put_contents(__DIR__.'/../../json/'.$username.'.json', json_encode($array));
    
            return $array;
        }
        else
        {
            $json = file_get_contents(__DIR__.'/../../json/'.$username.'.json');
            return json_decode($json, true);
        }
    }

    public function noCache($username)
    {
        if(file_exists(__DIR__.'/../../json/'.$username.'.json'))
            unlink(__DIR__.'/../../json/'.$username.'.json');
    }

}



?>