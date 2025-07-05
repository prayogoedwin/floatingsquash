
    jQuery(document).ready(function($) {
        
        function setActiveMenuWP() {
        var currentPath = window.location.pathname.replace(/\/$/, "");
        
        $('.floatingsquash-item[href]').each(function() {
            var menuPath = $(this).attr('href').split('?')[0];
            menuPath = menuPath.replace(window.location.origin, '').replace(/\/$/, "");
            
            if (currentPath === menuPath) {
                $(this).addClass('active-menu');
            }
        });
    }

    setActiveMenuWP();
    
        // Toggle share popup
        $(".floatingsquash-share-trigger").on("click", function() {
            $(".floatingsquash-share-popup").fadeIn();
        });
        
        // Close share popup
        $(".floatingsquash-close-share").on("click", function() {
            $(".floatingsquash-share-popup").fadeOut();
        });
        
        // Close when clicking outside
        $(document).on("click", function(e) {
            if (!$(e.target).closest(".floatingsquash-share-popup, .floatingsquash-share-trigger").length) {
                $(".floatingsquash-share-popup").fadeOut();
            }
        });
    });
    