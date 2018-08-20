
<?php

$banners = $bd->query(BannerMapper::get_by_location('top'))->fetchAll();

if ($banners) {
    ?>
<header class="slider">
    <div class="container">
        <ul class="bxslider">
            <!--
            <li><img src="img/slider.jpg" /></li>
            <li><img src="img/slider.jpg" /></li>
            <li><img src="img/slider.jpg" /></li>
            <li><img src="img/slider.jpg" /></li>
            -->
            <?php foreach ($banners as $banner) { ?>
                <?php if ($banner['link']) { ?>
                    <li>
                        <a href="<?= $banner['link'] ?>">
                            <div style="background-image: url(/<?= $banner['foto'] ?>); background-position: center; background-repeat: no-repeat; width: 100%; height: 400px;"></div>
                        </a>
                    </li>
                <?php } else { ?>
                    <li>
                        <div style="background-image: url(/<?= $banner['foto'] ?>); background-position: center; background-repeat: no-repeat; width: 100%; height: 400px;"></div>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</header>
<?php } ?>

    