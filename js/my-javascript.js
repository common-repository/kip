//jQuery(document).ready(function(){ jQuery('.hoverit').hoverZoom({speedView:100, speedRemove:400, showCaption:false, debug:true, hoverIntent: true, loadingIndicatorPos: 'center'}); });

jQuery(document).ready(function() {
   jQuery(".fancybox").fancybox();

//   jQuery('.text-wrap').focus(function() {
//      if (jQuery(this).val()==jQuery(this).attr("title")) { jQuery(this).val(""); }
//    }).blur(function() {
//      if (jQuery(this).val()=="") { jQuery(this).val($(this).attr("title")); }
//    });
   });

jQuery('.single-approve').live('click', function(e){
   e.preventDefault();
   if (true) {
      var objId = jQuery(this).parent().find('input[name=object_id]').val();
      var single = jQuery(this);

      jQuery.ajax({
         type : 'post',
         url: ccfAjax.url,
         data: {
            object_id : objId,
            action : 'ccf-ajax',
            type_action : 'approve-pending',
            nonce: ccfLang.nonce
         },
         success : function() {
            single.closest('tr').remove();
         }
      });
   }
   return false;
});

jQuery('.save-q').live('click', function(e){
   e.preventDefault();
   if (true) {
      var objId = jQuery(this).parent().parent().find('input[name=object_id]').val();
      var single = jQuery(this);

      var answer = jQuery(single).closest('tr').find('textarea[name=answer_text]').val();
      var source = jQuery(single).closest('tr').find('select[name=info_source]').val();

      jQuery.ajax({
         type : 'post',
         url: ccfAjax.url,
         data: {
            object_id : objId,
            answer : answer,
            source : source,
            action : 'ccf-ajax',
            type_action : 'save-q',
            nonce: ccfLang.nonce
         },
         success : function() {
            single.closest('tr').remove();
         }
      });

   }
   return false;
});

jQuery('.publish-q').live('click', function(e){
   e.preventDefault();
   if (true) {
      var objId = jQuery(this).parent().parent().find('input[name=object_id]').val();
      var single = jQuery(this);

      var answer = jQuery(single).closest('tr').find('textarea[name=answer_text]').val();
      var source = jQuery(single).closest('tr').find('select[name=info_source]').val();

      jQuery.ajax({
         type : 'post',
         url: ccfAjax.url,
         data: {
            object_id : objId,
            answer : answer,
            source : source,
            action : 'ccf-ajax',
            type_action : 'publish-q',
            nonce: ccfLang.nonce
         },
         success : function() {
            single.closest('tr').remove();
         }
      });

   }
   return false;
});

jQuery('.delete-q').live('click', function(e){
   e.preventDefault();
   if (true) {
      var objId = jQuery(this).parent().parent().find('input[name=object_id]').val();
      var single = jQuery(this);

      var answer = jQuery(single).closest('tr').find('textarea[name=answer_text]').val();

      jQuery.ajax({
         type : 'post',
         url: ccfAjax.url,
         data: {
            object_id : objId,
            answer : answer,
            action : 'ccf-ajax',
            type_action : 'delete-q',
            nonce: ccfLang.nonce
         },
         success : function() {
            single.closest('tr').remove();
         }
      });

   }
   return false;
});

jQuery('.topending-a').live('click', function(e){
   e.preventDefault();
   if (true) {
      var objId = jQuery(this).parent().parent().find('input[name=object_id]').val();
      var single = jQuery(this);

      jQuery.ajax({
         type : 'post',
         url: ccfAjax.url,
         data: {
            object_id : objId,
            action : 'ccf-ajax',
            type_action : 'topending-a',
            nonce: ccfLang.nonce
         },
         success : function() {
            single.closest('tr').remove();
         }
      });

   }
   return false;
});

jQuery('.updateans-a').live('click', function(e){
   e.preventDefault();
   if (true) {
      var objId = jQuery(this).parent().parent().find('input[name=object_id]').val();
      var single = jQuery(this);

      var answer = jQuery(single).closest('tr').find('textarea[name=answer_text]').val();
      var source = jQuery(single).closest('tr').find('select[name=info_source]').val();

      jQuery.ajax({
         type : 'post',
         url: ccfAjax.url,
         data: {
            object_id : objId,
            answer : answer,
            source : source,
            action : 'ccf-ajax',
            type_action : 'updateans-a',
            nonce: ccfLang.nonce
         },
         success : function() {
            location.reload();
         }
      });

   }
   return false;
});

jQuery('.unpublished-a').live('click', function(e){
   e.preventDefault();
   if (true) {
      var objId = jQuery(this).parent().parent().find('input[name=object_id]').val();
      var single = jQuery(this);

      jQuery.ajax({
         type : 'post',
         url: ccfAjax.url,
         data: {
            object_id : objId,
            action : 'ccf-ajax',
            type_action : 'unpublished-a',
            nonce: ccfLang.nonce
         },
         success : function() {
            location.reload();
         }
      });

   }
   return false;
});

jQuery('.publish-a').live('click', function(e){
   e.preventDefault();
   if (true) {
      var objId = jQuery(this).parent().parent().find('input[name=object_id]').val();
      var single = jQuery(this);

      jQuery.ajax({
         type : 'post',
         url: ccfAjax.url,
         data: {
            object_id : objId,
            action : 'ccf-ajax',
            type_action : 'publish-a',
            nonce: ccfLang.nonce
         },
         success : function() {
            location.reload();
         }
      });

   }
   return false;
});

jQuery('.js-set-sub').live('click', function(e){
      e.preventDefault();
      if (true) {
         var userId = jQuery(this).parent().parent().find('input[name=user_id]').val();
         var single = jQuery(this);

         jQuery.ajax({
            type : 'post',
            url: ccfAjax.url,
            data: {
               user_id : userId,
               action : 'ccf-ajax',
               type_action : 'set-sub',
               nonce: ccfLang.nonce
            },
            success : function() {
               location.reload();
            }
         });

      }
      return false;
   });

jQuery('.js-set-ppid').live('click', function(e){
    e.preventDefault();
    if (true) {
       var userId = jQuery(this).parent().parent().find('input[name=user_id]').val();
       var single = jQuery(this);

       jQuery.ajax({
          type : 'post',
          url: ccfAjax.url,
          data: {
             user_id : userId,
             action : 'ccf-ajax',
             type_action : 'set-ppid',
             nonce: ccfLang.nonce
          },
          success : function() {
             location.reload();
          }
       });

    }
    return false;
 });

jQuery('.js-del-user').live('click', function(e){
    e.preventDefault();
   var r=confirm("Apakah Anda yakin akan menghapus pengguna ini ?");
   if (r==true)
     {
       var userId = jQuery(this).parent().parent().find('input[name=user_id]').val();
       var single = jQuery(this);

       jQuery.ajax({
          type : 'post',
          url: ccfAjax.url,
          data: {
             user_id : userId,
             action : 'ccf-ajax',
             type_action : 'del-user',
             nonce: ccfLang.nonce
          },
          success : function() {
             location.reload();
          }
       });
     }
   else
     {
//     x="You pressed Cancel!";
    }

    return false;
 });




jQuery('.fix-user-close').live('click', function() {
   jQuery(this).closest('#ccf-form-success').hide();
});

jQuery('.fix-user-show').live('click', function() {
   var uid = jQuery(this).attr('id').replace('show-', '');
   jQuery('.fix-user-' + uid).show();
});