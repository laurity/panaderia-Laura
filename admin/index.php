<?php
session_start();
include '../includes/config/database.php';

function listarPanaderia()
{
    $bd = conectarDB();
    $consulta = $bd->prepare("SELECT id, nombre, descripcion, precio, imagen FROM productos");
    $consulta->execute();

    $resultado = $consulta->get_result(); 
?>
    <table>
    <h1>Zona Admin</h1>
    <p>Si desea crear un producto, clickar aquí <a href="./propiedades/crear.php">Crear Producto</a></p>
    <?php while ($row = $resultado->fetch_assoc()): ?>
        <tr>
            <?php
            if (!empty($row['imagen'])) {
                echo "<td><img src='../imagenes/" . $row['imagen'] . "' width='100'></td>";
            } else {
                echo "<td><img src='https://via.placeholder.com/150' width='100'></td>";
            }
            ?>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['descripcion'] ?></td>
            <td><?= $row['precio'] ?>€</td>
            <td>
                <form action='<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post' style='display: inline;'>
                    <input type='hidden' name='id' value='<?= $row['id'] ?>'>
                    <button type='submit' class='edit' name='editar'>Editar</button>
                </form>

                <form action='<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>' method='post' style='display: inline;'>
                    <input type='hidden' name='id' value='<?= $row['id'] ?>'>
                    <button type='submit' class='delete' name='borrar'>Borrar</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
    </table>
<?php
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../styles/admin.css">
    <title>Panadería</title>
</head>
<body>
    <?php listarPanaderia(); ?>
    <a href='../../index.php?logout=true'>Cerrar Sesión</a>
</body>
</html>