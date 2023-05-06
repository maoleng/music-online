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
                    <li class="breadcrumb__item breadcrumb__item--active">Podcast</li>
                </ul>
            </div>
            <!-- end breadcrumb -->

            <!-- title -->
            <div class="col-12">
                <div class="main__title main__title--page">
                    <h1>Podcast</h1>
                </div>
            </div>
            <!-- end title -->
        </div>

        <div class="row row--grid">
            <div class="col-12">
                <div class="main__filter">
                    <form action="" class="main__filter-search">
                        <input name="q" type="text" value="<?= request()->get('q') ?>" placeholder="Search...">
                        <button type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.71,20.29,18,16.61A9,9,0,1,0,16.61,18l3.68,3.68a1,1,0,0,0,1.42,0A1,1,0,0,0,21.71,20.29ZM11,18a7,7,0,1,1,7-7A7,7,0,0,1,11,18Z"/></svg></button>
                    </form>
                </div>

                <div class="row row--grid">
                    <?php foreach ($podcasts as $i => $podcast): ?>
                        <div class="col-12 col-sm-6 col-lg-4">
                        <div class="live">
                            <a href="<?= $podcast->path ?>" class="live__cover open-video">
                                <img src="<?= $podcast->banner ?>" alt="">
                                <span class="live__status">live</span>
                                <span class="live__value"><?= $podcast->prettyViews() ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"></path></svg>
                            </a>
                            <h3 class="live__title"><a href="<?= $podcast->path ?>" class="open-video"><?= $podcast->name ?></a></h3>
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
        $('select').on('change', function (e) {
            const category = this.value
            window.location.href = location.protocol + '//' + location.host + location.pathname + '?category=' + category
        })
    })

</script>
</body>
</html>