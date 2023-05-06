<!DOCTYPE html>
<html lang="en">
<?php include asset('view/shared/head-tag.php') ?>
<body>
<?php include asset('view/shared/header.php') ?>
<?php include asset('view/shared/sidebar.php') ?>

<main class="main">
    <div class="container-fluid">
        <!-- slider -->
        <section class="row">
            <div class="col-12">
                <div class="hero owl-carousel" id="hero">
                    <div class="hero__slide" data-bg="<?= url('public/img/home/slide1.jpg') ?>">
                        <h1 class="hero__title">Online music & Record label</h1>
                        <p class="hero__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
                        <div class="hero__btns">
                            <a href="#" class="hero__btn hero__btn--red">Buy now</a>
                            <a href="#" class="hero__btn">Learn more</a>
                        </div>
                    </div>

                    <div class="hero__slide" data-bg="<?= url('public/img/home/slide2.jpg') ?>">
                        <h2 class="hero__title">Metallica and Slipknot feature in trailer for ‘Long Live Rock’ documentary</h2>
                        <p class="hero__text">It also features Rage Against The Machine, Guns N' Roses and a number of others</p>
                        <div class="hero__btns">
                            <a href="#" class="hero__btn hero__btn--red">Learn more</a>
                            <a href="http://www.youtube.com/watch?v=0O2aH4XLbto" class="hero__btn hero__btn--video open-video"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,10.27,11,7.38A2,2,0,0,0,8,9.11v5.78a2,2,0,0,0,1,1.73,2,2,0,0,0,2,0l5-2.89a2,2,0,0,0,0-3.46ZM15,12l-5,2.89V9.11L15,12ZM12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z"/></svg> Watch video</a>
                        </div>
                    </div>

                    <div class="hero__slide" data-bg="<?= url('public/img/home/slide3.jpg') ?>">
                        <h2 class="hero__title">New Artist of Our Label</h2>
                        <p class="hero__text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
                        <div class="hero__btns">
                            <a href="#" class="hero__btn">Learn more</a>
                        </div>
                    </div>
                </div>

                <button class="main__nav main__nav--hero main__nav--prev" data-nav="#hero" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17,11H9.41l3.3-3.29a1,1,0,1,0-1.42-1.42l-5,5a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l5,5a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L9.41,13H17a1,1,0,0,0,0-2Z"/></svg></button>
                <button class="main__nav main__nav--hero main__nav--next" data-nav="#hero" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z"/></svg></button>
            </div>
        </section>
        <!-- end slider -->

        <!-- releases -->
        <section class="row row--grid">
            <!-- title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>New Releases</h2>

                    <a href="<?= url('music') ?>" class="main__link">See all <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z"/></svg></a>
                </div>
            </div>
            <!-- end title -->
            <?php foreach ($new_musics as $music): ?>
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

        </section>
        <!-- end releases -->

        <section class="row row--grid">
            <div class="col-12 col-md-6 col-xl-4">
                <div class="row row--grid">
                    <!-- title -->
                    <div class="col-12">
                        <div class="main__title">
                            <h2><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.65,2.24a1,1,0,0,0-.8-.23l-13,2A1,1,0,0,0,7,5V15.35A3.45,3.45,0,0,0,5.5,15,3.5,3.5,0,1,0,9,18.5V10.86L20,9.17v4.18A3.45,3.45,0,0,0,18.5,13,3.5,3.5,0,1,0,22,16.5V3A1,1,0,0,0,21.65,2.24ZM5.5,20A1.5,1.5,0,1,1,7,18.5,1.5,1.5,0,0,1,5.5,20Zm13-2A1.5,1.5,0,1,1,20,16.5,1.5,1.5,0,0,1,18.5,18ZM20,7.14,9,8.83v-3L20,4.17Z"/></svg><a href="#">Top Singles</a></h2>
                        </div>
                    </div>
                    <!-- end title -->

                    <div class="col-12">
                        <ul class="main__list">
                            <?php foreach ($top_musics as $i => $music): ?>
                                <li class="single-item">
                                <span class="single-item__number"><?= $i + 1 ?></span>
                                <span class="single-item__rate"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.71,12.54a1,1,0,0,0-1.42,0l-3,3A1,1,0,0,0,9.71,17L12,14.66,14.29,17a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Zm-3-1.08L12,9.16l2.29,2.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42l-3-3a1,1,0,0,0-1.42,0l-3,3a1,1,0,0,0,1.42,1.42Z"/></svg> 1</span>
                                <a data-link data-title="<?= $music->name ?>" data-artist="<?= $music->singer ?>" data-img="<?= $music->bannerPath() ?>" href="<?= $music->musicPath() ?>" class="single-item__cover">
                                    <img src="<?= $music->bannerPath() ?>" alt="">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"/></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2a3,3,0,0,0-3,3V19a3,3,0,0,0,6,0V5A3,3,0,0,0,16,2Zm1,17a1,1,0,0,1-2,0V5a1,1,0,0,1,2,0ZM8,2A3,3,0,0,0,5,5V19a3,3,0,0,0,6,0V5A3,3,0,0,0,8,2ZM9,19a1,1,0,0,1-2,0V5A1,1,0,0,1,9,5Z"/></svg>
                                </a>
                                <div class="single-item__title">
                                    <h4><a href="<?= url('detail')."?id=$music->id" ?>"><?= $music->limitName() ?></a></h4>
                                    <span><a href="#"><?= $music->singer ?></a></span>
                                </div>
                                    <button data-id="<?= $music->id ?>" class="btn-add_to_playlist single-item__add">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19,11H13V5a1,1,0,0,0-2,0v6H5a1,1,0,0,0,0,2h6v6a1,1,0,0,0,2,0V13h6a1,1,0,0,0,0-2Z"></path></svg>
                                    </button>
                            </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- podcasts -->
        <section class="row row--grid">
            <!-- title -->
            <div class="col-12">
                <div class="main__title">
                    <h2>Podcasts</h2>

                    <a href="<?= url('podcast') ?>" class="main__link">See all <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z"/></svg></a>
                </div>
            </div>
            <!-- end title -->

            <div class="col-12">
                <div class="main__carousel-wrap">
                    <div class="main__carousel main__carousel--podcasts owl-carousel" id="podcasts">
                        <?php foreach ($podcasts as $podcast): ?>
                            <div class="live">
                            <a href="<?= $podcast->path ?>" class="live__cover open-video">
                                <img src="<?= $podcast->bannerPath() ?>" alt="">
                                <span class="live__status">new</span>
                                <span class="live__value"><?= $podcast->prettyViews() ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"></path></svg>
                            </a>
                            <h3 class="live__title"><a href="<?= $podcast->path ?>" class="open-video"><?= $podcast->name ?></a></h3>
                        </div>
                        <?php endforeach ?>
                    </div>

                    <button class="main__nav main__nav--prev" data-nav="#podcasts" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17,11H9.41l3.3-3.29a1,1,0,1,0-1.42-1.42l-5,5a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l5,5a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L9.41,13H17a1,1,0,0,0,0-2Z"/></svg></button>
                    <button class="main__nav main__nav--next" data-nav="#podcasts" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M17.92,11.62a1,1,0,0,0-.21-.33l-5-5a1,1,0,0,0-1.42,1.42L14.59,11H7a1,1,0,0,0,0,2h7.59l-3.3,3.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l5-5a1,1,0,0,0,.21-.33A1,1,0,0,0,17.92,11.62Z"/></svg></button>
                </div>
            </div>
        </section>
        <!-- end podcasts -->
    </div>
</main>

<?php include asset('view/shared/footer.php') ?>
<?php include asset('view/shared/script-tag.php') ?>
<script>
    $(document).ready(function () {
        $('.btn-add_to_playlist').on('click', function () {
            $.ajax({
                url: '<?= url('add-to-playlist') ?>',
                method: 'post',
                data: {
                    id: $(this).data('id'),
                }
            }).done(function (e) {
                $.notify(e, 'success')
            })
        })
    })
</script>
</body>
</html>