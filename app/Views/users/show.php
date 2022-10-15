<?= $this->extend('layouts/admin.php') ?>
<?= $this->section('content') ?>




<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>User: </h4>
                    <h6><?=$user['name']?></h6>
                    <div class="">
                        <div class="mb-3">
                            <span>Phone:</span>
                            <p><?=$user['phone']?></p>
                        </div>
                        <div class="mb-3">
                            <span>Address:</span>
                            <p><?=$user['address']?></p>
                        </div>
                        <div class="mb-3">
                            <span>Gender:</span>
                            <p><?=$user['gender']?></p>
                        </div>
                        <div class="mb-3">
                            <span>Day of birth:</span>
                            <p><?=$user['day_of_birth']?></p>
                        </div>
                        <div class="mb-3">
                            <span>Rore:</span>
                            <p><?=$user['rights_group_id']?></p>
                        </div>
                       
                    </div>
                </div>
                <div class="card-body">

                    
                </div>
            </div>

        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>

<?= $this->endSection() ?>