<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'nombre_base_datos';
$username = 'usuario';
$password = 'contraseña';

// Datos simulados de respaldo
$usuariosSimulados = [
    ['email' => 'usuario1@example.com', 'password' => '12345678'],
    ['email' => 'usuario2@example.com', 'password' => 'contraseña'],
    ['email' => 'admin@example.com', 'password' => 'admin123']
];

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener datos enviados por el formulario
    $input = json_decode(file_get_contents('php://input'), true);
    $email = $input['email'] ?? '';
    $password = $input['password'] ?? '';

    // Verificar si el correo existe en la base de datos
    $stmt = $pdo->prepare("SELECT password FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        // Validar contraseña si el correo existe
        if ($resultado['password'] === $password) {
            echo json_encode(['exito' => true, 'mensaje' => 'Inicio de sesión exitoso.']);
        } else {
            echo json_encode(['exito' => false, 'mensaje' => 'Contraseña incorrecta.']);
        }
    } else {
        // Si no está en la base de datos, verificar en los datos simulados
        $usuarioEncontrado = false;

        foreach ($usuariosSimulados as $usuario) {
            if ($usuario['email'] === $email && $usuario['password'] === $password) {
                $usuarioEncontrado = true;
                break;
            }
        }

        if ($usuarioEncontrado) {
            echo json_encode(['exito' => true, 'mensaje' => 'Inicio de sesión exitoso. (Datos simulados)']);
        } else {
            echo json_encode(['exito' => false, 'mensaje' => 'El correo no está registrado.']);
        }
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['exito' => false, 'mensaje' => 'Error en el servidor: ' . $e->getMessage()]);
}
?>
