/**
 * Theme: Metrica - Responsive Bootstrap 4 Admin Dashboard
 * Author: Mannatthemes
 * Nastable Js
 */



!function($) {
  "use strict";

  var Nestable = function() {};

  Nestable.prototype.updateOutput = function (e) {
      var list = e.length ? e : $(e.target),
          output = list.data('output');
      if (window.JSON) {
          output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
      } else {
          output.val('JSON browser support required for this demo.');
      }
  },
  //init
  Nestable.prototype.init = function() {
      // activate Nestable for list 1
          $('.nestable_list').nestable({
              group: 1
          }).on('change', this.updateOutput);



        //   // output initial serialised data
        //   this.updateOutput($('#nestable_list_'+i).data('output', $('#nestable_list_'+i+'_output')));

        //   $('#nestable_list_menu').on('click', function (e) {
        //       var target = $(e.target),
        //           action = target.data('action');
        //       if (action === 'expand-all') {
        //           $('.dd').nestable('expandAll');
        //       }
        //       if (action === 'collapse-all') {
        //           $('.dd').nestable('collapseAll');
        //       }
        //   });
  },
  //init
  $.Nestable = new Nestable, $.Nestable.Constructor = Nestable
}(window.jQuery),

//initializing
function($) {
  "use strict";
  $.Nestable.init()
}(window.jQuery);