<div id="container">
    <div id="content" class="samples-content">
        <?php
        $dirs = scandir('samples');
        sort($dirs);
        $i = 0;
        ?> <input type="hidden" id="total_samples" value="<?php echo count($dirs); ?>"><?php
        foreach ($dirs as $dir) {
            if ($dir == '.' || $dir == '..' || $dir == '.htaccess') {
                continue;
            }
            $i++;
            if ($i == 10)
                break;
            $siteDir = scandir('samples/' . $dir);

            foreach ($siteDir as $elem) {
                if ($elem == "img.png" || $elem == "img.jpg" || $elem == "img.jpg") {
                    if ($i == 4 || $i == 7 || $i == 1) {
                        ?>  <img alt = 'new icon' class = 'new-icon-first' src = '<?php echo base_url("img/new_icon.png"); ?>' /><?php
                    } else {
                        ?>
                        <img alt='new icon' class='new-icon' src='<?php echo base_url("img/new_icon.png"); ?>' />
                    <?php } ?>
                    <a alt="homepage sample" href="<?php echo base_url("samples/$dir/src"); ?>">

                        <img class="sample-img" src="<?php echo base_url("samples/$dir/$elem"); ?>"/></a><?php
                    }
                }
            }
            ?>
                        <div id='show_more' onclick="loadMoreSamples();">Radīt vēl</div>
    </div>
</div>