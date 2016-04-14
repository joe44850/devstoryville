var JForm = Class({
	
	__construct : function(vars){
		(vars['formID']) ? this.formID = vars['formID'] : this.formID = "";
		(vars['submitButton']) ? this.submitButton = vars['submitButton'] : this.submitButton = 'sbmit';
		this.oSubmitButton = null;
		this.Spa = new Spa();
		this.Spa.Debug = true;
		this.oForm = document.getElementById(this.formID);
		this.InitSubmitButton();
	},
	
	oFrame : null,

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
		if(this.Validate()){
			if(this.oFrame != null){ this.Spa.DeleteFrame(this.oFrame);}
			this.oFrame = this.Spa.CreateFrame();
			this.oForm.setAttribute("target", this.oFrame.name);
			this.oForm.submit();
		}
		else return false;
	},
	
	Validate : function(){
		var el;
		var val;
		for(var i = 0; i < this.oForm.elements.length; i++){			
			if(!this.PropertyIsValid(this.oForm.elements[i])){ return false;}
		}
		return true;
	},
	
	PropertyIsValid : function(oItem){
		
		if(!oItem.hasAttribute("data-validation")){ return true;}
		var jsonString = oItem.getAttribute("data-validation");
		var jsonRules = JSON.stringify(eval("("+jsonString+")"));
		var jsonObject = JSON.parse(jsonRules);	
		
		if(jsonObject.hasOwnProperty("min") && oItem.value.length < jsonObject.min){ 
			var error = (jsonObject.min == 1) ? "Required" : "Must be at least "+jsonObject.min+" characters";
			this.PrintError(oItem, error);
			oItem.focus();
			return false;
		}	
		else if(jsonObject.hasOwnProperty("rules")){
			console.log("Json rules...");
		}
		this.PrintOK(oItem);		
		return true;
	},
	
	PrintError : function(oItem, error){
		var id = oItem.id+"-error";
		self = this;
		if(document.getElementById(id) == null){ 
			$(oItem).after("<span style='color:red;' id='"+id+"' class='input-error'>"+error+"</span>");			
		}
	},
	
	RemoveError : function(oItem){
		var id = oItem.id+"-error";
		$("#"+id).remove();
	},
	
	PrintOK : function(oItem){
		
		var id = oItem.id+"-error";
		self = this;
		if(document.getElementById(id) == null){
			$(oItem).after("<span style='color:red;' id='"+id+"' class='input-error'></span>");
		}
		var oError = document.getElementById(id);
		oError.innerHTML = "&#10003;";
		oError.style.color = "green";
		oError.style.weight = "bold";
	}
	
	
	
});