<?= $this->extend('layouts/admin.php') ?>
<?= $this->section('content') ?>




<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4>Creat New User</h4>
                            <?php if (session('message_error')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session('message_error') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row col-3">

                        <a href="" class="btn btn-danger">Cancle</a>

                    </div>
                </div>
                <div class="card-body">

                    <form action="<?= base_url('usersCreate') ?>" method="post">
                        <?= csrf_field() ?>

                        <label for="">Name</label>
                        <input type="text" value="<?= old('name'); ?>" class="form-control" name="name">
                        <?php if ($validation->getError('name')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->getError('name'); ?>
                            </div>
                        <?php endif; ?>
                        <label for="">Email</label>
                        <input type="email" value="<?= old('email'); ?>" class="form-control" name="email">
                        <?php if ( $validation->getError('email')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->getError('email'); ?>
                            </div>
                        <?php endif; ?>
                        <label for="">Phone</label>
                        <input type="number" value="<?= old('phone'); ?>" class="form-control" name="phone">
                        <?php if ($validation->getError('phone')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->getError('phone'); ?>
                            </div>
                        <?php endif; ?>
                        <label for="">Address</label>
                        <input type="text" value="<?= old('address'); ?>" class="form-control" name="address">
                        <?php if ($validation->getError('address')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->getError('address'); ?>
                            </div>
                        <?php endif; ?>
                        <label for="">Day of birth</label>
                        <input type="date" value="<?= old('day_of_birth'); ?>" class="form-control" name="day_of_birth">
                        <?php if ( $validation->getError('day_of_birth')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->getError('day_of_birth'); ?>
                            </div>
                        <?php endif; ?>
                        <label for="">Gender</label>
                        <select name="gender" id="" class="form-control" name="gender">
                            <option value="" selected>Select One</option>
                            <option value="male"<?php old('gender')?'selected':''; ?>>Male</option>
                            <option value="female" <?php old('gender')?'selected':''; ?>>Female</option>
                        </select>
                        <?php if ($validation->getError('gender')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->getError('gender'); ?>
                            </div>
                        <?php endif; ?>
                        <label for="">Role</label>
                        <!-- <select name="rights_group_id[]"  id="select2Multiple" class="form-control" multiple="multiple" > -->
                        <select class="js-example-basic-multiple form-control" name="righst_group_id">
                            <option value="" selected>Select One</option>
                            <option value="1" <?php old('righst_group_id')?'selected':''; ?>>Admin</option>
                            <option value="2" <?php old('righst_group_id')?'selected':''; ?>>SEO</option>
                            <option value="3" <?php old('righst_group_id')?'selected':''; ?>>Maketing</option>
                        </select>
                        <?php if ($validation->getError('righst_group_id')) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $validation->getError('righst_group_id'); ?>
                            </div>
                        <?php endif; ?>
                        <div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>


                    </form>
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