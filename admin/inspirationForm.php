<?php require_once "inc/header.php"; ?>

<?php
if (!empty($_GET['id'])) {
    $urlId = $fm->validation($_GET['id']);
    $inspirationQuote = $common->first('daily_inspirations', "id=:urlId", ['urlId' => $urlId]);
}

if (isset($_POST['inspiration_quote_submit'])) {
    if (empty($_POST['inspiration_quote'])) {
        Session::set('error', 'Inspiration quote is required');
        header("Location: " . SITE_URL . "/admin/inspirationForm.php" . (!empty($_GET['id']) ? "?id={$_GET['id']}" : ""));
        return;
    }
    if (empty($_POST['date'])) {
        Session::set('error', 'Date is required');
        header("Location: " . SITE_URL . "/admin/inspirationForm.php" . (!empty($_GET['id']) ? "?id={$_GET['id']}" : ""));
        return;
    }
    $id = $fm->validation($_POST['id']);
    $inspirationQuote = $fm->validation($_POST['inspiration_quote']);

    try {
        $date = date_create_from_format('Y-m-d', $_POST['date']);
        if ($date) {
            $date = date_format($date, 'Y-m-d');
        } else {
            Session::set('error', 'Invalid date input. Please try again.');
            header("Location: " . SITE_URL . "/admin/inspirationForm.php");
            return;
        }

        if (empty($id)) {
            $dateCheck = $common->first('daily_inspirations', "date = :date", ['date' => $date]);
            if ($dateCheck) {
                Session::set('error', 'There is already an inspiration quote on this date');
                header("Location: " . SITE_URL . "/admin/inspirationForm.php");
                return;
            }
            $data = $common->insert('daily_inspirations',  ['inspiration_quote' => $inspirationQuote, 'date' => $date]);
            Session::set('success', 'Inspiration added successfully!');
        } else {
            $dateCheck = $common->first('daily_inspirations', "date = :date and id != :id", ['date' => $date, 'id' => $id]);
            if ($dateCheck) {
                Session::set('error', 'There is already an inspiration quote on this date');
                header("Location: " . SITE_URL . "/admin/inspirationForm.php?id=$id");
                return;
            }
            $data = $common->update('daily_inspirations', ['inspiration_quote' => $inspirationQuote, 'date' => $date], "id = :id", ['id' => $id]);
            Session::set('success', 'Inspiration updated successfully!');
        }
    } catch (Exception $e) {
        Session::set('error', 'Something went wrong. Please try again later.');
    }

    header("Location: " . SITE_URL . "/admin/inspiration.php");
    return;
}
?>

    <style>
        .tox-notifications-container {
            display: none !important;
        }
        .letter {
            float: right;
            margin: 15px 10px 15px 10px;
        }
    </style>
    <script src="<?= SITE_URL ?>/admin/assets/jquery-3.6.0.min.js"></script>
    <script src="<?= SITE_URL ?>/admin/assets/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="<?= SITE_URL ?>/admin/assets/tinymce-jquery.min.js"></script>
<main class="row">
    <div class="ml-sm-auto col-md-9 col-lg-10 my-3 text-white">
        <div class="my-5">
            <div class="text-center">
                <h3>Daily Inspiration <?= empty($_GET['id']) ? 'Add' : 'Update' ?></h3>
            </div>
            <div class="px-5">
                <form class="form-floating my-3" action="" method="post">
                    <input type="hidden" name="id" value="<?= $_GET['id'] ?? null ?>">
                    <div class="py-3">
                        <textarea id="inspiration-quote" class="form-control w-75 mx-auto form-box shadow-lg border border-light border-opacity-10" name="inspiration_quote" placeholder="write your quote here...">
                            <?= $inspirationQuote['inspiration_quote'] ?? '' ?>
                        </textarea>
                    </div>
                    <!--                    Inspiration date input-->
                    <div>
                        <label for="date">Date</label>
                        <input class="form-control" id="date" type="date" name="date" value="<?= $inspirationQuote['date'] ?? '' ?>">
                    </div>
                    <div class="text-center my-3">
                        <button class="btn btn-primary" type="submit" name="inspiration_quote_submit"><?= (!empty($_GET['id'])) ? 'Update' : 'Add' ?></button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</main>

<script>
    tinymce.init({
        selector: '#inspiration-quote',
        height: 600,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount', 'autoresize',
            'autosave', 'codesample', 'directionality', 'emoticons', 'importcss',
            'nonbreaking', 'pagebreak', 'quickbars', 'save', 'template', 'visualchars'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help' +
            'anchor | restoredraft | ' +
            'charmap | code | codesample | ' +
            'ltr rtl | emoticons | fullscreen | ' +
            'image | importcss | insertdatetime | ' +
            'link | numlist bullist | media | nonbreaking | ' +
            'pagebreak | preview | save | searchreplace | ' +
            'table tabledelete | tableprops tablerowprops tablecellprops | ' +
            'tableinsertrowbefore tableinsertrowafter tabledeleterow | ' +
            'tableinsertcolbefore tableinsertcolafter tabledeletecol | ' +
            'template | visualblocks | visualchars | wordcount | undo redo | ' +
            'blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
    });
</script>

<?php require_once "inc/footer.php"; ?>