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
                    <li class="breadcrumb__item breadcrumb__item--active">Playlist</li>
                </ul>
            </div>
            <!-- end breadcrumb -->

            <!-- title -->
            <div class="col-12">
                <div class="main__title main__title--page">
                    <h1>Playlist</h1>
                </div>
            </div>
            <!-- end title -->

            <div class="col-12">
                <div class="release">
                    <div class="release__content">
                        <div class="release__cover">
                            <img src="<?= url('public/img/covers/cover12.jpg') ?>" alt="">
                        </div>
                        <div class="release__stat">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.65,2.24a1,1,0,0,0-.8-.23l-13,2A1,1,0,0,0,7,5V15.35A3.45,3.45,0,0,0,5.5,15,3.5,3.5,0,1,0,9,18.5V10.86L20,9.17v4.18A3.45,3.45,0,0,0,18.5,13,3.5,3.5,0,1,0,22,16.5V3A1,1,0,0,0,21.65,2.24ZM5.5,20A1.5,1.5,0,1,1,7,18.5,1.5,1.5,0,0,1,5.5,20Zm13-2A1.5,1.5,0,1,1,20,16.5,1.5,1.5,0,0,1,18.5,18ZM20,7.14,9,8.83v-3L20,4.17Z"/></svg>
                                <?= count($musics) ?> tracks
                            </span>
                        </div>
                        <button id="btn-play" class="release__buy">Play</button>
                    </div>

                    <div class="release__list">
                        <ul class="main__list main__list--playlist main__list--dashbox">
                            <?php foreach ($musics as $i => $music): ?>
                                <?php $no = $i + 1 ?>
                                <li class="single-item">
                                <a <?= $no === 1 ? 'id="first-song"' : '' ?> data-playlist data-title="<?= "$no .$music->name" ?>" data-artist="<?= $music->singer ?>" data-img="<?= $music->bannerPath() ?>" href="<?= $music->musicPath() ?>" class="single-item__cover">
                                    <img src="<?= $music->bannerPath() ?>" alt="">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.54,9,8.88,3.46a3.42,3.42,0,0,0-5.13,3V17.58A3.42,3.42,0,0,0,7.17,21a3.43,3.43,0,0,0,1.71-.46L18.54,15a3.42,3.42,0,0,0,0-5.92Zm-1,4.19L7.88,18.81a1.44,1.44,0,0,1-1.42,0,1.42,1.42,0,0,1-.71-1.23V6.42a1.42,1.42,0,0,1,.71-1.23A1.51,1.51,0,0,1,7.17,5a1.54,1.54,0,0,1,.71.19l9.66,5.58a1.42,1.42,0,0,1,0,2.46Z"/></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16,2a3,3,0,0,0-3,3V19a3,3,0,0,0,6,0V5A3,3,0,0,0,16,2Zm1,17a1,1,0,0,1-2,0V5a1,1,0,0,1,2,0ZM8,2A3,3,0,0,0,5,5V19a3,3,0,0,0,6,0V5A3,3,0,0,0,8,2ZM9,19a1,1,0,0,1-2,0V5A1,1,0,0,1,9,5Z"/></svg>
                                </a>
                                <div class="single-item__title">
                                    <h4><a href="#"><?= "$no .$music->name" ?></a></h4>
                                    <span><a href="#"><?= $music->singer ?></a></span>
                                </div>
                                <button data-id="<?= $music->id ?>" class="remove-music single-item__add">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                </button>
                                <button data-url="<?= $music->musicPath() ?>" class="btn-download single-item__export">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21,14a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V15a1,1,0,0,0-2,0v4a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V15A1,1,0,0,0,21,14Zm-9.71,1.71a1,1,0,0,0,.33.21.94.94,0,0,0,.76,0,1,1,0,0,0,.33-.21l4-4a1,1,0,0,0-1.42-1.42L13,12.59V3a1,1,0,0,0-2,0v9.59l-2.29-2.3a1,1,0,1,0-1.42,1.42Z"></path></svg>
                                </button>
                            </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
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
        $('#btn-play').on('click', function () {
            $('#first-song').click()
        })
        $('.remove-music').on('click', function () {
            $.ajax({
                url: '<?= url('remove-from-playlist') ?>',
                method: 'post',
                data: {
                    id: $(this).data('id'),
                }
            }).done(function (e) {
                window.location.reload()
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