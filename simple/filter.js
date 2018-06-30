function filter() {
	//Read the chosen office
	let office = document.getElementById('office').value;
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			//Assign responce from php file to table body
			document.getElementById('table').innerHTML = this.responseText;
		}
	}
	xhttp.open('POST', 'filterOffice.php', true);
	xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); //!!! Required?
	xhttp.send('office=' + office);
}