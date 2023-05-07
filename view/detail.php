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
                            <img src="<?= $music->bannerPath() ?>" alt="">
                        </div>
                        <div class="release__stat">
                            <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20,13.18V11A8,8,0,0,0,4,11v2.18A3,3,0,0,0,2,16v2a3,3,0,0,0,3,3H8a1,1,0,0,0,1-1V14a1,1,0,0,0-1-1H6V11a6,6,0,0,1,12,0v2H16a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1h3a3,3,0,0,0,3-3V16A3,3,0,0,0,20,13.18ZM7,15v4H5a1,1,0,0,1-1-1V16a1,1,0,0,1,1-1Zm13,3a1,1,0,0,1-1,1H17V15h2a1,1,0,0,1,1,1Z"/></svg> <?= $music->views ?></span>
                        </div>

                        <?php if (c() !== null && (int) c()->is_admin) { ?>
                            <a style="width: 30%; float:left; margin-bottom: 15px" href="#modal-create" class="release__buy open-modal">Edit</a>
                            <a style="width: 30%; float:left; margin-bottom: 15px; margin-left: 20px  " href="#modal-del" class="release__buy open-modal">Delete</a>
                            <form action="<?= url('music/delete') ?>" method="post" id="modal-del" class="zoom-anim-dialog mfp-hide modal modal--form">
                                <button class="modal__close" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"/></svg></button>

                                <h4 class="sign__title">Delete music</h4>
                                <div class="sign__group sign__group--row">
                                    <span class="sign__value">This can be undo, do you really want to delete ?</span>
                                </div>
                                <input type="hidden" name="id" value="<?= $music->id ?>">

                                <button class="sign__btn">Delete</button>
                            </form>

                            <form action="<?= url('music/update') ?>" method="post" enctype="multipart/form-data" id="modal-create" class="zoom-anim-dialog mfp-hide modal modal--form">
                                <button class="modal__close" type="button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13.41,12l4.3-4.29a1,1,0,1,0-1.42-1.42L12,10.59,7.71,6.29A1,1,0,0,0,6.29,7.71L10.59,12l-4.3,4.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L12,13.41l4.29,4.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"/></svg></button>

                                <h4 class="sign__title">Edit music</h4>

                                <input type="hidden" name="id" value="<?= $music->id ?>" hidden>
                                <div class="sign__group sign__group--row">
                                    <label class="sign__label" for="email">Name</label>
                                    <input value="<?= $music->name ?>" id="email" type="text" name="name" class="sign__input" >
                                </div>
                                <div class="sign__group sign__group--row">
                                    <label class="sign__label" for="email">Singer</label>
                                    <input value="<?= $music->singer ?>" id="email" type="text" name="singer" class="sign__input" >
                                </div>
                                <div class="sign__group sign__group--row">
                                    <label class="sign__label" for="value">Category:</label>
                                    <select class="sign__select" name="category" id="value">
                                        <?php foreach ($categories as $category): ?>
                                            <option <?= $category === $music->category ? 'selected' : '' ?> value="<?= $category ?>"><?= $category ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="sign__group sign__group--row">
                                    <label class="sign__label" for="email">Lyrics</label>
                                    <textarea id="text" name="lyrics" class="sign__textarea" placeholder="Add comment"><?= $music->lyrics ?></textarea>
                                </div>
                                <div class="sign__group sign__group--row">
                                    <label class="sign__label" for="email">Banner</label>
                                    <input id="email" type="file" name="banner" class="" placeholder="email@email.com">
                                </div>
                                <div class="sign__group sign__group--row">
                                    <label class="sign__label" for="email">Audio file</label>
                                    <input id="audio" type="file" name="audio" class="" placeholder="email@email.com">
                                </div>

                                <button class="sign__btn">Edit</button>
                            </form>
                        <?php } ?>
                        <button data-id="<?= $music->id ?>" class="btn-add_to_playlist release__buy">Add to playlist</button>
                        <a data-url="<?= $music->musicPath() ?>" href="#" class="btn-download release__buy">Download</a>
                    </div>

                    <div class="release__list">
                        <ul class="main__list main__list--playlist main__list--dashbox">
                            <li class="single-item">
                                <a id="btn-play" data-playlist data-title="<?= $music->name ?>" data-artist="<?= $music->singer ?>" data-img="<?= $music->bannerPath() ?>" href="<?= $music->musicPath() ?>" class="single-item__cover">
                                </a>
                            </li>
                        </ul>
                        <div class="article__content">
                            <h4>Category</h4>
                            <p><?= $music->category ?></p>
                            <h4>Singer</h4>
                            <p><?= $music->singer ?></p>
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
                                <textarea id="text" name="content" <?= c() === null ? 'disabled' : '' ?> class="sign__textarea" placeholder="Add comment"></textarea>
                            </div>
                            <button <?= c() === null ? 'disabled' : '' ?> class="sign__btn">Send</button>
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
    $(document).ready(function () {
        <?= notifyMessage() ?>
        $('#btn-play').click()
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
        $('.btn-download').on('click', function () {
            downloadResource($(this).data('url'))
        })
        function downloadBlob(blob, filename) {
            var a = document.createElement('a');
            a.download = filename;
            a.href = blob;
            document.body.appendChild(a);
            a.click();
            a.remove();
        }

        function downloadResource(url) {
            filename = url.split('\\').pop().split('/').pop();
            fetch(url, {
                mode: 'no-cors'
            })
                .then(response => response.blob())
                .then(blob => {
                    let blobUrl = window.URL.createObjectURL(blob);
                    downloadBlob(blobUrl, filename);
                })
                .catch(e => console.error(e));
        }

    })

</script>
</body>
</html>