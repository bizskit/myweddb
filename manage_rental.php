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
    <title>จัดการข้อมูลการเช่ายืม</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="myself.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/png" href="image/5731465.png"/>

</head>
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

    img {
        object-fit: cover;
        width: 250px;
        height: 200px;
    }

    .btn {
        font-size: 20px;
    }

    .page-link {
        color: #da6666;
    }

    .page-link:hover {
        background-color: #da6666;
        color: white;
    }

    @media screen and (max-width: 1344px){
    

    }

    @media screen and (max-width: 992px) {

        .nav-link{
			padding-bottom: 5px;
		}

        .container {
            max-width: 960px;
        }

        img {
            object-fit: cover;
            width: 200px;
            height: 150px;
        }
    }

    @media screen and (max-width: 768px) {
        .navbar {
            padding-top: 10pt;
            padding-bottom: 10pt;
            padding-left: 25pt;
            padding-right: 25pt;
        }

        .container {
            max-width: 720px;
        }

        img {
            object-fit: cover;
            width: 150px;
            height: 100px;
        }

        .btn {
            font-size: 15px;
        }

        footer p {
            font-size: 15px;
            margin: 10px;
        }

    }

    @media screen and (max-width: 576px) {

        .alert {
            box-shadow: 10px 10px lightcoral;
            /* margin: 40px; */
            margin-left: 40px;
            margin-right: 40px;
        }

        .btn {
            font-size: 15px;
        }

        th,
        td {
            font-size: 10px;
        }

        img {
            object-fit: cover;
            width: 120px;
            height: 90px;
        }

        footer p {
            font-size: 13px;
            margin: 10px;
        }
    }

</style>

<body>
    <?php
    include 'menu_nav.php'; //navbar
    ?>

    <!-- <div class="box-alert"> -->
    <div class="alert color-myself h4 text-center" role="alert">
        แสดงข้อมูลการเช่า
    </div>
    <!-- </div> -->
    <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-danger " href="fr_product.php" role="button">Add Product</a>
        </div> -->

    <div class="container table-responsive ">
        <table class="table text-center table-hover">

            <!-- <tr class="text-center">
                <th>เลขใบสัญญา</th>
                <th>ทะเบียน</th>
                <th>ชื่อ</th>
                <th>นามสกุล</th>
                <th>วันที่เช่า</th>
                <th>วันที่คืน</th>
                <th>ราคารวม</th>
                <th>รูปภาพ</th>
                <th>ส่งคืน</th>
            </tr><br> -->
            <?php
            $perpage = 4; //กำหนดหน้าเพจ
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $start = ($page - 1) * $perpage;

            $keyword = @$_POST['keyword'];
            if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
                // $sql2 = "SELECT * FROM promise WHERE promise_id like '%$keyword%' or 
                // price <= '$keyword' or firstname like '%$keyword%' or lastname like '%$keyword%' or date_get like '%$keyword%' 
                // or date_return like '%$keyword%' ORDER BY promise_id limit {$start}, {$perpage}";

                $sql2 = "SELECT * FROM promise WHERE promise_id like '%$keyword%' or pro_id like '%$keyword%' or
                price <= '$keyword' or firstname like '%$keyword%' or lastname like '%$keyword%' or date_get like '%$keyword%' 
                or date_return like '%$keyword%' ORDER BY promise_id limit {$start}, {$perpage}";
            } else {
                // $sql="SELECT * FROM product,brand WHERE product.brand_id = brand.brand_id ORDER BY pro_id ";
                // $sql1="SELECT * FROM product,model,brand WHERE product.model_id = model.model_id ORDER BY pro_id ";
                $sql2 = "SELECT * FROM promise ORDER BY promise_id limit {$start}, {$perpage}";
            }
            $hand2 = mysqli_query($conn, $sql2);
            // $hand=mysqli_query($conn,$sql);
            ?>


            <?php if (mysqli_num_rows($hand2)) { ?>
                <!-- <div>
                    <tr>
                        <th>
                            <div class="alert color-myself h4 text-center mt-4 " role="alert">
                                แสดงข้อมูลการเช่า
                            </div>
                        </th>
                    </tr>
                </div> -->

                <tr>
                    <th>เลขใบสัญญา</th>
                    <th>ทะเบียน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>วันที่เช่า</th>
                    <th>วันที่คืน</th>
                    <th>ราคารวม</th>
                    <th>รูปภาพ</th>
                    <th>ส่งคืน</th>
                </tr><br>

                <?php while ($row = mysqli_fetch_array($hand2)) {
                ?>
                    <tr>
                        <td><?= $row['promise_id'] ?></td>
                        <td><?= $row['pro_id'] ?></td>
                        <td><?= $row['firstname'] ?></td>
                        <td><?= $row['lastname'] ?></td>
                        <td><?= $row['date_get'] ?></td>
                        <td><?= $row['date_return'] ?></td>
                        <td><?= number_format($row['price']) ?></td>
                        <td><img src="image/<?= $row['image'] ?>"></td>
                        <!-- <td><a class="btn btn-outline-warning" href="edit_product.php?id=<?= $row['pro_id'] ?>"><i class="fa-regular fa-pen-to-square fa-xl"></i></a></td> -->
                        <td><a class="btn btn-outline-primary" href="del_promise.php?id=<?= $row['promise_id'] ?>" onclick="Return(this.href);return false;" title="ส่งคืนรถ"><i class="fa-solid fa-motorcycle"></i></a></td>
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
            //mysqli_close($conn);
            ?>
        </table><br>

        <br><br>
    </div>

    <?php
    if (mysqli_num_rows($hand2)) {
        $sql1 = "SELECT * FROM promise";
        $query1 = mysqli_query($conn, $sql1);
        $total_record = mysqli_num_rows($query1);
        $total_page = ceil($total_record / $perpage);
    ?>

        <nav aria-label="Page navigation example ">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="manage_rental.php?page=1" aria-label="Previous" title="ย้อนกลับ">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                    <li class="page-item"><a class="page-link" href="manage_rental.php?page=<?= $i ?>"><?= $i ?></a></li>
                <?php } ?>
                <li class="page-item">
                    <a class="page-link" href="manage_rental.php?page=<?= $total_page ?>" aria-label="Next" title="หน้าถัดไป">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>

    <?php
    }
    mysqli_close($conn);
    ?>

    <footer class="text-center p-3 color-myself">
        <div class="footer-container">
            <p>Copyright &copy; AAA Official 2022</p>
        </div>
    </footer>

</body>

</html>

<script language="JavaScript">
    // คำสั่งยืนยันก่อนจะลบข้อมูล
    function Return(mypage) {
        var agree = confirm("ยืนยันการคืน");
        if (agree) {
            window.location = mypage;
        }
    }
</script>

<script language="JavaScript">
    // คำสั่งยืนยันก่อนจะลบข้อมูล
    function Out(mypage) {
        var agree = confirm("คุณต้องการออกระบบหรือไม่");
        if (agree) {
            window.location = mypage;
        }
    }
</script>