<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Empleado</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 120vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 20px;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }

        .alert {
            background-color: #e7f3fe;
            padding: 10px;
            color: #0366d6;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .form-group label {
            margin-right: 10px;
        }

        .a_guardar {
            font-size: 15px;
            color: white; 
            background-color: #0086b3; 
            padding: 10px 20px; 
            border-radius: 5px; 
            text-decoration: none;
        }
    </style>
</head>
<body>
    
    <div class="container">
    <h1>Crear Empleado</h1>
        <div class="alert">Los campos con asteriscos (*) son obligatorios</div>
        <form method="POST" action="?action=store" onsubmit="return validateForm();">
            <label for="name">Nombre Completo *</label>
            <input type="text" id="name" name="name" placeholder="Nombre completo del empleado" required>

            <label for="email">Correo Electrónico *</label>
            <input type="text" id="email" name="email" placeholder="Correo electrónico*" required>

            <label for="sexo">Sexo *</label>
            <div class="form-group">
                <input type="radio" id="masculino" name="sexo" value="M">
                <label for="masculino">Masculino</label>
            </div>
            <div class="form-group">
                <input type="radio" id="femenino" name="sexo" value="F">
                <label for="femenino">Femenino</label>
            </div>
 
            <label for="area">Área *</label>
            <select id="area" name="area" required>
                <option value="">Seleccione el área:</option>
                <?php foreach ($areas as $area): ?>
                    <option value="<?php echo $area['id']; ?>"><?php echo $area['nombre']; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="description">Descripción *</label>
            <textarea id="description" name="description" placeholder="Descripción de la experiencia del empleado"></textarea>

            <div>
                <input type="checkbox" id="boletin" name="boletin" value="1">
                <label for="boletin" style="margin-left: 25px;">Deseo recibir boletin informativo</label>
            </div><br>
                
            <label for="rol">Roles *</label>

            <?php foreach ($roles as $rol): ?>
                <div>
                    <input type="checkbox" id="rol" name="rol[]" value="<?php echo $rol['id']; ?>">
                    <label for="rol" style="margin-left: 25px;"><?php echo $rol['nombre']; ?></label>
                </div>

            <?php endforeach; ?>
            
            <button class="a_guardar" type="submit">Guardar</button>
        </form>
    </div>

    <script src="views/js/scripts.js"></script>

</body>
</html>
