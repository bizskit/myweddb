<?php
include 'connectdb.php'; 
$pro_id = $_GET['id'];
$sql = "DELETE FROM product WHERE pro_id='$pro_id' ";

if(mysqli_query($conn,$sql)){
    echo "<script> alert('ลบข้อมูลเรียบร้อย'); </script>";
    echo "<script> window.location='show_product.php'; </script>";
}else if( mysqli_error($conn)){
    echo "<script> alert('ไม่สามารถลบข้อมูลได้'); </script>";
}

mysqli_close($conn);

?>