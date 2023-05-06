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
                    <li class="breadcrumb__item breadcrumb__item--active">Detail</li>
                </ul>
            </div>
            <!-- end breadcrumb -->

            <!-- title -->
            <div class="col-12">
                <div class="main__title main__title--page">
                    <h1><?= $music->singer.' - '.$music->name ?></h1>
                </div>
            </div>
            <!-- end title -->

            <div class="col-12">
                <div class="release">
                    <div class="release__content">
                        <div class="release__cover">
                            <img src="<?= $music->banner ?>" alt="">
                        </div>
                        <div class="release__stat">
                            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20,13.18V11A8,8,0,0,0,4,11v2.18A3,3,0,0,0,2,16v2a3,3,0,0,0,3,3H8a1,1,0,0,0,1-1V14a1,1,0,0,0-1-1H6V11a6,6,0,0,1,12,0v2H16a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h3a3,3,0,0,0,3-3V16A3,3,0,0,0,20,13.18ZM7,15v4H5a1,1,0,0,1-1-1V16a1,1,0,0,1,1-1Zm13,3a1,1,0,0,1-1,1H17V15h2a1,1,0,0,1,1,1Z"/></svg> <?= $music->views ?></span>
                        </div>
                    </div>

                    <div class="release__list">
                        <ul class="main__list main__list--playlist main__list--dashbox">
                            <li class="single-item">
                                <a id="btn-play" data-playlist data-title="<?= $music->name ?>" data-artist="<?= $music->singer ?>" data-img="<?= $music->banner ?>" href="<?= $music->music_path ?>" class="single-item__cover">
                                </a>
                            </li>
                        </ul>
                        <div class="article__content">
                            <h4>Lyrics</h4>
                            <p><?= $music->lyrics ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="article">
                    <!-- comments -->
                    <div class="comments">
                        <div class="comments__title">
                            <h4>Comments</h4>
                            <span><?= count($comments) ?></span>
                        </div>

                        <ul class="comments__list">
                            <?php foreach ($comments as $comment): ?>
                                <li class="comments__item">
                                    <div class="comments__autor">
                                        <img class="comments__avatar" src="<?= url('public/img/avatar.svg') ?>" alt="">
                                        <span class="comments__name"><?= $comment->name ?></span>
                                        <span class="comments__time"><?= $comment->commented_at ?></span>
                                    </div>
                                    <p class="comments__text"><?= $comment->content ?></p>
                                </li>
                            <?php endforeach ?>
                        </ul>

                        <form action="<?= url('comment') ?>" method="post" class="comments__form">
                            <div class="sign__group">
                                <textarea id="text" name="content" <?= c() === null ? '' : 'disabled' ?> class="sign__textarea" placeholder="Add comment"></textarea>
                            </div>
                            <button <?= c() === null ? '' : 'disabled' ?> class="sign__btn">Send</button>
                        </form>
                    </div>
                    <!-- end comments -->
                </div>
            </div>

        </div>
    </div>
</main>

<?php include asset('view/shared/footer.php') ?>
<?php include asset('view/shared/script-tag.php') ?>
<script>
    $( document ).ready(function () {
        $('#btn-play').click()
    })

</script>
</body>
</html>