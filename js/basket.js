function printItems(itm) {
	itm.forEach(function(i) {
		const corb = i.caseorbottle == 'C';
		$('#itms').append('<tr><td>' + i.wine.name + '</td><td>' + i.caseorbottle + '</td><td>'
				+ (corb ? i.wine.pricecase : i.wine.pricebottle) + '</td><td>'+i.quantity+'</td><td>' + (corb ? i.wine.pricecase * i.quantity : i.wine.pricebottle * i.quantity) +
				'</td></tr>');
	});
}

function clearItems() {
	if(customer !== null) {
		$.ajax({
			url: '/10gb/api/basket/clear',
			method: 'POST',
			dataType: 'json',
			data: customer.basket,
			success: function(data) {
				console.log(data);
				alert("Basket cleared!");
				window.location.replace("/10gb/");
			},
			error: function(err) {
				console.log(err);
			}
		});
	} else {
		document.cookie = "items=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
		alert("Basket cleared!");
		window.location.replace("/10gb");
	}
}

function order() {
	if(customer !== null) {
		window.location.replace('/10gb/order');
	} else {
		alert('You are not logged in to place an order!');
	}
}

lawgin(function() {
	//console.log(getCookie("items"));
	var items = customer !== null ? customer.basket.items : JSON.parse(getCookie("items")).items;
	printItems(items);
	console.log(items);
});