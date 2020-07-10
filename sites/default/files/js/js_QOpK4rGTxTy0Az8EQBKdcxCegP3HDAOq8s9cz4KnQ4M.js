(function ($) {

Drupal.behaviors.textarea = {
  attach: function (context, settings) {
    $('.form-textarea-wrapper.resizable', context).once('textarea', function () {
      var staticOffset = null;
      var textarea = $(this).addClass('resizable-textarea').find('textarea');
      var grippie = $('<div class="grippie"></div>').mousedown(startDrag);

      grippie.insertAfter(textarea);

      function startDrag(e) {
        staticOffset = textarea.height() - e.pageY;
        textarea.css('opacity', 0.25);
        $(document).mousemove(performDrag).mouseup(endDrag);
        return false;
      }

      function performDrag(e) {
        textarea.height(Math.max(32, staticOffset + e.pageY) + 'px');
        return false;
      }

      function endDrag(e) {
        $(document).unbind('mousemove', performDrag).unbind('mouseup', endDrag);
        textarea.css('opacity', 1);
      }
    });
  }
};

})(jQuery);
;
(function ($) {

/**
 * Toggle the visibility of a fieldset using smooth animations.
 */
Drupal.toggleFieldset = function (fieldset) {
  var $fieldset = $(fieldset);
  if ($fieldset.is('.collapsed')) {
    var $content = $('> .fieldset-wrapper', fieldset).hide();
    $fieldset
      .removeClass('collapsed')
      .trigger({ type: 'collapsed', value: false })
      .find('> legend span.fieldset-legend-prefix').html(Drupal.t('Hide'));
    $content.slideDown({
      duration: 'fast',
      easing: 'linear',
      complete: function () {
        Drupal.collapseScrollIntoView(fieldset);
        fieldset.animating = false;
      },
      step: function () {
        // Scroll the fieldset into view.
        Drupal.collapseScrollIntoView(fieldset);
      }
    });
  }
  else {
    $fieldset.trigger({ type: 'collapsed', value: true });
    $('> .fieldset-wrapper', fieldset).slideUp('fast', function () {
      $fieldset
        .addClass('collapsed')
        .find('> legend span.fieldset-legend-prefix').html(Drupal.t('Show'));
      fieldset.animating = false;
    });
  }
};

/**
 * Scroll a given fieldset into view as much as possible.
 */
Drupal.collapseScrollIntoView = function (node) {
  var h = document.documentElement.clientHeight || document.body.clientHeight || 0;
  var offset = document.documentElement.scrollTop || document.body.scrollTop || 0;
  var posY = $(node).offset().top;
  var fudge = 55;
  if (posY + node.offsetHeight + fudge > h + offset) {
    if (node.offsetHeight > h) {
      window.scrollTo(0, posY);
    }
    else {
      window.scrollTo(0, posY + node.offsetHeight - h + fudge);
    }
  }
};

Drupal.behaviors.collapse = {
  attach: function (context, settings) {
    $('fieldset.collapsible', context).once('collapse', function () {
      var $fieldset = $(this);
      // Expand fieldset if there are errors inside, or if it contains an
      // element that is targeted by the URI fragment identifier.
      var anchor = location.hash && location.hash != '#' ? ', ' + location.hash : '';
      if ($fieldset.find('.error' + anchor).length) {
        $fieldset.removeClass('collapsed');
      }

      var summary = $('<span class="summary"></span>');
      $fieldset.
        bind('summaryUpdated', function () {
          var text = $.trim($fieldset.drupalGetSummary());
          summary.html(text ? ' (' + text + ')' : '');
        })
        .trigger('summaryUpdated');

      // Turn the legend into a clickable link, but retain span.fieldset-legend
      // for CSS positioning.
      var $legend = $('> legend .fieldset-legend', this);

      $('<span class="fieldset-legend-prefix element-invisible"></span>')
        .append($fieldset.hasClass('collapsed') ? Drupal.t('Show') : Drupal.t('Hide'))
        .prependTo($legend)
        .after(' ');

      // .wrapInner() does not retain bound events.
      var $link = $('<a class="fieldset-title" href="#"></a>')
        .prepend($legend.contents())
        .appendTo($legend)
        .click(function () {
          var fieldset = $fieldset.get(0);
          // Don't animate multiple times.
          if (!fieldset.animating) {
            fieldset.animating = true;
            Drupal.toggleFieldset(fieldset);
          }
          return false;
        });

      $legend.append(summary);
    });
  }
};

})(jQuery);
;
/**
 * @file
 * Behaviors and utility functions for administrative pages.
 *
 * @author Jim Berry ("solotandem", http://drupal.org/user/240748)
 */

(function ($) {

/**
 * Provides summary information for the vertical tabs.
 */
Drupal.behaviors.gtmInsertionSettings = {
  attach: function (context) {
    if (typeof jQuery.fn.drupalSetSummary == 'undefined') {
      // This behavior only applies if drupalSetSummary is defined.
      return;
    }

    $('fieldset#edit-path', context).drupalSetSummary(function (context) {
      var $radio = $('input[name="google_tag_path_toggle"]:checked', context);
      if ($radio.val() == 'exclude listed') {
        if (!$('textarea[name="google_tag_path_list"]', context).val()) {
          return Drupal.t('All paths');
        }
        else {
          return Drupal.t('All paths except listed paths');
        }
      }
      else {
        if (!$('textarea[name="google_tag_path_list"]', context).val()) {
          return Drupal.t('No paths');
        }
        else {
          return Drupal.t('Only listed paths');
        }
      }
    });

    $('fieldset#edit-role', context).drupalSetSummary(function (context) {
      var vals = [];
      $('input[type="checkbox"]:checked', context).each(function () {
        vals.push($.trim($(this).next('label').text()));
      });
      var $radio = $('input[name="google_tag_role_toggle"]:checked', context);
      if ($radio.val() == 'exclude listed') {
        if (!vals.length) {
          return Drupal.t('All roles');
        }
        else {
          return Drupal.t('All roles except selected roles');
        }
      }
      else {
        if (!vals.length) {
          return Drupal.t('No roles');
        }
        else {
          return Drupal.t('Only selected roles');
        }
      }
    });

    $('fieldset#edit-status', context).drupalSetSummary(function (context) {
      var $radio = $('input[name="google_tag_status_toggle"]:checked', context);
      if ($radio.val() == 'exclude listed') {
        if (!$('textarea[name="google_tag_status_list"]', context).val()) {
          return Drupal.t('All statuses');
        }
        else {
          return Drupal.t('All statuses except listed statuses');
        }
      }
      else {
        if (!$('textarea[name="google_tag_status_list"]', context).val()) {
          return Drupal.t('No statuses');
        }
        else {
          return Drupal.t('Only listed statuses');
        }
      }
    });
  }
};

})(jQuery);
;
