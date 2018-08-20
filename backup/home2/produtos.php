<?php include 'includes/header.php'?>
<?php //include 'includes/slider.php'?>

<?

if ($_GET['categoria']) {



    $cod_categoria = (int)$_GET['categoria'];

    $sql = ProdutoMapper::get_by_categoria($cod_categoria);


	$categorias = $bd->query(CategoriaMapper::get($cod_categoria))->fetchAll();
	
	foreach ($categorias as $categoria);
}


$qnt = $bd->query($sql)->rowCount();


if ($qnt) {



    $pages = new Paginator();

    $pages->items_total = $qnt;

    $pages->items_per_page = 12;

    $pages->paginate();

    $sqlProd = $sql . $pages->limit;

    $produtos = $bd->query($sqlProd)->fetchAll();

}


if ($categoria['foto_categoria']) {
    ?>
<header class="slider">
    <!--
    <div class="container">
        <ul class="bxslider">-->
           
           
                <?php if ($categoria['foto_categoria']) { ?>
                  <!--  <li> -->
                        
                        <div style="background-image: url(/<?= $categoria['foto_categoria']; ?>); background-position: center; background-repeat: no-repeat; width: 100%; height: 400px;"></div>
                        
                    <!--</li>-->
                <?php } ?>
            
       <!-- </ul>
    </div>-->
</header>
<?php } ?>



<div class="container">
    <div class="line"><img src="img/linha.png" width="100%" alt=""></div>
</div>

<section>
    <article class="container">

        
        <div class="destaque">
            <h1 class="the-font"><?= $categoria['nome'] ?></h1>
        </div>
        <?php if ($produtos) { ?>
        <ul class="the-font list-destaque">
            
            <?php foreach ($produtos as $produto) { ?>
            <li>
                	<a href="produto.php?produto=<?= $produto['cod_produto'] ?>">
					<?php if ($produto['foto']) { ?>

                        <img src="/<?= $produto['foto'] ?>" style="max-height: 439px" width="100%" alt="">
                
                    <?php } else { ?>
                
                        <img src="img/sem_foto_site.jpg" width="100%" alt="">
                
                    <?php } ?>
                    </a>
                	<p><a href="produto.php?produto=<?= $produto['cod_produto'] ?>"><?= $produto['nome'] ?></a></p>
            </li>
            <? } ?>
            
            
        </ul>
        
        
        <br clear="all"/><br/><br/><br/>

        <div style="float: right" class="pagination pagination-sm"><?= $pages->display_pages(); ?></div>
        
        <? } ?>
    </article>
</section>



<?php include 'includes/footer.php'?>
