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

    $sql = "SELECT * FROM video1 WHERE id = $comentarioId";
    $response = $conn->query($sql);

    $row = $response->fetch_assoc();
    $dislikesActuales = $row['dislikes'];
    $nuevosDislikes = $dislikesActuales + 1;

    $sql = "UPDATE video1 SET dislikes = $nuevosDislikes WHERE id = $comentarioId";
    $conn->query($sql);

    $conn->close();
?>