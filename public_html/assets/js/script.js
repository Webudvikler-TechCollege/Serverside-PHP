function remove(id, $url) {
	if(confirm('Vil du slette denne post?')) {
		fetch($url)
			.then(response => response.json())
			.then(data => console.log(data))
	}

}