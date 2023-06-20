<?php
include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");

//For Registration Processsing
if (isset($_POST["username"]) and isset($_POST["email"])) {
	$user = new User();
	$result = $user->createUserAccount($_POST["username"], $_POST["email"], $_POST["password1"], $_POST["usertype"]);
	echo $result;
	exit();
}

//For Login Processing
if (isset($_POST["log_email"]) and isset($_POST["log_password"])) {
	$user = new User();
	$result = $user->userLogin($_POST["log_email"], $_POST["log_password"]);
	echo $result;
	exit();
}

//To get Category
if (isset($_POST["getCategory"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("categories");
	foreach ($rows as $row) {
		echo "<option value='" . $row["cid"] . "'>" . $row["category_name"] . "</option>";
	}
	exit();
}

//Fetch Brand
if (isset($_POST["getBrand"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("brands");
	foreach ($rows as $row) {
		echo "<option value='" . $row["bid"] . "'>" . $row["brand_name"] . "</option>";
	}
	exit();
}

//Add Category
if (isset($_POST["category_name"]) and isset($_POST["parent_cat"])) {
	$obj = new DBOperation();
	$result = $obj->addCategory($_POST["parent_cat"], $_POST["category_name"]);
	echo $result;
	exit();
}

//Add Brand
if (isset($_POST["brand_name"])) {
	$obj = new DBOperation();
	$result = $obj->addBrand($_POST["brand_name"]);
	echo $result;
	exit();
}

//Add Product
if (isset($_POST["product_name"])) {
	$obj = new DBOperation();
	$result = $obj->addProduct(
		$_POST["select_cat"],
		$_POST["select_brand"],
		$_POST["product_name"],
		$_POST["product_price"],
		$_POST["product_qty"]
	);
	echo $result;
	exit();
}

// Order Processing 

if (isset($_POST["getNewOrderItem"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("products");
?>
	<tr>
		<td><b class="number">1</b></td>
		<td>
			<select name="pid[]" class="form-control form-control-sm pid" required>
				<option value="">Choose Product</option>
				<?php
				foreach ($rows as $row) {
				?><option value="<?php echo $row['pid']; ?>"><?php echo $row["product_name"]; ?></option><?php
																													}
																														?>
			</select>
		</td>
		<td><input name="tqty[]" readonly type="text" class="form-control form-control-sm tqty"></td>
		<td><input name="qty[]" type="text" class="form-control form-control-sm qty" required></td>
		<td><input name="price[]" type="text" class="form-control form-control-sm price" readonly></span>
			<span><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name">
		</td>
		<td>Tk.<span class="amt">0</span></td>
	</tr>
<?php
	exit();
}


//Get price and qty of one item
if (isset($_POST["getPriceAndQty"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("products", "pid", $_POST["id"]);
	echo json_encode($result);
	exit();
}


if (isset($_POST["order_date"]) and isset($_POST["cust_name"])) {

	$orderdate = $_POST["order_date"];
	$cust_name = $_POST["cust_name"];


	//Now getting array from order form
	$ar_tqty = $_POST["tqty"];
	$ar_qty = $_POST["qty"];
	$ar_price = $_POST["price"];
	$ar_pro_name = $_POST["pro_name"];


	$sub_total = $_POST["sub_total"];
	$gst = $_POST["gst"];
	$discount = $_POST["discount"];
	$net_total = $_POST["net_total"];
	$paid = $_POST["paid"];
	$due = $_POST["due"];
	$payment_type = $_POST["payment_type"];


	$m = new Manage();
	echo $result = $m->storeCustomerOrderInvoice($orderdate, $cust_name, $ar_tqty, $ar_qty, $ar_price, $ar_pro_name, $sub_total, $gst, $discount, $net_total, $paid, $due, $payment_type);
}

?>