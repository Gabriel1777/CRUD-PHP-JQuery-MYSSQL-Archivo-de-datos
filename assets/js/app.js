$(document).ready(function(){

	var id = 0;
	var error = false;
	var action = 'save';
	var name = $('#name');
	var last_name = $('#last_name');
	var email = $('#email');
	var code = $('#code');
	code.val('');

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
                    <td><button class='btn btn-warning' id="btn-edit-user-${user.id}">edit</button></td>
                    <td><button class='btn btn-danger' id="btn-delete-user-${user.id}">delete</button></td>
                </tr>`;
			});

			table.html(html);

			users.map(user => {
				$(`#btn-edit-user-${user.id}`).click(function(e){
					id = user.id;
					action = 'update';
				    name.val(user.name);
				    code.val(user.code);
				    email.val(user.email);
				    last_name.val(user.last_name);
				    $(document).scrollTop(2000000000);
			    });

			    $(`#btn-delete-user-${user.id}`).click(function(e){
				    request({
			            url: `php/controller.php?method=delete&id=${user.id}`,
			            method: "DELETE"
		            }).then(res => {
			            fillTable();
			            if (JSON.parse(response).code == 200)
            	            alert("usuario eliminado exitosamente.");
            	        else
            		        alert(JSON.parse(response).data);
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

	$('#save-user').click(function(){
		error = false;

		if (!email.val()){
			error = true;
			email.addClass('is-invalid');
			$('#email-error').html('El email es requerido');
		}
		else if(!/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i.test(email.val())){
			error = true;
	     	email.addClass('is-invalid');
	     	$('#email-error').html('Dirección de correo invalida');
	    }
	    else
	    	email.removeClass('is-invalid');

		if (!code.val()){
			error = true;
			code.addClass('is-invalid');
			$('#code-error').html('El código es requerido');
		}
		else
			code.removeClass('is-invalid');

		if (!error){
			var formData = new FormData();
			formData.append('name', name.val());
			formData.append('last_name', last_name.val());
			formData.append('email', email.val());
			formData.append('code', code.val());

			request({
        	    method: "POST",
        	    data: formData,
        	    url: "php/controller.php?method=" + action + "&id=" + id,
        	    async: true,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
            }).then(response => {
            	fillTable();
            	if (JSON.parse(response).code == 200){
            		let currentAction = action == 'save' ? 'creado' : 'actualizado';
            	    alert("usuario " + currentAction + " exitosamente.");
            	    clean();
            	}
            	else
            		alert(JSON.parse(response).data);
            });
		}

	});

	function clean(){
		name.val('');
		last_name.val('');
		email.val('');
		code.val('');
		action = 'save';
	}

	$("#btn-load-file").click(function(){
		let files = $('#load-file')[0].files;

		if (files.length > 0){
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
            	if (JSON.parse(response).code == 200)
            	    alert("Archivo cargado exitosamente.");
            	else
            		alert(JSON.parse(response).data);
            });
        }
        else
        	alert("Debe seleccionar un archivo de texto antes de continuar");
    });

    fillTable();

});