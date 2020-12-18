<?php 

function getUrlDbpediaAbstract($term) 
{ 
$format = 'json'; 

$query =  <<< 'SPARQL'
PREFIX wd: <http://www.wikidata.org/entity/>
PREFIX wdt: <http://www.wikidata.org/prop/direct/>
PREFIX wikibase: <http://wikiba.se/ontology#>
PREFIX p: <http://www.wikidata.org/prop/>
PREFIX ps: <http://www.wikidata.org/prop/statement/>
PREFIX pq: <http://www.wikidata.org/prop/qualifier/>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX bd: <http://www.bigdata.com/rdf#>

SELECT ?food ?calories ?foodLabel ?caloriesLabel ?image WHERE {
  ?food wdt:P31 wd:Q2095.
  ?food wdt:P31 ?calories.
  ?food wdt:P18 ?image.
  SERVICE wikibase:label { bd:serviceParam wikibase:language 'en'. }
} LIMIT 10
SPARQL;

$searchUrl = 'https://query.wikidata.org/sparql'.'?query='.urlencode($query).'&format='.$format; 

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

$term = @$_GET['search'] ?: "food"; 
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
  
    <th>FOOD LABLE</th>
    <th>CALORIES</th>
    <th>IMAGE</th>
  </tr>

<?php

for ($i=0; $i <10 ; $i++) { 
	# code...
?>
  <tr>
    <td><?php echo $responseArray["results"]["bindings"][$i]["foodLabel"]["value"]; ?></td>
    <td><?php echo $responseArray["results"]["bindings"][$i]["caloriesLabel"]["value"]; ?></td>
  </tr>

 <?php }  ?>

</table>



</body> 
</html>