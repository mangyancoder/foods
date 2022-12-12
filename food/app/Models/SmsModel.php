<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class SmsModel extends Model
{
  protected $table = 'sms';
  protected $primaryKey = 'sid';
  protected $allowedFields = ['api', 'pwd', 'validity', 'status'];
}

 ?>
