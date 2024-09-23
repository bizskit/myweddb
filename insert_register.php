<?php 
include ('connectdb.php');
session_start();

$errors = array();
//รับค่าตัวแปรจาก register.php
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$phone = $_POST['phone'];

//เข้ารหัสด้วย sha512
$password = hash('sha512',$password);


// if (is_uploaded_file($_FILES['image']['tmp_name'])) {
//     $new_image_name = 'pic_'.uniqid().".".pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION);
//     $image_upload_path = "./image/".$new_image_name;
//     move_uploaded_file($_FILES['image']['tmp_name'],$image_upload_path);
//      } else {
//      $new_image_name = " ";
// }

// $sql = "INSERT INTO user(user_email,password,title_name,fname,lname,phone,image) 
// VALUES ('$email','$password','$gender','$fname','$lname','$phone','$new_image_name')";
//$result = mysqli_query($conn,$sql);

//จะทำการเช็คว่าข้อมูลตรงกันในระบบรึป่าว
$chack_sql = "SELECT * FROM user WHERE user_email = '$email' ";
$query = mysqli_query($conn,$chack_sql);
$result = mysqli_fetch_assoc($query);

if($result){
    if($result['user_email'] === $email){array_push($errors,"*อีเมลถูกใช้งานไปแล้ว กรุณากรอกข้อมูลใหม่อีกครั้ง*");
    }
}

if(count($errors) == 0){
    $sql = "INSERT INTO user(user_email,password,title_name,fname,lname,phone) 
    VALUES ('$email','$password','$gender','$fname','$lname','$phone')";
    mysqli_query($conn,$sql);

    echo "<script> alert('สมัครสมาชิกเรียบร้อย! เข้าสู่ระบบ'); </script>";
    echo "<script> window.location='login.php'; </script>";
    //header('location:login.php');
}else{
    array_push($errors,"*อีเมลถูกใช้ไปแล้ว กรุณากรอกข้อมูลใหม่อีกครั้ง*");
    $_SESSION['error_email'] = "*อีเมลถูกใช้ไปแล้ว กรุณากรอกข้อมูลใหม่อีกครั้ง*";
    header('location:register.php');
}

// if($result){
//     echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
//     echo "<script> window.location='login.php'; </script>";
// }else{
//     echo "Error: ".$sql."<br>".mysqli_error($conn);
//     echo "<script> alert('ไม่สามารถบันทึกข้อมูล'); </script>";
// }

// if(!$result){
//     die("อีเมลนี้ถูกใช้แล้ว".mysqli_error($conn));
// }else{
//     echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
//     echo "<script> window.location='login.php'; </script>";
// }

mysqli_close($conn);
?>