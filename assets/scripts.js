/* eslint-disable no-unused-vars */
(function($){

  var orderingProcess = {

    contentBox: $(".dash-content-box"),

    programs:$(".program-item"),

    notice:[],

    init : function(){
      $(document).ready(function () {
        orderingProcess.update_state( {
          update_state:"add_new_user_to_courser",
          user_id:12
        } );
      });
      this.contentBox.on("click", function(){
        orderingProcess.update_state( {
          update_state:"add_new_user_to_courser",
          user_id:12
        } );
      });
    },

    update_state:function(currentData){
      $.ajax({
        type: "POST",
        url: window.ccop.ajax_url,
        data:{
          action:"ccop_update_state",
          data: currentData,
          nonce:window.ccop.nonce
        },
        dataType: "json",
        success: function (response) {
          console.log("success Result: ", response);
        //   orderingProcess.notice.push({ update_cart_response:response });
        //   orderingProcess.update_cart_html(response.current_cart);
        //   orderingProcess.update_total(response.total_bundle_price);
        //   orderingProcess.update_total_discount(response.total_bundle_discount);
        },
        beforeSend:function(){
          orderingProcess.block_content_box();
          console.log("Before Send", $(".dash-content-box") );
        },
        complete:function(){
          orderingProcess.unblock_content_box();
          console.log("complete after request, notice");
        },
        fail:function(res){
          console.log("Failed Response: ", res);
        },
        error: function(res){
          console.log("Error Response: ", res);
        }
      });            
    },

    block_content_box: function(){
      orderingProcess.block( $(".dash-content-box") );
    },
    unblock_content_box: function(){
      orderingProcess.unblock($(".dash-content-box"));
    },
    block: function( $node ) {
      if ( ! orderingProcess.is_blocked( $node ) ) {
        $node.addClass( 'processing' ).block( {
          message: null,
          overlayCSS: {
            background: '#fff',
            opacity: 0.6
          }
        } );
      }
    },

    unblock: function( $node ) {
      $node.removeClass( 'processing' ).unblock();
    },
    is_blocked: function( $node ) {
      return $node.is( '.processing' ) || $node.parents( '.processing' ).length;
    }
  }

  orderingProcess.init();

})(jQuery)