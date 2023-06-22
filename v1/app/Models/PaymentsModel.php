<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentsModel extends Model
{
    protected $table      = 'payments';
    protected $primaryKey = 'paymentId';
    protected $allowedFields = ['customer_id', 'income_expense', 'categoryType', 'year', 'tAmount', 'pAmount', 'dAmount', 'paymentType', 'note', 'login_id', 'status', 'paymentDate'];
}
