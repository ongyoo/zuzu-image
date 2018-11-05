<?php
class CovertImage {
    function download($water_mark, $image, $id) {
    
    // Load the stamp and the photo to apply the watermark to
 $stamp = imagecreatefrompng(__DIR__.'/uploads/'.$water_mark);   
 $im = imagecreatefromjpeg(__DIR__.'/uploads/'.$image);
//$stamp = imagecreatefrompng('logo_mini.png');
//$im = imagecreatefromjpeg('Nomad-1-desktop-The-Eisen.jpg');

// Set the margins for the stamp and get the height/width of the stamp image
$marge_right = 10;
$marge_bottom = 10;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

// Copy the stamp image onto our photo using the margin offsets and the photo 
// width to calculate positioning of the stamp. 
imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

// Output and free memory
header('Content-type: image/png');
header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.'imageZuZu'.$id.uniqid().'png');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        ob_clean();
        flush();
        readfile(imagepng($im));
}
}
?>