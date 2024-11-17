jQuery(document).ready(function ($) {
    // Loop through each plugin on the page
    $('.plugin-title strong').each(function () {
        const pluginName = $(this).text().trim(); // Get the plugin name
        
        // Check if the plugin name exists in our pluginData object
        if (pluginData[pluginName]) {
            const version = pluginData[pluginName]; // Get version from localized data
            
            // Append version information next to the plugin name
            // $(this).append(` <span class="plugin-version" style="color: #2e8b2d">v${version}</span>`);
            $(this).append(` <span class="plugin-version" style="color: #dba617">v${version}</span>`);
        }
    });
});
