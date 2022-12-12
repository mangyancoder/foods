<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class SiteModel extends Model
{
  protected $table = 'company_bg';
  protected $primaryKey = 'cmid';
  protected $allowedFields = [
    'name',
    'description',
    'address',
    'contact_no',
    'email' 
  ];
}

 ?>
