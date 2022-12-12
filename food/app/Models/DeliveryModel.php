<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class DeliveryModel extends Model
{
  protected $table = 'delivery_setting';
  protected $primaryKey = 'did';
  protected $allowedFields = ['del_amount', 'dstatus'];
}

 ?>
