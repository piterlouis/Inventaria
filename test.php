<?php
if (empty($_POST)) {
  $db = mysql_connect('localhost', 'uinventaria', 'pasar');
  if (!$db) {
    die('No se puede conectar a la BD: ' . mysql_error());
  }
  $db_selected = mysql_select_db('inventaria', $db);
  if (!$db_selected) {
    die ('No puedo seleccionar inventaria DB : ' . mysql_error());
  }
  $result = mysql_query('SELECT id, name FROM Departments ORDER BY name ASC');
  
  echo '<form action="test.php" method="post">';
  echo '<select name="department">';
  echo '<option value="">Selecciona un Departamento</option>';
  while ($row = mysql_fetch_assoc($result)) {
    echo '<option value="' . $row['id'] .'">' . $row['name'] . '</option>';
  }
  echo '</select>';
  echo '<input type="submit" value="Acceder" />';
  echo '</form>'; 
  mysql_close($db);
}
else {
  $department = $_POST['department'];
  if (empty($department)) {
    echo "Error!!";
  }
  else {
    $db = mysql_connect('localhost', 'uinventaria', 'pasar');
    if (!$db) {
      die('No se puede conectar a la BD: ' . mysql_error());
    }
    $db_selected = mysql_select_db('inventaria', $db);
    if (!$db_selected) {
      die ('No puedo seleccionar inventaria DB : ' . mysql_error());
    }
    $result = mysql_query('SELECT id, name, pass FROM Departments WHERE id='.$department);
    if (mysql_num_rows($result) > 0) {
      echo "Autenticacion de usuario.."
       $row = mysql_fetch_assoc($result);
       if ($row['pass'] == $_POST['pass']) {
        echo 'OK';
       }
    }
    else {
      echo "Login correcto, pasamos a la siguiente page";
    }
  }
//  echo 'department: ' . $_POST['department'];
//  echo '<br /><br />';
//  echo '<a href="test.php">Volver</a>';
}
?>
