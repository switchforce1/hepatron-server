# HEPATRON

## General
Application web pour c.........
Deux applicaton distinctes 
  - Mobile Js (cross plateforme)
  - web server (php symfony) 
## Fonctionnel
### Module serveur avec les fonctionnalités server-side
 - Admin (Administration de l'appli)
 - Web (Acces sur le net via navigateur)
    - Front(sans authentification ou authentification abonnées)
    - Manage (avec authencation rigoureuse , gestion des élément du site)
 - Middle (structure de base (fondammentaux) Entites, services, Managers ...)
 - Security (Authentification et Autorisation ; logique d'acces)
 - API (Acces externe de la application , + documentation de l'API)
 
## Techniques 
  - Symfony 4.2
  - GrumPhp  (Lint du code avant les commit)
  - Webpack


## Windows Vhost
    <VirtualHost *:80>
        ServerName hepatron.local
        ServerAlias hepatron.local
        
        DocumentRoot "${INSTALL_DIR}/www/hepatron/public"
        <Directory "${INSTALL_DIR}/www/hepatron/public">
            AllowOverride All
              Require all granted
            Allow from All
            
            FallbackResource /index.php
        </Directory>
        
        #ErrorLog "${INSTALL_DIR}/var/log/apache2/hepatron_error.log"
        #CustomLog "${INSTALL_DIR}/var/log/apache2/hepatron_access.log" combined
        
    </VirtualHost>
    
