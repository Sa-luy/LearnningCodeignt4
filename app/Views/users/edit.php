<?= $this->extend('layouts/admin.php') ?>
<?= $this->section('content') ?>




<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">

                            <h4>Edit User</h4>
                        </div>
                    </div>
                    <div class="row col-1">

                        <a href="" class="btn btn-danger">Cancle</a>
                        <?php if (isset($_SESSION['message_error'])) : ?>
                            <div class="alert alert-danger" role="alert">
                            <?= $_SESSION['message_error']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Validation error</strong>
                            <?= $validation->listErrors(); ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= base_url('usersEdit/' . $user['id']) ?>" method="post">
                        <?= csrf_field() ?>

                        <label for="">Name</label>
                        <input type="text" value="<?= $user['name'] ?>" class="form-control" name="name">
                        
                        <label for="">Email</label>
                        <input type="email" value="<?= $user['email'] ?>" class="form-control" name="email">
                        <label for="">Address</label>
                        <input type="text" value="<?= $user['address'] ?>" class="form-control" name="address">
                        <label for="">Day of birth</label>
                        <input type="text" value="<?= $user['day_of_birth'] ?>" class="form-control" name="day_of_birth">
                        <label for="">Gender</label>
                        <select name="gender" id="" class="form-control" name="gender">
                            <option value="male" <?= $user['gender'] = 'male' ? 'selected' : '' ?>>Male</option>
                            <option value="female" <?= $user['gender'] = 'female' ? 'selected' : '' ?>>Female</option>
                        </select>
                        <label for="">Role</label>
                        <!-- <select name="rights_group_id[]"  id="select2Multiple" class="form-control" multiple="multiple" > -->
                        <select class="js-example-basic-multiple form-control" name="righst_group_id">
                            <option value="" selected>Select One</option>
                            <option value="1" <?= $user['righst_group_id'] = '1' ? 'selected' : '' ?>>Admin</option>
                            <option value="2" <?= $user['righst_group_id'] = '2' ? 'selected' : '' ?>>SEO</option>
                            <option value="3" <?= $user['righst_group_id'] = '3' ? 'selected' : '' ?>>Maketing</option>
                        </select>
                        <div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>


                    </form>
                </div>
            </div>

        </div>
    </div>

</div>



<?= $this->endSection() ?>