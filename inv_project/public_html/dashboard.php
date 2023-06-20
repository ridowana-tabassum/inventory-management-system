<?php
include_once("./database/constants.php");
if (!isset($_SESSION["userid"])) {
	header("location:".DOMAIN."/");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Inventory Management System</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
 	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 	<script type="text/javascript" src="./js/main.js"></script>
 </head>
<body>
	<!-- Navbar -->
	<?php include_once("./header.php"); ?>
	<br/><br/>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="jumbotron" style="width:100%;height:100%;">
					<h1>Inventory Project</h1>
					<div class="row">
						<div class="col-sm-6">
							<div class="card">
						      <div class="card-body">
						        <h4 class="card-title">Orders</h4>
						        <p class="card-text">Here you can make invoices and create new orders</p>
						        <a href="new_order.php" class="btn btn-primary">New Orders</a>
						      </div>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<p></p>
	<p></p>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title">Categories</h4>
						<p class="card-text">Here you can add new categories</p>
						<a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary">Add</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title">Brands</h4>
						<p class="card-text">Here you can add new brand</p>
						<a href="#" data-toggle="modal" data-target="#form_brand" class="btn btn-primary">Add</a>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
						<div class="card-body">
						<h4 class="card-title">Products</h4>
						<p class="card-text">Here you can add new prpducts</p>
						<a href="#" data-toggle="modal" data-target="#form_products" class="btn btn-primary">Add</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	
	<?php
	//Category Form
	include_once("./category.php");
	 ?>
	 <?php
	//Brand Form
	include_once("./brand.php");
	 ?>
	 <?php
	//Products Form
	include_once("./products.php");
	 ?>


</body>
</html>