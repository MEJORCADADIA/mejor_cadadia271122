<?php
ob_start();
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../lib/Session.php');
include_once($filepath . '/../lib/RememberCookie.php');
include_once($filepath . '/../helper/Format.php');
include_once($filepath . '/../classes/Common.php');


$db = new Database();
$fm = new Format();
$common = new Common();

$user_infos = null;
$rememberCookieData = RememberCookie::getRememberCookieData();
if ($rememberCookieData) {
    $user_infos = $common->first(
        "`users`",
        "`id` = :id AND password = :password AND remember_token = :remember_token",
        ['id' => $rememberCookieData[RememberCookie::ID], 'remember_token' => $rememberCookieData[RememberCookie::REMEMBER_TOKEN], 'password' => $rememberCookieData[RememberCookie::PASSWORD]]
    );
}

if ($user_infos === null && Session::get('user_id') !== NULL) {
    $user_id = Session::get('user_id');
    $user_infos = $common->first("users", "id = :id", ['id' => $user_id]);
}

$profile_info = $common
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="https://blog.mejorcadadia.com/wp-content/uploads/2022/04/mcdf-01.png" type="image/x-icon">
    <title>Mejorcadadia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css'>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0&appId=1108588056758284&autoLogAppEvents=1" nonce="JQBAhE2Y"></script>
    <link rel="stylesheet" href="./assets/style.css">
    <script>
        var SITE_URL = '<?= SITE_URL; ?>';
    </script>
    <style>
        @media only screen and (min-width: 768px) {
            .desktop-only {
                display: block;
            }

            .mobile-only {
                display: none;
            }

            .res_logo .mobile {
                display: none;
            }

            .res_logo .desktop {
                display: block;
            }
        }

        @media only screen and (max-width: 767px) {
            .desktop-only {
                display: none;
            }

            body.logged-in .desktop-only {
                display: block;
            }

            body.logged-in .responsive_view_text,
            body.logged-in .mobile-only {
                display: none;
            }

            body.guest .mobile-only {
                display: block;
            }

            body.guest .responsive_nav .blog-btn {
                display: none !important;
            }

            .mobile-blog-btn {
                position: absolute;
                right: 10px;
                top: 10px;
            }

            .res_logo .mobile {
                display: block;
                margin: 0 auto;
            }

            .res_logo .desktop {
                display: none;
            }
        }
    </style>
</head>

<body class="<?= (Session::get('login')) ? 'logged-in' : 'guest'; ?>">