<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    protected $table      = 'expense';
    protected $primaryKey = 'expenseId';
    protected $allowedFields = ['expenseType', 'pAmount', 'paymentType', 'note', 'login_id', 'status', 'createDate', 'modifyDate'];
}
