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
                        <div class="card-body">
                            <form action="<?= site_url() ?>dashboard/expenseAction" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <label for="expenseType" class="form-label">Expense Type</label>
                                    <select name="expenseType" class="form-control form-control-lg" id="expenseType">
                                        <option value="" selected disabled>Select</option>
                                        <option value="Salary">Salary</option>
                                        <option value="Rent">Rent</option>
                                        <option value="CA Filing">CA Filing</option>
                                        <option value="Internet bill">Internet bill</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'expense') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="pAmount" class="form-label">Paid Amount</label>
                                    <input type="number" name="pAmount" class="form-control form-control-lg" id="pAmount" placeholder="Paid Amount" value="<?= set_value('pAmount') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'pAmount') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="paymentType" class="form-label">Payment Type</label><br>
                                    <input type="radio" class="form-check-input" name="paymentType" id="paymentType_credit" value="Credit">Credit
                                    <input type="radio" class="form-check-input" name="paymentType" id="paymentType_cash" value="Cash">Cash
                                    <input type="radio" class="form-check-input" name="paymentType" id="paymentType_online" value="Online" checked>Online
                                </div>
                                <div class="form-group mt-3">
                                    <label for="note" class="form-label">Note</label>
                                    <textarea class="form-control form-control-lg" name="note" id="note"></textarea>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'note') : '' ?></small>
                                </div>
                                <div class="text-center"><button type="submit" class="btn btn-success btn-lg">Save</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer') ?>
</div>