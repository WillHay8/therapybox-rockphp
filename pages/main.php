<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 20/01/2018
 * Time: 16:21
 */

    include "../inc/header.php";

?>
    <style>
        .box{
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: "http://api.openweathermap.org/data/2.5/weather?lat=35&lon=139&appid=d0a10211ea3d36b0a6423a104782130e",
                context: document.body
            }).done(function(data) {
                console.log(data);
                document.querySelector(".weather").textContent = "Temp is(in K): "+data.main.temp + " in " + data.name ;
            });


        });

        var isBlink=false;

        setInterval(function () {
            if(!isBlink){
                document.querySelector(".swapnill").style.opacity="1";
                isBlink=true;
            }else{
                document.querySelector(".swapnill").style.opacity="0";
                isBlink=false;
            }

        },500);
    </script>
<div>
    <h1 class="text-center swapnill">Good day Swapnil!</h1>
</div>
<div class="container">
    <div class="row">
        <div class="box col-md-4">
            <div>Weather</div>
            <div class="weather"></div>
        </div>
        <div class="box col-md-4">SSS</div>
        <div class="box col-md-4">SSS</div>
    </div>
    <div class="row">
        <div class="box col-md-4">XX</div>
        <div class="box col-md-4">XX</div>
        <div class="box col-md-4">XX</div>
    </div>
</div>

<?php
include "../inc/footer.php";
?>