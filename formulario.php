<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Compras</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Formulario de Compras</h1>
        <form action="generar_pdf.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" required placeholder="Ingresa tu nombre completo">
            </div>

            <div class="form-group">
                <label for="dni">DNI:</label>
                <input type="text" id="dni" name="dni" required placeholder="Ingresa tu DNI">
            </div>

            <div class="form-group">
                <label for="producto">Producto:</label>
                <input type="text" id="producto" name="producto" required placeholder="Nombre del producto">
            </div>

            <div class="form-group">
                <label for="precio_unitario">Precio Unitario:</label>
                <input type="number" step="0.01" id="precio_unitario" name="precio_unitario" required placeholder="Precio del producto">
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required placeholder="Cantidad de producto">
            </div>

            <button type="submit">Generar PDF</button>
        </form>
    </div>
</body>
</html>
