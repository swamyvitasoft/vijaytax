<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomersModel extends Model
{
    protected $table      = 'customers';
    protected $primaryKey = 'customer_id';
    protected $allowedFields = ['panNo', 'name', 'mobile', 'login_id', 'status', 'createDate'];
}
