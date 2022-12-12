<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class PackageList extends Model
{
  protected $table = 'package_list';
  protected $primaryKey = 'plid';
  protected $allowedFields = ['packageID','pl_quantity', 'pl_category'];
}

 ?>
