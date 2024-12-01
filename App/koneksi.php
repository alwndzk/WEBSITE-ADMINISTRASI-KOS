<?php

$conn = mysqli_connect("localhost","root","","kost");

if(!$conn) {
    echo "Connection failed";
}