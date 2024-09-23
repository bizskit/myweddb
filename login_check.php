ฒ<?php 
include 'connectdb.php'; 
session_start();

$username = $_POST['username'];
$password = $_POST['password'];
//$admin = $_POST['username'];

//เข้ารหัสด้วย sha512
$password = hash('sha512',$password);

$sql = "SELECT * FROM user WHERE user_email = '$username' 
and password = '$password' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result);
// $level = $row['level'];

// $sql1 = "SELECT * FROM admin WHERE admin_user = '$admin' 
// and password = '$password';
// $result1 = mysqli_query($conn,$sql);
// $row1 = mysqli_fetch_array($result1);

if($row > 0){
    $_SESSION["username"] = $row['user_email'];
    $_SESSION["password"] = $row['password'];
    $_SESSION["firstname"] = $row['fname'];
    $_SESSION["lastname"] = $row['lname'];
    $_SESSION["image"] = $row['image'];

    // if($level == ''){
    //     $show = header('location:menu_product.php');
    // }elseif($level == '1'){
    //     $show = header('location:show_product.php');
    // }

}else{
    $_SESSION["Error"] = "*ผิดพลาด กรุณากรอกข้อมูลให้ถูกต้อง*";
    header("location:login.php");
}
// echo $show;
header("location:menu_product.php");

mysqli_close($conn);
?>