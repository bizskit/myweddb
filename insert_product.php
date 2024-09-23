<?php
include ('connectdb.php'); 
session_start();

$errors = array();

$IDname = $_POST['IDname'];
$modelID = $_POST['modelID'];
$brandID = $_POST['brandID'];
$price = $_POST['price'];


// Upload image
if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'pro_'.uniqid().".".pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "./image/".$new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'],$image_upload_path);
    } else {
    $new_image_name = "question-mark.png";
}

$chack_sql = "SELECT * FROM product WHERE pro_id = '$IDname' ";
$query = mysqli_query($conn,$chack_sql);
$result = mysqli_fetch_assoc($query);

if($result){
    if($result['pro_id'] === $IDname){array_push($errors,"*มีข้อมูลรถจักรยานยนต์อยู่แล้ว กรุณากรอกข้อมูลใหม่*");
    }
}

if(count($errors) == 0){
   $sql = "INSERT INTO product(pro_id,model_id,brand_id,price,image) 
    VALUES ('$IDname','$modelID','$brandID','$price','$new_image_name')";
    mysqli_query($conn,$sql);


    echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
    echo "<script> window.location='show_product.php'; </script>";
    //header('location:menu_product.php');
}else{
    array_push($errors,"*มีข้อมูลรถจักรยานยนต์อยู่แล้ว กรุณากรอกข้อมูลใหม่*");
    $_SESSION['error_product'] = "*มีข้อมูลรถจักยานยนต์อยู่แล้ว กรุณากรอกข้อมูลใหม่*";
    header('location:fr_product.php');
}


// $sql = "INSERT INTO product(pro_id,model_id,brand_id,price,image) 
// VALUES ('$IDname','$modelID','$brandID','$price','$new_image_name')";
// $result = mysqli_query($conn,$sql);



// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


// try {
//     // Connect to the database
//     include 'connectdb.php';
  
    
//     $sql = "INSERT INTO product(pro_id,model_id,brand_id,price,image) 
//     VALUES ('$IDname','$modelID','$brandID','$price','$new_image_name')";

//     $stmt = $conn->prepare($sql);
//     // $stmt->bind_param($_POST['IDname'], $_POST['modelID'], $_POST['brandID'], $_POST['price']);
//     $stmt->execute();
//     //$stmt->close();

// }catch (Exception $sql){
//     if ($sql->getCode() == 1062) { // 1062 = Unique constraint error code
//         // Unique field error, handle it
//         // If you only have unique on the email, example: 
//         // echo 'The email already exists';
//         error_log($sql->getMessage());
//         echo "<script> alert('มีข้อมูลรถจักยายนตร์อยู่แล้ว'); </script>";
//         echo "<script> window.location='fr_product.php'; </script>";
//     } else {
//         // Handle the error, something else went wrong
//         $sql->getMessage();
//         echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
//         echo "<script> window.location='show_product.php'; </script>";
//         exit(0);
//     }
// }

// if($result){
//     echo "<script> alert('บันทึกข้อมูลเรียบร้อย'); </script>";
//     echo "<script> window.location='show_product.php'; </script>";
//     exit(0);
// }else{
//     echo "Error: ".$sql."<br>".mysqli_error($conn);
//     echo "<script> alert('ไม่สามารถบันทึกข้อมูล'); </script>";
//     echo "<script> window.location='fr_product.php'; </script>";
//     exit(0);
// }

// try{
//     $checkId_pro = $conn->prepare("SELECT pro_id FROM product WHERE pro_id = pro_id"); 
//     $checkId_pro->bind_param("pro_id", $IDname);
//     $checkId_pro->execute();
//     $row = $checkId_pro->fetch(PDO::FETCH_ASSOC);

//     if($row){
//             // $_SESSION['error_ISBN'] = "มี Id isbn นี้อยู่ในระบบแล้ว";
//             // header("location: ../admin/insert_book_page.php");
//             echo "Error: ".$sql."<br>".mysqli_error($conn);
//             echo "<script> alert('มีข้อมูลรถจักยายนตร์อยู่แล้ว'); </script>";
//             echo "<script> window.location='fr_product.php'; </script>";
//         } else {
//             $stmt = $conn->prepare("INSERT INTO product(pro_id,model_id,brand_id,price,image) 
//             VALUES ('$IDname','$modelID','$brandID','$price','$new_image_name')");
//             $stmt->bind_param("pro_id", $IDname);
//             $stmt->bind_param("model_id", $modelID);
//             $stmt->bind_param("brand_id", $brandID);
//             $stmt->bind_param("price", $price);
//             $stmt->bind_param("image", $new_image_name);
//             $stmt->execute();
//     }
// }catch(Throwable $e){

// }

mysqli_close($conn);
?>