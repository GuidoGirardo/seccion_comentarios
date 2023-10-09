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

        $sql = "INSERT INTO video4 (nombre, comentario) VALUES ('$nombre', '$comentario')";
        if($conn->query($sql) === true) header("Location: http://localhost/xampp/scomentarios/pagina4.php");
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

        <iframe width="100%" height="335px" src="https://www.youtube.com/embed/7cBM_chGv0g?si=KEGQxiQ8f8Uhoj_G" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

        <section id="comentarios">
            <?php
                $sql = "SELECT * FROM video4";
                $result = $conn->query($sql);

                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo '<div class="comments">';
                        echo "<p><b>" . $row["nombre"] . "</b></p>";
                        echo "<p>" . $row["comentario"] . "</p>";
                        echo "<p>" . $row["likes"] . "</p>";
                        echo "<p>" . $row["dislikes"] . "</p>";
                        echo "<button class='btnLike' video='video4' data-id='{$row['id']}'>LIKE</button>";
                        echo "<button class='btnDislike' video='video4' data-id='{$row['id']}'>DISLIKE</button>";
                        echo "</div>";
                    }
                }
            ?>
        </section>
    </div>

    <div id="div2">
        <article id="otros">
            <a href="http://localhost/xampp/scomentarios/pagina1.php" class="video" id="v2">V1</a>
            <a href="http://localhost/xampp/scomentarios/pagina2.php" class="video" id="v4">V2</a>
            <a href="http://localhost/xampp/scomentarios/pagina3.php" class="video" id="v3">V3</a>
        </article>

        <form method="post">
            <input type="text" placeholder="Nombre de usuario" name="nombre">
            <textarea id="comentario" name="comentario" rows="4" cols="50" placeholder="Comentario"></textarea>
            <button type="submit" name="postear_comentario">PUBLICAR</button>
        </form>
    </div>

    <script src="script_p1.js"></script>
    <link rel="stylesheet" href="style_pagina1.css">
</body>
</html>

<?php $conn->close(); ?>