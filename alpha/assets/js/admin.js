;(function ($) {
    $(document).ready(function () {
        $("#post-formats-select .post-format").on("click", function () {
            if ($(this).attr("id") == "post-format-audio") {
                $("#_alpha_image_information").show();
            } else {
                $("#_alpha_image_information").hide();
            }
        });

        if (alpha_pf.format != "audio") {
            $("#_alpha_image_information").hide();
        }else{
            $("#_alpha_image_information").show();
        }
    });
})(jQuery);