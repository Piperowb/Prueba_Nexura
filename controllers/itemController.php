<?php
require_once './model/model.php';

class ItemController
{
    private $model;

    public function __construct()
    {
        // Inicializar el modelo
        $this->model = new ItemModel();
    }

    public function index()
    {
        // Obtener todos los items del modelo
        $items = $this->model->getAllItems();

        // Pasar los datos a la vista
        include 'views/item-list.php';
    }

    public function create()
    {   
        // Obtener los detalles de las areas
        $areas = $this->model->getAreas();

        // Obtener los detalles de los roles
        $roles = $this->model->getRoles();

        // Mostrar el formulario de creación de item
        include 'views/item-create.php';
    }

    public function store($data, $roles)
    {
        // Validación en el lado del servidor (PHP)
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Validar campos requeridos
            $errors = array();
            if (empty($data['name'])) {
                $errors[] = "Por favor, ingresa el nombre completo.";
            }

            if (empty($data['email'])) {
                $errors[] = "Por favor, ingresa el correo electrónico.";
            }

            // Validar formato de correo electrónico
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Por favor, ingresa un correo electrónico válido.";
            }

            // Errores adicionales
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p>Error: $error</p>";
                }
                exit; 
            }

            // Si la validación es exitosa, continuar con el procesamiento de los datos

            // Crear un nuevo item usando el modelo
            $this->model->createItem($data, $roles);

            // Redirigir al index
            header("Location: ?action=index&message=El registro se ha insertado exitosamente");
            exit();
        }
    }

    public function edit($id)
    {
        // Obtener los detalles de las areas
        $areas = $this->model->getAreas();

        // Obtener los detalles de los roles
        $roles = $this->model->getRoles();

        // Obtener los detalles del item del modelo
        $item = $this->model->getItemById($id);

        // Pasar los datos a la vista
        include 'views/item-edit.php';
    }

    public function update($id, $data, $roles)
    {
        // Validación en el lado del servidor (PHP)
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Validar campos requeridos
            $errors = array();
            if (empty($data['name'])) {
                $errors[] = "Por favor, ingresa el nombre completo.";
            }

            if (empty($data['email'])) {
                $errors[] = "Por favor, ingresa el correo electrónico.";
            }

            // Validar formato de correo electrónico
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Por favor, ingresa un correo electrónico válido.";
            }

            // Errores adicionales
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<p>Error: $error</p>";
                }
                exit; 
            }

            // Si la validación es exitosa, continuar con el procesamiento de los datos

            // Actualizar el item usando el modelo
            $rowCount = $this->model->updateItem($id, $data, $roles);

            // Redirigir al index
            header("Location: ?action=index&message=El registro se ha actualizado exitosamente");
            exit();
        }
    }

    public function delete($id)
    {
        // Eliminar el item usando el modelo
        $rowCount = $this->model->deleteItem($id);

        // Redirigir al index
        header("Location: ?action=index&message=El registro se ha eliminado exitosamente");
        exit();
    }
}
?>
