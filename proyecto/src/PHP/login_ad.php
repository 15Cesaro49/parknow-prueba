<!DOCTYPE html>
<html lang="es">
    <body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'crea';
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$conn) {
    die("Error de la conexion a la base de datos". mysqli_connect_error());
}

session_start();

if (!isset($_POST['email'])) {
    header('location:../login-ad.html');
}

$correo = $_POST['email'];
$contra = $_POST['password'];

$sql_admin = "SELECT * FROM administradores WHERE email = '$correo' and contra = '$contra'";
$result_admin = mysqli_query($conn, $sql_admin);
$existe1 = mysqli_num_rows($result_admin);


if ($existe1 > 0) {
    while ($row = mysqli_fetch_array($result_admin)) {
        if ($correo == $row['email'] && $contra == $row['contra']) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            echo "
            <script language='JavaScript'>
                swal.fire({
                    icon: 'success',
                    title: '¡Bienvenid@ a SaludRural Administrador!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(function() {
                    window.location = '../crud-ad/index.php';
                });
            </script>";
        }
    }
} else 
 {
    echo "
    <script language='JavaScript'>
        swal.fire({
            icon: 'error',
            title: 'Su usuario o contraseña pueden estar incorrecto',
            text: '¡Vuelva a ingresar sus datos!',
        }).then(function() {
            window.location = '../login-ad.html';
        });
    </script>
    ";
}

?>
</body>
</html>