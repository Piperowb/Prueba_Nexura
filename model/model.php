<?php

class ItemModel
{
    private $db;

    public function __construct()
    {
        // Iniciar conexion a la base de datos
        $this->db = new PDO('mysql:host=localhost;dbname=prueba_tecnica_dev', 'root', '');
    }

    public function getAllItems()
    {
        // Recuperar todos los elementos de la base de datos
        $query = $this->db->prepare('SELECT empleado.id, empleado.nombre, empleado.email, empleado.sexo, empleado.boletin, empleado.descripcion, area_id, areas.nombre as nombre_area 
                                     FROM empleado 
                                     INNER JOIN areas ON empleado.area_id = areas.id');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItemById($id)
    {
        // Recuperar un elemento por ID de la base de datos
        $query = $this->db->prepare('SELECT empleado.id, empleado.nombre, empleado.email, empleado.sexo, empleado.boletin, empleado.descripcion, rol_id, roles.nombre as nombre_rol, area_id, areas.nombre as nombre_area 
                                     FROM empleado 
                                     INNER JOIN empleado_rol ON empleado.id = empleado_rol.empleado_id 
                                     INNER JOIN roles ON empleado_rol.rol_id = roles.id 
                                     INNER JOIN areas ON empleado.area_id = areas.id 
                                     WHERE empleado.id = :id');
        $query->execute(['id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getRoles()
    {
        // Recuperar los roles
        $query = $this->db->prepare('SELECT * FROM roles');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAreas()
    {
        // Recuperar las areas
        $query = $this->db->prepare('SELECT * FROM areas');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createItem($data, $roles)
    {
        // Insertar los datos del crear
        $query = $this->db->prepare('INSERT INTO empleado (nombre, email, sexo, area_id, descripcion, boletin) VALUES (:name, :email, :sexo, :area, :description, :boletin)');
        $query->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'sexo' => $data['sexo'],
            'area' => $data['area'],
            'description' => $data['description'],
            'boletin' => $data['boletin']
        ]);

        $lastId = $this->db->lastInsertId();

        // Insertar los roles
        foreach ($roles as $rol) {
            $query = $this->db->prepare('INSERT INTO empleado_rol (empleado_id, rol_id) VALUES (:id, :rol)');
            $query->execute([
                'id' => $lastId,
                'rol' => $rol
            ]);
        }
        

        return $lastId;
    }

    public function updateItem($id, $data, $roles)
    {
        // Actualizar los datos
        $query = $this->db->prepare('UPDATE empleado SET nombre = :name, email = :email, sexo = :sexo, area_id = :area, descripcion = :description, boletin = :boletin 
                                     WHERE id = :id');
        $query->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'sexo' => $data['sexo'],
            'area' => $data['area'],
            'description' => $data['description'],
            'boletin' => $data['boletin'],
            'id' => $id
        ]);

        // Eliminar los roles para asi insertarlos nuevamente
        $queryDelRoles = $this->db->prepare('DELETE FROM empleado_rol WHERE empleado_id = :id');
        $queryDelRoles->execute(['id' => $id]);

        // Insertar los roles
        foreach ($roles as $rol) {
            $queryRoles = $this->db->prepare('INSERT INTO empleado_rol (empleado_id, rol_id) VALUES (:id, :rol)');
            $queryRoles->execute([
                'id' => $id,
                'rol' => $rol
            ]);
        }

        $querys = $query+$queryDelRoles+$queryRoles;

        return $query->rowCount();
    }

    public function deleteItem($id)
    {
        // Eliminar los datos
        $query = $this->db->prepare('DELETE empleado, empleado_rol FROM empleado
                                     LEFT JOIN empleado_rol ON empleado.id = empleado_rol.empleado_id
                                     WHERE empleado.id = :id');
        $query->execute(['id' => $id]);
        return $query->rowCount();
    }
}