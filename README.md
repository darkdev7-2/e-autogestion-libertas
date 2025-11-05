# E-Auto Gestion - MVP

Application web de gestion administrative des véhicules au Bénin.

## 📋 Vue d'ensemble

**E-Auto Gestion** permet aux prestataires de services et aux propriétaires de véhicules de suivre facilement leurs dossiers administratifs (assurance, visite technique, immatriculation, etc.) grâce à :
- Des notifications automatiques (SMS, Email, WhatsApp)
- Des paiements en ligne sécurisés
- Un tableau de bord intuitif
- Une interface multilingue (FR/EN)

## 🚀 Technologies utilisées

### Backend
- **Laravel 11** (PHP 8.2+)
- **MySQL 8**
- **Redis** (queues & cache)
- **Laravel Horizon** (monitoring des queues)
- **Laravel Sanctum** (authentification API)
- **Spatie Laravel Permission** (gestion des rôles)

### Frontend
- **Vue 3** avec Inertia.js
- **TailwindCSS**
- **Vite**

### Services externes
- **Twilio** (SMS & WhatsApp)
- **SendGrid** (Email)
- **KkiaPay / FedaPay** (Paiements)

## 📦 Installation

### Prérequis

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL >= 8.0
- Redis (optionnel en développement)

### Étapes d'installation

1. **Cloner le repository**
```bash
git clone https://github.com/darkdev7-2/e-autogestion-libertas.git
cd e-autogestion-libertas
```

2. **Installer les dépendances PHP**
```bash
composer install
```

3. **Installer les dépendances Node**
```bash
npm install
```

4. **Configurer l'environnement**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurer la base de données**

Éditez le fichier `.env` :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eautogestion
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

6. **Créer la base de données**
```bash
mysql -u root -p -e "CREATE DATABASE eautogestion CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

7. **Exécuter les migrations et seeders**
```bash
php artisan migrate --seed
```

8. **Compiler les assets**
```bash
npm run build
```

9. **Lancer l'application**
```bash
php artisan serve
```

L'application sera accessible sur http://localhost:8000

## 👥 Comptes de test

Après le seeding, vous pouvez vous connecter avec :

### Super Administrateur
- Email: `super@eautogestion.bj`
- Mot de passe: `password`

### Administrateur
- Email: `admin@eautogestion.bj`
- Mot de passe: `password`

### Agent
- Email: `agent@eautogestion.bj`
- Mot de passe: `password`

### Clients
- Email: `pierre.kouassi@example.bj` / Mot de passe: `password`
- Email: `aicha.dossou@example.bj` / Mot de passe: `password`
- Email: `thomas.agossou@example.bj` / Mot de passe: `password`

## 🏗️ Structure de la base de données

### Tables principales

- **users** : Utilisateurs (clients, agents, admins)
- **clients** : Profils clients avec adresses
- **vehicles** : Véhicules des clients
- **reminders** : Rappels d'échéances
- **notifications** : Historique des notifications envoyées
- **payments** : Transactions de paiement
- **service_requests** : Demandes de service
- **referrals** : Codes de parrainage
- **audit_logs** : Journal d'audit
- **settings** : Paramètres de l'application

## 🔐 Rôles et permissions

### Super Admin
- Accès complet à toutes les fonctionnalités
- Gestion des utilisateurs, paramètres, et intégrations

### Admin
- Gestion des clients et véhicules
- Envoi de notifications et rappels
- Accès aux rapports et exports

### Agent
- Gestion des dossiers clients
- Mise à jour des informations véhicules
- Traitement des demandes de service

### Client
- Consultation de ses véhicules
- Réception des notifications
- Paiements en ligne
- Demandes de service

## 📬 Notifications automatiques

### Configuration

Les rappels sont envoyés automatiquement via la commande :
```bash
php artisan reminders:send
```

Configuration des délais dans la base de données (table `settings`) :
- J-14 : Premier rappel
- J-7 : Rappel de suivi
- J-2 : Rappel urgent

### Planification (Cron)

Ajoutez cette ligne à votre crontab :
```bash
* * * * * cd /path/to/eautogestion && php artisan schedule:run >> /dev/null 2>&1
```

Puis dans `app/Console/Kernel.php`, ajoutez :
```php
protected function schedule(Schedule $schedule)
{
    $schedule->command('reminders:send')->dailyAt('08:00');
}
```

### Canaux de notification

- **SMS** : Via Twilio
- **Email** : Via SendGrid ou SMTP
- **WhatsApp** : Via Twilio Business API

## 💳 Paiements en ligne

### Providers supportés

1. **KkiaPay** (recommandé pour le Bénin)
2. **FedaPay**

### Configuration

Dans `.env` :
```env
PAYMENT_PROVIDER=kkiapay

KKIAPAY_PUBLIC_KEY=your_public_key
KKIAPAY_PRIVATE_KEY=your_private_key
KKIAPAY_SECRET=your_secret
KKIAPAY_SANDBOX=true
```

### Workflow de paiement

1. Client initie un paiement
2. Redirection vers la page de paiement (KkiaPay/FedaPay)
3. Client effectue le paiement
4. Webhook reçu → Paiement confirmé
5. Notification envoyée au client

## 🌐 API REST

### Authentification

L'API utilise Laravel Sanctum. Pour obtenir un token :

```bash
POST /api/login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "password"
}
```

### Endpoints principaux

```
GET    /api/vehicles          # Liste des véhicules
POST   /api/vehicles          # Créer un véhicule
GET    /api/vehicles/{id}     # Détails d'un véhicule
PUT    /api/vehicles/{id}     # Modifier un véhicule
DELETE /api/vehicles/{id}     # Supprimer un véhicule

GET    /api/reminders         # Liste des rappels
POST   /api/reminders/{id}/send  # Envoyer un rappel

GET    /api/payments          # Liste des paiements
POST   /api/payments/initiate # Initier un paiement
POST   /api/payments/webhook  # Webhook des providers
```

## 🔧 Configuration avancée

### Laravel Horizon (Queues)

Lancer Horizon :
```bash
php artisan horizon
```

Accéder au dashboard : http://localhost:8000/horizon

### Redis

Pour activer Redis en développement :
```env
CACHE_STORE=redis
QUEUE_CONNECTION=redis
REDIS_CLIENT=predis
```

### Variables d'environnement importantes

```env
# Application
APP_NAME="E-Auto Gestion"
APP_URL=https://eautogestion.bj
APP_LOCALE=fr
APP_TIMEZONE=Africa/Porto-Novo

# Twilio
TWILIO_SID=your_account_sid
TWILIO_TOKEN=your_auth_token
TWILIO_FROM=+229xxxxxxxx

# SendGrid
SENDGRID_API_KEY=your_api_key
MAIL_FROM_ADDRESS=no-reply@eautogestion.bj

# Paiements
PAYMENT_PROVIDER=kkiapay
KKIAPAY_PUBLIC_KEY=pk_xxx
KKIAPAY_PRIVATE_KEY=sk_xxx
KKIAPAY_SECRET=xxx
```

## 📊 KPI à suivre

- Taux d'ouverture des notifications : ≥ 80%
- Satisfaction utilisateur : ≥ 90%
- Réduction des oublis d'échéances : ≥ 95%
- Temps de chargement page : < 2s
- Temps de réponse serveur : < 500ms

## 🚢 Déploiement en production

### 1. Préparer le serveur

Hébergeurs recommandés :
- **DigitalOcean** (Droplet Ubuntu 22.04)
- **AWS Lightsail**
- **Scaleway**

### 2. Configuration serveur

```bash
# Installer les dépendances
sudo apt update
sudo apt install php8.2 php8.2-fpm php8.2-mysql php8.2-redis php8.2-mbstring php8.2-xml composer nginx mysql-server redis-server

# Cloner le projet
cd /var/www
git clone https://github.com/darkdev7-2/e-autogestion-libertas.git
cd e-autogestion-libertas

# Installation
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### 3. Configuration Nginx

```nginx
server {
    listen 80;
    server_name eautogestion.bj www.eautogestion.bj;
    root /var/www/e-autogestion-libertas/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 4. SSL avec Let's Encrypt

```bash
sudo apt install certbot python3-certbot-nginx
sudo certbot --nginx -d eautogestion.bj -d www.eautogestion.bj
```

### 5. Optimisations Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 6. Supervisor pour Horizon

```ini
[program:eautogestion-horizon]
process_name=%(program_name)s
command=php /var/www/e-autogestion-libertas/artisan horizon
autostart=true
autorestart=true
user=www-data
redirect_stderr=true
stdout_logfile=/var/www/e-autogestion-libertas/storage/logs/horizon.log
```

## 🐛 Dépannage

### Les migrations échouent

```bash
php artisan migrate:fresh --seed
```

### Les assets ne se chargent pas

```bash
npm run build
php artisan optimize:clear
```

### Problèmes de permissions

```bash
sudo chown -R $USER:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## 📝 Licence

Propriétaire - E-Auto Gestion © 2025

## 👨‍💻 Support

- Email : support@eautogestion.bj
- Téléphone : +229 97 00 00 00

## 🙏 Remerciements

- Laravel Team
- Vue.js Team
- Spatie
- Twilio
- KkiaPay / FedaPay

---

**Version MVP - Janvier 2025**
