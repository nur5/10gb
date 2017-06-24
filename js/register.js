function RegisterRequest(firstname, lastname, email, username, password) {
	this.firstname = firstname;
	this.lastname = lastname;
	this.emailaddress = email;
	this.username = username;
	this.password = password;
}

function register() {
	var reqbody = new RegisterRequest($("#firstname").val(), $("#lastname")
			.val(), $("#emailaddress").val(), $("#username").val(), $(
			"#password").val());
	$.ajax({
		method : 'POST',
		url : "/10gb/api/register",
		data : reqbody,
		dataType: 'json',
		success : function(data,status,jqXhr) {
			console.log(data);
			$("#alertt").html("<b>Registration successful!</b>");
		},
		error : function(data) {
			console.log(data);
			$("#alertt").html("<i>Registration failed...</i>");
		}
	});
}