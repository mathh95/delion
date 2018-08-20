<?php include 'includes/header.php'?>

<?

if ($_GET['produto']) {



            $cod_produto = (int)$_GET['produto'];

            $produto = $bd->query(ProdutoMapper::get($cod_produto))->fetch();
			
}

?>

<section class="section-item">
    <article class="container">
        <div class="img-item">
            
            <?php if ($produto['foto']) { ?>

                <a class="fancybox" href="/<?= $produto['foto'] ?>" data-fancybox-group="gallery">

                    <img class="fancybox" src="/<?= $produto['foto'] ?>" style="max-width: 100%" width="100%" alt="<?= $produto['nome'] ?>">

                </a>

            <?php } else { ?>

                <img class="img-product" src="img/sem_foto_site.jpg" width="100%" alt="<?= $produto['nome'] ?>">

            <?php } ?>
        </div>
        <div class="item-description">
            <h1 class="the-font"><?= $produto['nome'] ?></h1>
            <?= nl2br(stripslashes(html_entity_decode($produto['descricao'], ENT_QUOTES, 'UTF-8'))) ?>
        </div>
    </article>
</section>


<?php include 'includes/footer.php'?>
