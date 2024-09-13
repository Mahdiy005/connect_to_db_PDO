<?php
declare(strict_types=1);

namespace App\Controller;

use App\View;

class InvoicesController
{
  public static function index(): View
  {
    return View::make('Invoices/index');
  }
  public static function create(): View
  {
    return View::make('Invoices/create');
  }

  public static function store()
  {
    $amount = $_POST['amount'];
    var_dump($amount);
  }

  public static function upload()
  {
    move_uploaded_file($_FILES['myFile']['tmp_name'], PATH_STORAGE . $_FILES['myFile']['name']);
  }
}
