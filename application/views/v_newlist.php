
<?php 

function getUrlDbpediaAbstract($term) 
{ 
$format = 'json'; 

$query = 
"PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX food: <http://www.paguyubankseusu.org/hanna/hanna-food.owl#>


SELECT ?food_name ?ing
WHERE {
  ?no food:has_name ?food_name;
      food:has_ing ?ing .
}"; 

$searchUrl = 'http://localhost:3030/food-hanna/sparql?'.'query='.urlencode($query).'&format='.$format; 

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

$term = @$_GET['search'] ?: "food_name"; 
$requestURL = getUrlDbpediaAbstract($term); 
$responseArray = json_decode(request($requestURL),  true); 
?> 



  <section class="bg-green text-white">

      <div class="container text-center">
        <h2 class="mb-4">  LIST FOOD <?php echo $term ?>     </h2>
        <p class="text-faded mb-4">
        
        <table class="sparql" border="1">
  <tr>
  
    <th>a</th>
    <th>b</th>
  </tr>


<?php

for ($i=0; $i <100 ; $i++) { 
  # code...
?>
  <tr>

    <td><?php echo $responseArray["results"]["bindings"][$i]["food_name"]["value"]; ?></td>
    <td><?php echo $responseArray["results"]["bindings"][$i]["ing"]["value"]; ?></td>
    
  </tr>

 <?php }  ?>

<!-- <br>
<h4>
<?php echo $responseArray["results"]["bindings"][0]["ing"]["value"];?>
</h4>
 
<br/>  -->

</table>
        </p>
      </div>
    </section>