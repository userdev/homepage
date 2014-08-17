<div id="container">
    <div id="content" class="samples-content">
        <?php
        $dirs = scandir('samples');
        sort($dirs);
        $i = 0;
        ?> <input type="hidden" id="total_samples" value="<?php echo count($dirs); ?>"><?php
        foreach ($dirs as $dir) {
            if ($dir == '.' || $dir == '..') {
                continue;
            }
            $i++;
            if ($i == 10)
                break;
            $siteDir = scandir('samples/' . $dir);
            $myFooter = "<div id =\"homepage_footer\" style=\"
             position: fixed; 
             height: 40px; 
             width: 100%; 
             bottom: 0; 
             background: #CBE32D; 
             text-align: center; 
             padding-top: 12px; 
             cursor: pointer;
             font-size:20px\" onclick=\"window.open('/homepage/homepage/contact', '_self')\">Pieteikties mājāslapas iztrādei</div>";

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
    </div>
</div>