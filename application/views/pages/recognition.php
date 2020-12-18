
<div class="container-fluid content">
    <div id="inner-content">
        <div id="home-body" style="background-color:#ffffff">
            <form>
                <div class="form-group" style="padding:20px">
                    <label for="exampleInputEmail1">Enter Image Url</label>
                    <input type="email" class="form-control" id="inputvalue" aria-describedby="emailHelp">
                </div>
                <button type="button" class="btn mybtn search">Find Out</button>
            </form>
            <div class="foodList">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://sdk.clarifai.com/js/clarifai-latest.js"></script>
<script>

    $(function() {
        $(".search").click(function() {
            var value = $("#inputvalue").val();
            value = value.trim();
            $(".foodList").html("");
            var img = "<img src='" + value + "' style='text-align:center; width=200px; height:200px' />";
            $(img).insertBefore(".foodList");
            const app = new Clarifai.App({
                apiKey: 'ec28d1e1dc6a4763b58c1e6c33d476c1'
            });

            app.models.predict(Clarifai.GENERAL_MODEL, value).then(
                function(response) {
                    var res = response.outputs[0].data.concepts;
                    var output = "<table class='table table-striped'><thead><tr style='text-align:center'><th>Result</th></thead><tbody>";
                    res.map(function(data) {
                        output += "<tr><td>" + data.name + "</td></tr>";
                    });
                    output += "</tbody></table>";
                    $(".foodList").append(output);
                },
                function(err) {
                    console.error(err);
                }
            );
        });

    });

</script>



