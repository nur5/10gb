function BasketItemReq(whine, quantity, corb) {
	this.wineid = whine;
	this.quantity = quantity;
	this.caseorbottle = corb;
	if (customer !== null) {
		this.customerid = customer.id;
	} else {
		if(getCookie("items") != "") {
			this.items = JSON.parse(getCookie("items")).items;
		}
	}
}
function addToBasket(id) {
	var neww = new BasketItemReq(id, $('#wine_quantity' + id).val(), $('#wine_corb' + id).val());
	if (customer !== null) {
		$.ajax({
			url : '/10gb/api/basket',
			method : 'POST',
			dataType : 'json',
			data : neww,
			success : function(d) {
				console.log(d);
				$('#wine_sts' + id).html('Added ' + neww.quantity + ' of these badboys to cart!');
			},
			error : function(err) {
				console.log(err);
			}
		});
	} else {
		$.ajax({
			url : '/10gb/api/mockbasket',
			method : 'POST',
			dataType : 'json',
			data : neww,
			success : function(d) {
				console.log(d);
				$('#wine_sts' + id).html('Added ' + neww.quantity + ' of these badboys to cart!');
				setCookie("items", JSON.stringify(d), 1);
			},
			error : function(err) {
				console.log(err);
			}
		});
	}
}