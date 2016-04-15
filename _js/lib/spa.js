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
	},
	
	DivCover : function(oDiv){
		var jDiv = $(oDiv);
		var position = jDiv.position();
		var CoverDiv = document.createElement("div");
		CoverDiv.style.position = "absolute";
		CoverDiv.style.left = position.left+"px";
		CoverDiv.style.top = position.top+"px";
		CoverDiv.style.height = jDiv.height()+"px";
		CoverDiv.style.width = jDiv.width()+"px";
		CoverDiv.style.opacity = .0;
		CoverDiv.style.background = "#fff";
		CoverDiv.style.zIndex = 1000;
		CoverDiv.id = "spa-cover";
		document.body.appendChild(CoverDiv);
		/* fade in quickly */
		$(CoverDiv).animate({opacity:.5},250);
	},
	
	RemoveCover : function(){
		var jCover = $("#spa-cover");
		jCover.animate({opacity:0},250, function(){
			jCover.remove();
		});
	}
	
});