<?php
$hash = 'advertising-'.md5(rand(0,1000).time());
?>
<div id="<?=$hash?>" style="width:<?=$advertising['width']?>px;height:<?=$advertising['height']?>px;overflow:hidden">
    <?php
    foreach ($advertising['bannerId'] as $i => $bannerId) {
        if (empty($bannerId)) {
            continue;
        }
        ?>
        <div>
            <a href="<?=$advertising['bannerLink'][$i]?>" target="_blank">
                <img src="<?=$advertising['bannerSrc'][$i]?>"
                     style="width:<?=$advertising['width']?>px;height:<?=$advertising['height']?>px"
                     width="<?=$advertising['width']?>"
                     height="<?=$advertising['height']?>" />
            </a>
        </div>
        <?php
    }
    ?>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('#<?=$hash?>').cycle({
            fx: 'fade'
        });
    });
</script>
