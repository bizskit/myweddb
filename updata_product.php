<?php
include 'connectdb.php'; 
$proid = $_POST['proid'];
$modelid = $_POST['modelID'];
$brandid = $_POST['brandID'];
$price = $_POST['price'];
$image = $_POST['txtimg'];


if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'pro_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "./image/".$new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
    } else {
    $new_image_name = "$image";
    }

//updata product
$sql = "UPDATE product SET model_id ='$modelid',brand_id ='$brandid',price ='$price',image ='$new_image_name' 
WHERE pro_id ='$proid' ";

$result = mysqli_query($conn,$sql);
if($result){
echo "<script> alert('แก้ไขข้อมูลเรียบร้อย'); </script>";
echo "<script> window.location='show_product.php'; </script>";
}else{
    echo "<script> alert('ไม่สามารถแก้ไขข้อมูลได้'); </script>";
}

?>
