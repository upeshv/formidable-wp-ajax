/**
 * Plugin script file.
 * Below ajax call is made once we click on the refresh data button.
 */
jQuery(document).ready(function($) {
  jQuery(".get-ajax-data").on("click", function() {
    jQuery("#get-ajax-data").attr("disabled", true);

    jQuery.ajax({
      type: "get",
      contentType: "application/json",
      dataType: "json",
      url: ajax_initialize_script_frmwp.ajax_url,
      data: {
        action: "get_strategy_data", // Callback function
        security: ajax_initialize_script_frmwp.security // nonce
      },
      success: function(response) {
        // This message will display from AJAX callback function.
        if (response.type == "success") {
          jQuery(".show-content").html(response.data);
          jQuery("#get-ajax-data").attr("disabled", false);
        } else {
          console.warn(response);
        }
      },
      error: function(error) {
        console.warn(error);
      }
    });
  });
});
