if(window.location.pathname!="/")
{
	var url = window.location.href.replace(window.location.pathname, "");
}
else
{
	var url = window.location.href;
}
var url = url.replace('#','');
var products = document.getElementsByClassName("add-to-cart");
for (var i = 0; i < products.length; i++) 
{
	products[i].addEventListener('click',function(){
		put(this.id);
	});
}
function put(id)
{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
	  	if (this.readyState == 4 && this.status == 200) {
	    	document.getElementById("cart").innerHTML = "Cart: "+this.responseText;
	  		}
		};
		
		xhttp.open('GET',url+'/cart/add?id='+id, true);
		xhttp.send();
}