<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class BPayment extends Model
{
  protected $table = 'bpayment';
  protected $primaryKey = 'bpid';
  protected $allowedFields = [
    'bid',
    'payor',
    'userID',
    'type',
    'amount',
  ];
}

 ?>
