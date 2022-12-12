<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class WalkinModel extends Model
{
  protected $table = 'walkin';
  protected $primaryKey = 'wid';
  protected $allowedFields = [
    'tlid',
    'total',
    'amount',
    'clientID'
  ];
}

 ?>
