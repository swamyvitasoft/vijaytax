<?php

use App\Models\PaymentsModel;

$paymentsModel = new PaymentsModel();
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
            foreach ($months as $index => $row) {
                $color = ($index % 3 == 0 ? 'bg-cyan' : ($index % 3 > 1 ? 'bg-success' : 'bg-primary'));
                $month = $row['paymentDate'];
                $monthPayments = $paymentsModel->select('income_expense,sum(tAmount) as tAmount,sum(pAmount) as pAmount,sum(dAmount) as dAmount')->where(['DATE_FORMAT(paymentDate, "%Y-%m")' => date('Y-m', strtotime($month))])->orderBy('income_expense', 'DESC')->groupBy('income_expense')->findAll();
                $netAmount = 0;
                $paidAmount = 0;
                $pendingAmount = 0;
                $expenseAmount = 0;
                if (count($monthPayments) == 1) {
                    if ($monthPayments[0]['income_expense'] == "Income") {
                        $netAmount = $monthPayments[0]['tAmount'];
                        $paidAmount = $monthPayments[0]['pAmount'];
                        $pendingAmount = $monthPayments[0]['dAmount'];
                    } else if ($monthPayments[0]['income_expense'] == "Expense") {
                        $expenseAmount = $monthPayments[0]['pAmount'];
                    }
                } else if (count($monthPayments) == 2) {
                    $netAmount = $monthPayments[0]['tAmount'];
                    $paidAmount = $monthPayments[0]['pAmount'];
                    $pendingAmount = $monthPayments[0]['dAmount'];
                    $expenseAmount = $monthPayments[1]['pAmount'];
                }
            ?>
                <div class="row justify-content-md-center">
                    <div class="col">
                        <div class="card card-hover dayView" data-value='{"paymentDate" :"<?= $row['paymentDate'] ?>"}'>
                            <div class="box <?= $color ?> text-center">
                                <h1 class="font-light text-white">
                                    <?= date("F-Y", strtotime($row['paymentDate'])) ?>
                                </h1>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-white float-start">Net Amount</h6>
                                    <h6 class="text-white float-end"><?= $netAmount ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-white float-start">Paid Amount</h6>
                                    <h6 class="text-white float-end"><?= $paidAmount ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-white float-start">Pending Amount</h6>
                                    <h6 class="text-white float-end"><?= $pendingAmount ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-white float-start">Expense</h6>
                                    <h6 class="text-white float-end"><?= $expenseAmount ?></h6>
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
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= site_url() ?>assets/custom-libs/jquery.redirect.js"></script>
<script>
    jQuery(function($) {
        $(document).on("click", ".dayView", function(e) {
            var values = $(this).data("value");
            var month = values.paymentDate;
            $.redirect("<?= site_url() ?>dashboard/dayView", {
                "month": month
            }, "POST");
        });
    });
</script>