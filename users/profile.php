<?php
require_once "inc/header.php";
require_once "inc/questions.php";
?>

<?php
$userInterests = $db->select("select i.id, i.interest from interest_user inner join interests as i on interest_user.interest_id=i.id where user_id = {$user_infos['id']}");
$userInterests = $db->get($userInterests);

if ($user_infos['answers']) {
    $answers = json_decode($user_infos['answers']);
}
?>

<link rel="stylesheet" href="./assets/styleOne.css">

<style>
    @media screen and (max-width: 480px) {
        .maincontonent {
            width: 100%;
            padding-top: 0%;
            height: 100vh;
        }

        .user_name {
            font-size: 30px !important;
            font-weight: 600 !important;
            margin-bottom: 0 !important;
            margin-top: 10px !important;
        }

        .id {
            font-size: 24px !important;
            font-weight: 400 !important;
            font-family: 'Abel' !important;
            display: block !important;
            padding-top: 10px !important;
        }

        .description {
            font-size: 22px !important;
            font-weight: 400 !important;
            width: 380px !important;
            max-width: 100% !important;
            text-align: center !important;
            font-family: 'Abel' !important;
            margin-bottom: 14px !important;
        }
    }

    @media screen and (min-width: 600px) {
        .maincontonent {
            width: 100%;
            padding-top: 0%;
            height: 100vh;
        }

        .user_name {
            font-size: 30px !important;
            font-weight: 600 !important;
            margin-bottom: 0 !important;
            margin-top: 10px !important;
        }

        .id {
            font-size: 24px !important;
            font-weight: 400 !important;
            font-family: 'Abel' !important;
            display: block !important;
            padding-top: 10px !important;
        }

        .description {
            font-size: 22px !important;
            font-weight: 400 !important;
            width: 380px !important;
            max-width: 100% !important;
            text-align: center !important;
            font-family: 'Abel' !important;
            margin-bottom: 14px !important;
        }
    }

    @media screen and (min-width: 786px) {
        .maincontonent {
            width: 83%;
            padding-top: 0%;
            height: auto;
        }

        .user_name {
            font-size: 36px !important;
            font-weight: 600 !important;
            margin-bottom: 0 !important;
            margin-top: 10px !important;
        }

        .id {
            font-size: 13px !important;
            font-weight: 400 !important;
            font-family: 'Abel' !important;
            display: block !important;
            padding-top: 10px !important;
        }

        .description {
            font-size: 16px !important;
            font-weight: 400 !important;
            width: 380px !important;
            max-width: 100% !important;
            text-align: center !important;
            font-family: 'Abel' !important;
            margin-bottom: 0px !important;
        }
    }

    @media screen and (min-width: 992px) {
        .maincontonent {
            width: 83%;
            padding-top: 0%;
            height: auto;
        }

        .user_name {
            font-size: 36px !important;
            font-weight: 600 !important;
            margin-bottom: 0 !important;
            margin-top: 10px !important;
        }

        .id {
            font-size: 13px !important;
            font-weight: 400 !important;
            font-family: 'Abel' !important;
            display: block !important;
            padding-top: 10px !important;
        }

        .description {
            font-size: 16px !important;
            font-weight: 400 !important;
            width: 380px !important;
            max-width: 100% !important;
            text-align: center !important;
            font-family: 'Abel' !important;
            margin-bottom: 0px !important;
        }
    }

    @media screen and (min-width: 1200px) {
        .maincontonent {
            width: 83%;
            padding-top: 0%;
            height: auto;
        }

        .user_name {
            font-size: 36px !important;
            font-weight: 600 !important;
            margin-bottom: 0 !important;
            margin-top: 10px !important;
        }

        .id {
            font-size: 13px !important;
            font-weight: 400 !important;
            font-family: 'Abel' !important;
            display: block !important;
            padding-top: 10px !important;
        }

        .description {
            font-size: 16px;
            font-weight: 400 !important;
            width: 380px !important;
            max-width: 100% !important;
            text-align: center !important;
            font-family: 'Abel' !important;
            margin-bottom: 0px !important;
        }
    }
</style>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 my-3 text-white" style="margin-top: 0rem!important;margin-bottom: 0rem!important;">
    <div class=" container row g-5">
        <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 0px;">
            <div style="padding: 15px">
                <div id="Profile">
                    <img class="profile_image" src="<?= $user_infos['image'] != NULL ? $user_infos['image'] : 'https://s3-us-west-2.amazonaws.com/harriscarney/images/150x150.png'; ?>" />
                    <a href="<?php echo SITE_URL; ?>/users/edit-profile.php" class="profile_edit_btn">Edit profile</a>
                    <h4 class="user_name"><?= $user_infos['full_name']; ?></h4>

                    <p class="description"><?= $user_infos['description']; ?></p>



                </div>
            </div>
        </div>

        <!-- Interests Start -->
        <style>
            .interest-list {
                list-style: none;
            }
        </style>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <h5>Interests :</h5>
            <div class="">
                <?php if ($userInterests) : ?>
                    <ul class="d-flex flex-wrap m-0">
                        <?php foreach ($userInterests as $interest) : ?>
                            <li class="me-2 interest-list py-1 px-4 border rounded-pill"><?= $interest['interest'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <!-- Interests End -->
        <style>
            .qa-font {
                font-size: 14px;
            }
        </style>


        <!-- Questions & Answers -->
        <div class="py-3 mb-5">
            <div class="row g-4">
                <?php foreach ($questions as $key => $question) : ?>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="p-3 border border-light border-opacity-10 rounded shadow">
                            <p class="qa-font py-2 text-muted "><?= $question ?></p>
                            <p class="qa-font"><?= $answers->{$key} ?? '' ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>

<?php require_once "inc/footer.php"; ?>