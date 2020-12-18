
<?php 

function getUrlDbpediaAbstract($term) 
{ 
$format = 'json'; 

$query = 
"PREFIX dbp: <http://dbpedia.org/resource/> 
PREFIX dbp2: <http://dbpedia.org/ontology/> 

SELECT distinct ?Food ?pengertian
WHERE 
{ 
dbo:Food rdfs:label ?Food . 
dbo:Food rdfs:comment ?pengertian.
}"; 

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

$term = @$_GET['search'] ?: "Food"; 
$requestURL = getUrlDbpediaAbstract($term); 
$responseArray = json_decode(request($requestURL),	true); 
?> 





  <section class="bg-green text-white">

      <div class="container text-center">
        <h2 class="mb-4">       DBPedia about <?php echo $term ?>     </h2>
        <p class="text-faded mb-4">
        


<strong>
<?php 

for ($i=0; $i <11 ; $i++) { 
	
	echo $responseArray["results"]["bindings"][$i]["Food"]["value"];
	echo "-";
}
?>
</strong>

<br>
<h4>
<?php echo $responseArray["results"]["bindings"][0]["pengertian"]["value"];?>
</h4>
 
<br/> 








        </p>
      </div>
    </section>