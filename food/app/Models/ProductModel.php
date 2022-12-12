<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class ProductModel extends Model
{
  protected $table = 'product';
  protected $primaryKey = 'pid';
  protected $allowedFields = [
    'name',
    'description',
    'category',
    'picture',
    'price',
    'stocks'
  ];
}

 ?>
