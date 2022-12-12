<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class TransHistory extends Model
{
  protected $table = 'transhistory';
  protected $primaryKey = 'thid';
  protected $allowedFields = ['tlid', 'tstatus'];
}

 ?>
