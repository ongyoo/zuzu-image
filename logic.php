<?php
require_once 'CovertImage.php';
$water_marks = $_FILES['input_water_marks'];
$images = $_FILES['input_images'];
//var_dump($_POST['input_water_marks']);
//var_dump($_POST['input_images']);
//var_dump($_FILES['input_water_marks']);
//exit();
if(isset($water_marks) && isset($images)){
    foreach($_FILES['input_water_marks']['tmp_name'] as $key => $tmp_name) {
        $file_name_water = $key.$water_marks['name'][$key];
        $file_size_water = $water_marks['size'][$key];
        $file_tmp_water = $water_marks['tmp_name'][$key];
        $file_type_water = $water_marks['type'][$key]; 
        //move_uploaded_file($_FILES["input_water_marks"]["tmp_name"][$key1], "upload/" . $_FILES["input_water_marks"]["name"][$key1]); //Move the file from the temporary position till a new one. 
        loopDownload($images, $_FILES, $file_tmp_water, $file_name_water);
    }
}

function loopDownload($images, $fileData,$file_tmp_water, $file_name_water) {
    // foreach($fileData['input_images']['tmp_name'] as $key => $tmp_name) {
    //     $file_name_image = $key.$images['name'][$key];
    //     $file_size_image = $images['size'][$key];
    //     $file_tmp_image = $images['tmp_name'][$key];
    //     $file_type_image = $images['type'][$key];  
    //     //move_uploaded_file($_FILES["input_images"]["tmp_name"][$key2], "upload/" . $_FILES["input_images"]["name"][$key2]); //Move the file from the temporary position till a new one. 
    //     //$realImages = imagecreatefromjpeg($_FILES['txtfile']['tmp_name']);
        
    // }

    for ($key = 0; $key <= count($fileData['input_images']['tmp_name']); $key++) {
        $file_name_image = $key.$images['name'][$key];
        $file_size_image = $images['size'][$key];
        $file_tmp_image = $images['tmp_name'][$key];
        $file_type_image = $images['type'][$key];  
        if (move_uploaded_file($file_tmp_water, __DIR__.'/uploads/'. $file_name_water)
        && move_uploaded_file($file_tmp_image, __DIR__.'/uploads/'. $file_name_image)) {
            echo "Uploaded";
            $covertImage = new CovertImage();
            $covertImage -> download($file_name_water, $file_name_image, $key);
        }
    } 
}
// for ($w = 0; $w <= count($water_marks); $w++) {
//     for ($imgs = 0; $imgs <= count($images); $imgs++) {
//         download($water_marks[$w], $images[$imgs]);
//     } 
// } 
?>

<?php
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
?>