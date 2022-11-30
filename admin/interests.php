<?php require_once "inc/header.php"; ?>

<?php
$interests = $common->select('interests');
$interests = $db->get($interests);

if (isset($_POST['interest_delete']) && isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $fm->validation($_POST['id']);
    try {
        $data = $common->delete('interests', "id=$id");
        Session::set('success', 'Interest deleted successfully');
    } catch (Exception $e) {
        Session::set('success', 'Something went wrong. Please try again later.');
    }

    header("Location: " . SITE_URL . "/admin/interests.php");
    return;
}
?>

<main class="col-md-9 ml-sm-auto col-lg-10 my-3 text-white min-vh-100">
    <div class=" px-3-sm px-5-lg">
        <div class="text-end py-3"><a class="btn btn-success" href="<?= SITE_URL ?>/admin/interestAdd.php">Add Interest</a></div>

        <div class="container p-2-sm p-5-lg py-4 shadow">

            <h3 class="text-center">Interests</h3>

            <!-- Interests -->
            <div>
                <ul class="list-group p-1-sm p-3-lg">
                    <?php if ($interests) : ?>
                        <?php foreach ($interests as $interest) : ?>
                            <li class="d-flex justify-content-between align-items-end py-2 mb-2 border-bottom border-1 border-light border-opacity-25">
                                <div>
                                    <p class="interests px-3"><?= $interest['interest'] ?></p>
                                </div>
                                <div class="d-flex ">
                                    <a class="btn btn-sm btn-primary ed-font" href="<?= SITE_URL ?>/admin/interestUpdate.php?id=<?= $interest['id'] ?>">Edit</a>
                                    <form class="ps-3" action="" method="post" onsubmit="return confirm('Are you sure you want to delete <?= $interest['interest'] ?>?');">
                                        <input type="hidden" name="id" value="<?= $interest['id'] ?>">
                                        <button class="btn btn-sm btn-danger ed-font" type="submit" name="interest_delete">Delete</button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>

        </div>
    </div>

</main>

<?php require_once "inc/footer.php"; ?>