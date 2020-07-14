<?php
@session_start();

include('conection.php');

if(empty($_POST['user']) || empty($_POST['password'])) {
	header('Location: ../../login.php');
	exit();
}
 
$user = mysqli_real_escape_string($con, $_POST['user']);
$password = mysqli_real_escape_string($con, $_POST['password']);
 
$query = "select * from usuario where usuario = '{$user}' and usu_senha = md5('{$password}')";
$result_user = mysqli_query($con, $query);
$result = mysqli_fetch_assoc($result_user);

                    
    $_SESSION['access_level'] = $result['usu_acesso'];

$result_row = mysqli_query($con, $query);
$row = mysqli_num_rows($result_row);


if($row == 1 ) {
    if ($_SESSION['access_level'] == "1") {
        $_SESSION['login'] = $user;
        $_SESSION['adm'] = 1;
        header("Location: ../../home");
        exit();
    } elseif ($_SESSION['access_level'] == "2") {
        $_SESSION['login'] = $user;
        header("Location: ../../home");
        exit();
    } 
} else {
	$_SESSION['nao_autenticado'] = true;
	header('Location: ../../login.php');
	exit();
}




?>