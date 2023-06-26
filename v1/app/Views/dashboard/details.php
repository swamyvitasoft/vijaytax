<?php

use App\Models\CustomersModel;
use App\Models\PaymentsModel;

$paymentsModel = new PaymentsModel();
$customersModel = new CustomersModel();
?>
<div class="main-wrapper">
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <?= view('common/header') ?>
    <div class="page-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="container-fluid">
            <div class="row text-center">
                <?php
                if (!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                <?php elseif (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif ?>
            </div>
            <?php
            foreach ($details as $index => $row) {
                $customer_id = $row['customer_id'];
                $row1 = $customersModel->where('customer_id', $customer_id)->first();
                // $color = ($index % 3 == 0 ? 'bg-cyan' : ($index % 3 > 1 ? 'bg-success' : 'bg-primary'));
                $color = 'bg-white rounded shadow';
            ?>
                <div class="row justify-content-md-center">
                    <div class="col">
                        <div class="card card-hover">
                            <div class="box <?= $color ?> text-center">
                                <h1 class="font-light text-dark">
                                    <?= $row1['panNo'] ?>
                                </h1>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Full Name</h6>
                                    <h6 class="text-dark float-end"><?= $row1['name'] ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Mobile</h6>
                                    <h6 class="text-dark float-end"><?= $row1['mobile'] ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Category</h6>
                                    <h6 class="text-dark float-end"><?= $row['categoryType'] ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Income/Expense</h6>
                                    <h6 class="text-dark float-end"><?= $row['income_expense'] ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Total Amount</h6>
                                    <h6 class="text-dark float-end"><?= $row['tAmount'] ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Paid Amount</h6>
                                    <h6 class="text-dark float-end"><?= $row['pAmount'] ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Due Amount</h6>
                                    <h6 class="text-dark float-end"><?= $row['dAmount'] ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Year</h6>
                                    <h6 class="text-dark float-end"><?= $row['year'] ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Payment Date</h6>
                                    <h6 class="text-dark float-end"><?= date('d-m-Y', strtotime($row['paymentDate'])) ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Note</h6>
                                    <h6 class="text-dark float-end"><?= $row['note'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?= view('common/footer') ?>
</div>