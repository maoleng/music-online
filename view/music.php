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
                    <li class="breadcrumb__item breadcrumb__item--active">Music</li>
                </ul>
            </div>
            <!-- end breadcrumb -->

            <!-- title -->
            <div class="col-12">
                <div class="main__title main__title--page">
                    <h1>Music</h1>
                </div>
            </div>
            <!-- end title -->
        </div>

        <a href="#modal-create" class="hero__btn hero__btn--red open-modal">Create music</a>
        <form action="<?= url('music/create') ?>" method="post" enctype="multipart/form-data" id="modal-create" class="zoom-anim-dialog mfp-hide modal modal--form">
            <button class="modal__close" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"/></svg></button>

            <h4 class="sign__title">Add music</h4>

            <div class="sign__group sign__group--row">
                <label class="sign__label" for="email">Name</label>
                <input id="email" type="text" name="name" class="sign__input" >
            </div>
            <div class="sign__group sign__group--row">
                <label class="sign__label" for="email">Singer</label>
                <input id="email" type="text" name="singer" class="sign__input" >
            </div>
            <div class="sign__group sign__group--row">
                <label class="sign__label" for="value">Category:</label>
                <select class="sign__select" name="category" id="value">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category ?>"><?= $category ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="sign__group sign__group--row">
                <label class="sign__label" for="email">Lyrics</label>
                <textarea id="text" name="lyrics" class="sign__textarea" placeholder="Add comment"></textarea>
            </div>
            <div class="sign__group sign__group--row">
                <label class="sign__label" for="email">Banner</label>
                <input id="email" type="file" name="banner" class="" placeholder="email@email.com">
            </div>
            <div class="sign__group sign__group--row">
                <label class="sign__label" for="email">Audio file</label>
                <input id="audio" type="file" name="audio" class="" placeholder="email@email.com">
            </div>

            <button class="sign__btn">Create</button>
        </form>

        <!-- releases -->
        <div class="row row--grid">
            <div class="col-12">
                <div class="main__filter">
                    <form action="" class="main__filter-search">
                        <input name="q" type="text" value="<?= request()->get('q') ?>" placeholder="Search...">
                        <button type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z"/></svg></button>
                    </form>

                    <div class="main__filter-wrap">
                        <select class="main__select" name="years">
                            <option value="All genres"><?= ($category = request()->get('category')) === null ? 'All' : $category ?></option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category ?>"><?= $category ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="slider-radio">
                        <a href="<?= url('music') ?>"><input <?= empty(request()->get('sort')) ? 'checked="checked"' : ''  ?> type="radio" name="grade"><label for="popular">All</label></a>
                        <a href="?sort=popular"><input <?= request()->get('sort') === 'popular' ? 'checked="checked"' : '' ?> type="radio" name="grade"><label for="popular">Popular</label></a>
                    </div>
                </div>

                <div class="row row--grid">

                    <?php foreach ($musics as $i => $music): ?>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="album">
                                <div class="album__cover">
                                    <img src="<?= $music->bannerPath() ?>" alt="">
                                    <a href="<?= url('detail')."?id=$music->id" ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"/></svg></a>
                                    <span class="album__stat">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20,13.18V11A8,8,0,0,0,4,11v2.18A3,3,0,0,0,2,16v2a3,3,0,0,0,3,3H8a1,1,0,0,0,1-1V14a1,1,0,0,0-1-1H6V11a6,6,0,0,1,12,0v2H16a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h3a3,3,0,0,0,3-3V16A3,3,0,0,0,20,13.18ZM7,15v4H5a1,1,0,0,1-1-1V16a1,1,0,0,1,1-1Zm13,3a1,1,0,0,1-1,1H17V15h2a1,1,0,0,1,1,1Z"/></svg>
                                            <?= $music->views ?>
                                        </span>
                                    </span>
                                </div>
                                <div class="album__title">
                                    <h3><a href="<?= url('detail')."?id=$music->id" ?>"><?= $music->name ?></a></h3>
                                    <span><a href="#"><?= $music->singer ?></a></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
    </div>
</main>

<?php include asset('view/shared/footer.php') ?>
<?php include asset('view/shared/script-tag.php') ?>
<script>
    $( document ).ready(function () {
        <?= notifyMessage() ?>
        $('select').on('change', function (e) {
            const category = this.value
            window.location.href = location.protocol + '//' + location.host + location.pathname + '?category=' + category
        })

</script>
</body>
</html>