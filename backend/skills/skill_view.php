<?php
require_once("../../assets/session.php");
$sql = "SELECT * FROM skills";
$query = mysqli_query($conn, $sql);
require_once("../includes/header.php");
require_once("../includes/sidebar.php");
require_once("../includes/navbar.php");
?>

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="<?= url() ?>backend/dashboard.php">Dashboard</a>
        <span class="breadcrumb-item active">View Skills</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0 text-center">View Skills</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered align-middle">
                            <thead class="bg-info">
                                <tr>
                                    <th width="5%" class="text-center">Serial</th>
                                    <th width="15%" class="text-center">Technoloogy</th>
                                    <th class="text-center">Description</th>
                                    <th width="10%" class="text-center">Percentage</th>
                                    <th width="15%" class="text-center">Status</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($query as $key => $skill) : ?>
                                    <tr>
                                        <td class="text-center"><?= ++$key ?></td>
                                        <td class="text-center"><?= $skill['technology'] ?></td>
                                        <td><?= $skill['description'] ?></td>
                                        <td class="text-center"><?= $skill['percentage'] . '%' ?></td>
                                        <td class="text-center"><a href="skill_status.php?id=<?= $skill['id'] ?>" class="btn btn-sm  <?= ($skill['status'] == 1) ? 'btn-success' : 'btn-secondary' ?>"><?= ($skill['status'] == 1) ? 'Activated' : 'Deactivated' ?></a></td>
                                        <?php if ($admin['role'] >= 2) : ?>
                                            <td class="text-center">
                                                <?php if ($skill['status'] == 0) : ?>
                                                    <button class=" btn btn-danger btn-sm delete" data-id="<?= $skill['id'] ?>">Delete</button>
                                                <?php else : ?>
                                                    - - -
                                                <?php endif ?>
                                            </td>
                                        <?php endif ?>
                                    </tr>
                                <?php endforeach ?>
                                <?php if (mysqli_num_rows($query) == 0) : ?>
                                    <tr>
                                        <td class="text-center" colspan="7">No data found</td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                        <a href="skill_add.php" class="btn btn-sm btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add New Skill</a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->
<?php require_once("../includes/footer.php"); ?>

<script>
    $('.delete').click(function() {
        Swal.fire({
            title: 'Are you sure?',
            text: "This skill will be deleted permanently.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr('data-id');
                document.location.href = 'skill_delete.php?id=' + id;
            }
        })
    });
</script>