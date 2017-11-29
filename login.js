document.onreadystatechange = function(e) {
	// Everything that needs to be loaded when the page is loaded.
	var urlVars = getUrlVars();
	if (urlVars) {
		urlHandler(urlVars);
	}

	var buttonLogin = document.querySelector('.button_login');
	var buttonRegister = document.querySelector('.button_register');
	buttonLogin.addEventListener('onclick', login, false);
	buttonRegister.addEventListener('onclick', register, false);
};


window.onhashchange = function(e) {
	var urlVars = getUrlVars();
	if (urlVars) {
		urlHandler(urlVars);
	}
};

function urlHandler(vars) {
	var login_block = document.querySelector('#login_block');
	var register_block = document.querySelector('#register_block');
	if (vars.login == "true" || vars.register == "false") { // LOGIN
		login_block.style.display = 'block';
		register_block.style.display = 'none';
	} else if (vars.register == "true" || vars.login == "false") { // REGISTER
		login_block.style.display = 'none';
		register_block.style.display = 'block';
	} else { // NOT_SPECIFIED - LOGIN
		login_block.style.display = 'block';
		register_block.style.display = 'none';
	}
}

function getUrlVars() {
var vars = {};
var parts = window.location.href.replace(/[#&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
vars[key] = value;
});
return vars;
}

function clmsg(message) {
	var elm = document.querySelector('#login_message');
	elm.innerHTML += message;
}

function crmsg(message) {
	var elm = document.querySelector('#register_message');
	elm.innerHTML += message;
}
