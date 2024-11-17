<?php
function analyse_plugin_delete_info() {
    global $wpdb;
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    if ($id > 0 && $wpdb->delete('wp_plugin_analysis', array('id' => $id))) {
        wp_send_json_success(array('message' => 'Analysis successfully deleted.'));
    } else {
        wp_send_json_error(array('message' => 'Deletion error.'));
    }
}


// Use the JSON data instead of API response
function analyse_plugin_save_info($plugin_data_json) {
  global $wpdb;

  // Decode JSON data
  $json_data = json_decode($plugin_data_json, true);

  // Example of inserting data into the database
  $wpdb->insert(
      'wp_plugin_analysis',
      [
          'icon' => $json_data['icon'],
          'slug_version' => $json_data['plugin_analysis']['plugin_store']['plugin_name_version'],
  
          // Whois Data
          'whois_owner_email' => $json_data['plugin_analysis']['whois']['owner_email'],
          'whois_owner_country' => $json_data['plugin_analysis']['whois']['owner_country'],
          'whois_creation_date' => $json_data['plugin_analysis']['whois']['creation_date'],
          'whois_expiration_date' => $json_data['plugin_analysis']['whois']['expiration_date'],
          'whois_data_anonymization' => $json_data['plugin_analysis']['whois']['data_anonymization'],
  
          // Plugin Author Contributor Data
          'author_name' => $json_data['plugin_analysis']['developers_contributors']['author_name'],
          'contributors' => json_encode($json_data['plugin_analysis']['developers_contributors']['contributors']),
          'password_leaks_count' => $json_data['plugin_analysis']['developers_contributors']['password_leaks_count'],
          'email_list' => json_encode($json_data['plugin_analysis']['developers_contributors']['email_list']),
  
          // Plugin WordPress Data
          'wp_creation_date' => $json_data['plugin_analysis']['plugin_store']['creation_date'],
          'wp_version' => $json_data['plugin_analysis']['plugin_store']['version'],
          'wp_rating' => $json_data['plugin_analysis']['plugin_store']['rating'],
          'wp_rating_count' => $json_data['plugin_analysis']['plugin_store']['rating_count'],
          'wp_thread_rating' => $json_data['plugin_analysis']['plugin_store']['thread_rating'],
          'wp_download_count' => $json_data['plugin_analysis']['plugin_store']['download_count'],
          'wp_download_link' => $json_data['plugin_analysis']['plugin_store']['download_link'],
          'wp_domain' => $json_data['plugin_analysis']['plugin_store']['domain'],
          'wp_git_repository' => $json_data['plugin_analysis']['plugin_store']['git_repository'],
  
          // WP Vulnerability Data
          'wp_cves_last_years' => json_encode($json_data['plugin_analysis']['wp_vulnerability']['cves_last_years']),
          'wp_cvss_score' => $json_data['plugin_analysis']['wp_vulnerability']['cvss_score'],

          // SonarQube Data
          'sonar_security_score' => $json_data['plugin_analysis']['sonarqube_analysis']['security_score'],
          'sonar_security_hotspots' => $json_data['plugin_analysis']['sonarqube_analysis']['security_hotspots'],
  
          // Owas Dependency Check Data
          'owasp_dependency_count' => $json_data['plugin_analysis']['owasp_dependency_check']['dependency_count'],
          'owasp_vulnerable_dependencies_count' => $json_data['plugin_analysis']['owasp_dependency_check']['vulnerable_dependencies_count'],
          'owasp_total_vulnerabilities_count' => $json_data['plugin_analysis']['owasp_dependency_check']['total_vulnerabilities_count'],
          'owasp_highest_cvss_score' => $json_data['plugin_analysis']['owasp_dependency_check']['highest_cvss_score'],
  
          // Metadata
          'created_at' => current_time('mysql')
      ]
  );
}

$json_data_test = '{
  "icon": "https://ps.w.org/elementor/assets/icon-256x256.gif",
  "plugin_analysis": {
    "whois": {
      "owner_email": "admin@example.com",
      "owner_country": "France",
      "creation_date": "2016-06-02",
      "expiration_date": "2026-06-02",
      "data_anonymization": true
    },
    "developers_contributors": {
      "author_name": "Example Author",
      "contributors": ["Contributor1", "Contributor2"],
      "password_leaks_count": 2,
      "email_list": ["dev1@example.com", "dev2@example.com"]
    },
    "plugin_store": {
      "plugin_name_version": "Elementor 3.15.3",
      "creation_date": "2016-06-02",
      "version": "3.15.3",
      "rating": 4.7,
      "rating_count": 6200,
      "thread_rating": "High",
      "download_count": 500000,
      "download_link": "https://wordpress.org/plugins/example",
      "domain": "example.com",
      "git_repository": "https://github.com/example/example-plugin"
    },
    "wp_vulnerability": {
      "cves_last_years": ["CVE-2023-0001", "CVE-2022-1234"],
      "cvss_score": 7.5
    },
    "sonarqube_analysis": {
      "security_score": "B",
      "vulnerability_count": {
        "minor": 5,
        "major": 2,
        "critical": 1,
        "blocker": 0
      },
      "security_hotspots": 3
    },
    "owasp_dependency_check": {
      "dependency_count": 12,
      "vulnerable_dependencies_count": 3,
      "total_vulnerabilities_count": 5,
      "highest_cvss_score": 8.1
    }
  }
}';

// Call the function to save the plugin info to the database
analyse_plugin_save_info($json_data_test);










































// Use the JSON data instead of API response
function aaaaaanalyse_plugin_save_info($plugin_data_json) {
  global $wpdb;

  // Decode JSON data
  $json_data = json_decode($plugin_data_json, true);

  // Example of inserting data into the database
  $wpdb->insert(
      'wp_plugin_analysis',
      [
          'icon' => $json_data['icon'],

          // Basic plugin information
          'plugin_nom_version' => $json_data['Whois']['Plugin_nom_version'],
  
          // Whois Data
          'whois_ip' => $json_data['Whois']['IP'],
          'whois_email_proprietaire' => $json_data['Whois']['Email_proprietaire'],
          'whois_pays_du_proprietaire' => $json_data['Whois']['Pays_du_proprietaire'],
          'whois_date_de_creation' => $json_data['Whois']['Date_de_creation'],
          'whois_date_d_expiration' => $json_data['Whois']['Date_d_expiration'],
          'whois_nom_hebergeur' => $json_data['Whois']['Nom_hebergeur'],
  
          // Plugin WordPress Data
          'wp_nom_de_l_auteur' => $json_data['Plugin_Wordpress']['Nom_de_l_auteur'],
          'wp_noms_de_contributeur' => json_encode($json_data['Plugin_Wordpress']['Noms_de_contributeur']), // Convert array to JSON
          'wp_date_de_creation' => $json_data['Plugin_Wordpress']['Date_de_creation'],
          'wp_note' => $json_data['Plugin_Wordpress']['Note'],
          'wp_nb_notes' => $json_data['Plugin_Wordpress']['Nb_Notes'],
          'wp_lien_de_telechargement' => $json_data['Plugin_Wordpress']['Lien_de_telechargement'],
          'wp_domain' => $json_data['Plugin_Wordpress']['Domain'],
          'wp_lien_git' => $json_data['Plugin_Wordpress']['Lien_Git'],
          'wp_nb_telechargement' => $json_data['Plugin_Wordpress']['Nb_telechargement'],
          'wp_note_thread' => $json_data['Plugin_Wordpress']['Note_Thread'],
  
          // Plugin Author Contributor Data
          'author_nom_de_l_auteur' => $json_data['Plugin_Auteur_Contributeur']['Nom_de_l_auteur'],
          'author_date_d_inscription' => $json_data['Plugin_Auteur_Contributeur']['Date_d_inscription'],
          'author_pays' => $json_data['Plugin_Auteur_Contributeur']['Pays'],
          'author_home_page' => $json_data['Plugin_Auteur_Contributeur']['HomePage'],
          'author_lien_git' => $json_data['Plugin_Auteur_Contributeur']['Lien_Git'],
          'author_listes_plugins' => json_encode($json_data['Plugin_Auteur_Contributeur']['Listes_plugins']), // Convert array to JSON
  
          // SonarQube Data
          'sonar_nb_vulns' => $json_data['SonarQube']['Nb_Vulns'],
          'sonar_nb_vulns_critiques' => $json_data['SonarQube']['Nb_Vulns_critiques'],
          'sonar_rating_securite' => $json_data['SonarQube']['Rating_Securite'],
          'sonar_nb_securite_hotspot' => $json_data['SonarQube']['Nb_securite_Hotspot'],
          'sonar_owasp_dc' => $json_data['SonarQube']['OWASP_DC'],
  
          // WP Vulnerability Data
          'wp_vuln_cve_dernières_annees' => json_encode($json_data['WP_Vulnerability']['CVE_dernières_annees']), // Convert array to JSON
          'wp_vuln_score_cvss' => $json_data['WP_Vulnerability']['Score_CVSS_des_vulns'],
  
          // Hunter.io Data
          'hunter_domain' => $json_data['Hunter_io']['Domain'],
          'hunter_listes_emails' => json_encode($json_data['Hunter_io']['Listes_emails']), // Convert array to JSON
  
          // IHBP Data
          'ihbp_listes_emails' => json_encode($json_data['IHBP']['Listes_emails']), // Convert array to JSON
          'ihbp_nb_leak' => $json_data['IHBP']['Nb_leak'],
  
          // Metadata
          'created_at' => current_time('mysql')
      ]
  );
}


// Call function with JSON data
$aajson_data_test = '{
  "icon": "https://ps.w.org/elementor/assets/icon-256x256.gif",
  "Whois": {
    "Plugin_nom_version": "Elementor 3.15.3",
    "IP": "192.0.66.2",
    "Email_proprietaire": "admin@elementor.com",
    "Pays_du_proprietaire": "Israel",
    "Date_de_creation": "2016-06-02",
    "Date_d_expiration": "2026-06-02",
    "Nom_hebergeur": "Automattic Inc."
  },
  "Plugin_Wordpress": {
    "Plugin_nom_version": "Elementor 3.15.3",
    "Nom_de_l_auteur": "Elementor.com",
    "Noms_de_contributeur": ["benwp", "arielk", "elishaleigh"],
    "Date_de_creation": "2016-06-02",
    "Note": 4.7,
    "Nb_Notes": 6200,
    "Lien_de_telechargement": "https://wordpress.org/plugins/elementor/",
    "Domain": "elementor.com",
    "Lien_Git": "https://github.com/elementor/elementor",
    "Nb_telechargement": 5000000,
    "Note_Thread": "High"
  },
  "Plugin_Auteur_Contributeur": {
    "Plugin_nom_version": "Elementor 3.15.3",
    "Nom_de_l_auteur": "Elementor.com",
    "Date_d_inscription": "2016-06-02",
    "Pays": "Israel",
    "HomePage": "https://elementor.com",
    "Lien_Git": "https://github.com/elementor/elementor",
    "Listes_plugins": ["Elementor", "Elementor Pro"]
  },
  "SonarQube": {
    "Plugin_nom_version": "Elementor 3.15.3",
    "Nb_Vulns": 12,
    "Nb_Vulns_critiques": 2,
    "Rating_Securite": "B",
    "Nb_securite_Hotspot": 3,
    "OWASP_DC": "A3"
  },
  "WP_Vulnerability": {
    "Plugin_nom_version": "Elementor 3.15.3",
    "CVE_dernières_annees": ["CVE-2023-23456", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890", "CVE-2022-67890"],
    "Score_CVSS_des_vulns": 7.8
  },
  "Hunter_io": {
    "Plugin_nom_version": "Elementor 3.15.3",
    "Domain": "elementor.com",
    "Listes_emails": ["contact@elementor.com", "support@elementor.com"]
  },
  "IHBP": {
    "Plugin_nom_version": "Elementor 3.15.3",
    "Listes_emails": ["security@elementor.com"],
    "Nb_leak": 1
  }
}';


?>