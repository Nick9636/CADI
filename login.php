$host = 'localhost'; // Cambiar si es necesario
$dbname = 'mi_sistema'; // Nombre de la base de datos
$username = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña del usuario

// Conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Obtener datos enviados por el formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Consulta para buscar el usuario
$sql = "SELECT * FROM usuarios WHERE email = :email AND password = :password";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email, 'password' => $password]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Validar credenciales
if ($usuario) {
    // Credenciales correctas
    echo "<h1>¡Bienvenido, {$usuario['email']}!</h1>";
    echo "<p>Inicio de sesión exitoso.</p>";
    echo '<a href="index2.0.html">Ir al sistema</a>';
} else {
    // Credenciales incorrectas
    echo "<h1>Error</h1>";
    echo "<p>Correo o contraseña incorrectos.</p>";
    echo '<a href="index.html">Volver al login</a>';
}
?>
