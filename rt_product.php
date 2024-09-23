<?php  
include 'connectdb.php'; 

session_start();
if (!isset($_SESSION['username'])) {
    // $_SESSION['msg'] = "กรุณาเข้าสู่ระบบ";
    header("location:login.php");
}

date_default_timezone_set('asia/bangkok');

$proid = $_GET['id'];
$datenow = date("Y-m-d");
$sql = " SELECT * FROM product WHERE pro_id='$proid' ";
$result = mysqli_query($conn,$sql);
$rs = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มการจอง</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="myself.css">
    <link rel="icon" type="image/png" href="image/5731465.png"/>

</head>
<style>
    body{
        background-color: lightgray;
    }

    @media (min-width: 1200px) {
        .container {
            max-width: 920px;
        }
    }

    @media (min-width: 992px) {
        .container {
            max-width: 920px;
        }
    }

    @media (min-width: 762px) {
        .container {
            max-width: 920px;
        }
    }

    .container{
        background: white;
        border-radius: 15px;
        padding: 1px 20px 20px 20px;
    }
    
    .alert {
        box-shadow: 10px 10px lightcoral;
        }

    img{
            object-fit:cover;
            width: 300px;
            height: 250px;
            border-radius: 10px;
        }
</style>
<body>
<div class="container">
        <div class="row">
            <div class="col align-self-center">
                <div class="alert color-myself h4 text-center mb-4 mt-4 " role="alert">
                    เพิ่มการจองรถ
                </div>
                <form name="form1" method="post" action="confirm_product.php" enctype="multipart/form-data">
                    <lab>รูปภาพ: </lab><br>
                    <img class="img-myself" src="image/<?=$rs['image']?>">
                    <br><br>
                    <input type="hidden" name="file1" > 
                    <input type="hidden" name="txtimg" class="form-control" value=<?=$rs['image']?>> 
                    <br><br>
                    <label>ทะเบียนรถจักรยานยนต์: </label>
                    <input type="text" name="proid" class="form-control" readonly value=<?=$rs['pro_id']?>>
                    <br>
                    <lab>ราคา: </lab>
                    <input type="number" name="price" class="form-control" readonly value=<?=$rs['price']?>> 
                    <br>
                    <label>ชื่อ: </label>
                    <input type="text" name="fname" class="form-control" required >
                    <br>
                    <label>นามสกุล: </label>
                    <input type="text" name="lname" class="form-control" required >
                    <br>
                    <label>วันที่เช่า: </label> 
                    <input type="date" value="<?php echo $datenow ?>" readonly name="dateget" class="form-control">
                    <br>
                    <label>วันที่คืน: </label>
                    <input type="date" value="<?php echo $datenow ?>" min="<?php echo $datenow ?>" name="datereturn" class="form-control" required >
                    <br>
                    <button type="submit" class="btn btn-outline-success">ยืนยันการเช่า</button>
                    <!-- <input class="btn btn-outline-warning" type="reset" value="Reset"> -->
                    <a class="btn btn-outline-danger" href="menu_product.php" role="button">ยกเลิก</a>
                </form><br>
            </div>
        </div>
    </div>
</body>
</html>