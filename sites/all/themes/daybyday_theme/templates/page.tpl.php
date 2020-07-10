<?php
/**
 * @file
 * Returns the HTML for a single Drupal page.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728148
 */
?>
<a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>
<div id="page">
    <?php
        print render($page['header']);
        print render($page['navigation']);
    ?>
    <div class="sub-nav-wrap">
        <div id="highlighted" class="container-fluid">
            <?php print render($page['highlighted']); ?>
        </div>
        <div class="container">
            <?php
                // Render the sidebars to see if there's anything in them.
                $sidebar_first  = render($page['sidebar_first']);
                $sidebar_second = render($page['sidebar_second']);

                // Add column or float classes for #content and .sidebars
                if ($sidebar_first) {
                    $sidebar_content_class = "col-xs-12 col-md-8 pull-right";
                    $sidebar_sidebar_class = "pull-left";
                } elseif ($sidebar_second) {
                    $sidebar_content_class = "col-xs-12 col-md-8";
                    $sidebar_sidebar_class = "";
                } else {
                    $sidebar_content_class = "";
                    $sidebar_sidebar_class = "";
                }
            ?>

            <div id="content" class="column <?php print $sidebar_content_class; ?>" role="main">
                <?php if ($title): ?>
                    <h1 class="page__title title" id="page-title"><?php print $title; ?></h1>
                <?php endif; ?>

                <?php print $messages; ?>
                <?php print render($tabs); ?>
                <?php print render($page['help']); ?>
                <?php if ($action_links): ?>
                    <ul class="action-links"><?php print render($action_links); ?></ul>
                <?php endif; ?>
                <?php print render($page['content']); ?>
            </div>

            <?php if ($sidebar_first || $sidebar_second): ?>
                <aside class="sidebars col-xs-12 col-md-4 <?php print $sidebar_sidebar_class; ?>">
                <?php print $sidebar_first; ?>

                <?php print $sidebar_second; ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</div>
    <?php print render($page['footer']); ?>
    <?php print render($page['bottom']); ?>
