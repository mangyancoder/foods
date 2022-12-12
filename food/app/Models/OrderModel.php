<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class OrderModel extends Model
{
  protected $table = 'orders';
  protected $primaryKey = 'oid';
  protected $allowedFields = ['productID', 'product_name', 'userID', 'quantity'];
}

 ?>
