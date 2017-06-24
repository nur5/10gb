function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}
function logout() {
	document.cookie = "customer=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	window.location.replace('/10gb/');
}
function getCustomerById(id, cb) {
	$.ajax({
		url : '/10gb/api/customers/' + id,
		method : 'GET',
		dataType : 'json',
		success : function(d) {
			cb(d);
		},
		error : function(err) {
			console.log(err);
		}
	});
}
const cukes = getCookie("customer");
var customer = cukes != "" ? JSON.parse(cukes) : null;
function lawgin(cb) { //with callback
	if (customer !== null) {
		getCustomerById(customer.id, function(cus) { //to get updated info
			customer = cus;
			cb();
		});
		$('#log').html("Log out, " + customer.firstname);
		$('#log').attr('href', '#');
		$('#log').attr('onclick', 'logout()');
	} else {
		cb();
	}
}