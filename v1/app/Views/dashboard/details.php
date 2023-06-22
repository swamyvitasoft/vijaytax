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
            <div class="row justify-content-md-center">
                <div class="col">
                    <div class="card card-hover">
                        <div class="card-body">
                            <div class="adv-table">
                                <table id="zero_config" class="table table-striped table-bordered w-100 d-md-table">
                                    <thead>
                                        <tr>
                                            <th>PAN</th>
                                            <th>Paid</th>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Category</th>
                                            <th>Total</th>
                                            <th>Pending</th>
                                            <th>Date</th>
                                            <th>Year</th>
                                            <th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($details as $index => $row) {
                                            $customer_id = $row['customer_id'];
                                            $row1 = $customersModel->where('customer_id', $customer_id)->first();
                                        ?>
                                            <tr>
                                                <td><?= $row1['panNo'] ?></td>
                                                <td><?= $row['pAmount'] ?></td>
                                                <td><?= $row['income_expense'] ?></td>
                                                <td><?= $row1['name'] ?></td>
                                                <td><?= $row1['mobile'] ?></td>
                                                <td><?= $row['categoryType'] ?></td>
                                                <td><?= $row['tAmount'] ?></td>
                                                <td><?= $row['dAmount'] ?></td>
                                                <td><?= date('d-m-Y', strtotime($row['paymentDate'])) ?> </td>
                                                <td><?= $row['year'] ?></td>
                                                <td><?= $row['note'] ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>PAN</th>
                                            <th>Paid</th>
                                            <th>Type</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Category</th>
                                            <th>Total</th>
                                            <th>Pending</th>
                                            <th>Date</th>
                                            <th>Year</th>
                                            <th>Note</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer') ?>
</div>