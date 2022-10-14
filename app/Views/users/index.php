<?= $this->extend('layouts/admin.php') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 mb-3">

                            <a href="<?= base_url('usersCreate') ?>" class="btn btn-secondary">Add User</a>
                        </div>
                    </div>
                    <div class="row">

                        <h4>List User</h4>
                        <?php if (isset($_SESSION['message_noti'])) : ?>
                            <div class="alert alert-success" role="alert">
                             <p><?= $_SESSION['message_noti'] ?></p>   
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['message_error'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['message_error'] ?>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Validation error</strong>
                            <?= $validation->listErrors(); ?>
                            <?php endif; ?>
                           

                    </div>
                </div>
                <div class="card-body">
                    <?php if (!empty($users)) : ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th>Role</th>
                                    <th>Day of birth</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $user['id'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><?= $user['address'] ?></td>
                                        <td><?= $user['gender'] ?></td>
                                        <td>SEO</td>
                                        <td><?= $user['day_of_birth'] ?></td>
                                        <td>
                                            <a href="<?= base_url('usersEdit/'.$user['id']) ?>"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="#"><i class="bi bi-eye"></i></a>
                                            <a href="<?= base_url('usersDestroy/'.$user['id']) ?>" onclick="return confirm('Delete movie data? You will not be able to recover it.');"><i class="bi bi-trash text-danger"></i></a>
                                            
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else : ?>
                        <h3>No Users</h3>

                        <p>Unable to find any news for you.</p>

                    <?php endif ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>