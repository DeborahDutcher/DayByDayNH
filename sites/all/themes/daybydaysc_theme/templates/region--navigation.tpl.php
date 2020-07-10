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
                    <a href="/" class="navbar-brand"><img src="/sites/all/themes/daybydaysc_theme/images/logo_sm.png" alt="<?php print $site_name; ?>" /></a>
                </div>
                <div class="navbar-collapse collapse">
                    <button class="form-submit btn btn-primary btn-sm btn-toggle"><span class="glyphicon glyphicon-search"></span></button>
                    <?php print $content; ?>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="/" class="dropdown-toggle" data-toggle="dropdown">Months<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/january">January - Health & Safety</a>
                                </li>
                                <li>
                                    <a href="/february">February - Colors</a>
                                </li>
                                <li>
                                    <a href="/march">March - Seasons</a>
                                </li>
                                <li>
                                    <a href="/april">April - Reading</a>
                                </li>
                                <li>
                                    <a href="/may">May - Animals</a>
                                </li>
                                <li>
                                    <a href="/june">June - Food</a>
                                </li>
                                <li>
                                    <a href="/july">July - Music</a>
                                </li>
                                <li>
                                    <a href="/august">August - Imagination</a>
                                </li>
                                <li>
                                    <a href="/september">September - Letters</a>
                                </li>
                                <li>
                                    <a href="/october">October - Numbers</a>
                                </li>
                                <li>
                                    <a href="/november">November - Family</a>
                                </li>
                                <li>
                                    <a href="/december">December - Friends</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="/lets-get-crafty" class="dropdown-toggle">Arts & Crafts</a>
                        </li>
                        <li class="dropdown">
                            <a href="/be-clean-and-well" class="dropdown-toggle">Be Healthy</a>
                        </li>
                        <li class="dropdown">
                            <a href="/places-in-sc" class="dropdown-toggle">Places in SC</a>
                        </li>
                        <li class="dropdown">
                            <a href="/read-with-me" class="dropdown-toggle">Read with Me</a>
                        </li>
<li class="dropdown">
                            <a href="/everyday-literacy-toolkit" class="dropdown-toggle">Literacy Toolkit</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<?php endif; ?>