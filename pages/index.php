
<?php
include '../inc/header.php';



if(isset($_SESSION)){
    include "main.php";
}else{
    include "signin.php";
}


include '../inc/footer.php';



