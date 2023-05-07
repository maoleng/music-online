<!DOCTYPE html>
<html lang="en">
<?php include asset('view/shared/head-tag.php') ?>
<body>
<?php include asset('view/shared/header.php') ?>
<?php include asset('view/shared/sidebar.php') ?>

<main class="main">
    <div class="container-fluid">
        <div class="row row--grid">
            <!-- breadcrumb -->
            <div class="col-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb__item"><a href="<?= url('/') ?>">Home</a></li>
                    <li class="breadcrumb__item breadcrumb__item--active">Sign up</li>
                </ul>
            </div>
            <!-- end breadcrumb -->

            <!-- sign in -->
            <div class="col-12">
                <div class="sign">
                    <div class="sign__content">
                        <form method="post" action="<?= url('signup') ?>" class="sign__form">

                            <a href="<?= url('/') ?>" class="sign__logo">
                                <img src="<?= url('public/img/logo.svg') ?>" alt="">
                            </a>
                            <div class="sign__group">
                                <input name="name" type="text" class="sign__input" placeholder="Name">
                            </div>

                            <div class="sign__group">
                                <input name="email" type="email" class="sign__input" placeholder="Email">
                            </div>

                            <div class="sign__group">
                                <input name="password" type="password" class="sign__input" placeholder="Password">
                            </div>

                            <div class="sign__group">
                                <input name="password2" type="password" class="sign__input" placeholder="Retype password">
                            </div>

                            <button class="sign__btn">Sign up</button>

                            <span class="sign__text">Have an account? <a href="<?= url('login') ?>">Sign in!</a></span>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end sign in -->
        </div>
    </div>
</main>

<?php include asset('view/shared/footer.php') ?>
<?php include asset('view/shared/script-tag.php') ?>
<script>
    <?= notifyMessage() ?>
</script>
</body>
</html>