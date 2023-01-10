<?php require_once "inc/header.php"; ?>

<?php

if (empty($_GET['id'])) {
    Session::set('error', 'Interest id is required to visit this page');
    header('Location: ' . SITE_URL . '/admin/interests.php');
    return;
}
$id = $fm->validation($_GET['id']);

if (isset($_POST['update_interest']) && !empty($_POST['interest'])) {
    $interest = $fm->validation($_POST['interest']);
    try {
        $common->update('interests', ["interest" => $interest], "id = :id", ['id' => $id]);
        Session::set('success', 'Interest updated successfully');
    } catch (Exception $e) {
        Session::set('error', 'Something went wrong. Please try again later');
    }

    header('Location: ' . SITE_URL . "/admin/interests.php");
    return;
}

$interest = $common->first('interests', "id = :id", ['id' => $id]);
?>

<main class="col-md-9 ml-sm-auto col-lg-10 my-3">
    <div class="my-5">
        <div>
            <h3 class="text-center">update Interest</h3>

        </div>
        <div>
            <form action="" method="post">
                <div class="py-3">
                    <input class="form-control w-75 mx-auto shadow-lg border border-light border-opacity-10" required id="interest" type="text" name="interest" value="<?= $interest['interest'] ?>">
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit" name="update_interest">Update</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php
require_once "../inc/footer.php";
