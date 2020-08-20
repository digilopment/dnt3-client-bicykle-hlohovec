<!DOCTYPE html>
<!--[if IE 9]> 
<html lang="sk" class="ie9">
   <![endif]-->
<!--[if !IE]><!--> 
<html lang="<?php print($data['meta_settings']['keys']['language']['value']); ?>">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title><?php echo $data['title']; ?></title>
        <?php
        foreach ($data['meta'] as $meta) {
            echo $meta;
        }
        ?>
        <meta name="author" content="digilopment">
        <meta name="robots" content="index,follow" />
        <meta name="viewport" content="width=device-width" />
        <?php
        $favicon = $this->data['plugin_data']['favicon'];
        ?>
        <!-- Favicone Icon -->
        <link rel="" type="img/x-icon" href="<?php echo $favicon; ?>" />
        <link rel="" type="img/png" href="<?php echo $favicon; ?>" />
        <link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $favicon; ?>" />
        <!-- Web Fonts -->
        <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:400,300,700'>
        <!-- CSS Customization -->
        <link rel="stylesheet" href="<?php echo $data['media_path']; ?>css/bundle.css">
        <link rel="stylesheet" href="<?php echo $data['media_path']; ?>css/custom.css?<?php echo rand(10, 1000) ?>">
        <link rel="stylesheet" href="<?php echo $data['media_path']; ?>css/red.css?<?php echo rand(10, 1000) ?>">
        <link rel="stylesheet" href="<?php echo $data['media_path']; ?>css/eshop.css?<?php echo rand(10, 1000) ?>">
        <!-- Custom Fonts -->
        <?php /* <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
          <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
          <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'> */ ?>
        <!-- light box -->
        <script src="<?php echo $data['media_path']; ?>js/jquery.min.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/jquery.validate.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/additional-methods.min.js"></script>
        <script src="<?php echo $data['media_path']; ?>js/cookies.js"></script> <!-- Gem jQuery -->
    </head>