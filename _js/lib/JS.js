var JS = {
	
	Now : function(){
		if (!Date.now) {
			Date.now = function() { return new Date().getTime(); }
		}
		else{ return Date.now();}
	}
	
}