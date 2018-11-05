var from = 9;
window.addEventListener("scroll", load);
function load()
{
	if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight)
	{
		from = from+4;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
	  	if (this.readyState == 4 && this.status == 200) {
	    	document.getElementById("row").innerHTML += this.responseText;//zmienic element
	  		}
		};
		xhttp.open('GET','http://localhost:8888/load?from='+from, true);
		xhttp.send();
	}
}
