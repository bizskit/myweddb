<?php
include 'connectdb.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มรถจักรยานยนต์</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="myself.css">

</head>
<style>
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

    .btn:hover{
        color:white;
    }
</style>

<body><br><br>
    <div class="container">
        <div class="row">
            <div class="col align-self-center">
                <div class="alert color-myself h4 text-center mb-4 mt-4 " role="alert">
                    เพิ่มรถจักรยานยนต์
                </div>
                <?php
                if(isset($_SESSION["error_product"])){
                    echo "<div class = 'text-danger'>";
                    echo $_SESSION["error_product"];
                    echo "</div>";
                    unset($_SESSION["error_product"]);
                }
                // echo "<br>";
                ?>
                <form name="form1" method="post" action="insert_product.php" enctype="multipart/form-data">
                    <label>ทะเบียนรถจักรยานยนต์: </label>
                    <input type="text" onkeyup='check_char(this)' name="IDname" class="form-control" required placeholder="ทะเบียนรถจักรยานยนต์...">
                    <br>
                    <label>รุ่นรถจักรยานยนต์: </label>
                    <select class="form-select" name="modelID" required>
                        <option value=""> --> เลือกรุ่นรถจักรยานยนต์ <-- </option>
                                <?php
                                $sql = "SELECT * FROM model ORDER BY model_name";
                                $hand = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($hand)) {
                                ?>
                        <option value="<?= $row['model_id'] ?>"><?= $row['model_name'] ?></option>
                    <?php
                                }
                                // mysqli_close($conn);
                    ?>
                    </select>
                    <br>
                    <label>ยี่ห้อรถจักรยานยนต์: </label>
                    <select class="form-select" name="brandID" required>
                        <option value="">--> เลือกยี่ห้อรถจักรยานยนต์ <-- </option>
                                <?php
                                $sql = "SELECT * FROM brand ORDER BY brand_name";
                                $hand = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($hand)) {
                                ?>
                        <option value="<?= $row['brand_id'] ?>"><?= $row['brand_name'] ?></option>
                    <?php
                                }
                                mysqli_close($conn);
                    ?>
                    </select>
                    <br>
                    <label>ราคา: </label>
                    <input type="number_format" pattern="[0-9]*" min="0" name="price" class="form-control" required placeholder="ราคา...">
                    <br>
                    <label>รูปภาพ: </label><br>
                    <!-- <img src="image/<?= $new_image_name ?>"><br><br> -->
                    <input type="file" name="file1" required>
                    <br><br>
                    <button type="submit" class="btn btn-outline-success">Submit</button>
                    <input class="btn btn-outline-warning" type="reset" value="Reset">
                    <a class="btn btn-outline-danger" href="show_product.php" role="button">Cancel</a>
                </form><br>
            </div>
        </div>
    </div>

    <script type='text/javascript'>
        //คำสั่งห้ามป้อนอักษรพิเศษ
        function check_char(elm) {
            if (!elm.value.match(/^[ก-ฮa-z0-9]+$/i) && elm.value.length > 0) {
                alert('ไม่สามารถใช้ตัวอักษรพิเศษได้');
                elm.value = '';
            }
        }
    </script>

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