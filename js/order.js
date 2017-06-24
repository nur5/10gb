if (customer == null) {
	alert("Not logged in!");
	window.location.replace("/10gb");
} else if (customer.basket.items.length == 0) {
	alert("You have no items in your basket!");
	window.location.replace("/10gb");
}

lawgin(function() {
	console.log(customer);
	printItems(customer.basket.items);
	customerAddresses();
});


function printItems(itm) {
	itm.forEach(function(i) {
		const corb = i.caseorbottle == 'C';
		$('#itms').append('<tr><td>' + i.wine.name + '</td><td>' + i.caseorbottle + '</td><td>'
			+ (corb ? i.wine.pricecase : i.wine.pricebottle) + '</td><td>' + i.quantity + '</td><td>' + (corb ? i.wine.pricecase * i.quantity : i.wine.pricebottle * i.quantity) +
			'</td></tr>');
	});
}

function customerAddresses() {
	$('#adrss').html("");
	customer.addresses.forEach(function(a) {
		//$('#adrss').append('<option value="'+a.id+'">'+a.address+'</option>');
		$('#adrss').append($('<option>', {
			value : a.id,
			text : a.address
		}));
	});
}

function NewAddress(add) {
	this.address = add;
	this.customerid = customer.id;
}

function NewOrder(ad, pd) { //blue monday
	this.customerid = customer.id;
	this.addressid = ad;
	this.items = customer.basket.items;
	this.paymentdetails = pd;
}

function cashOut() {
	var neww = new NewOrder($('#adrss').val(),$('#pd').val());
	$.ajax({
		url : '/10gb/api/orders',
		method : 'POST',
		dataType : 'json',
		data : neww,
		success : function(a) {
			console.log(a);
			alert("Order successfully placed!");
			$.ajax({
				url: '/10gb/api/basket/clear',
				method: 'POST',
				dataType: 'json',
				data: customer.basket,
				success: function(data) {
					console.log(data);
					window.location.replace("/10gb/");
				},
				error: function(err) {
					console.log(err);
				}
			});
		},
		error : function(err) {
			console.log(err);
		}
	});
}

function saveAddr() {
	var neww = new NewAddress($('#addy').val());
	$.ajax({
		url : '/10gb/api/address',
		method : 'POST',
		dataType : 'json',
		data : neww,
		success : function(a) {
			console.log(a);
			lawgin(function() {
				customerAddresses();
			});
		},
		error : function(err) {
			console.log(err);
		}
	});
}