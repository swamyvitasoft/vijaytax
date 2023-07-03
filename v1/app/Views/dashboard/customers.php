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
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="adv-table">
                                <table id="zero_config" class="table table-striped table-bordered w-100 d-md-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>PAN</th>
                                            <th class="none">Mobile</th>
                                            <th class="none">Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($customers as $index => $row) {
                                        ?>
                                            <tr>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['panNo'] ?></td>
                                                <td><?= $row['mobile'] ?></td>
                                                <td><?= date('d-m-Y', strtotime($row['createDate'])) ?> </td>
                                                <td><i class="fa fa-user me-1 ms-1 view" data-value='{"customer_id" :"<?= $row['customer_id'] ?>"}'></i></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>PAN</th>
                                            <th class="none">Mobile</th>
                                            <th class="none">Date</th>
                                            <th></th>
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
<script src="<?= site_url() ?>assets/libs/jquery/dist/jquery.min.js"></script>
<script src="<?= site_url() ?>assets/custom-libs/jquery.redirect.js"></script>
<script>
    jQuery(function($) {
        $(document).on("click", ".view", function(e) {
            var values = $(this).data("value");
            var customer_id = values.customer_id;
            $.redirect("<?= site_url() ?>dashboard/view", {
                "customer_id": customer_id
            }, "POST");
        });
    });
</script>