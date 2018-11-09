var from = 9;
var categoryId = document.getElementById('category_id');
var category = "";
if(window.location.pathname!="/")
{
	var url = window.location.href.replace(window.location.pathname, "");
}
else
{
	var url = window.location.href;
}
var url = url.replace('#','');
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
	    	document.getElementById("row").innerHTML += this.responseText;
	  		}
		};
		
		xhttp.open('GET',url+'/load?from='+from+'&category='+category+'&sale='+sale, true);
		xhttp.send();
	}
}