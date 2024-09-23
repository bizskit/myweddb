<?php 
include 'connectdb.php';
session_start()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าระบบ</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="myself.css">
    <link rel="icon" type="image/png" href="image/5731465.png"/>
</head>

<style>
    @media (min-width: 1200px) {
        .container {
            max-width: 620px;
        }
    }

    @media (min-width: 992px) {
        .container {
            max-width: 620px;
        }
    }

    @media (min-width: 762px) {
        .container {
            max-width: 620px;
        }
    }

    body {
        background: linear-gradient(275deg, #6495ED, #FF7F50);
    }

    .container {
        background: whitesmoke;
        border-radius: 15px;
        padding: 1px 20px 20px 20px;
    }

    .alert {
        box-shadow: 10px 10px lightcoral;
    }

    .btn-light {
        background: #6495ED;
    }

    .btn-light:hover {
        background-color: lightcoral;
        border-color: coral;
        color: white;
    }

    .btn {
        height: 45px;
        width: 100%;
    }
</style>

<body>
    <br><br><br><br>
    <div class="container">
        <div class="alert color-myself h4 text-center mt-4 " role="alert">
            เข้าสู่ระบบ
        </div>
        <form method="post" action="login_check.php" enctype="multipart/form-data">
            <label>อีเมล: </label>
            <input type="text" name="username" class="form-control" required placeholder="ชื่อบัญชี..."><br>
            <label>รหัสผ่าน: </label>
            <input type="password" name="password" class="form-control" required placeholder="รหัสผ่าน..."><br>
            <?php
            if(isset($_SESSION["Error"])){
                echo "<div class = 'text-danger'>";
                echo $_SESSION["Error"];
                echo "</div>";
                unset($_SESSION["Error"]);
            }
            // echo "<br>";
            ?>
            <div class="text-center">
                <input class="btn btn-light" type="submit" name="loginsubmit" value="เข้าสู่ระบบ">
            </div>
        </form>
        <br><br><br>
        <div class="text-center">
            ถ้าคุณต้องการเป็นสมาชิก <a href="register.php">สมัครสมาชิก</a>?
        </div>
    </div>


</body>

</html>