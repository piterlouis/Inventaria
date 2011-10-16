<?php
  require 'libs/Smarty.class.php';

  //$webapp = '/inventario/';  
  //$host   = 'localhost';
  //$dbname = 'ieszafra_inventario';
  //$dbuser = 'ieszafra_morales';
  //$dbpass = 'inventario2011';

  $webapp = '/inv/';  
  $host   = 'localhost';
  $dbname = 'inventaria';
  $dbuser = 'uinventaria';
  $dbpass = 'pasar';

  
  function opendb() {
      global $host, $dbname, $dbuser, $dbpass;
      
      $db = mysql_connect($host, $dbuser, $dbpass);
      if (!$db) {
          die('No se puede conectar a la BD: ' . mysql_error());
      }
      $db_selected = mysql_select_db($dbname, $db);
      if (!$db_selected) {
          die ('No puedo seleccionar inventaria DB : ' . mysql_error());
      }
      return $db;
  }
  
  function render_view($view, $data) {
      global $webapp;
      
      $smarty = new Smarty;
      $smarty->compile_check = true;
      $smarty->debugging = false;
      $smarty->use_sub_dirs = false;
      $smarty->caching = false;
      
      $data['webapp'] = $webapp;
      if (isset($_SESSION['departname'])) {
          $data['departname'] = $_SESSION['departname'];
      }
      $smarty->assign('data', $data);
      
      $smarty->display('views/' .$view. '.tpl'); 
  }
  
  //Check authentication data
  session_start();
  //print_r($_SESSION);
  $params['departid'] = (!empty($_SESSION['departid'])) ? $_SESSION['departid'] : null;
  
  //Extract Controller, Action and parameters from URL
  $query = $_SERVER['QUERY_STRING'];
  $request = explode('/', $query);
  $controller = (!empty($request[1])) ? $request[1] : 'main';
  $action =     (!empty($request[2])) ? $request[2] : 'index';
  if (count($request) > 3) {
      for ($i = 3; $i < count($request); $i++) {
          $px = 'p' . ($i - 2);
          $params[$px] = (!empty($request[$i])) ? $request[$i] : null;
      }
  }

  $isControllerOk = !strcmp($controller, 'main');
  $isActionOk = !strcmp($action, 'index') 
                || !strcmp($action, 'prelogin')
                || !strcmp($action, 'login')
                || !strcmp($action, 'addpasswd');
  if (!empty($params['departid']) || ($isControllerOk && $isActionOk)) {
      include('controllers/'.$controller.'.php');
      $instance = new $controller;
      $result = call_user_func(array($instance, $action), $params);
      $view = $result['view'];
      $data = $result['data'];
      render_view($view, $data);
  }
  else {
      header('Location: '.$webapp);
  }
      
?>
