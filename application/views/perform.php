<div id="container">
    <div id="content">
        <?php
        $dirs = scandir('samples');
        foreach ($dirs as $dir) {
            if ($dir == '.' || $dir == '..') {
                continue;
            }
            $siteDir = scandir('samples/' . $dir);
            // = scandir($dir);
            // print_r($siteDir);
            foreach ($siteDir as $elem) {
                if ($elem == "img.png" || $elem == "img.jpg" || $elem == "img.jpg") {
                    ?><a href="<?php echo base_url("samples/$dir/src"); ?>"><img class="sample-img" src="<?php echo base_url("samples/$dir/$elem"); ?>" /> </a><?php
                    }
                }
            }
            ?>
        <!-- <div id="bullets_container">
             <div class="cotainer-header">Mēs esam jauni, bet mums IR paveiktie darbi</div>
             <div class='bullet-container-text'>
                 <p>Lai arī esam nesen dzimuši mums ir izstrādātas mājaslapas.
                     Mēs esam izstrādājuši sākot no vizītkares tipa mājaslapām līdz sareždžītam interneta veikalam.</p>             
             </div>                        
         </div> -->
    </div>
</div>