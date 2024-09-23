<?php 
include('connectdb.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมัครสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="myself.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="image/5731465.png"/>
</head>
<style>
    @media (min-width: 1200px) {
        .container {
            max-width: 670px;
        }
    }

    @media (min-width: 992px) {
        .container {
            max-width: 670px;
        }
    }

    @media (min-width: 762px) {
        .container {
            max-width: 670px;
        }
    }

    body {
        background: linear-gradient(275deg,#e66465, #9198e5);
    }

    .container{
        background: whitesmoke;
        border-radius: 15px;
        padding: 1px 20px 20px 20px;
    }

    .alert {
        box-shadow: 10px 10px lightcoral;
    }

    .form-check-input:checked {
    background-color: lightcoral;
    border-color: darkred;
    }

    .btn{
        color: black;
    }

    .btn-light{
        background:  #9198e5 ;
    }

    .btn-light:hover{
        background-color: lightcoral;
        border-color: coral;
        color: white;
    }

    .btn-outline-danger{
        background:  #e66465 ;
    }

    .btn-outline-danger:hover{
        background-color: #9198e5;
        border-color: lightblue;
        transition: 0.3s;
    }
    

</style>

<body>
    <br>
    <div class="container">
        <div class="alert color-myself h4 text-center mt-4 " role="alert">
            สมัครสมาชิก
        </div>
            <?php
            if(isset($_SESSION["error_email"])){
                echo "<div class = 'text-danger'>";
                echo $_SESSION["error_email"];
                echo "</div>";
                unset($_SESSION["error_email"]);
            }
            // echo "<br>";
            ?>

        
        <form method="post" action="insert_register.php" enctype="multipart/form-data">
            <label>อีเมล: </label>
            <input type="email" name="email" class="form-control" required placeholder=กรอกชื่ออีเมล... ><br>
            <label>รหัสผ่าน: </label>
            <input type="password" name="password" class="form-control" required placeholder="กรอกรหัสผ่าน..."><br>

            <label>คำนำหน้า: </label><br>
            <input class="form-check-input" type="radio" name="gender" value="นาย" /> นาย  &nbsp;&nbsp;&nbsp;&nbsp;
            <input class="form-check-input" type="radio" name="gender" value="นาง"/> นาง &nbsp;&nbsp;&nbsp;&nbsp;
            <input class="form-check-input" type="radio" name="gender" value="นางสาว"/> นางสาว <br><br>
            
            <label>ชื่อ: </label>
            <input type="text" name="firstname" class="form-control" required placeholder="กรอกชื่อ..."><br>
            <label>นามสกุล: </label>
            <input type="text" name="lastname" class="form-control" required placeholder="กรอกนามสกุล..."><br>
            <label>เบอร์โทรศัพท์: </label>
            <input type="text" name="phone" class="form-control" pattern="[0-9]*" minlength="10" maxlength="10" required placeholder="กรอกเบอร์โทรติดต่อ..."><br>
            <!-- <label>รูปใบขับขี่: </label>
            <br><input type="file" name="image" required><br> -->

            <div class="text-center">
                <input class="btn btn-light" type="submit" name="submit" value="สมัครเรียบร้อย">
                <a class="btn btn-outline-danger" href="show_product.php" role="button">ยกเลิก</a>
            </div>

        </form>
    </div>
    <script type='text/javascript'>
        //คำสั่งห้ามป้อนอักษรพิเศษ
        function check_number(elm) {
            if (!elm.value.match(/^[0-9]+$/i) && elm.value.length > 0) {
                //alert('ไม่สามารถใช้ตัวอักษรพิเศษได้');
                elm.value = '';
            }
        }
    </script>

</body>
</html>