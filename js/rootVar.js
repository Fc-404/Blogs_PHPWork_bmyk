// JavaScript Document
var BRAND = '博美雅客';

//
var toHref = (
	function(href, sign){
		this.href = href;
		this.sign = sign;
		return (function(){
			window.location.href = this.href + (this.sign ? '?' : '') + this.sign;
			}
		)
	}
)