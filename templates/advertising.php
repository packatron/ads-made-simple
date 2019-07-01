asd
<div>
    <?php
    foreach ($advertising['bannerId'] as $i => $bannerId) {
        if (empty($bannerId)) {
            continue;
        }
        ?>
        <div class="">
            <a href="<?=$advertising['bannerLink'][$i]?>" target="_blank">
                <img src="<?=$advertising['bannerSrc'][$i]?>"
                     width="<?=$advertising['width']?>"
                     height="<?=$advertising['height']?>" />
            </a>
        </div>
        <?php
    }
    ?>
</div>
