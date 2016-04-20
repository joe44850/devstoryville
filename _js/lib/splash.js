var Splash = Class({
	
	oDiv1 : null,
	oDiv2 : null,
	oDiv11: null,
	oDiv22: null,
	_Spa : null,
	
	__construct : function(){
		this._Spa = new Spa();
	},
	
	BgTransition : function(){
		
		this.oDiv1 = document.getElementById('splash-bg');
		this.oDiv2 = document.getElementById('header-splash');		
		this.oDiv1.style.opacity = 1;
		this.oDiv2.style.opacity = 1;
		this.oDiv11 = this._Spa.DivClone({oDiv:this.oDiv1, id:"splash-bg2", copycontent:false});
		this.oDiv22 = this._Spa.DivClone({oDiv:this.oDiv2, id:"header-splash2", copycontent:false});
		this.oDiv22.style.position = "absolute";
		this.oDiv22.style.top = 0;
		this.oDiv22.style.left = 0;		
		$("#splash-bg2").addClass("splash-buttons-container");
		this.DoTransition();
	},
	
	DoTransition : function(){
		var RepeatTransition = (function(){
			this.DoTransition;			
		}).bind(this);
		var self = this;
		var next_opacity = (this.oDiv1.style.opacity == 1) ? next_opacity = 0 : next_opacity = 1;
		$(self.oDiv1).animate({opacity:next_opacity}, 1000, function(){
			
		});
		$(self.oDiv2).animate({opacity:next_opacity}, 1000, function(){
			
		});
	}
	
});