<?php
include 'connectdb.php';
//บังคับให้ต้อง login ก่อนถึงจะเข้าหน้าเพจนี้ได้
session_start();
if (!isset($_SESSION['username'])) {
    // $_SESSION['msg'] = "กรุณาเข้าสู่ระบบ";
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลรถจักรยานยนต์</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="myself.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="image/5731465.png"/>

    <style>
        .navbar {
            padding-top: 10pt;
            padding-bottom: 10pt;
            padding-left: 40pt;
            padding-right: 40pt;
        }

        .navbar-brand {
            font-size: 35px;
        }

        .nav-link{
			padding-bottom: 0px;
		}

        .logout {
            margin-left: 10cm;
        }

        .alert {
            box-shadow: 10px 10px lightcoral;
            margin: 30px;
        }

        .addproduct{
            margin-right: 20px;
            margin-left: 30px;
        }

        img {
            object-fit: cover;
            width: 250px;
            height: 200px;
        }

        .page-link {
            color: #da6666;
        }

        .page-link:hover {
            background-color: #da6666;
            color: white;
        }

        @media only screen and (max-width:992px) {
            .navbar {
                padding-left: 15pt !important;
            }

            .nav-link{
			padding-bottom: 5px;
		}

            img {
                object-fit: cover;
                width: 200px;
                height: 150px;
            }
        }

        @media only screen and (max-width:768) {
            .alert {
                padding-right: 30px !important;
            }
        }

        @media only screen and (max-width:576) {
            .alert {
                padding-right: 30px !important;
            }

            /* .container{
                max-width:auto;
            } */

            .addproduct{
            margin-right: 20px;
            
            }

            .btn{
                margin-left: 20px;
            }

        }
    </style>

</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark color-myself">
        <div class="container-fluid">
            <a class="navbar-brand" href="menu_product.php" >เช่ารถจักรยานยนต์</a>
            <div class="navbar-collapse justify-content-end" id="#">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="show_product.php">จัดการข้อมูลรถจักรยานยนต์</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_rental.php">จัดการข้อมูลการเช่ายืม</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" onclick="Out(this.href);return false;">ออกจากระบบ</a>
                    </li>
                    <li class="nav-link">
                        admin :
                        <?php
                        if (isset($_SESSION["username"])) {
                            echo $_SESSION["username"];
                        }
                        ?>
                    </li>
                </ul>
                <form class="d-flex" method="post" action="show_product.php">
                    <input class="form-control me-2" name="keyword" type="search" placeholder="ค้นหารถจักรยานยนต์..." 
                    value="<?= (isset($_POST['keyword'])) ? $_POST['keyword'] : '' ?>" aria-label="Search">
                    <button class="btn btn-light" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </nav> -->
    <?php
    include 'menu_nav.php'; //navbar
    ?>

    <div class="alert color-myself h4 text-center" role="alert">
        แสดงข้อมูลรถจักรยานยนต์
    </div>

    <div class="addproduct" >
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-danger " href="fr_product.php" role="button" title="เพิ่มรถจักรยานตร์">Add Product</a>
        </div>
    </div>


    <div class="container table-responsive">
        <table class="table text-center table-hover">
            <?php
            $perpage = 5; //กำหนดหน้าเพจ
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $start = ($page - 1) * $perpage;

            $keyword = @$_POST['keyword'];
            if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
                $sql2 = "SELECT * FROM product INNER JOIN brand ON product.brand_id = brand.brand_id
				INNER JOIN model ON  product.model_id = model.model_id WHERE pro_id like '%$keyword%' or
				price <= '$keyword' or model_name like '%$keyword%'or brand_name like '%$keyword%' ORDER BY pro_id
				limit {$start}, {$perpage}";
            } else {
                // $sql="SELECT * FROM product,brand WHERE product.brand_id = brand.brand_id ORDER BY pro_id ";
                // $sql1="SELECT * FROM product,model,brand WHERE product.model_id = model.model_id ORDER BY pro_id ";
                $sql2 = "SELECT * FROM product INNER JOIN brand ON product.brand_id = brand.brand_id
                INNER JOIN model ON  product.model_id = model.model_id ORDER BY pro_id limit {$start}, {$perpage}";
            }
            $hand2 = mysqli_query($conn, $sql2);
            // $hand=mysqli_query($conn,$sql);
            if (mysqli_num_rows($hand2)) { ?>
                <tr class="text-center">
                    <th>ทะเบียนรถจักรยานยนต์</th>
                    <th>รุ่นรถจักรยานยนต์</th>
                    <th>ยี่ห้อรถจักรยานยนต์</th>
                    <th>ราคา</th>
                    <th>รูปภาพ</th>
                    <th>แก้ไขข้อมูล</th>
                    <th>ลบข้อมูล</th>
                </tr><br>
                <?php
                while ($row = mysqli_fetch_array($hand2)) {
                ?>
                    <tr>
                        <td><?= $row['pro_id'] ?></td>
                        <td><?= $row['model_name'] ?></td>
                        <td><?= $row['brand_name'] ?></td>
                        <td><?= $row['price'] ?></td>
                        <td><img src="image/<?= $row['image'] ?>"></td>

                        <?php
                        $idd1 = $row['pro_id'];
                        $sql3 = "SELECT pro_id FROM promise WHERE pro_id = '$idd1' ";
                        $noshow3 = mysqli_query($conn, $sql3);
                        $noshow = mysqli_fetch_array($noshow3);
                        if (isset($noshow['pro_id'])) { ?>
                            <td><a href="#" class="btn btn-secondary" role="button" aria-disabled="true" title="ไม่สามารถแก้ไขได้ขณะนี้"><i class="fa-regular fa-pen-to-square fa-xl"></i></a></td>
                            <td><a href="#" class="btn btn-secondary" role="button" aria-disabled="true" title="ไม่สามารถลบได้ขณะนี้"><i class="fa-regular fa-trash-can fa-xl"></i></a></td>
                        <?php } else { ?>
                            <td><a class="btn btn-outline-warning" href="edit_product.php?id=<?= $row['pro_id'] ?>" title="แก้ไขข้อมูลรถ"><i class="fa-regular fa-pen-to-square fa-xl"></i></a></td>
                            <td><a class="btn btn-outline-danger" href="delete_product.php?id=<?= $row['pro_id'] ?>" onclick="Del(this.href);return false;" title="ลบข้อมูลรถ"><i class="fa-regular fa-trash-can fa-xl"></i></a></td>
                        <?php } ?>
                    </tr>
                <?php
                }
            } else {
                ?>
                <div class="text-center">
                    <br><br><br><br><br><br>
                    <h2>ไม่พบรถจักรยานยนต์</h2>
                    <br><br><br><br><br><br><br><br><br>
                </div>
            <?php
            }
            ?>
        </table><br><br>
    </div>
    <?php
    if (mysqli_num_rows($hand2)) {
        $sql1 = "SELECT * FROM product";
        $query1 = mysqli_query($conn, $sql1);
        $total_record = mysqli_num_rows($query1);
        $total_page = ceil($total_record / $perpage);
    ?>

        <nav aria-label="Page navigation example ">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="show_product.php?page=1" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="show_product.php?page=<?= $i ?>"><?= $i ?></a></li>
                <?php } ?>
                <li class="page-item">
                    <a class="page-link" href="show_product.php?page=<?= $total_page ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    <?php
    }
    mysqli_close($conn);
    ?>

    <footer class="text-center p-4 color-myself">
        <div class="footer-container">
            <p>Copyright &copy; AAA Official 2022</p>
        </div>
    </footer>

</body>

</html>

<script language="JavaScript">
    // คำสั่งยืนยันก่อนจะลบข้อมูล
    function Del(mypage) {
        var agree = confirm("คุณต้องการลบข้อมูลหรือไม่");
        if (agree) {
            window.location = mypage;
        }
    }
</script>

<!-- <script language="JavaScript">
    // คำสั่งยืนยันก่อนจะลบข้อมูล
    function Out(mypage) {
        var agree = confirm("คุณต้องการออกระบบหรือไม่");
        if (agree) {
            window.location = mypage;
        }
    }
</script> -->