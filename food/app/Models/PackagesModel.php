<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class PackagesModel extends Model
{
  protected $table = 'packages';
  protected $primaryKey = 'pcid';
  protected $allowedFields = [ 'package_name', 'package_description','package_banner', 'price', 'promo', 'validity' ];
}

 ?>
