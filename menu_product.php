<?php
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
	<title>เมนูสินค้า</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="myself.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="icon" type="image/png" href="image/5731465.png" />
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

	<style>
		.navbar {
			padding-top: 10pt;
			padding-bottom: 10pt;
			padding-left: 40pt;
			padding-right: 40pt;
		}

		.nav-link {
			padding-bottom: 0px;
		}

		.navbar-brand {
			font-size: 35px;
		}

		.logout {
			margin-left: 10cm;
		}

		img {
			object-fit: cover;
			width: 300px;
			height: 250px;
			border: 2.5px solid;
			border-radius: 15px;
			border-color: palevioletred;
		}

		.col-sm {
			padding-bottom: 35px;
			text-align: left;
			}

		.alert {
			box-shadow: 10px 10px lightcoral;
			}

		.page-link {
			color: #da6666;
			}

		.page-link:hover {
			background-color: #da6666;
			color: white;
			}

		@media only screen and(max-width: 992px) {
			.navbar {
				padding-left: 15pt !important;
			}

			.nav-link {
				padding-bottom: 5px;
			}
		}

		@media only screen and(max-width: 1199px) {
				.col-sm {
					text-align: center;
				}
			} 
	</style> 
</head>

<body>
	<?php include 'menu_nav.php'; //navbar?>
	<br>
	<div class = "container text-center" >
		<div class = "alert color-myself h4 text-center mb-4" role="alert"> 
			เลือกรถจักรยานยนต์ 
		</div>
		<div class="row">
		<?php
		include 'connectdb.php';
		//คำสั่งแบ่งหน้าเพจ
		$perpage = 8; //กำหนดหน้าเพจ
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
			$start = ($page - 1) * $perpage;

		//คำสั่งการค้นหา
		$keyword = @$_POST['keyword'];
		if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
			$sql = "SELECT * FROM product INNER JOIN brand ON product.brand_id = brand.brand_id
			INNER JOIN model ON  product.model_id = model.model_id WHERE pro_id like '%$keyword%' or
			price <= '$keyword' or model_name like '%$keyword%'or brand_name like '%$keyword%' ORDER BY pro_id
			limit {$start}, {$perpage}";
		} else {
			$sql = "SELECT * FROM product INNER JOIN brand ON product.brand_id = brand.brand_id
			INNER JOIN model ON  product.model_id = model.model_id ORDER BY pro_id limit {$start}, {$perpage}";
		}
			$hand = mysqli_query($conn, $sql);
			if (mysqli_num_rows($hand)) {
			while ($row = mysqli_fetch_array($hand)) {
		?> 
			<div class="col-sm">
				<img src = "image/<?= $row['image'] ?>"><br>
				<!--ทะเบียน: <?= $row['pro_id'] ?> <br>
				รุ่น: <?= $row['model_name'] ?> <br>
				ยี่ห้อ: <?= $row['brand_name'] ?> <br>
				ราคาเช่า: < b class = "text-danger" > <?= $row['price'] ?> < /b> บาท <br>-->
				<br>
				<!--Button trigger modal-->
				<button type="button" class="btn btn-danger view_data" title = "เข้าดูข้อมูลรถ"
				id="<?=$row['pro_id'];?>" data-bs-toggle = "modal"> ดูข้อมูลเพิ่มเติม </button>
			
			<?php
			$idd = $row['pro_id'];
			$sql2 = "SELECT pro_id FROM promise WHERE pro_id = '$idd' ";
			$noshow = mysqli_query($conn, $sql2);
			$noshow1 = mysqli_fetch_array($noshow);
			if (isset($noshow1['pro_id'])) {
			?>
			<a href="#" class="btn btn-secondary" role="button"	aria-disabled="true" title="ถูกเช่าอยู่ขณะนี้"> ไม่ว่าง </a>
			<?php } else { ?>
				<a class="btn btn-outline-danger" href="rt_product.php?id=<?= $row['pro_id'] ?>" title="ทำการเช่า"> กดจอง </a>
			<?php } ?>
			</div>

			<?php
			}
			} else {
			?>
			<div>
			<br><br><br><br><br><br>
			<h2> ไม่พบรถจักรยานยนต์ </h2>
			<br><br><br><br><br><br><br><br><br><br>
			</div>

		<?php
		}
		?>
		</div>

		<?php
		include 'modal_product.php'
		?>
		
	</div>

	<?php
	$sql1 = "SELECT * FROM product";
	$query1 = mysqli_query($conn, $sql1);
	$total_record = mysqli_num_rows($query1);
	$total_page = ceil($total_record / $perpage);
	?>

	<nav aria-label="Page navigation example">
		<ul class="pagination justify-content-center" >
			<li class="page-item">
				<a class="page-link" href="menu_product.php?page=1" aria-label="Previous" title="ย้อนกลับ" >
				<span aria-hidden="true">&laquo;</span>
			 	</a> 
			</li>
			<?php for ($i = 1; $i <= $total_page; $i++) { ?>
			<li class="page-item"><a class="page-link" href="menu_product.php?page=<?=$i?>"><?=$i?></a></li>
			<?php } ?> 
			<li class="page-item">
				<a class="page-link" href="menu_product.php?page=<?=$total_page?>" aria-label="Next" title="หน้าถัดไป">
				<span aria-hidden = "true">&raquo;</span> 
				</a> 
			</li> 
		</ul> 
	</nav>

	<?php
	mysqli_close($conn);
	?>

	<footer class="text-center p-4 color-myself">
		<div class="footer-container">
			<p>Copyright &copy; AAA Official 2022 </p> 
		</div> 
	</footer>

</body>

<script language = "JavaScript" >
	//คำสั่งยืนยันก่อนจะลบข้อมูล
	function Out(mypage) {
		var agree = confirm("คุณต้องการออกระบบหรือไม่");
			if (agree) {
			window.location = mypage;
		}
	}
</script>

<script language="JavaScript">
	$(document).ready(function() {
		$(document).on('click','.view_data',function(){
			var id=$(this).attr("id");
			$.ajax({
				url: "select_product.php",
				type: "get",
				data: {id:id},
				success: function(data) {
					$('#info_update5').html(data);
					$('#editData5').modal('show');
				}
			});
		});
	});
</script>
</html>