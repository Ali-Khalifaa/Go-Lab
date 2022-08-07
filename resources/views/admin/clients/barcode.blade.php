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



<body onload="window.print();">
	<div style="margin-left: 5%">

		<?php

		
		for($i=1;$i<=$quantity;$i++){
			echo "<p class='inline'><span ><b>User: $product->name</b></span>".$barcode."</p>&nbsp&nbsp&nbsp&nbsp";
		}

		?>
	</div>
</body>
</html>