var Register = Class({
	
	_SpaForm : null,
	
	InitSignup : function(){
		this._SpaForm = new SpaForm({
			formID : 'signup'			
		});
	},
	
	Complete : function(json, _SpaForm){
		this._SpaForm = _SpaForm;
		json = JSON.parse(json);
		if(!json.success){ this.DisplayError(json);}
		else {
			this.DisplaySuccess(json);
			this.StoreUserInfo(json);
		}
	},
	
	DisplayError : function(json){
		var error = json.create_error;
		if(error.indexOf("username")!=-1){ this.DisplayUsernameError(json);}
		else if(error.indexOf("email")!=-1){ this.DisplayEmailError(json);}
	},
	
	DisplayUsernameError : function(json){		
		var oItem = document.getElementById('username');
		this._SpaForm.PrintError(oItem, json.create_error);
	},
	
	DisplayEmailError : function(json){
		var oItem = document.getElementById('email');
		this._SpaForm.PrintError(oItem, json.create_error);
	},
	
	DisplaySuccess : function(json){		
		var DisplayComplete = (function(){
			this._SpaForm.oForm.innerHTML = html;
		}).bind(this);
		var html = "<div><center><p>User created!<br />Please check your email to complete.</p><p>&nbsp;</p></center></div>";
		setTimeout(function(){
			DisplayComplete();
		},500);		
	},
	
	StoreUserInfo : function(json){
		console.log(json);
	}
	
	
});

function CompleteRegistration(json, _SpaForm, callBack){
	_Register = new Register();
	_Register.Complete(json, _SpaForm);
	if(callBack != null){ callBack();}
}

function CompleteConfirmation(){
	setTimeout(function(){
		alert("Finish confirmation");
	}, 1000);
}