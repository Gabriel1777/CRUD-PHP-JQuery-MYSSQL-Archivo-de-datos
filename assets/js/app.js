$(document).ready(function(){

	function request({ url, method, data, ...rest }){
		return $.ajax({
			url,
			data,
			method, 
			success: function(result){
                console.log("success: ", result);
            },
            error: function(error){
            	console.log("error: ", error);
            },
            ...rest
        });
	}

	function fillTable(filter = ''){
		let res = request({
			method: "GET",
			url: "php/controller.php?method=index&" + filter
		});
		
		res.then(response => {
			var html = '';
			var users = JSON.parse(response).data;
			var table = $('#fill-table');

			users.map(user => {
				html = html + `
				<tr>
				    <th scope="row">${user.id}</th>
                    <td>${user.name}</td>
                    <td>${user.last_name}</td>
                    <td>${user.email}</td>
                    <td>${user.code}</td>
                    <td><button class='btn btn-warning'>edit</button></td>
                    <td><button class='btn btn-danger' id="btn-delete-user-${user.id}">delete</button></td>
                </tr>`;
			});

			table.html(html);

			users.map(user => {
				$(`#btn-delete-user-${user.id}`).click(function(e){
				    request({
			            url: `php/controller.php?method=delete&id=${user.id}`,
			            method: "DELETE"
		            }).then(res => {
			            fillTable();
		            });
			    });
			});
		});
	}

	$('#all').click(function(){
		fillTable();
	});

	$('#active').click(function(){
		fillTable('filter=code = 1');
	});

	$('#inactive').click(function(){
		fillTable('filter=code = 2');
	});

	$('#inwait').click(function(){
		fillTable('filter=code = 3');
	});

	$("#btn-load-file").click(function(){
		let files = $('#load-file')[0].files;

		if (true){
			let file = files[0];

			if (file.type != 'text/plain')
				alert("El archivo seleccionado debe ser de tipo texto con extensión .txt");

		    let formData = new FormData();
		    formData.append("attachment", file);

            request({
        	    method: "POST",
        	    data: formData,
        	    url: "php/controller.php?method=files",
        	    async: true,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
            }).then(response => {
            	fillTable();
            });
        }
    });

    fillTable();

});