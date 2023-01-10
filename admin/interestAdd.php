<?php require_once "inc/header.php"; ?>

<?php
if (isset($_POST['add_interest']) && isset($_POST['interest']) && !empty($_POST['interest'])) {
    $interest = $fm->validation($_POST['interest']);
    try {
        $existingInterest = $common->first('interests', "interest=:interest", ['interest' => $interest]);
        if ($existingInterest) {
            Session::set('error', $interest . ' already exists.');
            header("Location: " . SITE_URL . "/admin/interests.php");
            return;
        }

        $data = $common->insert('interests', ['interest' => $interest]);

        if ($data) {
            Session::set('success', 'Interest added successfully!');
        }
    } catch (Exception $e) {
        Session::set('error', 'Something went wrong. Please try again later');
    }


    header("Location: " . SITE_URL . "/admin/interests.php");
    return;
}
?>

<main class="col-md-9 ml-sm-auto col-lg-10 my-3">
    <div class="my-5">
        <div>
            <h3 class="text-center">Add Interest</h3>
        </div>
        <div>
            <form action="" method="post">
                <div class="py-3">
                    <input class="form-control w-75 mx-auto shadow-lg border border-light border-opacity-25" required id="interest" type="text" name="interest" placeholder="Travelling...">
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" type="submit" name="add_interest">Add Interest</button>
                </div>
            </form>
        </div>
    </div>

</main>

<?php require_once "../inc/footer.php"; ?>