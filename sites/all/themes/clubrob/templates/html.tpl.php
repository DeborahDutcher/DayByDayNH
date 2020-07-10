<?php
/**
 * @file
 * Returns the HTML for the basic html structure of a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728208
 */
?><!DOCTYPE html>
<!--[if IEMobile 7]><html class="iem7"><![endif]-->
<!--[if lte IE 6]><html class="lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&(!IEMobile)]><html class="lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="lt-ie9"><![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)]><!--><html <?php print $rdf_namespaces; ?>><!--<![endif]-->

<head>
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="cleartype" content="on">
    <link href='http://fonts.googleapis.com/css?family=Oswald:300,400,700' rel='stylesheet' type='text/css'>
    <?php print $styles; ?>
    <?php print $scripts; ?>
    <!--[if lte IE 8]>
        <script src="<?php print $base_path . $path_to_clubrob; ?>/js/modernizr.js" type="text/javascript"></script>
        <script src="<?php print $base_path . $path_to_clubrob; ?>/js/respond.min.js" type="text/javascript"></script>
    <![endif]-->
</head>

<body class="<?php print $classes; ?>" <?php print $attributes;?>>
    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>

    <script src="<?php print $base_path . $path_to_clubrob; ?>/js/bootstrap.min.js"></script>
    <script src="<?php print $base_path . $path_to_clubrob; ?>/js/scripts.js" type="text/javascript"></script>
</body>
</html>
