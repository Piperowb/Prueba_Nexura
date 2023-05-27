<?php
require_once 'controllers/itemController.php';

// Obtener la acción solicitada desde la cadena de consulta
$action = $_GET['action'] ?? 'index';

// Crear el controlador de items y llamar al método de acción correspondiente
$controller = new ItemController();

if ($action === 'index') {
    $controller->index();
} elseif ($action === 'create') {
    $controller->create();
} elseif ($action === 'store') {
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'sexo' => $_POST['sexo'],
        'area' => $_POST['area'],
        'description' => $_POST['description'],
        'boletin' => isset($_POST['boletin']) ? $_POST['boletin'] : 0,
    ];
    $roles = isset($_POST['rol']) ? $_POST['rol'] : array();
    $controller->store($data, $roles);
} elseif ($action === 'show') {
    $id = $_GET['id'] ?? null;
    $controller->show($id);
} elseif ($action === 'edit') {
    $id = $_GET['id'] ?? null;
    $controller->edit($id);
} elseif ($action === 'update') {
    $id = $_GET['id'] ?? null;
    $data = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'sexo' => $_POST['sexo'],
        'area' => $_POST['area'],
        'description' => $_POST['description'],
        'boletin' => isset($_POST['boletin']) ? $_POST['boletin'] : 0,
    ];
    $roles = isset($_POST['rol']) ? $_POST['rol'] : array();
    $controller->update($id, $data, $roles);
} elseif ($action === 'delete') {
    $id = $_GET['id'] ?? null;
    $controller->delete($id);
} else {
    // Manejar acción inválida
    echo 'Acción inválida';
}

?>