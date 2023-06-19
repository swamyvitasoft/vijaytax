<?php

namespace App\Models;

use CodeIgniter\Model;

class IncomeModel extends Model
{
    protected $table      = 'income';
    protected $primaryKey = 'incomeId';
    protected $allowedFields = ['incomeType', 'panNo', 'name', 'mobile', 'year', 'tAmount', 'pAmount', 'dAmount', 'paymentType', 'note', 'login_id', 'status', 'createDate', 'modifyDate'];
}
