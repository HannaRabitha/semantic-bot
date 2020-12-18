

<div class="container-fluid content">
    <div id="inner-content">
        <div id="home-body">
                <?php

                foreach($post as $row) {
                    echo "<div id='ctx'>";
                    echo "<h2 class='judul'><a id='p' href='" . base_url() . "post/id1'>" . $row["nama"] . "</a></h2>";
                    echo "<img class='postimg' src=" . $this->db->escape($row['gambar']) . "/>";
                    echo "<div class='desc'>". $row['description'] . "</div>";
                    echo "<a href='" . base_url() . "post/" . $row["kode_makanan"] . "' type='button' class='btn btn-danger postbtn'>Read More</a>";
                    echo "</div>";
                }

                ?>
            </div>
        </div>
    </div>



