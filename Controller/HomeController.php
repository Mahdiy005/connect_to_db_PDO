<?php
declare(strict_types=1);
namespace App\Controller;

use App\View;
use PDO;
use PDOStatement;

class HomeController
{
  public static function index(): View
  {
    try {
      $db = new PDO('mysql:host=localhost;dbname=my_db', 'root', '', [
        // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // PDO::ATTR_EMULATE_PREPARES => true
      ]);
      $email = $_GET['email'];
      $name = 'Mohamed Mahdi';
      $is_active = 1;
      $created_at = date('Y-m-d H:i:s', strtotime('now'));
      $query = 'INSERT INTO users (email, full_name, is_active, created_at, updated_at) 
                VALUES (:email , :name, :is_active, :created_at, :updated_at)';

      $stmt = $db->prepare($query);
      $stmt->bindValue(':name', 'New Name ok', PDO::PARAM_STR);
      $stmt->bindParam(':email', $email);
      $stmt->bindValue(':is_active', $is_active, PDO::PARAM_BOOL);
      $stmt->bindValue(':created_at', $created_at);
      $stmt->bindValue('updated_at', $created_at);


      $stmt->execute();
      $id = $db->lastInsertId();
      echo '<pre>';
      var_dump($db->query('SELECT * FROM users WHERE id = ' . $id)->fetchAll());
      
      echo '</pre>';
    } catch (\PDOException $epdo) {
      echo $epdo;
      
    }


    // var_dump($db);
    return View::make('index');
  }

  public static function download(): void
  {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="myfile.pdf"');
    readfile(PATH_STORAGE . 'file ');
  }

  public static function upload(): void
  {
    echo $_SERVER['REQUEST_METHOD'];
    move_uploaded_file($_FILES['myFile']['tmp_name'], PATH_STORAGE . $_FILES['myFile']['name']);
    header('Location: /php_revision/', true);
  }
}
