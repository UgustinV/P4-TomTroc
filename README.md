# Documentation
## Pour lancer le projet en local :
### XAMPP
Installer un logiciel comme XAMPP et cloner le git dans \xampp\htdocs (sous Windows)
### ENV
Il faudra ensuite créer le fichier config.php dans le dossier config afin d'y mettre toutes les variables d'environnement :
- DB_HOST
- DB_NAME
- DB_USER
- DB_PASS
- CLOUDINARY_CLOUD_NAME
- CLOUDINARY_API_KEY
- CLOUDINARY_SECRET
- CLOUDINARY_URL : doit avoir cette forme : 'https://api.cloudinary.com/v1_1/' . CLOUDINARY_CLOUD_NAME . '/image/upload'
- CLOUDINARY_DELETE_URL : doit avoir cette forme 'https://api.cloudinary.com/v1_1/' . CLOUDINARY_CLOUD_NAME . '/image/destroy'
- BASE_URL : l'url de base qui pointe à la racine du dossier /public

Cloudinary sert à publier les images de livres en ligne plutôt qu'en local (simplifie un futur déploiment)

### DB
Récupérer le fichier .sql permettant de créer les tables nécessaires au foncrionnement du site et l'importer dans PHPMyAdmin (accessible depuis le dashboard de XAMPP)
C'est là que l'on récupérera également les valeurs des variables d'environnement DB_X.
Par exemple, DB_NAME sera le nom de la base créée.