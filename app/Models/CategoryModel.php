<?php 
namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
	protected $table = 'category'; 
	protected $primaryKey = 'id';
	protected $allowedFields = [
		'nama','created_at','updated_at'
	];  
}