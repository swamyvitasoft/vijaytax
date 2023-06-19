<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div class="main-wrapper">
    <?= view('common/header') ?>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col d-flex no-block align-items-center">
                    <h4 class="page-title"><?= $pageHeading ?></h4>
                </div>
            </div>
            <div class="row">
                <?php

                if (!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                <?php elseif (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif ?>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="adv-table">
                                <table id="zero_config" class="table table-striped table-bordered w-100 d-md-table">
                                    <thead>
                                        <tr>
                                            <th>Income Type</th>
                                            <th>Name</th>
                                            <th>Total</th>
                                            <th>Paid</th>
                                            <th>Due Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($monthInfo as $index => $row) {
                                        ?>
                                            <tr>
                                                <td><?= $row['incomeType'] ?></td>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['tAmount'] ?></td>
                                                <td><?= $row['pAmount'] ?></td>
                                                <td><?= $row['dAmount'] ?></td>
                                                <td><?= date('d-m-Y', strtotime($row['createDate'])) ?> </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Income Type</th>
                                            <th>Name</th>
                                            <th>Total</th>
                                            <th>Paid</th>
                                            <th>Due Amount</th>
                                            <th>Date</th>
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