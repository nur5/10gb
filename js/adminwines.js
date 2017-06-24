function printWineDeets(wine) {
	$('#wine_name').val(wine.name);
	$('#wine_description').val(wine.description);
	$('#wine_country').val(wine.country);
	$('#wine_img').attr("src", wine.img);
	$('#wine_pc').val(wine.pricecase);
	$('#wine_bc').val(wine.bottlescase);
	$('#wine_pb').val(wine.pricebottle);
	$('#wine_bs').val(wine.bottlesize);
	$('#wine_bl').val(wine.bottlesleft);
	$('#wine_cl').val(wine.casesleft);
}

function UpdateWine(name, desc, country, pb, pc, bs, bc, bl, cl,img) {
	this.name = name;
	this.description = desc;
	this.country = country;
	this.price_bottle = pb;
	this.price_case = pc;
	this.bottle_size = bs;
	this.bottles_per_case = bc;
	this.bottles_left = bl;
	this.cases_left = cl;
	this.img = img;
	this.id = wid;
}

function uploadImage() {
	try {
		var file_data = $('#wine_image').prop('files')[0];
		if (file_data == null)
			throw 'No image selected!';
		var form_data = new FormData();
		form_data.append("wine", file_data);
		$.ajax({
			url : '/10gb/api/admin/upload',
			method : 'POST',
			data : form_data,
			contentType : false,
			cache : false,
			processData : false,
			success : function(url) {
				if (url == null) {
					alert('Got null uploading image. Check file size');
				} else {
					alert('Successfully changed picture!');
					$('#wine_img').attr("src", '/10gb/uploads/'+url);
				}
			},
			error : function(data) {
				console.log(data);
				alert(data);
			}
		});
	} catch (err) {
		alert('Error ' + err);
	}
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

function update() {
	var neww = new UpdateWine($('#wine_name').val(), $(
		'#wine_description').val(), $('#wine_country').val(), $('#wine_pb')
		.val(), $('#wine_pc').val(), $('#wine_bs').val(), $('#wine_bc')
		.val(), $('#wine_bl').val(), $('#wine_cl').val(),$('#wine_img').attr('src'));
	$.ajax({
		url: '/10gb/api/wines',
		type: 'PUT',
		data: neww,
		dataType: 'json',
		success: function(wine) {
			console.log(wine);
			alert('Successfully updated wine with ID: ' + wid);
			window.location.replace('/10gb/admin');
		},
		error: function(err) {
			console.log(err);
		}
	});
}

function del() {
	if (confirm("This action cannot be undone! Are you sure?")) {
		$.ajax({
			url : '/10gb/api/wines/' + wid,
			type : 'DELETE',
			dataType : 'json',
			success : function(wine) {
				console.log(wine);
				try {
					alert('Successfully deleted ' + wine.name + ' with ID: ' + wine.id);
					window.location.replace('/10gb/admin');
				} catch (err) {
					console.log(err);
					alert('Woops. Done fked up innit');
				}
			},
			error : function(err) {
				console.log(err);
			}
		});
	}
}


$(document).ready(getWine);