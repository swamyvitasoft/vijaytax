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
                    <div class="card card-hover customer">
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
                        <div class="card card-hover">
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
                    <div class="card card-hover">
                        <div class="box bg-cyan text-center">
                            <h1 class="font-light text-white">
                                Today
                            </h1>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Income</h6>
                                <h6 class="text-white float-end">100</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Expense</h6>
                                <h6 class="text-white float-end">100</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col">
                    <div class="card card-hover">
                        <div class="box bg-danger text-center">
                            <h1 class="font-light text-white">
                                This Month
                            </h1>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Income</h6>
                                <h6 class="text-white float-end">100</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Expense</h6>
                                <h6 class="text-white float-end">100</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col">
                    <div class="card card-hover">
                        <div class="box bg-warning text-center">
                            <h1 class="font-light text-white">
                                This Year
                            </h1>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Income</h6>
                                <h6 class="text-white float-end">100</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="text-white float-start">Expense</h6>
                                <h6 class="text-white float-end">100</h6>
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

        $(document).on("click", ".customer", function(e) {
            $.redirect("<?= site_url() ?>dashboard/index", {}, "POST");
        });

    });
</script>