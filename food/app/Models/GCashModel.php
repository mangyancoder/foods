<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class GCashModel extends Model
{
  protected $table = 'gcash_setting';
  protected $primaryKey = 'dsid';
  protected $allowedFields = ['gcash','g_no', 'g_qr', 'g_amount'];
}

 ?>
