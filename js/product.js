function printWineDeets(wine) {
	$('#name').html(wine.name);
	$('#desc').html(wine.description);
	$('#country').html(wine.country);
	$('#img').attr("src", wine.img);
	$('#pc').html('Price per case: £' + wine.pricecase);
	$('#pb').html('Price per bottle: £' + wine.pricebottle);
	$('#bl').html('Bottles left: ' + wine.bottlesleft);
	$('#cl').html('Cases left: ' + wine.casesleft);
	$('#wine_corb').attr("id","wine_corb"+wine.id);
	$('#wine_quantity').attr("id","wine_quantity"+wine.id);
	$('#atb').attr("onclick","addToBasket("+wine.id+");");
}

function getWine() {
	$.ajax({
		url : '/10gb/api/wines/' + wid,
		method : 'GET',
		dataType : 'json',
		success : function(wine) {
			console.log(wine);
			printWineDeets(wine);
		},
		error : function(err) {
			console.log(err);
		}
	});
}

$(document).ready(getWine);