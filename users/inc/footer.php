<?php
require_once "../inc/inspirationQuote.php";
?>

</div>
</div>
<style>
    @media screen and (max-width: 480px) {
        .footertitle {
            color: #fef200;
            text-align: center;
            margin: 0px;
            font-size: 20px;
        }

        .footertitleleft {
            color: #000000;
            text-align: center;
            margin: 0px;
            font-size: 13px;
        }

        .footertitlerigth {
            color: #000000;
            text-align: center;
            margin: 0px;
            font-size: 13px;
        }
    }

    @media screen and (min-width: 600px) {
        .footertitle {
            color: #fef200;
            text-align: center;
            margin: 0px;
            font-size: 20px;
        }

        .footertitleleft {
            color: #000000;
            text-align: center;
            margin: 0px;
            font-size: 13px;
        }

        .footertitlerigth {
            color: #000000;
            text-align: center;
            margin: 0px;
            font-size: 13px;
        }
    }

    @media screen and (min-width: 786px) {
        .footertitle {
            color: #fef200;
            text-align: center;
            margin: 0px;
            font-size: 40px;
        }

        .footertitleleft {
            color: #000000;
            text-align: center;
            margin: 0px;
            font-size: 20px;
        }

        .footertitlerigth {
            color: #000000;
            text-align: center;
            margin: 0px;
            font-size: 20px;
        }
    }

    @media screen and (min-width: 992px) {
        .footertitle {
            color: #fef200;
            text-align: center;
            margin: 0px;
            font-size: 40px;
        }

        .footertitleleft {
            color: #000000;
            text-align: center;
            margin: 0px;
            font-size: 20px;
        }

        .footertitlerigth {
            color: #000000;
            text-align: center;
            margin: 0px;
            font-size: 20px;
        }
    }

    @media screen and (min-width: 1200px) {
        .footertitle {
            color: #fef200;
            text-align: center;
            margin: 0px;
            font-size: 40px;
        }

        .footertitleleft {
            color: #000000;
            text-align: center;
            margin: 0px;
            font-size: 20px;
        }

        .footertitlerigth {
            color: #000000;
            text-align: center;
            margin: 0px;
            font-size: 20px;
        }
    }

    @media print {

        .footertitle,
        .footer-navbar,
        .tox.tox-tinymce-aux,
        .tox-editor-header,
        .tox-statusbar {
            display: none;
        }
    }
</style>
<div class="clearfix" style="float:none; clear:both;"></div>
<!-- Inspiration Quote Capsule Start -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

    .quote-text {
        font-family: 'Ubuntu', sans-serif;
        font-size: 1.2rem;
    }
</style>

<?php
$inspirationQuote = getInspirationQuote();
if (!empty($inspirationQuote)) :
?>
    <div class="navbar px-3 py-2 quote-text d-flex justify-content-center text-white bg-dark">
        <?= htmlspecialchars_decode(getInspirationQuote()) ?>
    </div>
<?php endif; ?>


<!-- Inspiration Quote Capsul End-->
<nav class="footer-navbar navbar navbar-dark flex-md-nowrap pb-2" style="background-color: #f36523;display: flex; justify-content: center; padding: 15px;">
    <h1 class="footertitle">Yes I Can. Yes I Will. It`s Worth it</h1>
</nav>
<nav class="navbar footer-navbar navbar-dark flex-md-nowrap pb-2" style="background-color: #fef200;display: flex; justify-content: space-between; padding: 5px;">
    <h1 class="footertitleleft">Mejorcadadia.com</h1>
    <h1 class="footertitlerigth">All rights reserved 2022</h1>
</nav>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
</script>
<script src="<?= SITE_URL; ?>/users/assets/bootstrap-datepicker.min.js"></script>


<script src="https://accounts.google.com/gsi/client" async defer></script>

</body>

</html>