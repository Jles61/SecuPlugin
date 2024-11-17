<?php
// Function to add custom menu in wp-admin
function analyse_plugin_add_menu() {
    add_menu_page(
        'Analyse Plugins',
        'Analyse Plugins',
        'manage_options',
        'plugin-analysis.php',
        'analyse_plugin_render_page',
        'dashicons-analytics',
        66
    );

    // Register new page for detailed plugin information
    add_submenu_page(
        null, // No menu item in admin sidebar
        'Plugin Details',
        'Plugin Details',
        'manage_options',
        'plugin-details',
        'analyse_plugin_render_details_page'
    );
}

// Function to enqueue scripts
function analyse_plugin_enqueue_script($hook_suffix) {
    if ($hook_suffix === 'plugin-install.php') {
        wp_enqueue_script(
            'analyse-plugin-script',                                // Script handle
            plugin_dir_url(__FILE__) . '../js/analyse-button.js',   // Script URL
            array('jquery'),                                        // Dependencies
            '1.0',                                                  // Version
            true                                                    // Load in the footer
        );
        
        wp_localize_script('analyse-plugin-script', 'analysePlugin', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }
    else if ($hook_suffix === 'plugins.php') {
        wp_enqueue_script(
            'analyse-plugin-script',                                // Script handle
            plugin_dir_url(__FILE__) . '../js/analyse-button-v2.js',   // Script URL
            array('jquery'),                                        // Dependencies
            '1.0',                                                  // Version
            true                                                    // Load in the footer
        );
        
        wp_localize_script('analyse-plugin-script', 'analysePlugin', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }
}






function get_plugin_versions() {
    $plugins = get_plugins(); // Get all installed plugins
    $plugin_versions = array();

    foreach ($plugins as $plugin_path => $plugin_data) {
        $plugin_versions[$plugin_data['Name']] = $plugin_data['Version'];
    }

    // Print plugin versions
    // echo '<pre>';
    // print_r($plugin_versions);
    // echo '</pre>';

    // Localize the script with plugin data
    wp_localize_script('plugin-version-script', 'pluginData', $plugin_versions);
}

function enqueue_version_script($hook) {
    // Only load on plugins.php
    if ($hook !== 'plugins.php') {
        return;
    }

    // Enqueue your custom jQuery script
    wp_enqueue_script('plugin-version-script', plugin_dir_url(__FILE__) . '../js/plugin-versions.js', array('jquery'), null, true);

    // Call the function to load plugin versions
    get_plugin_versions();
}















// function my_plugin_assets() {
//     // wp_register_style( 'custom-gallery', plugins_url( '/css/gallery.css' , __FILE__ ) );

//     wp_localize_script('analyse-plugin-script-v2', 'analysePlugin', array(
//         'ajax_url' => admin_url('admin-ajax.php')
//     ));
//     wp_register_script( 'analyse-plugin-script-v2', plugins_url( '/js/analyse-plugin.js' , __FILE__ ) );

//     wp_enqueue_script( 'analyse-plugin-script-v2' );
// }

// Function to render plugin analysis page
function analyse_plugin_render_page() {
    include plugin_dir_path(__FILE__) . '../templates/plugin-analysis.php';
}

// Render the detailed page for a selected plugin
function analyse_plugin_render_details_page() {
    include plugin_dir_path(__FILE__) . '../templates/plugin-details.php';
}

?>
