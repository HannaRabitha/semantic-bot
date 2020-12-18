<?php
$curl = curl_init();		// inisialisasi resource / session

$url = "http://localhost/food/other/namespace.txt";
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$res = curl_exec($curl);
?>
<div class="container-fluid content">
    <div id="inner-content">
        <div id="home-body" style="background-color:white">
            <?php

                echo "<pre>";
                print_r($res);
                echo "</pre>"

            ?>
        </div>
    </div>
</div>

<?php

    curl_close($curl);

?>
