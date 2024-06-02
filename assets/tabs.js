// $(document).ready(function (){
//     $('.tab-link').on("click", function() {
//
//         var tabID = $(this).attr('data-tab');
//
//         $(this).addClass('active').siblings().removeClass('active');
//
//         $('#tab-'+tabID).addClass('active').siblings().removeClass('active');
//     });
//     $('.sub-tab-link').on("click", function() {
//
//         var tabID = $(this).attr('data-sub-tab');
//
//         $(this).addClass('active').siblings().removeClass('active');
//
//         $('#sub-tab-'+tabID).addClass('active').siblings().removeClass('active');
//     });
//
// });

// $(document).ready(function() {
//     // Get the tab ID from the URL
//     var tabIdFromUrl = window.location.hash;
//
//     // Activate the tab based on the tab ID from the URL
//     if(tabIdFromUrl) {
//         $('.tab-link[href="' + tabIdFromUrl + '"]').addClass('active');
//         $(tabIdFromUrl).addClass('active');
//     } else {
//         // If no tab ID provided in the URL, activate the first tab
//         $('.tab-link:first').addClass('active');
//         $('.tab-content:first').addClass('active');
//     }
//
//     // Tab click event
//     $('.tab-link').click(function(e) {
//         e.preventDefault();
//
//         // Remove active class from all tabs and tab content
//         $('.tab-link').removeClass('active');
//         $('.tab-content').removeClass('active');
//
//         // Add active class to the clicked tab and corresponding tab content
//         $(this).addClass('active');
//         $($(this).attr('href')).addClass('active');
//     });
//     $('.sub-tab-link:first').addClass('active');
//     $('.sub-tab-content:first').addClass('active');
//
//     $('.sub-tab-link').on("click", function() {
//         var tabID = $(this).attr('data-sub-tab');
//
//         $(this).addClass('active').siblings().removeClass('active');
//
//         $('#sub-tab-'+tabID).addClass('active').siblings().removeClass('active');
//     });
// });

$(document).ready(function() {
    // Function to activate a tab
    function activateTab(tabId) {
        // Remove active class from all tabs and tab content
        $('.tab-link, .menu-item a').removeClass('active');
        $('.tab-content').removeClass('active');

        // Add active class to the selected tab and corresponding tab content
        $('.tab-link[href="#' + tabId + '"], .menu-item a[href$="#' + tabId + '"]').addClass('active');
        $('#' + tabId).addClass('active');

        // Scroll to the position 300px before the start of the tab content
        $('html, body').animate({
            scrollTop: $('#' + tabId).offset().top - $('nav').outerHeight() - 300
        }, 500);

    }

    // Function to get tab ID from URL
    function getTabIdFromUrl() {
        var hash = window.location.hash;
        return hash ? hash.substring(1) : null;
    }

    // Activate the tab based on the tab ID from the URL or default to the first tab
    var tabIdFromUrl = getTabIdFromUrl();
    if (tabIdFromUrl && $('#' + tabIdFromUrl).length) {
        activateTab(tabIdFromUrl);
    } else {
        var firstTabId = $('.tab-link').first().attr('href').substring(1);
        activateTab(firstTabId);
    }

    // Tab click event
    $('.tab-link').click(function(e) {
        e.preventDefault();

        // Extract the hash part of the link
        var tabId = this.href.split('#')[1];

        // Activate the clicked tab
        activateTab(tabId);

        // Update the URL hash without adding new history entries
        history.replaceState(null, null, '#' + tabId);
    });
    $('.menu-item a').click(function(e) {
        // Extract the hash part of the link
        var tabId = this.href.split('#')[1];

        // Activate the clicked tab
        activateTab(tabId);

        // Update the URL hash without adding new history entries
        history.replaceState(null, null, '#' + tabId);
    });

    $('.sub-tab-link:first').addClass('active');
    $('.sub-tab-content:first').addClass('active');

    $('.sub-tab-link').on("click", function() {
        var tabID = $(this).attr('data-sub-tab');

        $(this).addClass('active').siblings().removeClass('active');

        $('#sub-tab-'+tabID).addClass('active').siblings().removeClass('active');
    });
});

