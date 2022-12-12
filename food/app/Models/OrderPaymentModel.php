<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class OrderPaymentModel extends Model
{
  protected $table = 'order_payment';
  protected $primaryKey = 'oid';
  protected $allowedFields = [
    'tlid',
    'type',
    'amount',
    'picture'
  ];
}

 ?>
