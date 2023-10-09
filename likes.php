<?php

    /* CONFIG */
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "scomentarios1";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error){ die("conexion fallida: " . $conn->connect_error); }

    /* TEMA LIKES Y DISLIKES */
    $data = json_decode(file_get_contents('php://input'), true);
    $comentarioId = $data['comentarioId'];
    $video = $data['video'];

    $sql = "SELECT * FROM $video WHERE id = $comentarioId";
    $response = $conn->query($sql);

    $row = $response->fetch_assoc();
    $likesActuales = $row['likes'];
    $nuevosLikes = $likesActuales + 1;

    $sql = "UPDATE $video SET likes = $nuevosLikes WHERE id = $comentarioId";
    $conn->query($sql);

    echo $video;

    $conn->close();

?>