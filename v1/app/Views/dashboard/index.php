<?php

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
                <?php
                if ($loggedInfo['role'] == "Admin") {
                ?>
                    <div class="col">
                        <a href="#">
                            <div class="card card-hover">
                                <div class="box bg-warning text-center">
                                    <h1 class="font-light text-white">
                                        A
                                    </h1>
                                    <h6 class="text-white">AA</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
                <div class="col">
                    <div class="card card-hover customer">
                        <div class="box bg-primary text-center">
                            <h1 class="font-light text-white">
                                B
                            </h1>
                            <h6 class="text-white">BB</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col">
                    <a href="#">
                        <div class="card card-hover">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">
                                    C
                                </h1>
                                <h6 class="text-white">CC</h6>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="#">
                        <div class="card card-hover">
                            <div class="box bg-danger text-center">
                                <h1 class="font-light text-white">
                                    D
                                </h1>
                                <h6 class="text-white">DD</h6>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php
            if ($loggedInfo['role'] == "Drone") {
            ?>
                <div class="row justify-content-md-center">
                    <div class="col">
                        <a href="#">
                            <div class="card card-hover">
                                <div class="box bg-cyan text-center">
                                    <h1 class="font-light text-white">
                                        E
                                    </h1>
                                    <h6 class="text-white">EE</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row justify-content-md-center">
                    <div class="col">
                        <div class="card card-hover">
                            <div class="box bg-cyan text-center">
                                <h1 class="font-light text-white">
                                    F
                                </h1>
                                <h6 class="text-white">FF</h6>
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

        $(document).on("click", ".customer", function(e) {
            $.redirect("<?= site_url() ?>dashboard/index", {}, "POST");
        });

    });
</script>