<?php

/* REMOVE BEFORE PRODUCTION */
// Rebuild .info data.
system_rebuild_theme_data();
// Rebuild theme registry.
drupal_theme_rebuild();
/* END */

function clubrob_form_alter(&$form, &$form_state, $form_id) {
    if ($form_id == 'search_block_form') {
        $form['button'] = array
        (
            '#prefix' => '<button type="submit" id="edit-submit-btn" name="op" class="form-submit btn btn-primary btn-sm btn-submit">',
            '#suffix' => '</button>',
            '#markup' => '<span class="glyphicon glyphicon-search"></span>', // This line is required to force the element to render
            '#weight' => 1000,
        );
        $form['#attributes']['class'][] = 'form-inline';
        $form['search_block_form']['#title'] = t('Search'); // Change the text on the label element
        $form['search_block_form']['#title_display'] = 'invisible'; // Toggle label visibility
        $form['search_block_form']['#attributes']['class'][] = "form-control input-sm";
        $form['search_block_form']['#attributes']['placeholder'] = t('Search this site');
        $form['actions']['submit']['#value'] = t('Go!'); // Change the text on the submit button
        $form['actions']['submit']['#attributes']['alt'] = "Search Button"; //add alt tag
        $form['actions']['submit']['#attributes']['class'][] = "element-invisible"; //add Bootstrap button classes
    }
}

function clubrob_preprocess_html(&$variables, $hook) {
     $variables['base_path'] = base_path();
     $variables['path_to_clubrob'] = drupal_get_path('theme', 'clubrob');
}

function clubrob_preprocess_region(&$vars, $hook) {
     $vars['site_name'] = variable_get('site_name');
}

function clubrob_preprocess_block(&$vars) {
    // Make sure it's the right region
    if ($vars['block']->region === 'footer' || $vars['block']->region === 'bottom') {
        // Get the count of blocks
        $blocks = block_list($vars['block']->region);

        $count = count($blocks);

        // Add the class if necessary
        switch ($count) {
            case 1:
                $vars['classes_array'][] = 'col-xs-12';
                break;
            case 2:
                $vars['classes_array'][] = 'col-xs-12 col-md-6';
                break;
            case 3:
                $vars['classes_array'][] = 'col-xs-12 col-md-4';
                break;
            case 4:
                $vars['classes_array'][] = 'col-xs-12 col-md-3';
                break;
        }
    }

    if ($vars['block']->region === 'highlighted') {
        $vars['classes_array'][] = 'item';
    }
}

function clubrob_preprocess_node(&$vars, $hook) {
    $vars['unpublished'] = (!$vars['status']) ? TRUE : FALSE;
    $vars['content']['links']['node']['#links']['node-readmore']['attributes'] = array('class' => 'btn btn-primary pull-right');

    if($vars['is_front']) {
        $vars['submitted'] = date("l, M jS, Y", $vars['created']);
    } else {
        $vars['submitted'] = 'Posted by '. $vars['name']. ', '. date("l, M jS, Y", $vars['created']);
    }
}

function clubrob_pager($variables) {
    $tags = $variables['tags'];
    $element = $variables['element'];
    $parameters = $variables['parameters'];
    $quantity = $variables['quantity'];
    global $pager_page_array, $pager_total;

    // Calculate various markers within this pager piece:
    // Middle is used to "center" pages around the current page.
    $pager_middle = ceil($quantity / 2);
    // current is the page we are currently paged to
    $pager_current = $pager_page_array[$element] + 1;
    // first is the first page listed by this pager piece (re quantity)
    $pager_first = $pager_current - $pager_middle + 1;
    // last is the last page listed by this pager piece (re quantity)
    $pager_last = $pager_current + $quantity - $pager_middle;
    // max is the maximum page number
    $pager_max = $pager_total[$element];
    // End of marker calculations.

    // Prepare for generation loop.
    $i = $pager_first;
    if ($pager_last > $pager_max) {
        // Adjust "center" if at end of query.
        $i = $i + ($pager_max - $pager_last);
        $pager_last = $pager_max;
    }
    if ($i <= 0) {
        // Adjust "center" if at start of query.
        $pager_last = $pager_last + (1 - $i);
        $i = 1;
    }
    // End of generation loop preparation.

    $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
    $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));

    if ($pager_total[$element] > 1) {

        if ($li_previous) {
          $items[] = array(
            'class' => array('pager-previous'),
            'data' => $li_previous,
          );
        }

        // When there is more than one page, create the pager list.
        if ($i != $pager_max) {
          // Now generate the actual pager piece.
          for (; $i <= $pager_last && $i <= $pager_max; $i++) {
            if ($i < $pager_current) {
              $items[] = array(
                'class' => array('pager-item'),
                'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
              );
            }
            if ($i == $pager_current) {
              $items[] = array(
                'class' => array('pager-current active'),
                'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($pager_current), 'parameters' => $parameters)),
              );
            }
            if ($i > $pager_current) {
              $items[] = array(
                'class' => array('pager-item'),
                'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
              );
            }
          }
        }
        // End generation.
        if ($li_next) {
          $items[] = array(
            'class' => array('pager-next'),
            'data' => $li_next,
          );
        }
        return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
          'items' => $items,
          'attributes' => array('class' => array('pagination')),
        ));
    }
}