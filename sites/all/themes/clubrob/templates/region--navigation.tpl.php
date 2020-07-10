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
    <nav id="navigation" role="navigation" class="yamm">
        <div class="container <?php print $classes; ?>">
            <?php print $content; ?>
        </div>
    </nav>
<?php endif; ?>