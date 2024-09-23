<?php
include 'connectdb.php';

if (isset($_GET['id'])) {

    $idpro = $_GET['id'];
}

// $sql = "SELECT * FROM product WHERE pro_id = '$idpro' ";

$sql = "SELECT * FROM product INNER JOIN brand ON product.brand_id = brand.brand_id
INNER JOIN model ON  product.model_id = model.model_id WHERE pro_id = '$idpro' ";

$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_array($result);

?>

<img src="image/<?= $rs['image'] ?>"><br>
ทะเบียน : <?= $rs['pro_id'] ?><br>
รุ่น : <?= $rs['model_name'] ?><br>
ยี่ห้อ : <?= $rs['brand_name'] ?><br>
ราคาเช่า : <b class="text-danger"><?= $rs['price'] ?></b> บาท <br><br>