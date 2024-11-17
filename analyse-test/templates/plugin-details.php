<?php
if (!isset($_GET['plugin_id']) || !current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}

global $wpdb;
$plugin_id = intval($_GET['plugin_id']);
$plugin_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM `wp_plugin_analysis` WHERE id = %d", $plugin_id), ARRAY_A);

if (!$plugin_data) {
    echo '<div class="wrap"><h1>Plugin Not Found</h1><p>The plugin you are looking for does not exist.</p></div>';
    return;
}

// Display plugin details
?>
<div class="plugin-info-container">
    <div class="plugin-header">
        <img src="<?php echo esc_html($plugin_data['icon']); ?>" class="details-icon" alt="Plugin Icon">
        <h1>Details for <?php echo esc_html($plugin_data['slug_version']); ?></h1>
        <hr>
        <p>Analyzed On: <?php echo esc_html($plugin_data['created_at']); ?></p>
    </div>
    <div class="plugin-info">
        <div class="wrap left">
            <h2>Who Is Information</h2>
            <p><strong>Email Owner:</strong> <?php echo esc_html($plugin_data['whois_owner_email']); ?></p>
            <p><strong>Owner Country:</strong> <?php echo esc_html($plugin_data['whois_owner_country']); ?></p>
            <p><strong>Creation Date:</strong> <?php echo esc_html($plugin_data['whois_creation_date']); ?></p>
            <p><strong>Expiration Date:</strong> <?php echo esc_html($plugin_data['whois_expiration_date']); ?></p>
            <p><strong>Data Anonymization:</strong> <?php echo esc_html($plugin_data['whois_data_anonymization']); ?></p>
            <hr>

            <h2>Have I Been Pwned (IHBP) Information</h2>
            <p><strong>Email List:</strong> <?php echo esc_html(implode(', ', json_decode($plugin_data['email_list'], true))); ?></p>
            <p><strong>Number of Leaks:</strong> <?php echo esc_html($plugin_data['password_leaks_count']); ?></p>
        </div>

        <div class="wrap right">
            <h2>Plugin WordPress Information</h2>
            <p><strong>Author Name:</strong> <?php echo esc_html($plugin_data['author_name']); ?></p>
            <p><strong>Contributors:</strong> <?php echo esc_html(implode(', ', json_decode($plugin_data['contributors'], true))); ?></p>
            <p><strong>Creation Date:</strong> <?php echo esc_html($plugin_data['wp_creation_date']); ?></p>
            <p><strong>Rating:</strong> <?php echo esc_html($plugin_data['wp_rating']); ?> / 100</p>
            <p><strong>Number of Ratings:</strong> <?php echo esc_html($plugin_data['wp_rating_count']); ?></p>
            <p><strong>Download Link:</strong> <a href="<?php echo esc_url($plugin_data['wp_download_link']); ?>" target="_blank"><?php echo esc_html($plugin_data['wp_download_link']); ?></a></p>
            <p><strong>Domain:</strong> <?php echo esc_html($plugin_data['wp_domain']); ?></p>
            <p><strong>Git Link:</strong> <a href="<?php echo esc_url($plugin_data['wp_git_repository']); ?>" target="_blank"><?php echo esc_html($plugin_data['wp_git_repository']); ?></a></p>
            <p><strong>Downloads:</strong> <?php echo esc_html($plugin_data['wp_download_count']); ?></p>
            <p><strong>Thread Rating:</strong> <?php echo esc_html($plugin_data['wp_thread_rating']); ?></p>
        </div>
    </div>

    <div class="plugin-info">
        <div class="wrap left">
            <h2>Vulnerability Information (WP Vulnerability)</h2>
            <p><strong>CVE (last years):</strong> <?php echo esc_html(implode(', ', json_decode($plugin_data['wp_cves_last_years'], true))); ?></p>
            <p><strong>CVSS Score:</strong> <?php echo esc_html($plugin_data['wp_cvss_score']); ?></p>
            <hr>

            <h2>SonarQube Analysis</h2>
            <p><strong>Security Score:</strong> <?php echo esc_html($plugin_data['sonar_security_score']); ?></p>
            <p><strong>Security Hotspots:</strong> <?php echo esc_html($plugin_data['sonar_security_hotspots']); ?></p>
        </div>

        <div class="wrap right"> 
            <h2>OWASP Dependency Check</h2>
            <p><strong>Dependency Count:</strong> <?php echo esc_html($plugin_data['owasp_dependency_count']); ?></p>
            <p><strong>Vulnerable Dependencies:</strong> <?php echo esc_html($plugin_data['owasp_vulnerable_dependencies_count']); ?></p>
            <p><strong>Total Vulnerabilities:</strong> <?php echo esc_html($plugin_data['owasp_total_vulnerabilities_count']); ?></p>
            <p><strong>Highest CVSS Score:</strong> <?php echo esc_html($plugin_data['owasp_highest_cvss_score']); ?></p>
        </div>
    </div>
</div>

<?php
render_analyse_styles_and_scripts();

function render_analyse_styles_and_scripts() {
    ?>
    <style>
        /* Header Container for Title and Icon */
        .plugin-header {
            display: flex;
            align-items: center;
            
        }

        /* Icon Styling */
        .plugin-header .details-icon {
            width: 50px;
            height: 50px;
            margin-right: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Title Styling */
        .plugin-header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #2271b1;
            margin: 0;
            padding-bottom: 5px;
        }

        .plugin-header p {
            margin-right: 20px;
            font-style: italic;
            font-weight: bold;
        }

        .plugin-info-container {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: calc(100% - 100px);
            margin: 0 auto;
            margin-top: 50px;
        }

        .plugin-info {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }

        .plugin-info .wrap {
            width: 48%;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Hover effect for .wrap */
        .plugin-info .wrap:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .plugin-info h2 {
            font-size: 20px;
            color: #333;
            margin-top: 0;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .plugin-info p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
            margin: 5px 0;
        }

        .plugin-info hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ddd;
        }

        .plugin-info a {
            color: #2980b9;
            text-decoration: none;
        }

        .plugin-info a:hover {
            text-decoration: underline;
        }
    </style>
    <?php
}
?>
