<?php
    
  //Configure this information to login to your database
  $host = 'localhost';
  $dbname = 'inventaria';
  $dbuser = 'uinventaria';
  $dbpass = 'uinventaria';

  $db = mysql_connect($host, $dbuser, $dbpass);
  if (!$db) {
      die('No se puede conectar a la BD: ' . mysql_error());
  }
  $db_selected = mysql_select_db($dbname, $db);
  if (!$db_selected) {
      die ('No puedo seleccionar inventaria DB : ' . mysql_error());
  }

  echo 'Creating departments data table...';
  $sql =
    'create table `departments` ('
    . '`id` int(10) not null auto_increment primary key, '
    . '`name` varchar(255) not null, '
    . '`pass` varchar(40), '
    . 'constraint name_unique unique(`name`) ' 
    . ') engine = myIsam';
  $result = mysql_query($sql);
  if ($result) { echo 'OK<br/>'; }
  else { echo 'ERROR<br/>'; }

  echo 'Creating materials data table...';
  $sql = 
    'create table `materials` ('
    . '`id` int(10) not null auto_increment primary key, '
    . '`departid` int(10) not null, '
    . '`name` varchar(255) not null, '
    . '`observations` text, '
    . '`signDate` date not null, '
    . '`outDate` date '
    . ') engine = myIsam';
  $result = mysql_query($sql);
  if ($result) { echo 'OK<br/>'; }
  else { echo 'ERROR<br/>'; }
  
  echo 'Creating constraints...';
  $sql = 'ALTER TABLE materials ADD FOREIGN KEY(departid) REFERENCES departments(id)'; 
  $result = mysql_query($sql);
  if ($result) { echo 'OK<br/>'; }
  else { echo 'ERROR<br/>'; }

  echo 'Creating departments data---------------------------<br/>';
  $departments = array(
      'Religi&oacute;n',
      'Pl&aacute;stica',
      'Ciencias Sociales',
      'Tecnolog&iacute;a',
      'Franc&eacute;s',
      'Lat&iacute;n',
      'M&uacute;sica',
      'Gesti&oacute;n Administrativa',
      'F&iacute;sica y Qu&iacute;mica',
      'Educaci&oacute;n F&iacute;sica',
      'Biolog&iacute;a y Geolog&iacute;a',
      'Filosof&iacute;a',
      'Orientaci&oacute;n',
      'Matem&aacute;ticas',
      'Lengua',
      'Ingl&eacute;s',
  );
  
  foreach ($departments as &$department) {
      echo 'Creating ' .$department. ' table...';
      $sql = 'insert into `departments` (`id`, `name`, `pass`) '
             . 'values (NULL, \'' .$department. '\', NULL)';
      $result = mysql_query($sql);
      if ($result) { echo 'OK<br/>'; }
      else { echo 'ERROR<br/>'; }
  }

?>
