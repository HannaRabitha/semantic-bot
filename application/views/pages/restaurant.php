

<div class="container-fluid content">
    <div id="inner-content">
        <div id="home-body" style="background-color:#ffffff">

                <?php
                    $ch = curl_init("https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=3.5591103,98.6484404&radius=1500&type=restaurant&key=AIzaSyCpBVkYM1LOH8fIuTO7CAukIdCl3-PTYkg");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    $data = curl_exec($ch);
                    $data = json_decode($data, true);
                    curl_close($ch);

                    ?>


            <p id="listRestaurant" >
                        <?php

                        foreach ($data["results"] as $row) {

                            if(empty($row["name"])) $name = "";
                            else $name = $row["name"];
                            if(empty($row["icon"])) $icon = "...";
                            else $icon = $row["icon"];
                            if(empty($row["rating"])) $rating = "";
                            else $rating = $row["rating"];

                            echo "<h2>" . $name . "</h2>";
                            echo "<img src='" . $icon . "' />";
                            echo "<p>Rating : " . $rating . "</p>";
                            echo "<p>Jalan : " . $row["vicinity"] . "</p>";
                            echo "<p>Status : Buka</p>";
                        }

                        ?>
            </p>
        </div>
    </div>
</div>

