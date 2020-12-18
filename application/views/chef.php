<?php
$author = @$_GET['author'];
$swords = '';
$kalimat = '';

if(strpos($author,' ')!==false){ //This means it is multiple words strings
   $swords = explode(" ", $author);
   $kalimat = implode("_", $swords);
}else{
   $kalimat = $author;   //in this case array words contains the single entered words
}

function getUrlDbpediaAbstract($kalimat)
{
   $format = 'json';

   $query = 
   "PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
   PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
   PREFIX dbpedia: <http://dbpedia.org/resource/>
   PREFIX ontology: <http://dbpedia.org/ontology/>
   SELECT DISTINCT ?nama ?abstract ?nationality ?homepage  ?birthDate ?wikipedia ?thumbnail
   WHERE
      {
      dbpedia:".$kalimat." rdfs:label ?nama.
      FILTER langMatches(lang(?nama), 'en').
      OPTIONAL{
         dbpedia:".$kalimat." ontology:abstract ?abstract.
         FILTER langMatches(lang(?abstract), 'en').
      }
      OPTIONAL{
         dbpedia:".$kalimat." dbo:birthDate ?birthDate.
      }
      OPTIONAL{
         dbpedia:".$kalimat." dbo:nationality ?national.
         ?national rdfs:label ?nationality.
         FILTER langMatches(lang(?nationality), 'en').
      }
      OPTIONAL{
         dbpedia:".$kalimat." foaf:homepage ?homepage.
      }
      OPTIONAL{
         dbpedia:".$kalimat." dbo:wikiPageID ?wikipedia.
      }
      OPTIONAL{
         dbpedia:".$kalimat." dbo:thumbnail ?thumbnail.
      }
   }";
   $searchUrl = 'http://dbpedia.org/sparql?'.'query='.urlencode($query).'&format='.$format;
     
   return $searchUrl;
}
function buku($kalimat){
   $format = 'json';

   $query = "
   PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
   PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
   PREFIX dbpedia: <http://dbpedia.org/resource/>
   PREFIX ontology: <http://dbpedia.org/ontology/>

   select distinct ?titlebook  ?authorname
   where {
   ?s rdf:type ontology:Book.
   ?s  rdfs:label ?titlebook.
   ?s  ontology:author ?author.
   ?author rdfs:label ?authorname.
   FILTER (lang(?titlebook) = 'en').
   FILTER (lang(?authorname) = 'en').
   FILTER regex(str(?author), '".$kalimat."').
   }";
   $searchUrl = 'http://dbpedia.org/sparql?'.'query='.urlencode($query).'&format='.$format;
     
   return $searchUrl;
}
function hitung($kalimat){
   $format = 'json';
   $query = "
   PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
   PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
   PREFIX dbpedia: <http://dbpedia.org/resource/>
   PREFIX ontology: <http://dbpedia.org/ontology/>

   select distinct count(?titlebook) as ?total
   where {
   ?s rdf:type ontology:Book.
   ?s  rdfs:label ?titlebook.
   ?s  ontology:author ?author.
   ?author rdfs:label ?authorname.
   FILTER (lang(?titlebook) = 'en').
   FILTER (lang(?authorname) = 'en').
   FILTER regex(str(?author), '".$kalimat."').
   }";
   $htg = 'http://dbpedia.org/sparql?'.'query='.urlencode($query).'&format='.$format;
     
   return $htg;
}

include "curl.php";
$requestURL = getUrlDbpediaAbstract($kalimat);
//memanggil curl.php dengan url dari query
$responseArray = json_decode(request($requestURL), true); 
$booklist = json_decode(request(buku($kalimat)),true);
$hitung_karya = json_decode(request(hitung($kalimat)), true); 

$total = $hitung_karya["results"]["bindings"][0]["total"]["value"];
?>



<!DOCTYPE html>
<html>
<head>
   <title>Bookmarker Penulis</title>
   <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<body>


<div id="header"></div>


<div>
   <div id="judul"><h1><?php echo $author?></h1></div> 

<br/>
   <?php echo $responseArray["results"]["bindings"][0]["nama"]["value"] ?><br/>
   <?php 
   $photo_url = $responseArray["results"]["bindings"][0]["thumbnail"]["value"];
   print "<img src='".$photo_url."' />";
   ?>
   <?php echo $responseArray["results"]["bindings"][0]["abstract"]["value"] ?><br/>
   <?php echo $responseArray["results"]["bindings"][0]["birthDate"]["value"] ?><br/>
   <?php echo $responseArray["results"]["bindings"][0]["nationality"]["value"] ?><br/>
   <?php echo $responseArray["results"]["bindings"][0]["homepage"]["value"] ?><br/>
   <?php echo $responseArray["results"]["bindings"][0]["wikipedia"]["value"] ?><br/> 

   <h1>Karya</h1>
   <?php
   for ($b=0; $b<$total ; $b++) { ?>
   <?php echo $booklist["results"]["bindings"][$b]["titlebook"]["value"];?><br/>   
   <?php } ?>

</div>


<div id="footer"></div>


</body>