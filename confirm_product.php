<?php 
include 'connectdb.php'; 
$errors = array();

$proid = $_POST['proid'];
$price = $_POST['price'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dateget = $_POST['dateget'];
$datereturn = $_POST['datereturn'];
$image = $_POST['txtimg'];
$new_image_name = "$image";

$remain = intval(strtotime($datereturn)-strtotime($dateget));
$wan = floor($remain/86400);

if($wan != 0){
    $totalprice = $price * $wan;
    number_format($totalprice);
}else{
    $wan = $wan+1;
    $totalprice = $price * $wan;
    number_format($totalprice);
}

// if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
//     $new_image_name = 'pro_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
//     $image_upload_path = "./image/".$new_image_name;
//     move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
//     } else {
//     $new_image_name = "$image";
//     }

$chack_sql = "SELECT * FROM promise WHERE pro_id = '$proid' ";
$query = mysqli_query($conn,$chack_sql);
$result = mysqli_fetch_assoc($query);

if($result){
    if($result['pro_id'] === $proid){array_push($errors,"*รถจักยานยนต์ถูกเช่าแล้ว กรุณาเลือกคันใหม่*");
    }
}

if(count($errors) == 0){
    $sql = "INSERT INTO promise(pro_id,image,price,firstname,lastname,date_get,date_return) 
     VALUES ('$proid','$new_image_name','$totalprice','$fname','$lname','$dateget','$datereturn')";
     mysqli_query($conn,$sql);
 
 
     echo "<script> alert('บันทึกข้อมูลการเช่าเรียบร้อย'); </script>";
     //echo "<script> window.location='menu_product.php'; </script>";
     header('location:menu_product.php');
 }else{
    //  array_push($errors,"*รถจักยานยนต์ถูกเช่าแล้ว กรุณาเลือกคันใหม่*");
    //  $_SESSION['error_product'] = "*รถจักยานยนต์ถูกเช่าแล้ว กรุณาเลือกคันใหม่*";
    //  header('location:menu_product.php');

     echo "<script> alert('รถจักยานยนต์ถูกเช่าแล้ว กรุณาเลือกคันใหม่'); </script>";
     echo "<script> window.location='menu_product.php'; </script>";
 }

 mysqli_close($conn);

?>