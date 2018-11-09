var from = 8;
var categoryId = document.getElementById('category_id');
var category = "";
var search = document.getElementById('searchQuote');
if(search!=null)
{
	var search = document.getElementById('searchQuote').className;
}
else
{
	var search = "";
}
if(categoryId!=null)
{
	var category = categoryId.className;
}
if(document.getElementById('sale')!=null)
{
	var sale = true;
}
else
{
	var sale = false;
}
window.addEventListener("scroll", load);
function load()
{
	if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight)
	{
		from = from+4;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
	  	if (this.readyState == 4 && this.status == 200) {
	  		if(this.responseText!="")
	  		{
	  			document.getElementById("row").innerHTML += this.responseText;
	  		}
	  		}
		};
		
		xhttp.open('GET',window.location.origin+'/load?from='+from+'&searchQuote='+search+'&category='+category+'&sale='+sale, true);
		xhttp.send();
	}
}