<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class SalesModel extends Model
{
  protected $table = 'orders';
  protected $primaryKey = 'oid';
  protected $allowedFields = ['o_tlid','packageID', 'userID', 'status', 'o_quantity', 'p_price','type'];
}

 ?>
