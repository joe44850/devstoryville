var Spa = Class({
	
	CreateFrame : function(frameID){
		if(frameID == null){			
			this.frameID = "spa-frame-"+JS.Now();
			alert(this.frameID);
		}
	}
	
});