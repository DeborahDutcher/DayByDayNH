<?php
/**
 * @file
 * Returns HTML for a region.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728112
 */
?>
<?php if ($content): ?>
    <header class="header" id="header" role="banner">
        <div class="container <?php print $classes; ?>">
            <?php print $content; ?>
        </div>
    </header>
<?php endif; ?>