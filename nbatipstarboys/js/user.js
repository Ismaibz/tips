

function login(){
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            $.ajax({
                url : "../php/user/login.php",
                dataType : "json",
                type : "POST",
                data : {
                    email : username,
                    password : password,
                    
                },
                complete : function(r) {
                    var json = JSON.parse(r.responseText);
                    if (json.Token == 0) {
                        alert("error");
                    } else {

                        var id = json.id;
                        var token = json.Token;
                        var user_type = json.type;

                        localStorage.id = id;
                        localStorage.token = token;
                        localStorage.user_type = user_type;
                        window.location.href = "main.html"; // Redirecting to other page.
                    }

                },
                onerror : function(e, val) {
                    alert("Hay error");
                }
            });
}


function register(){
			var username = document.getElementById("regEmail").value;
            var password = document.getElementById("regPass").value;
            var repeatedPassword = document.getElementById("regPass2").value;

            if (password != repeatedPassword){
            	document.getElementById("success").innerHTML = ( "Passwords do not match." );
            }
            else{
	            $.ajax({
	                url : "../php/user/register.php",
	                dataType : "json",
	                type : "POST",
	                data : {
	                    email : username,
	                    password : password,
	                    
	                },
	                complete : function(r) {
	                    var json = JSON.parse(r.responseText);
	                    if (json.Token == 0) {
	                        alert("error");
	                    } else {

	                        var id = json.id;
	                        var token = json.Token;

	                        localStorage.id = id;
	                        localStorage.token = token;
	                        localStorage.user_type = 1;
	                        window.location.href = "main.html"; // Redirecting to other page.
	                    }

	                },
	                onerror : function(e, val) {
	                    alert("Hay error");
	                }
	            });

			}


}