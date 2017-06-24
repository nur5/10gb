//credits:w3 schools
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function LoginRes(usn,pw) {
	this.usn = usn;
	this.pw = pw;
}

function login() {
	var neww = new LoginRes($('#usn').val(),$('#pw').val());
	$.ajax({
		url: '/10gb/api/login',
		method: 'POST',
		dataType: 'json',
		data: neww,
		success: function(cst) {
			console.log(cst);
			if(cst=='FAIL' || cst=='UFAIL') {
				alert("Failed to login, check username/password combo");
			} else {
				setCookie("customer",JSON.stringify(cst),1);
				window.location.replace("/10gb/");
			}
		},
		error: function(err) {
			console.log(err);
		}
	});
}