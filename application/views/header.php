<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>IS | Mājaslapas</title> 


        <link href="<?php echo base_url('css/style.css'); ?>" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url('css/jquery-ui.css'); ?>" rel="stylesheet">

    </head>
    <body>
        
          <header class="header">
          <div class="menu">
          <div class="menu-items">
          <div class="item <?php if ($selectedPage == "index") echo "selected-menu-item"; ?>" >
          <div class="item-box"><a class="menu-header" href="<?php echo base_url('homepage/index'); ?>">Par mums</a></div>
          </div>
          <div class="item <?php if ($selectedPage == "sercices") echo "selected-menu-item"; ?>">
          <div class="item-box"><a class="menu-header" href="<?php echo base_url('homepage/services'); ?>">Piedāvājums</a></div>
          </div>
          <div class="item <?php if ($selectedPage == "contact") echo "selected-menu-item"; ?>">
          <div class="item-box"><a class="menu-header" href="<?php echo base_url('homepage/contact'); ?>"></a>Kontakti</div>
          </div>
          <div class="item <?php if ($selectedPage == "perform") echo "selected-menu-item"; ?>">
          <div class="item-box"><a class="menu-header" href="<?php echo base_url('homepage/perform'); ?>"></a>Paveiktais</div>
          </div
          </div>
          </div>
          </header>
      <?php /*
        <header class="header"> 
            <div class="menu">
                <div class="menu-items">
                    <div class="item <?php if ($selectedPage == "index") echo "selected-menu-item"; ?>" >
                        <div class="item-box"><a class="menu-header" href="<?php echo base_url('homepage/index'); ?>">Tests</a></div>
                    </div>
                    <div class="item <?php if ($selectedPage == "sercices") echo "selected-menu-item"; ?>">
                        <div class="item-box"><a class="menu-header" href="<?php echo base_url('homepage/services'); ?>">Test</a></div>
                    </div>
                    <div class="item <?php if ($selectedPage == "contact") echo "selected-menu-item"; ?>">
                        <div class="item-box"><a class="menu-header" href="<?php echo base_url('homepage/contact'); ?>"></a>Test</div>
                    </div>
                    <div class="item <?php if ($selectedPage == "perform") echo "selected-menu-item"; ?>">
                        <div class="item-box"><a class="menu-header" href="<?php echo base_url('homepage/perform'); ?>"></a>tet</div>
                    </div
                </div>
            </div>
        </header> <?php */