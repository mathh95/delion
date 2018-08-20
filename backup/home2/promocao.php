<?php include 'includes/header.php'?>

<?

if ($_GET['promocao']) {



            $cod_promocao = (int)$_GET['promocao'];

            $promocao = $bd->query(PromocaoMapper::get($cod_promocao))->fetch();
			
}

?>

<section class="section-item">
    <article class="container">
        <div class="img-item">
            
            <?php if ($promocao['foto']) { ?>

                <a class="fancybox" href="/<?= $promocao['foto'] ?>" data-fancybox-group="gallery">

                    <img class="fancybox" src="/<?= $promocao['foto'] ?>" style="max-width: 100%" width="100%" alt="<?= $promocao['nome'] ?>">

                </a>

            <?php } else { ?>

                <img class="img-product" src="img/no_image.jpg" width="100%" alt="<?= $promocao['nome'] ?>">

            <?php } ?>
        </div>
        <div class="item-description">
            <h1 class="the-font"><?= $promocao['nome'] ?></h1>
            <?= nl2br(stripslashes(html_entity_decode($promocao['descricao'], ENT_QUOTES, 'UTF-8'))) ?>
        </div>
    </article>
</section>


<?php include 'includes/footer.php'?>
