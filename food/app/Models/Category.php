<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class Category extends Model
{
  protected $table = 'category';
  protected $primaryKey = 'cid';
  protected $allowedFields = ['cname'];
}

 ?>
