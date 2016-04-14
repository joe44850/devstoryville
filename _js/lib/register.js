var Register = Class({
	
	InitSignup : function(){
		MyForm = new JForm({
			formID : 'signup'			
		});
	},
	
	Complete : function(json){
		alert(json);
	}
	
});

function CompleteRegistration(json){
	Register = new Register();
	Register.Complete(json);
}