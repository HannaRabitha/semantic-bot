


  <section class="bg-green">

      <div class="container text-center" style="color: white">
       <p class="text-faded mb-4"> <strong> <h3>FIND YOUR FOOD NUTRITIONS</h3> </strong></p>

        

  
        <div id="home-body" style="background-color:#ffffff; color: black;">
            <form>
                <div class="form-group" style="padding:20px">
                    <label for="exampleInputEmail1">Enter Food Name </label>
                    <input type="email" class="form-control" id="inputvalue" aria-describedby="emailHelp">
                </div>
                <button type="button" class="btn btn-primary btn-xl js-scroll-trigger search">Search</button>
            </form>

            <div class="foodList" style="margin-top:50px; text-align:left;">

            </div>
        </div>



<script>
    $(function() {
        var apiKey = "25899c31a27755f2f27cb9369cd271b5";
        var apiId = "578f8aa9";
        var result;
        $(".search").click(function() {
            var value = $("#inputvalue").val();
            value = value.trim();
            value = value.replace(" ", "%20");
            $(".foodList").html("");
            $.ajax({
                method: "GET",
                url: "https://api.nutritionix.com/v1_1/search/" + value + "?fields=item_name%2Citem_id%2Cbrand_name%2Cnf_calories%2Cnf_total_fat&appId=578f8aa9&appKey=25899c31a27755f2f27cb9369cd271b5"
                ,
                success: function(data) {
                    result = data.hits;
                },
                dataType:"json",
                crossDomain:true,
                complete: function() {
                    result.map(function(Data) {
                        $(".foodList").append("<div class='item'>" +
                            "<h3>" + Data.fields.item_name + "</h3>" +
                            "<p>Jumlah : " + Data.fields.nf_serving_size_qty + "</p>" +
                            "<p>Kalori : " + Data.fields.nf_calories + " gr" + "</p>" +
                            "<p>Lemak : " + Data.fields.nf_total_fat + " gr" + "</p>");
                        return Data;
                    });
                }
            });

        });

    });
</script>



      </div>
    </section>
