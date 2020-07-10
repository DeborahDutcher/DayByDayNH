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
        <div class="navbar navbar-default">
                <div class="container <?php print $classes; ?>">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed btn-primary" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="/" class="navbar-brand"><img src="/sites/all/themes/SUBTHEME/images/logo_sm.png" alt="<?php print $site_name; ?>" /></a>
                </div>
                <div class="navbar-collapse collapse">
                    <button class="form-submit btn btn-primary btn-sm btn-toggle"><span class="glyphicon glyphicon-search"></span></button>
                    <?php print $content; ?>
                    <ul class="nav navbar-nav">
                        <li class="dropdown yamm-fw">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="yamm-content container">
                                        <div class="col-xs-12 col-md-4">
                                            <h4></h4>
                                            <ul class="navgul"></ul>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <h4></h4>
                                            <ul class="navgul"></ul>
                                        </div>
                                        <div class="col-xs-12 col-md-4">
                                            <h4></h4>
                                            <div class="nav-feature"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<?php endif; ?>