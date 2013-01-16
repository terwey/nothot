$(document).ready(function() {
	var count = 0;
	while (count <= 5) {
		getImage(count);
		count++;
	}
});

function getImage(idNumber) {
	$.getJSON('data.php', { id: idNumber }, function(data) {
		console.log(data);

		$("#images").append(
		'<div id="'+data.id+'" class="image">'+
			'<h1>'+data.title+'</h1>'+
			'<img src="'+data.src+'" />'+
		'</div>'
		);

	});
}