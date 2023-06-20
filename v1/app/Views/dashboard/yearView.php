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
            foreach ($yearIncome as $index => $row) {
                $color = ($index % 2 == 0 ? 'bg-cyan' : ($index % 2 > 1 ? 'bg-success' : 'bg-primary'));
            ?>
                <div class="row justify-content-md-center">
                    <div class="col">
                        <div class="card card-hover">
                            <div class="box <?= $color ?> text-center">
                                <h1 class="font-light text-white">
                                    <?= date("Y", strtotime($row['createDate'])) ?>
                                </h1>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-white float-start">Total</h6>
                                    <h6 class="text-white float-end"><?= $row['tAmount'] > 0 ? $row['tAmount'] : 0 ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-white float-start">Income</h6>
                                    <h6 class="text-white float-end"><?= $row['pAmount'] > 0 ? $row['pAmount'] : 0 ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-white float-start">Expense</h6>
                                    <h6 class="text-white float-end"><?= $yearExpense[$index]['pAmount'] > 0 ? $yearExpense[$index]['pAmount'] : 0 ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-white float-start">Due</h6>
                                    <h6 class="text-white float-end"><?= $row['dAmount'] > 0 ? $row['dAmount'] : 0 ?></h6>
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