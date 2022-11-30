<?php require_once "inc/header.php"; ?>

<?php
$inspirations = $db->select('select * from daily_inspirations');
$inspirations = $db->get($inspirations);

if (isset($_POST['interest_delete'])) {
    $id = $fm->validation($_POST['id']);
    $common->delete('daily_inspirations', "id=$id");
    Session::set('success', 'Inspiration deleted successfully');
    header("Location: " . SITE_URL . "/admin/inspiration.php");
    return;
}
?>

<main class="col-md-9 ml-sm-auto col-lg-10 my-3 text-white min-vh-100">
    <div class=" px-3-sm px-5-lg">
        <div class="text-end py-3"><a class="btn btn-success" href="<?= SITE_URL ?>/admin/inspirationForm.php">Add Inspirations</a></div>

        <div class="container p-2-sm p-5-lg py-4 shadow">

            <h3 class="text-center">Inspirations</h3>

            <!-- Inspirations -->
            <div>
                <ul class="list-group p-1-sm p-3-lg">
                    <?php if ($inspirations) : ?>
                        <?php foreach ($inspirations as $inspiration) : ?>
                            <li class="d-flex justify-content-between py-2 mb-2 border-bottom border-1 border-light border-opacity-25">
                                <div>
                                    <!-- Quote -->
                                    <p class="px-3"><?= html_entity_decode($inspiration['inspiration_quote']) ?></p>
                                    <!-- Date -->
                                    <p class="text-muted mt-3 date-font"><?= date('j M, y', strtotime($inspiration['date'])) ?></p>
                                </div>
                                <div class="d-flex align-items-end">
                                    <div>
                                        <a class="btn btn-sm btn-primary ed-font" href="<?= SITE_URL ?>/admin/inspirationForm.php?id=<?= $inspiration['id'] ?>">Edit</a>
                                    </div>
                                    <div>
                                        <form class="ps-3" action="" method="post" onsubmit="return confirm('Are you sure you want to delete the quote?');">
                                            <input type="hidden" name="id" value="<?= $inspiration['id'] ?>">
                                            <button class="btn btn-sm btn-danger ed-font" type="submit" name="interest_delete">Delete</button>
                                        </form>
                                    </div>
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