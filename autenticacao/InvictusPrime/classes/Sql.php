<?php 

	class Sql extends PDO{

		private $conn;

		public function __construct(){
			$this->conn = new PDO("mysql:host=localhost;dbname=bd_invictus;charset=utf8", "root", "");
		}

		private function setParam($statement, $key, $value){
			$statement->bindParam($key, $value);
		}

		private function setParams($statement, $paramets = array()){
			foreach($paramets as $key => $value){
				$this->setParam($statement, $key, $value);
			}
		}

		public function query($codigoSql, $params = array()){
			$stmt = $this->conn->prepare($codigoSql);

			$this->setParams($stmt, $params);
			$stmt->execute();

			return $stmt;
		}

		public function select($codigoSql, $params = array()){
			$stmt = $this->query($codigoSql, $params);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

	}

 ?>