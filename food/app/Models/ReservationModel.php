<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class ReservationModel extends Model
{
  protected $table = 'reservation';
  protected $primaryKey = 'rid';
  protected $allowedFields = [
    'amount',
    'status'
  ];
}

 ?>
