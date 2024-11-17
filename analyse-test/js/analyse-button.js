jQuery(document).ready(function($) {
    $('.plugin-card').each(function() {
        // $(this).css({
        //     'color': 'crimson',
        //     'border-color': 'crimson'
        // });
        var pluginSlug = $(this).find('.install-now').data('slug');
        if (!$(this).find('.analyse-plugin-button').length) {
            $(this).find('.plugin-action-buttons').prepend('<li><button class="button analyse-plugin-button" data-slug="' + pluginSlug + '">Analyze the plugin</button></li>');
        }
    });
    $('.analyse-plugin-button').on('click', function() {
        var pluginSlug = $(this).data('slug');
        var urlAPIWordpress = "https://api.wordpress.org/plugins/info/1.0/" + pluginSlug + ".json";
        $.ajax({
            url: urlAPIWordpress,
            method: 'GET',
            success: function(response) {
                $.ajax({
                    url: analysePlugin.ajax_url,
                    method: 'POST',
                    // data: {
                    //     action: 'save_plugin_info',
                    //     slug_version: response.name + " v" + response.version,
                    //     author_profile: response.author,
                    //     rating: response.rating,
                    //     num_ratings: response.num_ratings,
                    //     ratio_threads: response.support_threads_resolved / response.support_threads,
                    //     downloaded: response.downloaded,
                    //     last_updated: response.last_updated,
                    //     added: response.added,
                    //     homepage: response.homepage
                    // },
                    success: function() {
                        alert("Analysis complete.");
                    },
                    error: function() {
                        alert("Error saving plugin data.");
                    }
                });
            },
            error: function() {
                alert("Error fetching plugin data.");
            }
        });
    });
});