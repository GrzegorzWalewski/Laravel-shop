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
		
		xhttp.open('GET','http://localhost:8000/cart/add?id='+id, true);
		xhttp.send();
}