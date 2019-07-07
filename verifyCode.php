<?php
function makeStr($length): string {
   $result = '';
   $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   $charactersLength = strlen($characters);
   for ( $i = 0; $i < $length; $i++ ) {
      $result .= $characters[rand(0, 61)];
   }

   return $result;
}

session_start();
$verifyCode = makeStr(4);
$_SESSION["verifyCode"] = $verifyCode;


// img
$im = imagecreate(80, 31);

$bg = imagecolorallocate($im, 0, 0, 0);
$textcolor = imagecolorallocate($im, 255, 255, 0);

imagestring($im, 10, 10, 5, $verifyCode, $textcolor);


ob_start ();
imagepng($im);
$image_data = ob_get_contents ();

ob_end_clean ();

$image_data_base64 = base64_encode ($image_data);
imagedestroy($im);

echo 'data:image/png;base64,'.$image_data_base64;

?>