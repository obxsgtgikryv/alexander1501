<?php
	require_once 'employee.php';
	require_once 'database.php';

	$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
	$editing = $action=='edit';
	$employee = new Employee();
	$database = new Database();

		switch($action) {
			case 'create':
				$employee->__set('Nombre',   $_REQUEST['Nombre']);
				$employee->__set('Apellido', $_REQUEST['Apellido']);
				$employee->__set('Correo',   $_REQUEST['Correo']);

				$database->create($employee);
				header('Location: index.php');
				break;

			case 'edit':
				$employee = $database->read($_REQUEST['id']);
				break;

			case 'update':
				$employee->__set('id',       $_REQUEST['id']);
				$employee->__set('Nombre',   $_REQUEST['Nombre']);
				$employee->__set('Apellido', $_REQUEST['Apellido']);
				$employee->__set('Correo',   $_REQUEST['Correo']);

				$database->update($employee);
				header('Location: index.php');
				break;

			case 'delete':
				$database->delete($_REQUEST['id']);
				header('Location: index.php');
				break;
		}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Unidad 1501</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="images/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<div class="box-container">
		<div class="box-wrapper">

			<!-- Form -->
			<form class="form-wrapper" method="post" action="?action=<?php echo $employee->id > 0 ? 'update' : 'create'; ?>">
				<span class="form-title">
					Listado U.P.T.N.M.L.S
				</span>

				<!-- ID -->
				<input type="hidden" name="id" value="<?php echo $employee->__get('id'); ?>"/>

				<!-- First name -->
				<div class="field-wrapper">
					<input class="input-field" type="text" placeholder="Nombre" name="Nombre" value="<?php echo $employee->__get('Nombre'); ?>">
					<span class="focus-field"></span>
				</div>

				<!-- Last name -->
				<div class="field-wrapper">
					<input class="input-field" type="text" placeholder="Apellido" name="Apellido" value="<?php echo $employee->__get('Apellido'); ?>">
					<span class="focus-field"></span>
				</div>

				<!-- E-mail -->
				<div class="field-wrapper">
					<input class="input-field" type="text" placeholder="Correo electrónico" name="Correo" value="<?php echo $employee->__get('Correo'); ?>">
					<span class="focus-field"></span>
				</div>

				<!-- Save -->
				<div class="button-wrapper">
					<button class="form-button" type="submit">
						<?php echo $editing ? 'Actualizar' : 'Agregar'; ?>
					</button>
				</div>

				<!-- Table -->
				<?php if (count($database->getAll())>0): ?>
					<table>
						<thead>
							<tr>
								<th style="text-align:left;">Nombre</th>
								<th style="text-align:left;">Apellido</th>
								<th style="text-align:left;">Correo electrónico</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<?php foreach($database->getAll() as $employee): ?>
							<tr>
								<td><?php echo $employee->__get('Nombre'); ?></td>
								<td><?php echo $employee->__get('Apellido'); ?></td>
								<td><?php echo $employee->__get('Correo'); ?></td>
								<td>
									<a href="?action=edit&id=<?php echo $employee->id; ?>">Editar</a>
								</td>
								<td>
									<a href="?action=delete&id=<?php echo $employee->id; ?>">Eliminar</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				<?php endif; ?>
			</form>

		</div>
	</div>
</body>
</html>