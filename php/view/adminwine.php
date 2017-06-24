<?php
if(!isset($_REQUEST['id'])) {
	echo "<script>alert('No ID passed!'); window.location.replace('/10gb/admin');</script>";	
}
$id = $_REQUEST['id'];
?> 




<!DOCTYPE html>
<html>
<head>
<title>Wine Administration Page</title>
</head>
<body>
	<div>
		<div style="float: left;">
			<img height="450" width="150" id="wine_img">
			<input id="wine_image" type="file">
			<button onclick="uploadImage();">Upload new image</button>
		</div>
		<div style="float: left;">
			<p>Name:</p>
			<input type="text" id="wine_name" />
			<p>Description</p>
			<input type="text" id="wine_description" />
			<p>Country</p>
			<select id="wine_country">
				<option value="Chile">Chile</option>
				<option value="France">France</option>
				<option value="Spain">Spain</option>
				<option value="United Kingdom">United Kingdom</option>
				<option value="United States of America">United States of
					America</option>
			</select>
			<p>Price per bottle</p>
			<input type="number" id="wine_pb" />
			<p>Price per case</p>
			<input type="number" id="wine_pc" />
			<p>Bottle size</p>
			<select id="wine_bs">
				<option value="750">750ml</option>
				<option value="1000">1000ml</option>
			</select>
			<p>Bottles per case</p>
			<input type="number" id="wine_bc" />
			<p>Bottles left in stock</p>
			<input type="number" id="wine_bl" />
			<p>Cases left in stock</p>
			<input type="number" id="wine_cl" />
			<div>
				<button onclick="del()">Delete wine</button>
				<button onclick="update()">Update wine</button>
			</div>
		</div>
	</div>
	<script>
			<?php
echo 'var wid=' . $id . ';';
?>
		</script>
	<script src="/10gb/js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="/10gb/js/adminwines.js"></script>
</body>
</html>