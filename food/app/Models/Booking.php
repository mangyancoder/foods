<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class Booking extends Model
{
  protected $table = 'book';
  protected $primaryKey = 'id';
  protected $allowedFields = [
    'userID',
    'title',
    'start',
    'end',
    'pax',
    'package',
    'product',
    'amount',
    'email',
    'phones',
    'location',
    'mop',
    'gproof',
    'bstatus'
  ];
}

 ?>
