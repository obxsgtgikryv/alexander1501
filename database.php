<?php
class Database {
	private $pdo;

	function __construct() {
		try {
			$this->pdo = new PDO('mysql:host=localhost;dbname=db_uptnmls', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(Exception $exception) {
			die($exception->getMessage());
		}
	}

	function create(Employee $employee) {
		try {
			$sql = "INSERT INTO empleados
							(Nombre, Apellido, Correo)
							VALUES (?, ?, ?)";

			$this->pdo->prepare($sql)->execute(
				array(
					$employee->__get('Nombre'),
					$employee->__get('Apellido'),
					$employee->__get('Correo'),
				)
			);
		} catch (Exception $exception) {
			die($exception->getMessage());
		}
	}

	function read($id) {
		try {
			$stmt = $this->pdo->prepare("SELECT * FROM empleados WHERE id = ?");
			$stmt->execute(array($id));
			$employee = $stmt->fetch(PDO::FETCH_OBJ);

			if ($employee==null) {
				return null;
			} else {
				$result = new Employee();
				$result->__set('id', $employee->id);
				$result->__set('Nombre', $employee->Nombre);
				$result->__set('Apellido', $employee->Apellido);
				$result->__set('Correo', $employee->Correo);

				return $result;
			}
		} catch (Exception $exception) {
			die($exception->getMessage());
		}
	}

	function update(Employee $employee) {
		try {
			$sql = "UPDATE empleados SET
							Nombre          = ?,
							Apellido        = ?,
							Correo          = ?
				  	  WHERE id = ?";

			$this->pdo->prepare($sql)->execute(
				array(
					$employee->__get('Nombre'),
					$employee->__get('Apellido'),
					$employee->__get('Correo'),
					$employee->__get('id'),
				)
			);
		} catch (Exception $exception) {
			die($exception->getMessage());
		}
	}

	function delete($id) {
		try {
			$stmt = $this->pdo->prepare("DELETE FROM empleados WHERE id = ?");
			$stmt->execute(array($id));
		} catch (Exception $exception) {
			die($exception->getMessage());
		}
	}

	function getAll() {
		try {
			$stmt = $this->pdo->prepare("SELECT * FROM empleados");
			$stmt->execute();

			$result = array();

			foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $employee) {
				$current = new Employee();

				$current->__set('id', $employee->id);
				$current->__set('Nombre', $employee->Nombre);
				$current->__set('Apellido', $employee->Apellido);
				$current->__set('Correo', $employee->Correo);

				$result[] = $current;
			}

			return $result;
		} catch(Exception $exception) {
			die($exception->getMessage());
		}
	}
}
?>