<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 13px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>


<?php 
use App\Http\Controllers\admin\barcode128;
?>
<style>
div.b128{
 border-left: 1px black solid;
 height: 30px;
} 
</style>

<?php

?>


<body onload="window.print();">
	<div style="margin-left: 5%">

		<?php
// 		include 'resources/views/admin/products/barcode128.php';
// 		$product = $_POST['product'];
// 		$product_id = $_POST['product_id'];
		$product_id = $product->code;
		if($product_id==null)
		{
		    $product_id = $product->id;
		}
		$rate = $product->price_total;

		for($i=1;$i<=$quantity;$i++){
			echo "<p class='inline'><span ><b>Item: $product->name</b></span>".$barcode."</p>&nbsp&nbsp&nbsp&nbsp";
		}

		?>
	</div>
</body>
</html>