<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" src="style.css" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
       $conexion = new PDO('mysql:host=localhost;dbname=recuperacion_su_numero_carnet', 'root', '', $pdo_options);

       if (isset($_POST["accion"])){
        //echo "Quieres " . $_POST["accion"];
        if ($_POST["accion"] == "crear"){
           $insert = $conexion->prepare("INSERT INTO recuperacion_su_numero_carnet (Codigo,Nombre,Precio, Existencia) VALUES 
           (:Codigo,:Nombre,:Precio,:Existencia)");
           $insert->bindValue('', $_POST['']);
           $insert->bindValue('Codigo', $_POST['Codigo']);
           $insert->bindValue('Nombre', $_POST['Nombre']);
           $insert->bindValue('Precio', $_POST['Precio']);
           $insert->bindValue('Existencia', $_POST['Existencia']);
           $insert->execute();
        }                   
       }
       
       $select = $conexion->query("SELECT Codigo, Nombre, Precio, Existencia FROM recuperacion_su_numero_carnet");

    ?>

    <?php if (isset($_POST["accion"]) && $_POST["accion"] == "Editar" ) { ?>
    <form method="POST">
        <input type="text" name="Codigo" placeholder="Ingresa el Codigo"/>
        <input type="text" name="Nombre" placeholder="Ingresa el Nombre"/>
        <input type="text" name="Precio" placeholder="Ingresa el Precio"/>
        <input type="text" name="Existencia" placeholder="Ingresa la Existencia"/>
        <input type="hidden" name="accion" value="crear"/>
        <button type="submit">Guardar </button>
    </form>
    <form>
            <?php } else { ?>
                <form method="POST"     
        <input type="text" name="Codigo" placeholder="Ingresa el Codigo"/>
        <input type="text" name="Nombre" placeholder="Ingresa el Nombre"/>
        <input type="text" name="Precio" placeholder="Ingresa el Precio"/>
        <input type="text" name="Existencia" placeholder="Ingresa la Existencia"/>
        <input type="hidden" name="accion" value="crear"/>
        <button type="submit">Crear </button>
            </form>        
        <?php } ?>
    <table border ="1">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Existencia</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($select->fetchAll() as $Producto) { ?>
                <tr>
                    <td> <?php echo $Producto["Codigo"] ?> </td>
                    <td> <?php echo $Producto["Nombre"] ?> </td>
                    <td> <?php echo $Producto["Precio"] ?> </td>
                    <td> <?php echo $Producto["Existencia"] ?> </td>
                    <td> <form method="POST" >
                            <button type="submit">Editar</button>
                            <input type="hidden" name="accion" value="Editar"/>
                            <input type="hidden" name="Codigo" value="<?php echo $Producto["Codigo"] ?>"/>
            </form>
            </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>