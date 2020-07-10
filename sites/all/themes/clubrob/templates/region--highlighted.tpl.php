<?php
/**
 * @file
 * Returns HTML for a region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728112
 */
?>
<?php
if ($content): ?>
  <div class="<?php print $classes; ?>">
    <?php print $content; ?>
  </div>
<?php endif;

/* ADD BOOTSTRAP CAROUSEL
if ($content): ?>
    <div id="myCarousel"class="carousel slide<?php print $classes; ?>" data-ride="carousel">
        <ol class="carousel-indicators">
            <li class="active" data-slide-to="0" data-target="#myCarousel"></li>
            <li data-slide-to="1" data-target="#myCarousel" class=""></li>
            <li data-slide-to="2" data-target="#myCarousel" class=""></li>
        </ol>
        <div class="carousel-inner">
            <?php print $content; ?>
        </div>
        <a data-slide="prev" role="button" href="#myCarousel" class="left carousel-control"><span class="glyphicon glyphicon-chevron-left"></span></a>
        <a data-slide="next" role="button" href="#myCarousel" class="right carousel-control"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
<?php endif; */ ?>