<?php

require_once 'conexion.php';

class User extends Conexion {

    public $id;
	public $name;
	public $code;
	public $email;
	public $last_name;

	public function all($filter = null){

	  $query = "select * from users";

	  if ($filter)
	  	$query = $query . " where $filter";

	  $statement = $this->pdo->prepare($query);
	  $statement->execute();

	  $result = $statement->fetchAll(PDO::FETCH_OBJ);
	  return $result;

	}

	public function find($id){

	  $query = "select * from users where id = :id limit 0,1";
	  $statement = $this->pdo->prepare($query);
	  $statement->bindParam(':id' , $id , PDO::PARAM_STR);
	  $statement->execute();

	  $result = $statement->fetchAll(PDO::FETCH_OBJ);

	  if (count($result) > 0){
	  	$model = $result[0];
	  	$this->id = $model->id;
	  	$this->name = $model->name;
	  	$this->email = $model->email;
	  	$this->last_name = $model->last_name;
	  	return $this;
	  }
	  
	  return null;

	}

	public function save(){
		$query = "insert into users (name, last_name, email, code) values (:name , :last_name , :email , :code)";

		$statement = $this->pdo->prepare($query);
		$statement->bindParam(':name' , $this->name);
		$statement->bindParam(':code' , $this->code);
		$statement->bindParam(":email" , $this->email);
		$statement->bindParam(':last_name' , $this->last_name);

		$statement->execute();
	}

	public function update(){

		$query = "update users set name = :name , last_name = :last_name , email = :email , code = :code where id = :id";
		$statement = $this->pdo->prepare($query);

		$statement->execute(array(
		   ':name' => $this->name,
		   ':last_name' => $this->last_name,
		   ':email' => $this->email,
		   ':code' => $this->code,
		   ':id' => $this->id
		));

		$statement->execute();
	}

	public function lastInsert(){
		return $this->pdo->lastInsertId();
	}

	public function delete($id){
	  $query = "delete from users where id = :id";
	  $statement = $this->pdo->prepare($query);
	  $statement->bindParam(':id' , $id , PDO::PARAM_STR);
	  $statement->execute();
	  return true;
	}

}

?>