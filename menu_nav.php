
<nav class="navbar navbar-expand-lg navbar-dark color-myself">
	<div class="container-fluid">
		<a class="navbar-brand" href="menu_product.php" title="หน้าแรก">เช่ารถจักรยานยนต์</a>
		<div class="navbar-collapse">
			<ul class="navbar-nav me-auto mt-auto mb-auto" >
				<li class="nav-item">
					<a class="nav-link" href="show_product.php" title="จัดการข้อมูลรถ">จัดการข้อมูลรถจักรยานยนตร์</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="manage_rental.php" title="จัดการข้อมูลเช่า">จัดการข้อมูลการเช่ายืม</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php" onclick="Out(this.href);return false;" title="ออกจากระบบ">ออกจากระบบ</a>
				</li>
				<li class="nav-link">
					admin :
					<?php
					if(isset($_SESSION["username"])){
						echo $_SESSION["username"];
					}
					?>
				</li>
			</ul>
			
			<form class="d-flex " method="post" action="" enctype="multipart/form-data">
					<input class="form-control me-2" name="keyword" type="text" placeholder="ค้นหารถจักรยานยนต์..." 
					value="<?=(isset($_POST['keyword'])) ? $_POST['keyword'] : '' ?>" aria-label="Search">
					<button class="btn btn-light" type="submit" title="ค้นหา"><i class="fa-solid fa-magnifying-glass"></i></button>
			</form>

		</div>
	</div>
</nav>
