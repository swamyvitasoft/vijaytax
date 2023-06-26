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
                <?= csrf_field(); ?>
                <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                <?php elseif (!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                <?php endif ?>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body row">
                            <form action="<?= site_url() ?>dashboard/searchAction" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                <div class="d-flex justify-content-between">
                                    <div class="float-start">
                                        <div class="form-group mt-3">
                                            <label for="sdate" class="form-label mx-5">StartDate</label>
                                            <input type="date" name="sdate" class="form-control form-control-lg" id="sdate" placeholder="Start Date" value="<?= set_value('sdate') ?>">
                                            <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'sdate') : '' ?></small>
                                        </div>
                                    </div>
                                    <div class="float-end">
                                        <div class="form-group mt-3">
                                            <label for="edate" class="form-label mx-5">EndDate</label>
                                            <input type="date" name="edate" class="form-control form-control-lg" id="edate" placeholder="End Date" value="<?= set_value('edate') ?>">
                                            <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'edate') : '' ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center"><button type="submit" class="btn btn-success">Search</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (!empty($searchData)) {
                $netAmount = 0;
                $paidAmount = 0;
                $pendingAmount = 0;
                $expenseAmount = 0;
                if (count($searchData) == 1) {
                    if ($searchData[0]['income_expense'] == "Income") {
                        $netAmount = $searchData[0]['tAmount'];
                        $paidAmount = $searchData[0]['pAmount'];
                        $pendingAmount = $searchData[0]['dAmount'];
                    } else if ($searchData[0]['income_expense'] == "Expense") {
                        $expenseAmount = $searchData[0]['pAmount'];
                    }
                } else if (count($searchData) == 2) {
                    $netAmount = $searchData[0]['tAmount'];
                    $paidAmount = $searchData[0]['pAmount'];
                    $pendingAmount = $searchData[0]['dAmount'];
                    $expenseAmount = $searchData[1]['pAmount'];
                }
            ?>
                <div class="row justify-content-md-center">
                    <div class="col">
                        <div class="card card-hover">
                            <div class="box bg-white text-center">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Net Amount</h6>
                                    <h6 class="text-dark float-end"><?= $netAmount ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Paid Amount</h6>
                                    <h6 class="text-dark float-end"><?= $paidAmount ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Pending Amount</h6>
                                    <h6 class="text-dark float-end"><?= $pendingAmount ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-dark float-start">Expense</h6>
                                    <h6 class="text-dark float-end"><?= $expenseAmount ?></h6>
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