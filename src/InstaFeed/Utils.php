<?php

namespace InstaFeed;

class Utils {

    public function getData($username)
    {
        if(!file_exists(__DIR__.'/../../json/'.$username.'.json'))
        {
            $ch = curl_init('https://i.instagram.com/api/v1/users/web_profile_info/?username='.$username);
            curl_setopt($ch, CURLOPT_REFERER, 'https://www.instagram.com/');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("x-ig-app-id: 936619743392459"));
            $result = curl_exec($ch);

            file_put_contents(__DIR__.'/../../json/'.$username.'.json', $result);
    
            return $result;
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
