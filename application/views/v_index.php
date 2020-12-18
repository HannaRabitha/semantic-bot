    <header class="masthead text-center text-white d-flex">
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <h1 class="text-uppercase">
              <br/>
              <strong> 

              FOODIES HERE FOR YOU!

              </strong>
            </h1>
            <hr>
          </div>
          <div class="col-lg-8 mx-auto">
           <!-- <p class="text-faded mb-5">
              
            </p> -->
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="<?php echo base_url().'index.php/web/foodlist' ?>">Find Out Your Favorite Food</a>
          </div>
        </div>
      </div>
    </header>


  <section class="bg-primary" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto text-center">
            <h2 class="section-heading text-white">
              What is Food?

            </h2>
            <hr class="light my-4">
            <p class="text-faded mb-4 text-white">
              
            <?php 

function getUrlDbpediaAbstract($term) 
{ 
$format = 'json'; 

$query = 
"PREFIX dbp: <http://dbpedia.org/resource/> 
PREFIX dbp2: <http://dbpedia.org/ontology/> 

SELECT ?Food ?pengertian
WHERE 
{ 
dbo:Food rdfs:label ?Food . 
dbo:Food rdfs:comment ?pengertian.
FILTER langMatches(lang(?Food), 'en'). 
FILTER langMatches(lang(?pengertian), 'en'). 
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
$responseArray = json_decode(request($requestURL),  true); 
?>   


              <?php echo $responseArray["results"]["bindings"][0]["pengertian"]["value"] ?> (DBPEDIA)
              <br/> 


            </p>
            <a class="btn btn-light btn-xl js-scroll-trigger" href="<?php echo base_url().'index.php/web/about'?>">More About Food >></a>
          </div>
        </div>
      </div>
    </section>

    <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">How To Use</h2>
            <hr class="my-4">
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fa fa-4x fa-diamond text-primary mb-3 sr-icons"></i>
              <h3 class="mb-3">FOOD</h3>
              <p class="text-muted mb-0">Search more about Food</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fa fa-4x fa-paper-plane text-primary mb-3 sr-icons"></i>
              <h3 class="mb-3">Foodlist & Restaurant</h3>
              <p class="text-muted mb-0">Find your food and restaurant</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fa fa-4x fa-newspaper-o text-primary mb-3 sr-icons"></i>
              <h3 class="mb-3">Nutrition</h3>
              <p class="text-muted mb-0">Know your nutrition well</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box mt-5 mx-auto">
              <i class="fa fa-4x fa-heart text-primary mb-3 sr-icons"></i>
              <h3 class="mb-3">Chef</h3>
              <p class="text-muted mb-0">Find your favorite chef</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="p-0" id="portfolio">
      <div class="container-fluid p-0">
        
         
<center>


<div class="widget_wrap" style="width:80%;height:1000px;display:inline-block;"><iframe src="https://www.zomato.com/widgets/all_collections.php?theme=red&widgetType=large" style="position:relative;width:100%;height:100%;" border="0" frameborder="0"></iframe></div>

</center>

      </div>
    </section>

    <section class="bg-dark text-white">
      <div class="container text-center">
        <h2 class="mb-4">Now See Your Favorite Chef!</h2>
        <a class="btn btn-light btn-xl sr-button" href="<?php echo base_url().'index.php/web/chef' ?>">Cheflist</a>
      </div>
    </section>