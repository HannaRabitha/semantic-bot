<?php

//include get_include_path() . "/easyrdf/lib/easyrdf.php";
/*
$curl = curl_init();		// inisialisasi resource / session

$url = "http://localhost/food/other/ex002.txt";
curl_setopt($curl, CURLOPT_URL, $url);		// CURLOPT_URL = url yang mau dikirim/diminta datanya
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);	// CURLOPT_SSL_VERIFYPEER = false biar bisa akses https
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$res = curl_exec($curl);
*/

/*
EasyRdf_Namespace::set('keterangan', 'http://kuliner.id/ns/daftar#indonesia#');
EasyRdf_Namespace::set('menu', 'http://kuliner.id/ns/menu#');

$sparql = new EasyRdf_Sparql_Client('http://localhost/food/other/ex002.ttl');

*/

putenv("JENA_HOME=D:\ApacheJena\apache-jena-3.6.0");
$res = shell_exec("D:\ApacheJena\apache-jena-3.6.0\bat\arq --data=\"D:\ApacheJena\Source\\cateringg.ttl\" --query=\"D:\ApacheJena\Sparql\\catering-1.rq\" -out JSON  2>&");
$res = json_decode($res, true);
$res = $res["results"]["bindings"];
?>

<div class="container-fluid content">
    <div id="inner-content">
        <h4 style="margin-top:20px">Get Our Data : <a id='h' type="button" class="btn mybtn" href="<?php echo base_url(); ?>other/kulinerid.ttl">Here !</a></h4>
        <div id="home-body" style="background-color:white" >

            <div class="sejarah">

            </div>
            <div class="service">
                <h2>Jasa Catering Indonesia</h2>
                <?php

                    foreach($res as $data) {
                        echo "<p>";

                       // $x = preg_match( "^(/&#124;#)^", $data["property"]["value"]);
                        $x = substr($data["property"]["value"], strpos($data["property"]["value"], "#") + 1);
                        if ($x == "Nama") {
                            //$y = substr($data["property"]["value"], 0, strpos($data["property"]["value"], "#"));
                            echo "<h5>" . $data["val"]["value"] . "</h5>";
                        }
                        if ($x == "gambar") {

                            $temp = trim($data["val"]["value"], " ");
                            echo '<img style=\'width:200px; height:200px\' src="' . $temp . '" />';


                        }
                        else {
                            echo "" . $x. " =  " . $data["val"]["value"] . "<br>";
                        }

                        //echo "<p> : " . $data["val"]["value"] . "</p>";
                        echo "</p>";
                    }

                ?>
            </div>
            <div class="wisata">

            </div>
        </div>
    </div>
</div>

<?php
   // curl_close($curl);
?>