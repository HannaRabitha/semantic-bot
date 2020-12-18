<?php 

function getUrlDbpediaAbstract($term) 
{ 
$format = 'json'; 

$query = 
"SELECT distinct ?id ?name ?ket ?restaurant
WHERE 
{ 
?id rdf:type dbo:Chef.
?id foaf:name ?name.
?id dct:description ?ket.
?id dbp:restaurants ?restaurant.

}
GROUP BY ?id"; 

$searchUrl = 'http://dbpedia.org/sparql?'.'query='.urlencode($query).'&format='.$format; 

return $searchUrl; 
} 


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

$term = @$_GET['search'] ?: "id"; 
$requestURL = getUrlDbpediaAbstract($term); 
$responseArray = json_decode(request($requestURL),	true); 
?> 
<style type="text/css">
	body {
		background-color: white;
	}
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 

<html xmlns="http://www.w3.org/1999/xhtml"> 

<head> 


<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
</head> 

<body> 


<table class="sparql" border="1">
  <tr>
  
    <th>NAME</th>
    <th>STATUS</th>
    <th>RESTAURANT</th>
  </tr>

<?php

for ($i=0; $i <100 ; $i++) { 
	# code...
?>
  <tr>

     <td><a href="<?php echo base_url().'index.php/web/biodatachef'?>">
                          <span><?php echo $responseArray["results"]["bindings"][$i]["name"]["value"]; ?>  </span>
      </a></td>

    <td><?php echo $responseArray["results"]["bindings"][$i]["ket"]["value"]; ?></td>
    <td><?php echo $responseArray["results"]["bindings"][$i]["restaurant"]["value"]; ?></td>
    
  </tr>

 <?php }  ?>

</table>



</body> 
</html>