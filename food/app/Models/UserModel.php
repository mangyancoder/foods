<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class UserModel extends Model
{
  protected $table = 'users';
  protected $primaryKey = 'uid';
  protected $allowedFields = ['uname','email','phone','address','password','token','utype'];
}

 ?>
