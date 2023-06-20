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
                            <form action="<?= site_url() ?>dashboard/incomeAction" method="post" role="form" class="php-email-form" enctype="multipart/form-data">
                                <div class="form-group mt-3">
                                    <label for="incomeType" class="form-label">Income Type</label>
                                    <select name="incomeType" class="form-control form-control-lg" id="incomeType">
                                        <option value="" selected disabled>Select</option>
                                        <option value="Income TAX">Income TAX</option>
                                        <option value="GST">GST</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'income') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="panNo" class="form-label">Customer PAN</label>
                                    <input type="text" name="panNo" class="form-control form-control-lg" id="panNo" placeholder="Customer Pan Number" value="<?= set_value('panNo') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'panNo') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="name" class="form-label">Customer Name</label>
                                    <input type="text" name="name" class="form-control form-control-lg" id="name" placeholder="Customer Name" value="<?= set_value('name') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'name') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="mobile" class="form-label">Customer Mobile</label>
                                    <input type="text" name="mobile" class="form-control form-control-lg" id="mobile" placeholder="Customer Mobile" value="<?= set_value('mobile') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'mobile') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="year" class="form-label">Year of Filing</label>
                                    <input type="year" name="year" class="form-control form-control-lg" id="year" placeholder="Year of Filing" value="<?= set_value('year') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'year') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="tAmount" class="form-label">Total Amount</label>
                                    <input type="number" name="tAmount" class="form-control form-control-lg" id="tAmount" placeholder="Total Amount" value="<?= set_value('tAmount') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'tAmount') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="pAmount" class="form-label">Paid Amount</label>
                                    <input type="number" name="pAmount" class="form-control form-control-lg" id="pAmount" placeholder="Paid Amount" value="<?= set_value('pAmount') ?>">
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'pAmount') : '' ?></small>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="dAmount" class="form-label">Due Amount</label>
                                    <input type="number" name="dAmount" class="form-control form-control-lg" id="dAmount" placeholder="Due Amount" value="<?= set_value('dAmount') ?>" readonly>
                                    <small class="text-danger"><?= !empty(session()->getFlashdata('validation')) ? display_error(session()->getFlashdata('validation'), 'dAmount') : '' ?></small>
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
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pAmount').on('blur', function() {
            var tAmount = $('#tAmount').val();
            var pAmount = $('#pAmount').val();
            var dAmount = tAmount - pAmount;
            $('#dAmount').val(dAmount);
        });
    });
</script>