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
                    <li class="breadcrumb__item"><a href="<?= url() ?>">Home</a></li>
                    <li class="breadcrumb__item breadcrumb__item--active">Profile</li>
                </ul>
            </div>
            <!-- end breadcrumb -->

            <!-- title -->
            <div class="col-12">
                <div class="main__title main__title--page">
                    <h1>Profile</h1>
                </div>
            </div>
            <!-- end title -->
        </div>

        <div class="row row--grid">
            <div class="col-12">
                <div class="profile">
                    <div class="profile__user">
                        <div class="profile__avatar">
                            <img src="<?= url('public/img/avatar.svg') ?>" alt="">
                        </div>
                        <div class="profile__meta">
                            <h3><?= c()->name ?></h3>
                            <span>ID: <?= c()->id ?></span>
                        </div>
                    </div>

                    <!-- tabs nav -->
                    <ul class="nav nav-tabs profile__tabs" id="profile__tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="true">Settings</a>
                        </li>
                    </ul>
                    <!-- end tabs nav -->

                    <a href="<?= url('logout') ?>" class="profile__logout" type="button">
                        <span>Sign out</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.59,13l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l4-4a1,1,0,0,0,.21-.33,1,1,0,0,0,0-.76,1,1,0,0,0-.21-.33l-4-4a1,1,0,1,0-1.42,1.42L12.59,11H3a1,1,0,0,0,0,2ZM12,2A10,10,0,0,0,3,7.55a1,1,0,0,0,1.8.9A8,8,0,1,1,12,20a7.93,7.93,0,0,1-7.16-4.45,1,1,0,0,0-1.8.9A10,10,0,1,0,12,2Z"/></svg>
                    </a>
                </div>

                <!-- content tabs -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-4" role="tabpanel">
                        <div class="row row--grid">
                            <!-- details form -->
                            <div class="col-12 col-lg-6">
                                <form action="<?= url('profile') ?>" method="post" class="sign__form sign__form--profile">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="sign__title">Profile details</h4>
                                            <?= alertMessage() ?>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                            <div class="sign__group">
                                                <label class="sign__label" for="email">Email</label>
                                                <input disabled value="<?= c()->email ?>" id="email" type="text" name="email" class="sign__input" placeholder="email@email.com">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                            <div class="sign__group">
                                                <label class="sign__label" for="name">Name</label>
                                                <input value="<?= c()->name ?>" id="name" type="text" name="name" class="sign__input" placeholder="Name">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="sign__btn">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end details form -->

                            <!-- password form -->
                            <div class="col-12 col-lg-6">
                                <form action="<?= url('change-password') ?>" method="post" class="sign__form sign__form--profile">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="sign__title">Change password</h4>
                                            <?= session()->get('success2') ?? session()->get('error2') ?>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                            <div class="sign__group">
                                                <label class="sign__label" for="old_password">Old password</label>
                                                <input id="old_password" type="password" name="old_password" class="sign__input">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6"></div>

                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                            <div class="sign__group">
                                                <label class="sign__label" for="password">New password</label>
                                                <input id="password" type="password" name="password" class="sign__input">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                            <div class="sign__group">
                                                <label class="sign__label" for="password2">Confirm new password</label>
                                                <input id="password2" type="password" name="password2" class="sign__input">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="sign__btn">Change</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- end password form -->
                        </div>
                    </div>
                </div>
                <!-- end content tabs -->
            </div>
        </div>
    </div>
</main>

<?php include asset('view/shared/footer.php') ?>
<?php include asset('view/shared/script-tag.php') ?>
<script>
    $( document ).ready(function () {
        $('select').on('change', function (e) {
            const category = this.value
            window.location.href = location.protocol + '//' + location.host + location.pathname + '?category=' + category
        })
    })

</script>
</body>
</html>