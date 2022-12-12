<?php
namespace App\Models;
use CodeIgniter\Model;

/**
 *
 */
class CommentModel extends Model
{
  protected $table = 'comment';
  protected $primaryKey = 'cmid';
  protected $allowedFields = [
    'userID',
    'rating',
    'comment',
    'status'
  ];
}

 ?>
