<?php

class main {

  public function index() {
      $db = opendb();
      $result = mysql_query('SELECT id, name FROM departments ORDER BY name ASC');      
      while ($row = mysql_fetch_assoc($result)) {
        $values[] = $row;
      }
      mysql_close($db);
      
      return(array('view' => 'login', 
                   'data' => array('regs' => $values)));
  }
  
  public function prelogin() {
      $departid = $_POST['department'];
      $db = opendb();
      $result = mysql_query('SELECT id, name, pass FROM departments WHERE id =' . $departid);
      if (mysql_num_rows($result) > 0) {
          $row = mysql_fetch_assoc($result);
          if (!empty($row['pass'])) {
              $msg = 'PASSWD';
          }
          else {
              $msg = 'NOPASSWD';
          }
      }
      else {
          $msg = 'ERROR';
      }
      return(array('view' => 'message', 'data' => array('msg' => $msg)));
  }

  public function login() {
      $departid = $_POST['departid'];
      $passwd = $_POST['passwd'];
      
      $db = opendb();
      $result = mysql_query('SELECT id, name, pass FROM departments WHERE id =' . $departid);
      if (mysql_num_rows($result) > 0) {
          $row = mysql_fetch_assoc($result);
          //mysql_close($db);
          if (empty($row['pass']) || $row['pass'] == $passwd) {
              $_SESSION['departid'] = $departid;
              $_SESSION['departname'] = $row['name'];
              $msg = "OK";
          }
          else {
              $msg = "ERROR";
          }
      }
      //$mysql_close($db);
      return array('view' => 'message', 'data' => array('msg' => $msg));
  }
  
  public function addpasswd() {
      $departid = $_POST['departid'];
      $newpasswd = $_POST['newpasswd'];
      $sql = 'UPDATE departments ' 
             . 'SET pass=\'' . $newpasswd . '\' '
             . 'WHERE id=' . $departid;
      $db = opendb();
      $result = mysql_query($sql);
      if ($result) {
          $result = mysql_query('SELECT id, name, pass FROM departments WHERE id =' . $departid);
          if (mysql_num_rows($result) > 0) {
              $row = mysql_fetch_assoc($result);
              $_SESSION['departid'] = $departid;
              $_SESSION['departname'] = $row['name'];
              $msg = 'OK';
          }
          else {
              $msg = 'ERROR';
          }
      }
      else {
          $msg = 'ERROR';
      }
      mysql_close($db);
      return(array('view' => 'message', 'data' => array('msg' => $msg)));
  }
  
  public function logout() {
    session_destroy();
    return(array('view' => 'logout', 
                 'data' => null));
  }
}
?>
