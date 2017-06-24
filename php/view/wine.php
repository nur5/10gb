<?php
if (! isset($_REQUEST['id'])) {
    echo '<script>window.location.replace("/10gb/");</script>';
}
$id = $_REQUEST['id'];
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/10gb/css/index.css">
</head>
<body>
	<div class="home">
		<ul>
			<li><a href="/10gb/">Home</a></li>
			<li><a href="#news">Order History</a></li>
			<li><a href="#more">More</a></li>
			<li class="right"><a href="/10gb/basket">Shopping Basket</a></li>
			<li class="right"><a href="/10gb/login" id="log">Login</a></li>
		</ul>
		<div
			style="padding: 10px; margin-top: 30px; background-color: #1abc9c; height: 150px;">
			<h1>Welcome to 10 Green bottles</h1>
			<h2>Your Destination for Wines</h2>
		</div>
		<div id="prod" class="product-card" style="float: center;">
			<div class="product-description">
				<div id="prod" class="product-image">
					<h2 class="abt" id="name"></h2>
					<p id="desc"></p>
					<p id="country"></p>
				</div>
				<img id="img">
			</div>
			<div id="two" class="product-info">
				<p id="cat"></p>
				<p id="pb"></p>
				<p id="pc"></p>
				<p id="bl"></p>
				<p id="cl"></p>
				<label> Choose:</label><br> <br> <select id="wine_corb">
					<option value="Bottle">Bottles</option>
					<option value="Cases">Cases</option>
				</select> <input id="wine_quantity" type="number" placeholder="Quantity">
				<p id="wine_sts"></p>
				<br>
				<div class="btn-group">
					<br>
					<button id="atb">Add to Basket >></button>
				</div>
			</div>
		</div>
	</div>
	<script>
	<?php
echo 'var wid=' . $id . ';';
?>
	</script>
	<script src="/10gb/js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="/10gb/js/log.js"></script>
	<script type="text/javascript" src="/10gb/js/bskt.js"></script>
	<script type="text/javascript" src="/10gb/js/product.js"></script>
</body>
</html>