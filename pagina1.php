<?php

    /* CONFIG */
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "scomentarios1";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){ die("conexion fallida: " . $conn->connect_error); }

    /* INSERTAR COMENTARIO */
    if(isset($_POST['postear_comentario'])){
        $nombre = $_POST["nombre"];
        $comentario = $_POST["comentario"];

        $sql = "INSERT INTO video1 (nombre, comentario) VALUES ('$nombre', '$comentario')";
        if($conn->query($sql) === true) header("Location: http://localhost/xampp/scomentarios/pagina1.php");
        else echo "Hubo un problema cargando el comentario!";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div id="div1">
        <video width="640" height="360" controls>
            <source src="mi-video.mp4" type="video/mp4">
            Tu navegador no soporta la etiqueta de video.
        </video>

        <section id="comentarios">
            <?php
                $sql = "SELECT * FROM video1";
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo '<div class="comments">';
                        echo "<p><b>" . $row["nombre"] . "</b></p>";
                        echo "<p>" . $row["comentario"] . "</p>";
                        echo "</div>";
                    }
                }
            ?>
        </section>
    </div>

    <div id="div2">
        <article id="otros">otros videos</article>

        <form method="post">
            <input type="text" placeholder="Nombre de usuario" name="nombre">
            <textarea id="comentario" name="comentario" rows="4" cols="50" placeholder="Comentario"></textarea>
            <button type="submit" name="postear_comentario">PUBLICAR</button>
        </form>
    </div>

    <link rel="stylesheet" href="style_pagina1.css">
</body>
</html>

<?php $conn->close(); ?>