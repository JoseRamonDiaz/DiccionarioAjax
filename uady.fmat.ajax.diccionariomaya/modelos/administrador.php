<?php

require_once '../../idiorm/idiorm.php';
require_once '../../paris/paris.php';

class Administrador extends Model {

  public static $_table = 'administrador';

  public static $_id_column = 'administrador_id';
  public static $_username_column = 'username';
  public static $_password_column = 'password';
  public static $_email_column = 'email';

}

?>
