<?php  
require_once("config.php");

/*Consulta um usuário pelo ID
$user = new Usuario();
$user->loadById(5);

echo $user;
*/


/*Consulta todos usuários registrados 
$list = Usuario::getList();

echo json_encode($list);
*/


/*Consulta todos usuário(s) pelo Login, seguindo a regra SQL LIKE '%value%'
$buscar = Usuario::search("paulo");

echo json_encode($buscar);
*/


//CONSULTA USUÁRIO ATRAVÉS DE AUTENTICAÇÃO
$user = new Usuario();
$user->login("Paulo Florencio Junior", 123);

echo $user;


?>