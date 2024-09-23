<?php
include 'connectdb.php'; 
session_start();
if (!isset($_SESSION['username'])) {
    // $_SESSION['msg'] = "กรุณาเข้าสู่ระบบ";
    header("location:login.php");
}

$idpro = $_GET['id'];
$sql1 = "SELECT * FROM product WHERE pro_id='$idpro' ";
$sql2 = "SELECT * FROM product WHERE pro_id='$idpro' ";
$result = mysqli_query($conn,$sql1);
$result2 = mysqli_query($conn,$sql2);
$rs = mysqli_fetch_array($result);
$rm = mysqli_fetch_array($result2);
$p_brandID = $rs['brand_id'];
$p_modelID = $rm['model_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลรถจักรยานยนต์</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="myself.css">
    <link rel="icon" type="image/png" href="image/5731465.png"/>

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
        }
</style>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col align-self-center">
                <div class="alert color-myself h4 text-center mb-4 mt-4 " role="alert">
                    แก้ไขข้อมูลรถจักรยานยนต์
                </div>
                <form name="form1" method="post" action="updata_product.php" enctype="multipart/form-data">
                    <label>ทะเบียนรถจักรยานยนต์: </label>
                    <input type="text" name="proid" class="form-control" readonly value=<?=$rs['pro_id']?>>
                    <br>
                    <label>รุ่นรถจักรยานยนต์: </label> 
                    <!-- <input type="text" name="pname" class="form-control" value="<?=$rs['pro_name']?>"> -->
                    <select class="form-select" name="modelID">
                        <?php 
                        $sql="SELECT * FROM model ORDER BY model_name";
                        $hand=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_array($hand)){
                            $mmodelID = $row['model_id'];
                        ?>
                            <option value ="<?=$row['model_id']?>"<?php if($p_modelID == $mmodelID){echo "selected=selected";} ?>  >    
                            <?=$row['model_name']?></option>
                        <?php
                        }
                        // mysqli_close($conn);
                        ?>
                    </select> 
                    <br>
                    <label>ยี่ห้อรถจักรยานยนต์: </label>
                    <select class="form-select" name="brandID">
                        <?php 
                        $sql="SELECT * FROM brand ORDER BY brand_name";
                        $hand=mysqli_query($conn,$sql);
                        while($row=mysqli_fetch_array($hand)){
                            $bbrandID = $row['brand_id'];
                            ?>
                            <option value ="<?=$row['brand_id']?>"<?php if($p_brandID == $bbrandID){echo "selected=selected";} ?>  >    
                            <?=$row['brand_name']?></option>
                            <?php
                        }
                        mysqli_close($conn);
                            ?>
                    </select> 
                    <br>
                    <lab>ราคา: </lab>
                    <input type="number" name="price" class="form-control" value=<?=$rs['price']?>> 
                    <br>
                    <lab>รูปภาพ: </lab><br>
                    <img class="img-myself" src="image/<?=$rs['image']?>"><br><br>
                    <input type="file" name="file1"> 
                    <br><br>
                    <input type="hidden" name="txtimg" class="form-control" value=<?=$rs['image']?>> 
                    
                    <button type="submit" class="btn btn-outline-warning">Update</button>
                    <!-- <input class="btn btn-outline-warning" type="reset" value="Reset"> -->
                    <a class="btn btn-outline-danger" href="show_product.php" role="button">Cancel</a>
                </form><br>
            </div>
        </div>
    </div>
    
</body>
</html>