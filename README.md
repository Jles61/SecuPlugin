<!-- # SecuPlugin
SecuPlugin is a powerful WordPress tool that enhances website security by analyzing plugins for vulnerabilities. Using OSINT, static code analysis, and dependency management, it provides detailed insights and generates security scores, helping administrators identify risks and maintain a safer WordPress environment.

Voici une suggestion pour le fichier `README.md` de votre projet SecuPlugin, incluant un dossier démonstrateur et les informations essentielles :

--- -->

# SecuPlugin

**SecuPlugin** est un outil robuste pour l'analyse des plugins WordPress, conçu pour renforcer la sécurité des sites en identifiant les vulnérabilités et en fournissant des insights approfondis. Il combine des techniques avancées telles que l'OSINT, l'analyse statique de code et la gestion des dépendances pour évaluer les plugins et générer des scores de sécurité exploitables.

---

## Table des matières

1. [Présentation](#présentation)
2. [Démonstrateur](#démonstrateur)
   - [Sources et Binaires](#sources-et-binaires)
   - [Guide de Déploiement](#guide-de-déploiement)
   - [Guide d'Utilisation](#guide-dutilisation)
3. [Structure du Projet](#structure-du-projet)
4. [Fonctionnalités](#fonctionnalités)
5. [Contribution](#contribution)
6. [Licence](#licence)

---

## Présentation

SecuPlugin offre une analyse complète des plugins WordPress en utilisant des sources ouvertes et des outils d'analyse comme SonarQube et OWASP Dependency-Check. 

---

## Démonstrateur

### Sources et Binaires

Le code source complet est disponible dans le répertoire `analyse-test` du projet. Aucune binaire n'est nécessaire pour ce plugin, car il est entièrement compatible avec l'environnement PHP et WordPress.

Vous pouvez télécharger les fichiers ici :
- [GitHub Repository](https://github.com/jles61/secuplugin)

### Guide de Déploiement

1. **Prérequis** :
   - WordPress version 6.0 ou supérieure.
   - PHP 7.4 ou supérieur.
   - Accès administrateur au site WordPress.

2. **Installation** :
   - Téléchargez les fichiers du plugin ou clonez le dépôt GitHub :
     ```bash
     git clone https://github.com/jles61/secuplugin.git
     ```
   - Compressez les fichiers dans une archive `.zip` si nécessaire.
   - Accédez à l'interface administrateur de WordPress, puis allez dans **Extensions > Ajouter**.
   - Cliquez sur **Téléverser une extension**, puis importez l'archive `.zip`.
   - Activez le plugin dans la liste des extensions.

3. **Configuration** :
   - Une fois le plugin activé, un nouveau menu **SecuPlugin** apparaît dans l'interface administrateur.
   - Configurez les options disponibles pour personnaliser l'analyse.

### Guide d'Utilisation

1. **Analyser un Plugin** :
   - Accédez au menu **SecuPlugin > Analyse**.
   - Sélectionnez un plugin installé ou entrez les informations d'un plugin externe.
   - Cliquez sur **Analyser** pour démarrer l'évaluation.

2. **Consulter les Résultats** :
   - Les résultats sont affichés sous forme de tableau avec :
     - Le score de sécurité.
     - Les vulnérabilités connues (CVE, CVSS).
     - Les informations sur les dépendances.
   - Cliquez sur **Détails** pour voir un rapport détaillé.

<!-- 3. **Rapport Exportable** :
   - Vous pouvez exporter un rapport au format JSON ou PDF depuis la page d'analyse. -->

---

## Structure du Projet

```
C:.
│   README.md
│
└───analyse-test
    │   analyse-test.php
    │   api json central.json
    │   test_api_json_central.json
    │
    ├───includes
    │       analyse-admin.php
    │       analyse-ajax.php
    │       analyse-utilities.php
    │
    ├───js
    │       analyse-button-v2.js
    │       analyse-button.js
    │       plugin-versions.js
    │
    └───templates
            plugin-analysis.php
            plugin-details.php
```

---

## Fonctionnalités

- Analyse complète des plugins installés :
  - Vérification des vulnérabilités connues (CVE, CVSS).
  - Évaluation de la qualité du code et des dépendances.
  - Informations sur les développeurs et contributeurs.
- Score de sécurité synthétisé.
- Interface utilisateur intuitive intégrée à WordPress.
- Export des résultats d'analyse.

---

## Contribution

Les contributions sont les bienvenues ! Si vous souhaitez participer :
1. Forkez le projet.
2. Créez une branche (`git checkout -b feature/YourFeature`).
3. Soumettez une pull request.

---

## Licence

Ce projet est sous licence **MIT**. Consultez le fichier [LICENSE](LICENSE) pour plus d'informations.
