<?php include 'includes/header.php'?>
<?php include 'includes/slider.php'?>

<?




    

    $sql = PromocaoMapper::get();




$qnt = $bd->query($sql)->rowCount();


if ($qnt) {



    $pages = new Paginator();

    $pages->items_total = $qnt;

    $pages->items_per_page = 12;

    $pages->paginate();

    $sqlProd = $sql . $pages->limit;

    $promocoes = $bd->query($sqlProd)->fetchAll();

}
?>

<div class="container">
    <div class="line"><img src="img/linha.png" width="100%" alt=""></div>
</div>

<section>
    <article class="container">
        <div class="destaque">
            <h1 class="the-font">Promções</h1>
        </div>
        <?php if ($promocoes) { ?>
        <ul class="the-font list-destaque">
            
            <?php foreach ($promocoes as $promocao) { ?>
            <li>
                	<a href="promocao.php?promocao=<?= $promocao['cod_promocao'] ?>">
					<?php if ($promocao['foto']) { ?>

                        <img src="/<?= $promocao['foto'] ?>" style="max-height: 439px" width="100%" alt="">
                
                    <?php } else { ?>
                
                        <img src="img/no_image.jpg" width="100%" alt="">
                
                    <?php } ?>
                    </a>
                	<p><a href="promocao.php?promocao=<?= $promocao['cod_promocao'] ?>"><?= $promocao['nome'] ?></a></p>
            </li>
            <? } ?>
            
            
        </ul>
        
        
        <br clear="all"/><br/><br/><br/>

        <div style="float: right" class="pagination pagination-sm"><?= $pages->display_pages(); ?></div>
        
        <? } ?>
    </article>
</section>



<?php include 'includes/footer.php'?>
