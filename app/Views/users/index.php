<?= $this->extend('layouts/admin.php') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 mb-3">


                            <a href="<?= base_url('usersCreate') ?>" class="btn btn-secondary opacity-75">Add User</a>
                        </div>
                        <div class="col-6 mb-6">
                            <div class="search-bar">
                                <form class="search-form d-flex align-items-center" method="POST" action="<?= base_url('usersSearch') ?>">
                                    <?= csrf_field() ?>
                                    <input type="text" name="keywords" placeholder="Search User" title="Enter search keyword" class="form-control">
                                    <button type="submit" title="Search" class="form-control "><i class="bi bi-search text-secondary"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="col-6 mb-3"></div> -->
                    </div>
                    <div class="row">

                        <div class="col-6">
                            <a href="<?= base_url('usersExport') ?>" class="btn btn-success ml">Export</a>


                            <?php if (session('message_noti')) : ?>
                                <div class="alert alert-success" role="alert">
                                    <p><?= session('message_noti') ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if (session('message_error')) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session('message_error') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-6">
                            <h4>List User</h4>
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
                                        <th>Phone</th>
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
                                            <td><?= $user['phone'] ?></td>
                                            <td><?= $user['address'] ?></td>
                                            <td><?= $user['gender'] ?></td>
                                           <?php foreach ($rights_groups as $role) {?>
                                            <?php if ($role->id == $user['rights_group_id']): ?>
                                                <td><?=$role->name?></td>
                                                <?php else: ?>
                                                <td>
                                                    <?= $user['rights_group_id'] ?>
                                                </td>
                                                <?php endif; ?>
                                          <?php }?>
                                            <td><?= $user['day_of_birth'] ?></td>
                                            <td>
                                                <a href="<?= base_url('usersEdit/' . $user['id']) ?>">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <a href="<?= base_url('usersShow/' . $user['id']) ?>">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="<?= base_url('usersDestroy/' . $user['id']) ?>" onclick="return confirm('Delete user data? You will not be able to recover it.');">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </a>
                                                <!-- <a href="<?= base_url('usersDestroy/' . $user['id']) ?>" class="deleteUser" data-id="<?= $user['id'] ?>" data-link="<?= base_url('usersDestroy/' . $user['id']) ?>">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </a> -->
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

    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <!-- <script>
        $(document).ready(function() {
                    $(document).on("click", ".deleteUser", function(e) {
                        e.preventDefault();
                        confirm("Are you sure you want to delete")
                        if (result.isConfirmed) {
                            let id = $('.deleteUser').data('id');
                            let url = $('.deleteUser').data('link');

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: url,
                                        headers: {
                                            'X-Requested-With': 'XMLHttpRequest'
                                        },
                                        type: 'get',
                                        dataType: 'json',
                                        data: {
    
                                            id: id
                                        },
                                        success: function(res) {
                                            Swal.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success')
                                            }
    
                                        })
                                }
                            })
                        }
                  

                    });
    </script> -->
    <?= $this->endSection() ?>