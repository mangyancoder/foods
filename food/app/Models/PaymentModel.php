<?php

namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class PaymentModel extends Model
{

  protected $table = 'payment',
  protected $primaryKey = 'pyid';
  protected $allowedFields = [
    'bookingID';
    'payor',
    'userID',
    'type',
    'amount',
  ];
}


 ?>
