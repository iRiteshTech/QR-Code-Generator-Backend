<?php

include "db.php";

$text = $_POST['text'];
$image = $_POST['image'];

$sql = "INSERT INTO qr_history(text_url, qr_image)
VALUES('$text','$image')";

if($conn->query($sql)){
    echo "success";
}else{
    echo "error";
}

?>