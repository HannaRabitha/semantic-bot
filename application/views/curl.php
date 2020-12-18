<?php


function request($url)
{
   // is curl installed?
   if (!function_exists('curl_init'))
   { 
      die('CURL is not installed!');
   }
 
   // get curl handle
   $ch= curl_init();
 
   // set request url
   curl_setopt($ch, CURLOPT_URL, $url);
 
   // return response, don't print/echo
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
   /*
   Here you find more options for curl:
   http://www.php.net/curl_setopt
   */    
 
   $response = curl_exec($ch);
 
   curl_close($ch);
 
   return $response;
}


?>