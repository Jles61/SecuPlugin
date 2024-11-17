<?php
// Ensure WordPress environment is loaded
require_once dirname(__FILE__) . '/../../../../wp-load.php';
if (!is_user_logged_in() || !current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}

global $wpdb;

$plugin_name = get_option('last_analyzed_plugin', 'Aucun plugin analysé pour l\'instant.');
$paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
$per_page = 4;
$offset = ($paged - 1) * $per_page;

$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM `wp_plugin_analysis` ORDER BY id DESC LIMIT %d OFFSET %d", $per_page, $offset), ARRAY_A);
$total_items = $wpdb->get_var("SELECT COUNT(*) FROM `wp_plugin_analysis`");
$total_pages = ceil($total_items / $per_page);

?>
<div class="wrap">
    <h1>Plugin Analysis</h1>
    <p>Welcome to the plugin analysis page. You can check the security of installed plugins here.</p>
    <?php if ($latest_plugin = $wpdb->get_row("SELECT slug_version FROM `wp_plugin_analysis` ORDER BY id DESC LIMIT 1", ARRAY_A)) : ?>
        <h2>Last plugin analyzed:</h2>
        <p><?php echo esc_html($latest_plugin['slug_version']); ?></p>
    <?php endif; ?>
    <h2>All plugins analyzed:</h2>
    <?php if (!empty($results)) : ?>
        <div class="plugin-cards">
            <?php foreach ($results as $row) : ?>
                <div class="plugin-card-analyse">
                    <h3><?php echo esc_html($row['slug_version']); ?></h3>
                    <h4>Analyzed On: <?php echo esc_html($row['created_at']); ?></h4>
                    <div class="infos">
                        <p><strong>Author:</strong> <?php echo esc_html($row['author_name']); ?></p>
                        <p><strong>Rating:</strong> <?php echo esc_html($row['wp_rating']); ?> / 100</p>
                        <p><strong>Number of ratings:</strong> <?php echo esc_html($row['wp_rating_count']); ?></p>
                        <p><strong>Added on:</strong> <?php echo esc_html($row['wp_creation_date']); ?></p>
                        <p><strong>Downloads:</strong> <?php echo esc_html($row['wp_download_count']); ?></p>
                        <p><strong>Domain:</strong> <?php echo esc_html($row['wp_domain']); ?></p>
                        <p><strong>Threads Note:</strong> <?php echo esc_html($row['wp_thread_rating']); ?></p>
                    </div>
                    
                    <div class="buttons">
                        <button class="button delete-plugin-button" data-id="<?php echo esc_attr($row['id']); ?>">Delete analysis</button>
                        <a class="button more-details-button" href="<?php echo add_query_arg(['page' => 'plugin-details', 'plugin_id' => $row['id']], admin_url('admin.php')); ?>">More details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <?php if ($i == $paged) : ?>
                    <span class="button current"><?php echo $i; ?></span>
                <?php else : ?>
                    <a class="button" href="<?php echo add_query_arg('paged', $i); ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    <?php else : ?>
        <p>No plugins analyzed for the moment.</p>
    <?php endif; ?>
</div>
<?php
render_analyse_styles_and_scripts();

function render_analyse_styles_and_scripts() {
    ?>
    <style>
        .plugin-cards { display: flex; flex-wrap: wrap; gap: 20px; }
        .plugin-card-analyse { display: flex; flex-wrap: wrap; flex-direction: column; background: #fff; border: 1px solid #e1e1e1; border-radius: 5px; padding: 20px; width: 20%; box-shadow: 0 1px 3px rgba(0,0,0,0.1); justify-content: space-between; }
        .plugin-card-analyse h3 { margin-top: 0; align-self: center; }
        .plugin-card-analyse h4 { margin-top: 0; align-self: center; }
        .pagination { margin-top: 20px; }
        .pagination .button { margin-right: 10px; }
        .pagination .button.current { background-color: #0073aa; color: #fff; font-weight: bold; }
        .buttons { display: flex; justify-content: space-between; }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.delete-plugin-button').on('click', function() {
                if (!confirm("Are you sure you want to delete this analysis?")) return;
                var pluginId = $(this).data('id');
                $.ajax({
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    method: 'POST',
                    data: { action: 'delete_plugin_info', id: pluginId },
                    success: function(response) { response.success ? alert('Analysis successfully deleted.') : alert('Error while deleting the analysis.'); location.reload(); },
                    error: function() { alert('Error during delete request.'); }
                });
            });
        });
    </script>
    <?php
}
?>
