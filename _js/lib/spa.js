var Spa = Class({
	Debug : false,
	
	CreateFrame : function(frameID){
		vis = "hidden";
		h = 0;
		w = 0;
		
		if(this.Debug){
			vis = "visible";
			h = 100;
			w = 200;
		}
		
		if(frameID == null){			
			this.frameID = "spa-frame-"+JS.Now();
		}
			this.oFrame = document.createElement("iframe");
			this.oFrame.id = this.frameID;
			this.oFrame.setAttribute("name", this.frameID);
			this.oFrame.width = h;
			this.oFrame.height = w;
			this.oFrame.style.visibility = vis;
			document.body.appendChild(this.oFrame);
			return this.oFrame;
		
	},
	
	DeleteFrame : function(oFrame){
		oFrame.parentNode.removeChild(oFrame);
	}
	
});