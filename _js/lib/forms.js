var JForm = Class({
	
	__construct : function(vars){
		(vars['formID']) ? this.formID = vars['formID'] : this.formID = "";
		(vars['submitButton']) ? this.submitButton = vars['submitButton'] : this.submitButton = 'sbmit';
		this.oSubmitButton = null;
		this.Spa = new Spa();
		this.oForm = document.getElementById(this.formID);
		this.InitSubmitButton();
	},

	InitSubmitButton : function(){
		try{
			this.oSubmitButton = document.getElementById(this.submitButton);
			var self = this;
			$(self.oSubmitButton).click(function(){
				self.Submit();
			});
		}
		catch(e){
			console.log("Cannot initialize submit button for form");
			throw e;
		}
	},	 
	
	Submit : function(){
		if(this.Validate){
			this.Spa.CreateFrame();
		}
		else return false;
	},
	
	Validate : function(){
		return true;
	}
	
});