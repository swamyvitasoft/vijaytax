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
            $customer_id = $payments[0]['customer_id'];
            $row1 = $customersModel->where('customer_id', $customer_id)->first();
            ?>
            <div class="row">
                <div class="col"><?= $row1['name'] ?></div>
                <div class="col"><?= $row1['panNo'] ?></div>
                <div class="col"><?= $row1['mobile'] ?></div>
            </div>
            <?php
            foreach ($payments as $index => $row) {
                // $color = ($index % 3 == 0 ? 'bg-cyan' : ($index % 3 > 1 ? 'bg-success' : 'bg-primary'));
                $color = 'bg-white rounded shadow';
            ?>
                <div class="row justify-content-md-center">
                    <div class="col">
                        <div class="card card-hover">
                            <div class="box <?= $color ?> text-center">
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
                                    <h6 class="text-danger float-start">Due Amount</h6>
                                    <h6 class="text-danger float-end"><?= $row['dAmount'] ?></h6>
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
                                <div class="d-flex justify-content-between">
                                    <?php
                                    if ($row['dAmount'] != 0) {
                                    ?>
                                        <form action="<?= site_url() ?>dashboard/viewAction" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                            <input type="hidden" value="<?= $row['paymentId'] ?>" name="paymentId" id="paymentId">
                                            <h6 class="text-dark float-start"><input type="text" class="form-control form-control-sm float-start" name="amount" id="amount"></h6>
                                            <h6 class="text-dark float-end"><button type="submit" class="btn btn-success btn-sm">Payment</button></h6>
                                        </form>
                                    <?php
                                    }
                                    ?>
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