<?php 

require_once 'users.php';

class Controller {

	public function files(){
		if (!isset($_FILES['attachment']))
			return $this->showMessage('El archivo adjunto es requerido', 400);
		else{
			$file = $_FILES['attachment'];

			if ($file['type'] != 'text/plain')
				return $this->showMessage("El archivo seleccionado debe ser de tipo texto con extensión .txt", 400);

			$fileName = '../assets/files/attachment.txt';
			move_uploaded_file($file['tmp_name'], $fileName);
			$attachment = fopen($fileName, 'r');
			$content = fread($attachment, filesize($fileName));
			$rows = explode('&', $content);

			foreach ($rows as $row){
				$column = explode(',', $row);
				if (count($column) < 2)
					return $this->showMessage('El archivo seleccionado no tiene el formato correcto. cada fila debe tener minimo 2 columnas ejemplo: email,code&email,code', 400);

				if ($column[1] != 1 && $column[1] != 2 && $column[1] != 3)
					return $this->showMessage("El código debe ser un número entre 1,2,3", 400);

				$user = new User();
				$user->email = $column[0];
				$user->code = $column[1];

				if (isset($column[2]))
				    $user->name = $column[2];

				if (isset($column[3]))
				    $user->last_name = $column[3];

				$user->save();
			}

			return $this->showMessage("Usuarios guardados exitosamente.", 200);
		}
	}

	public function index(){
		$filter = isset($_GET['filter']) ? $_GET['filter'] : null;
		echo json_encode(['data' => (new User())->all($filter), 'code' => 200]);
	}

	public function save(){
		$user = new User();
		$user->name = $_POST['name'];
		$user->last_name = $_POST['last_name'];
		$user->email = $_POST['email'];
		$user->code = $_POST['code'];
		$user->save();
		return $this->showMessage("Usuario creado exitosamente.", 200);
	}

	public function update(){
		if (!isset($_GET['id']))
			return $this->showMessage("Debe envíar el id de usuario", 400);

		$user = new User();
		$user->id = $_GET['id'];
		$user->name = $_POST['name'];
		$user->last_name = $_POST['last_name'];
		$user->email = $_POST['email'];
		$user->code = $_POST['code'];
		$user->update();
		return $this->showMessage("Usuario actualizado exitosamente.", 200);
	}

	public function delete(){
		(new User())->delete($_GET['id']);
		return $this->showMessage('Usuario eliminado exitosamente.', 200);
	}

	private function showMessage($error, $code){
		echo json_encode([
			'data' => $error,
			'code' => $code
		]);
	}
}

$controller = new Controller();
$method = isset($_GET["method"]) ? $_GET["method"] : "index";
call_user_func(array($controller , $method));