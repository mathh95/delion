<?php include 'includes/header.php'?>

<div class="container">
    <div class="line"><img src="img/linha.png" width="100%" alt=""></div>
</div>

<?php include 'includes/slider.php'?>

<?

$produtos = $bd->query(ProdutoMapper::get_destaque())->fetchAll();

?>

<section>
    <article class="container">
        <div class="destaque">
            <h1 class="the-font">Destaques</h1>
        </div>
        <ul class="the-font list-destaque">
            
            <?php if ($produtos) { ?>
            
            	<?php foreach ($produtos as $produto) { ?>
                <li>
                        <a href="produto.php?produto=<?= $produto['cod_produto'] ?>">
                        <?php if ($produto['foto']) { ?>
    
                            <img src="/<?= $produto['foto'] ?>" style="max-height: 439px" width="100%" alt="">
                    
                        <?php } else { ?>
                    
                            <img src="img/no_image.jpg" width="100%" alt="">
                    
                        <?php } ?>
                        </a>
                        <p><a href="produto.php?produto=<?= $produto['cod_produto'] ?>"><?= $produto['nome'] ?></a></p>
                </li>
                <? } ?>
            
            <? } ?>
            
        </ul>
    </article>
</section>


<?php include 'includes/footer.php'?>
