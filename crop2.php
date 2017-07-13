<?php

/**
 * Jcrop image cropping plugin for jQuery
 * Example cropping script
 * @copyright 2008-2009 Kelly Hallman
 * More info: http://deepliquid.com/content/Jcrop_Implementation_Theory.html
 */
if (isset($_FILES)) {
  $name = 'uploads/prueba'.time().'.jpg';

  if (move_uploaded_file($_FILES['foto']['tmp_name'], $name)) {
    // echo "El fichero es válido y se subió con éxito.\n";
?>
    <img src="<?php echo $name; ?>" id="target" alt="[Jcrop Example]" style="margin-top: 20px"/>
    <img src="<?php echo $name; ?>" id="original" style="display: none;">
    <div id="preview-pane">
      <div class="preview-container">
        <img src="<?php echo $name; ?>" class="jcrop-preview" alt="Preview" />
      </div>
    </div>
    <div class="preview-pane">
      <form action="crop2.php" id="form" method="post" onsubmit="checkCoords()">
        <input type="hidden" id="x" name="x">
        <input type="hidden" id="y" name="y">
        <input type="hidden" id="w" name="w">
        <input type="hidden" id="h" name="h">
        <button style="margin-top: 30px" type="button" id="cropit">Crop</button>
      </form>
    </div>
<?php
  } else {
      echo "¡Posible ataque de subida de ficheros!\n";
  }

}


?>
