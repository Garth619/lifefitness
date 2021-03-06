jQuery (function ($) {

  function b64e (str) {
    // first we use encodeURIComponent to get percent-encoded UTF-8,
    // then we convert the percent encodings into raw bytes which
    // can be fed into btoa.
    return btoa (encodeURIComponent (str).replace (/%([0-9A-F]{2})/g,
      function toSolidBytes (match, p1) {
        return String.fromCharCode ('0x' + p1);
    }));
  }

  function b64d (str) {
    // Going backwards: from bytestream, to percent-encoding, to original string.
    return decodeURIComponent (atob (str).split ('').map (function(c) {
      return '%' + ('00' + c.charCodeAt (0).toString (16)).slice (-2);
    }).join (''));
  }

  function getHostName (url) {
    var match = url.match (/:\/\/(.[^/:]+)/i);
    if (match != null && match.length > 1 && typeof match [1] === 'string' && match [1].length > 0) {
      return match [1];
    } else {
        return null;
      }
  }

  ai_process_lists = function () {
    var ai_debug = typeof ai_debugging !== 'undefined';
    var cookies  = document.cookie.split (";");
    var referrer = document.referrer;

    cookies.forEach (function (cookie, index) {
      cookies [index] = cookie.trim();
    });

    if (referrer != '') referrer = getHostName (referrer);

    var ai_list_blocks = $("div.ai-list-data");
    if (ai_list_blocks.length) {
      ai_list_blocks.each (function () {

        var enable_block = true;

        var found = false;

        var referer_list = $(this).attr ("referer-list");
        if (typeof referer_list != "undefined") {
          var referer_list_array  = b64d (referer_list).split (",");
          var referers_list_type  = $(this).attr ("referer-list-type");

          if (ai_debug) console.log ('');
          if (ai_debug) console.log ("AI LISTS referer:     ", referrer);
          if (ai_debug) console.log ("AI LISTS referer list:", b64d (referer_list), referers_list_type);

          $.each (referer_list_array, function (index, list_referer) {
            if (list_referer == '') return true;

            if (list_referer == '#') {
              if (referrer == "") {
                found = true;
                return false;
              }
            } else if (list_referer == referrer) {
                found = true;
                return false;
              }
          });

          switch (referers_list_type) {
            case "B":
              if (found) enable_block = false;
              break;
            case "W":
              if (!found) enable_block = false;
              break;
          }

          if (ai_debug) console.log ("AI LISTS list found", found);
          if (ai_debug) console.log ("AI LISTS list pass", enable_block);
        }

        if (enable_block) {
          var parameter_list = $(this).attr ("parameter-list");
          if (typeof parameter_list != "undefined") {
            var parameter_list_array = b64d (parameter_list).split (",");
            var parameter_list_type  = $(this).attr ("parameter-list-type");

            if (ai_debug) console.log ('');
            if (ai_debug) console.log ("AI LISTS cookies:       ", cookies);
            if (ai_debug) console.log ("AI LISTS parameter list:", b64d (parameter_list), parameter_list_type);

            var found = false;

            $.each (parameter_list_array, function (index, list_parameter) {

              if (list_parameter.indexOf ('=') != - 1) {
                if (cookies.indexOf (list_parameter) != - 1) {
                  found = true;
                  return false;
                }
              } else {
                  cookies.forEach (function (cookie) {
                    var cookie_data = cookie.split ("=");
                    if (list_parameter == cookie_data [0]) {
                      found = true;
                      return false;
                    }
                  });
                }
            });

            switch (parameter_list_type) {
              case "B":
                if (found) enable_block = false;
                break;
              case "W":
                if (!found) enable_block = false;
                break;
            }

            if (ai_debug) console.log ("AI LISTS list found", found);
            if (ai_debug) console.log ("AI LISTS list pass", enable_block);
          }
        }

        $(this).css ({"visibility": "", "position": "", "width": "", "height": "", "z-index": ""}).removeClass ('ai-list-data');
        var block_wrapping_div = $(this).closest ('div.ai-list-block');
//        block_wrapping_div.css ({"visibility": "", "position": "", "z-index": ""}).removeClass ('ai-list-block');
        block_wrapping_div.removeClass ('ai-list-block');
        block_wrapping_div.find ('.ai-debug-name.ai-list-info').text (referrer);
        block_wrapping_div.find ('.ai-debug-name.ai-list-status').text (enable_block ? 'VISIBLE' : 'HIDDEN');
        if (!enable_block) {
          $(this).hide ();
          block_wrapping_div.removeAttr ('data-ai');

          if (block_wrapping_div.find ('.ai-debug-block')) {
            block_wrapping_div.css ({"visibility": ""}).removeClass ('ai-close');
            if (block_wrapping_div.hasClass ('ai-remove-position')) {
              block_wrapping_div.css ({"position": ""});
            }
          } else block_wrapping_div.hide ();
        } else {
            block_wrapping_div.css ({"visibility": ""});
            if (block_wrapping_div.hasClass ('ai-remove-position')) {
              block_wrapping_div.css ({"position": ""});
            }

            if (typeof $(this).data ('code') != 'undefined') {
              var block_code = b64d ($(this).data ('code'));
              $(this).append (block_code);
              if (!ai_debug) $(this).attr ('data-code', '');

              if (typeof aiLazyLoading == 'function') {
                $("div.ai-lazy", this).each (function (index, element) {
                  aiLazyLoading ({
                    lazyClass: 'ai-lazy',
                    lazyElement: this.element,
                  });
                });
              }

              // Doesn't process inserted code for rotation - it will be called with setTimeout 5 ms later
            }
          }
      });
    }
  }

  $(document).ready(function($) {
    setTimeout (function() {ai_process_lists ();}, 5);
  });
});
