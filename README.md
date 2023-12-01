# Site_vetements_symfony

Site de vêtements et de chaussures en symfony 

## Prérequis

Assurez-vous d'avoir les éléments suivants installés sur votre machine :
- PHP 8+
- Composer
- Symfony CLI
- MySQL (ou tout autre système de gestion de base de données pris en charge)

## Installation

1. Clonez le dépôt depuis GitHub :
    ```bash
    git clone https://github.com/Pandespiegle/Site_vetements_symfony.git
    ```

2. Accédez au répertoire du projet :
    ```bash
    cd Site_vetements_symfony
    ```

3. Installez les dépendances à l'aide de Composer :
    ```bash
    composer install
    ```

4. Créez la base de données et exécutez les migrations :
    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
   
    ```
5. Créez les données de test :
    ```bash
    php bin/console doctrine:fixtures:load
    ```
    
6. Modifier la constante DATABASE_URL dans le fichier .env pour mettre l'url la BDD :
    ```bash
    php bin/console doctrine:fixtures:load
    ```

7. Lancer le site :
    Mettre le site dans le répertoire dans le dossier htdocs de Xampp



