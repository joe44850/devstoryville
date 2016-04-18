var Login = Class({
	
	oForm : null,
	
	InitForm : function(){
		this.oForm = document.getElementById('login');
		this.PreloadForm();
		this._SpaForm = new SpaForm({
			formID : 'login'			
		});
	},
	
	PreloadForm : function(){
		cookieArray = JS.ReadCookie("storyville");
		alert(cookieArray);
	},
	
	SaveFormInputs : function(){
		var username = document.getElementById('username').value;		
	}
	
	
});

function LoginAttempt(){
	
	
}
