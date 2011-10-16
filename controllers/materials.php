<?php
//Controller for materials handler
// AJAX methods:
//    - add()
//    - mod()
//    - del()

class materials {

  //Default action. Show the materials View
  public function index($params) {
      return array('view' => 'materials',
                   'data' => array());
  }

  //Internal function for list all material, ordered and filtered with the params
  //  - departid: (Numeric) department id of BD.
  //  - ltype: ['active' | 'history' | 'mixed']
  //  - ordem: ['material' | 'dates']
  private function listm($departid, $ltype, $orden) {
      global $webapp;
      
      if (empty($ltype)) {
          $where = ' AND outDate IS NULL ';
      }
      else if (!strcmp($ltype, 'active')) {
          $where = ' AND outDate IS NULL '; 
      }
      else if (!strcmp($ltype, 'history')) {
          $where = ' AND outDate IS NOT NULL ';
      }
      else if (!strcmp($ltype, 'mixed')) {
          $where = ' ';
      }
      $orderby = (!empty($orden) && !strcmp($orden, 'dates')) ?
          'ORDER BY signDate DESC, name ASC' : 'ORDER BY name ASC'; 

      $sql = 'SELECT id, name, observations, signDate, outDate '
             . 'FROM materials '
             . 'WHERE departid=' . $departid . $where 
             . $orderby;           
      $db = opendb();
      $result = mysql_query($sql);
      while ($row = mysql_fetch_assoc($result)) {
        $row['modlink'] = $webapp . 'materials/mod/' . $row['id'];
        $row['dellink'] = $webapp . 'materials/del/'  . $row['id'];
        $regs[]= $row;
      }
      mysql_close($db);
      
      return (!isset($regs)) ? null : $regs;  
  }
  
  public function listall($params) {
      $departid = $params['departid'];
      $ltype = (!empty($_POST['ltype'])) ? $_POST['ltype'] : null;
      $orden = (!empty($_POST['orden'])) ? $_POST['orden'] : null;
      
      $regs = $this->listm($departid, $ltype, $orden);
      $data = isset($regs) ? array('regs' => $regs) : array();
      return array('view' => 'materials-main',
                   'data' => $data);
  }
  
  public function listplain($params) {
      $departid = $params['departid'];
      $ltype = $params['p1']; //(!empty($_GET['ltype'])) ? $_GET['ltype'] : null;
      $orden = $params['p2']; //(!empty($_GET['orden'])) ? $_GET['orden'] : null;
      
      $regs = $this->listm($departid, $ltype, $orden);
      $data = isset($regs) ? array('regs' => $regs) : array();
      return array('view' => 'materials-plain',
                   'data' => $data);
  }
  
  public function add($params) {
      $departid = $params['departid'];
      $name = $_POST['name'];
      $obs  = $_POST['observations'];
            
      if (empty($name)) {
        $msg = 'ERROR';
      }
      else {
        $signDate = date('Y-m-d');
        $sql = 'INSERT INTO materials(id, departid, name, observations, signDate, outDate) ' 
               . 'VALUES (NULL, ' . $departid . ', \''. $name . '\', \'' 
               . $obs . '\', \'' . $signDate. '\', NULL)';
        
        $db = opendb();
        $result = mysql_query($sql);
        mysql_close($db);
        if ($result) {
          $msg = 'OK';
        }
        else {
          $msg = 'ERROR';
        }
      }
      
      return array('view' => 'message',
                   'data' => array('msg' => $msg));
  }
    
  public function mod($params) {
      $departid = $params['departid'];
      $matid = $params['p1'];
      $name = $_POST['name'];
      $observations = $_POST['observations'];
      
      if (empty($name)) {
        $msg = 'ERROR';
      }
      else {
        $sql = 'UPDATE materials ' 
               . 'SET name=\'' . $name . '\', '
               . 'observations=\'' . $observations . '\' '
               . 'WHERE id=' . $matid;
        $db = opendb();
        $result = mysql_query($sql);
        mysql_close($db);
        if ($result) {
          $msg = 'OK';
        }
        else {
          $msg = 'ERROR';
        }
      }
      
      return array('view' => 'message',
                   'data' => array('msg' => $msg));
  }
  
  public function del($params) {
      $departid = $params['departid'];
      $matid = $params['p1'];
      $outDate = date('Y-m-d');
      $sql = 'UPDATE materials ' 
             . 'SET outDate=\'' . $outDate. '\' '
             . 'WHERE id=' . $matid;
      $db = opendb();
      $result = mysql_query($sql);
      mysql_close($db);      
      if ($result) {
        $msg = 'OK';
      }
      else {
        $msg = 'ERROR';
      }
      return array('view' => 'message',
                   'data' => array('msg' => $msg));
  }
}
?>
