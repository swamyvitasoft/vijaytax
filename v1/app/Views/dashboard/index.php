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
                    <div class="card card-hover yearView">
                        <div class="box bg-cyan text-center">
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Total</h6>
                                <h6 class="text-white float-end"><?= $income['tAmount'] > 0 ? $income['tAmount'] : 0 ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Income</h6>
                                <h6 class="text-white float-end"><?= $income['pAmount'] > 0 ? $income['pAmount'] : 0 ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Expense</h6>
                                <h6 class="text-white float-end"><?= $expense['pAmount'] > 0 ? $expense['pAmount'] : 0 ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Due</h6>
                                <h6 class="text-white float-end"><?= $income['dAmount'] > 0 ? $income['dAmount'] : 0 ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col">
                    <div class="card card-hover income">
                        <div class="box bg-primary text-center">
                            <h1 class="font-light text-white">
                                Income
                            </h1>
                            <i class="fa fa-plus-circle me-1 ms-1 text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <a href="#">
                        <div class="card card-hover expense">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">
                                    Expense
                                </h1>
                                <i class="fa fa-minus-circle me-1 ms-1 text-white"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col">
                    <div class="card card-hover today">
                        <div class="box bg-cyan text-center">
                            <h1 class="font-light text-white">
                                Today(<?= $today_tAmount > 0 ? $today_tAmount : 0 ?>)
                            </h1>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Income</h6>
                                <h6 class="text-white float-end"><?= $today_pAmount > 0 ? $today_pAmount : 0 ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Expense</h6>
                                <h6 class="text-white float-end"><?= $today_expense > 0 ? $today_expense : 0 ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Due</h6>
                                <h6 class="text-white float-end"><?= $today_dAmount > 0 ? $today_dAmount : 0 ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col">
                    <div class="card card-hover month">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white">
                                This Month(<?= $month_tAmount > 0 ? $month_tAmount : 0 ?>)
                            </h1>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Income</h6>
                                <h6 class="text-white float-end"><?= $month_pAmount > 0 ? $month_pAmount : 0 ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Expense</h6>
                                <h6 class="text-white float-end"><?= $month_expense > 0 ? $month_expense : 0 ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Due</h6>
                                <h6 class="text-white float-end"><?= $month_dAmount > 0 ? $month_dAmount : 0 ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col">
                    <div class="card card-hover year">
                        <div class="box bg-warning text-center">
                            <h1 class="font-light text-white">
                                This Year(<?= $year_tAmount > 0 ? $year_tAmount : 0 ?>)
                            </h1>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Income</h6>
                                <h6 class="text-white float-end"><?= $year_pAmount > 0 ? $year_pAmount : 0 ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Expense</h6>
                                <h6 class="text-white float-end"><?= $year_expense > 0 ? $year_expense : 0 ?></h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Due</h6>
                                <h6 class="text-white float-end"><?= $year_dAmount > 0 ? $year_dAmount : 0 ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= view('common/footer') ?>
</div>
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= site_url() ?>assets/custom-libs/jquery.redirect.js"></script>
<script>
    jQuery(function($) {

        $(document).on("click", ".yearView", function(e) {
            $.redirect("<?= site_url() ?>dashboard/yearView", {
                "year": 'All'
            }, "POST");
        });

        $(document).on("click", ".income", function(e) {
            window.location.href = "<?= site_url() ?>dashboard/income";
        });

        $(document).on("click", ".expense", function(e) {
            window.location.href = "<?= site_url() ?>dashboard/expense";
        });

        $(document).on("click", ".today", function(e) {
            $.redirect("<?= site_url() ?>dashboard/today", {
                "today": '<?= date('Y-m-d') ?>'
            }, "POST");
        });

        $(document).on("click", ".month", function(e) {
            $.redirect("<?= site_url() ?>dashboard/month", {
                "month": '<?= date('Y-m-d') ?>'
            }, "POST");
        });

        $(document).on("click", ".year", function(e) {
            $.redirect("<?= site_url() ?>dashboard/year", {
                "year": '<?= date('Y-m-d') ?>'
            }, "POST");
        });

    });
</script>