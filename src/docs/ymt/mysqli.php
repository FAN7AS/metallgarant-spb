<?php

class Sql extends mysqli {
  //public $link = false;
  /** @var mysqli_result $res **/
  public $res = false;

  public function __construct($host, $user, $pass, $db) {
        parent::__construct($host, $user, $pass, $db);

        if (mysqli_connect_error()) {
            die('Ошибка подключения (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
  }

  /** @var mysqli_result return **/
  function q($query){
    $res = $this->query($query);
    return $res;
  }

  function val($q){
    $res = $this->q($q);
    if(!$res) return 0;
    $row = $res->fetch_row();
    return is_array($row) ? current($row) : NULL ;
  }
  function v($q){
    $res = $this->q($q);
    if(!$res) return 0;
    $row = $res->fetch_row();
    return is_array($row) ? current($row) : NULL ;
  }

  function row($q){
    $res = $this->q($q);
    if(!$res) return 0;
    return $res->fetch_assoc();
  }

  function a($q){
    $res = $this->q($q);
    if(!$res) return 0;
    return $res->fetch_all(MYSQLI_ASSOC);
  }

  function ai($q){
    $res = $this->q($q);
    if(!$res) return 0;
    $a = array();
    while($v = $res->fetch_array()) {
      $a[$v[0]] = $v;
    }
    return $a;
  }

}