/* COMMON FUNCTIONS THAT SHOULD HAVE BEEN IN THE Javascript Specs */

function arrayKey(needle, haystack){
	for(var i=0; i<haystack.length;i++){
		if(haystack[i] == needle){return i;}
	}
	return -1;
}

var JS = {
	
	Now : function(){
		if (!Date.now) {
			Date.now = function() { return new Date().getTime(); }
		}
		else{ return Date.now();}
	}
	
}