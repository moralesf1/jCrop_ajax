<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['borrar'])){
    $img = $_POST['img'];
    if (unlink($img)) {
      echo json_encode(array('status' => 1));
    }
    else{
      echo json_encode(array('status' => 0));
    }
  }


?>
