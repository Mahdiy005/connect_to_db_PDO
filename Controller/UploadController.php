<?php

declare(strict_types=1);

namespace App\Controller;

class UploadController
{

}


header("Location: /page1.php"); // This sends the Location header to redirect to /page1.php.
header("Location: /page2.php", true); // This will replace the previous Location header.
exit();