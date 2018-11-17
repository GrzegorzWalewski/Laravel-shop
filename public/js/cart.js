if(window.location.pathname!="/")
{
	var url = window.location.href.replace(window.location.pathname, "");
}
else
{
	var url = window.location.href;
}
var starsDiv = document.getElementById('stars');
var stars = document.getElementsByClassName('glyphicon');
var inputStars = document.getElementById('starInput');
if(inputStars!=null)
{
	inputStars.value = 1;
	starsDiv.addEventListener('click',function()
	{
		var gold = 0;
		for(var i=0;i<stars.length;i++)
		{
			if(stars[i].classList[2]=="glyphicon-star")
			{
				gold++;
			}
		}
		inputStars.value = gold;
	});
}
var quant = document.getElementById('quant');
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
		if(quant==null)
		{
			quant = 1;
		}
		else
		{
			quant = quant.value;
		}
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
	  	if (this.readyState == 4 && this.status == 200) {
	    	document.getElementById("cart").innerHTML = "Cart: "+this.responseText;
	  		}
		};
		
		xhttp.open('GET',url+'/cart/add?id='+id+'&quantity='+quant, true);
		xhttp.send();
}