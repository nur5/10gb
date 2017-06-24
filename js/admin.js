function NewWine(cat, subcat, name, desc, country, pb, pc, bs, bc,bl,cl) {
	switch (cat) {
	case '1':
		if (subcat < 3)
			throw 'Red wines can only be Light or Full-bodied';
		break;
	case '2':
		if (subcat > 2)
			throw 'White wines can only be Sweet or Dry';
		break;
	}
	this.cat = cat;
	this.subcat = subcat;
	this.name = name;
	this.description = desc;
	this.country = country;
	this.price_bottle = pb;
	this.price_case = pc;
	this.bottle_size = bs;
	this.bottles_per_case = bc;
	this.bottles_left = bl;
	this.cases_left = cl;
	this.img = '';
}

function NewAdmin(username, email, pwd) {
	this.username = username;
	this.password = pwd;
	this.emailaddress = email;
}

function printCustomers(customers) {
	var tbl = "<table>" + "<tr>" + "<th>ID</th>" + "<th>First Name</th>"
		+ "<th>Last Name</th>" + "<th>No. Of Orders</th>"
		+ "<th>Email Address</th></tr>";
	customers.forEach(function(c) {
		tbl += "<tr><td>" + c.id + "</td><td>" + c.firstname + "</td><td>"
			+ c.lastname + "</td><td>" + c.orders.length + "</td><td>"
			+ c.user.emailaddress + "</td></tr>";
	});
	tbl += "</table>";
	$('#users_customers').html(tbl);
}

function printWines(wines) {
	var tbl = "<table>" + "<tr>" + "<th>ID</th>" + "<th>Name</th></tr>";
	wines.forEach(function(w) {
		tbl += "<tr><td>" + w.id + '</td><td><a href="/10gb/php/view/adminwine.php?id=' + w.id + '">' + w.name + "</a></td></tr>";
	});
	tbl += "</table>";
	$('#wines_list').html(tbl);
}

function uploadFile() {
	try {
		var file_data = $('#wines_image').prop('files')[0];
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
					$('#wines_alert').html('Got null uploading image. Check file size');
				} else {
					makeWine(url);
				}
			},
			error : function(data) {
				console.log(data);
				alert(data);
			}
		});
	} catch (err) {
		$('#wines_alert').html('Error ' + err);
	}
}

function getWines() {
	$.ajax({
		url : '/10gb/api/wines',
		method : 'GET',
		contentType : 'json',
		success : function(arr) {
			console.log(arr);
			if (Array.isArray(arr)) {
				printWines(arr);
			}
		},
		error : function(err) {
			console.log(err);
		}
	});

}

function getCustomers() {
	$.ajax({
		url : '/10gb/api/admin/customers',
		method : 'GET',
		contentType : 'json',
		success : function(arr) {
			console.log(arr);
			if (Array.isArray(arr)) {
				printCustomers(arr);
			} else {
				$('#users_customers').html("ERROR");
			}
			getWines();
		},
		error : function(err) {
			console.log(err);
		}
	});
}

function makeWine(url) {
	try {
		$('#wines_alert').html("Creating that wine..");
		var neww = new NewWine($('#wines_cat').val(), $('#wines_subcat').val(), $('#wines_name').val(), $(
			'#wines_desc').val(), $('#wines_country').val(), $('#wines_pb')
			.val(), $('#wines_pc').val(), $('#wines_bs').val(), $('#wines_bc')
			.val(), $('#wines_bl').val(), $('#wines_cl').val());
		neww.img = '/10gb/uploads/' + url;
		console.log(neww);
		$.ajax({
			url : '/10gb/api/admin/wines',
			method : 'POST',
			data : neww,
			dataType : 'json',
			success : function(data) {
				console.log(data);
				$('#wines_alert').html("Success");
				getWines();
			},
			error : function(data) {
				console.log(data);
				$('#wines_alert').html("Error");
			}
		});
	} catch (err) {
		$('#wines_alert').html('Error ' + err);
	}
}

function catsel(selObj) {
	if (selObj.value === '3') {
		$('#fs_wsubcat').hide();
	} else {
		$('#fs_wsubcat').show();
	}
}

function makeAdmin() {
	var neww = new NewAdmin($('#admin_usr').val(), $('#admin_email').val(), $(
		'#admin_pass').val());
	$.ajax({
		url : '/10gb/api/admin/makeadmin',
		method : 'POST',
		dataType : 'json',
		data : neww,
		success : function(usr) {
			console.log(usr);
			$('#admin_status').html(
				'Created user <b>' + usr.username + '</b> successfully!');
		},
		error : function(err) {
			console.log(err);
			$('#admin_status').html("ERROR!");
		}
	});
}

$(document).ready(getCustomers);