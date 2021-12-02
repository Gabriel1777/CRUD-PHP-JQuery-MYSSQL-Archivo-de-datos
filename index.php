<!DOCTYPE html>
<html>
<head lang="es">
	<title>Pruba técnica</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="assets/css/app.css" rel="stylesheet"/>
</head>
<body>

	<header>
		<nav>
			<ul>
				<li><a href="#" id="all">Todos</a></li>
				<li><a href="#" id="active">Activos</a></li>
				<li><a href="#" id="inactive">Inactivos</a></li>
				<li><a href="#" id="inwait">En espera</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<div class="alert alert-primary" role="alert">
            Debe ser un archivo con extensión .txt teneiendo encuenta la separación de filas y columnas de la siguiente manera: <br/>
            email<strong>,</strong>código<strong>,</strong>nombre<strong>,</strong>apellido - separamos columnas por '<strong>,</strong>'' y filas con '&' un ejemplo del archivo:
            email<strong>,</strong>código<strong>,</strong>nombre<strong>,</strong>apellido<strong>&</strong>email<strong>,</strong>código<strong>,</strong>nombre<strong>,</strong>apellido
            <br/>
            tener en cuenta el orden de los campos email<strong>,</strong>código<strong>,</strong>nombre<strong>,</strong>apellido
            <br/>
            cada fila debe tener minimo 2 columnas
            <br/>
            email<strong>,</strong>código<strong>&</strong>email<strong>,</strong>código<strong>,</strong>nombre<strong>,</strong>apellido
        </div>
		<div class="load-file">
			<div class="mb-3">
                <label for="formFile" class="form-label">Cargar adjunto de usuarios</label>
                <input id="load-file" class="form-control" type="file" id="formFile">
            </div>
            <button id="btn-load-file" type="button" class="btn btn-primary btn-load-file">Guardar adjunto</button>
		</div>


		<div class="table-content">
			<table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Código</th>
                    </tr>
                </thead>
                <tbody id="fill-table">
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
		</div>
		<div class="form-user">
			<div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="email" class="form-control" id="name" placeholder="pepito">
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Apellido</label>
                <input type="email" class="form-control" id="last_name" placeholder="perez">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="name@example.com">
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Código</label>
                <select class="form-select" id="code" aria-label="Default select example">
                    <option value="1">Activo</option>
                    <option value="2">Inactivo</option>
                    <option value="3">En espera</option>
                </select>
            </div>

            <button id="btn-load-file" type="button" class="btn btn-primary">Guardar</button>
		</div>
	</main>

	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/app.js"></script>

</body>
</html>