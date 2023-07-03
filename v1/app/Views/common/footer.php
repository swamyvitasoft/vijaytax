<footer>
    <?php

    if (!empty($loggedInfo['login_id'])) {
        $role = session()->get('role');
    ?>
        <div class="container-fluid fixed-bottom">
            <div class="row text-center shadow p-1 bg-white rounded">
                <div class="col">
                    <a href="<?= site_url() ?>dashboard/customers" class="btn btn-sm text-primary" role="button" aria-pressed="true"><i class="fa fa-user me-1 ms-1"></i></a>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>dashboard/changepwd" class="btn btn-sm text-primary" role="button" aria-pressed="true"><i class="fa fa-eye-slash me-1 ms-1"></i></a>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>dashboard/index" class="btn btn-sm text-primary" role="button" aria-pressed="true"><i class="fa fa-home me-1 ms-1"></i></a>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>dashboard/search" class="btn btn-sm text-primary" role="button" aria-pressed="true"><i class="fa fa-search me-1 ms-1"></i></a>
                </div>
                <div class="col">
                    <a href="<?= site_url() ?>logout" class="btn btn-sm text-primary" role="button" aria-pressed="true"><i class="fa fa-power-off me-1 ms-1"></i></a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</footer>