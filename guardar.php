<?php
include 'conexion.php';

// Determinar el tipo de solicitud
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['usuario_id'])) {
        // Obtener actividades de un usuario específico
        $usuario_id = intval($_GET['usuario_id']);
        $query = "SELECT * FROM actividades WHERE id_usuario = $usuario_id";
        $result = $conn->query($query);
        $actividades = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $actividades[] = $row;
            }
        }

        echo json_encode($actividades);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear nueva actividad
    $data = json_decode(file_get_contents("php://input"), true);
    $id_usuario = intval($data['id_usuario']);
    $titulo = $data['titulo'];
    $descripcion = $data['descripcion'];
    $fecha_inicio = $data['fecha_hora_inicio'];
    $fecha_fin = $data['fecha_hora_fin'];
    $prioridad = $data['prioridad'];
    $estado = $data['estado'];

    $query = "INSERT INTO actividades (id_usuario, titulo, descripcion, fecha_hora_inicio, fecha_hora_fin, prioridad, estado)
              VALUES ('$id_usuario', '$titulo', '$descripcion', '$fecha_inicio', '$fecha_fin', '$prioridad', '$estado')";

    if ($conn->query($query) === TRUE) {
        echo json_encode(["message" => "Actividad creada correctamente"]);
    } else {
        echo json_encode(["error" => $conn->error]);
    }
}
?>
