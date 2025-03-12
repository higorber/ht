<?php
function sanitize($dirty){
    return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}


//Function to log an admin IN
function login($userID) {
    $_SESSION['casf_user'] = $userID;
    global $db;
    $date = date("Y-m-d H:i:s");
    $db->query("UPDATE users SET last_login = '$date' WHERE id = '$userID' ");
    $_SESSION['logged_in'] = 'Login Efetuado Com Sucesso';
    header("Location: index.php");
}

//function to check if the user is logged in
function is_logged_in(){
    if(isset($_SESSION['casf_user']) && $_SESSION['casf_user'] > 0){
        return true;
    }
        return false;
}

// function setUserId($user) {
//   global $userId; // Define a variável global $userId
//   $userId = $user;
// }

function login_error_check($redirect = 'login.php'){
    $_SESSION['error_flash'] = 'Você deve estar logado para visualizar essa página.';
    header('Location: '.$redirect);
}

function permission_error($url = 'index.php'){
  $_SESSION['permission_error'] = 'Você não tem permissão para acessar essa página';
  header('Location: '.$url);
}

function permission($permission = 'admin'){
  global $user_info;
  $permissions = explode(',', $user_info['permissions']);
  if(in_array($permission, $permissions,true)) {
    return true;
  }
    return false;
}

function hospede($permission = 'editor'){
  global $user_info;
  $permissions = explode(',', $user_info['permissions']);
  if(in_array($permission, $permissions,true)) {
    return true;
  }
    return false;
}

 ?>
