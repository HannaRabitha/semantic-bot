
    <div class="container-fluid content">
        <div id="inner-content">
            <div id="home-body body-pos">

                    <?php

                        echo "<h2 style='color:#c0392b'>" . $post["nama"] . "</h2>";
                        echo "<img id='pos' src=" . $this->db->escape($post['gambar']) . "/>";
                        echo "<p class='detail'>" . $post["description"] . "</p>";

                    ?>

            </div>
        </div>
    </div>



