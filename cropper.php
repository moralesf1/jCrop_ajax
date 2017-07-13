<?php
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['croperar'])){
		$targ_w = $targ_h = 400;
		$jpeg_quality = 90;

		$src = $_POST['img'];
		$img_r = imagecreatefromjpeg($src);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
		$targ_w,$targ_h,$_POST['w'],$_POST['h']);

		// header('Content-type: image/jpeg');
		imagejpeg($dst_r,'cropped_img/cropped'.time().'.jpg',$jpeg_quality);
		unlink($src);
		exit;
	}

	




?>