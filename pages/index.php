<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 20/01/2018
 * Time: 16:19
 */

include "../inc/header.php";


if(isset($_SESSION)){
    include "pages/main.php";
}else{
    include "pages/signin.php";
}

include "../inc/footer.php";