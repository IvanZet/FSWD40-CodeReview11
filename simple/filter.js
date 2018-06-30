function filter() {
	//Read the chosen office
	let office = document.getElementById('office').value;
	xhttp = new XMLHttpRequest();
	//When response of the request arrives
	xhttp.onreadystatechange = function () {
		//Responce OK?
		if (this.readyState == 4 && this.status == 200) {
			//work with responce
			//Assign responce from php file to table body
			document.getElementById('table').innerHTML = this.responseText;
		}
	}
	//Try to execute the request
	xhttp.open('POST', 'filterOffice.php', true);
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); //!!! Required?
	xhttp.send('office=' + office);
}