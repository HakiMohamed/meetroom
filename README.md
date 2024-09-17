# Réservation de Salles de Réunion - Plateforme Web Interne

## Contexte du Projet

L’objectif de ce projet est de créer une plateforme web interne permettant aux employés de réserver des salles de réunion dans l’entreprise. La plateforme supporte les réunions virtuelles et en présentiel et offre des fonctionnalités de réservation, d’annulation, et de gestion des équipements pour les réunions en présentiel.

## Objectifs Principaux

- Mettre en place une plateforme sécurisée permettant aux employés de réserver des salles de réunion en fonction de leur disponibilité.
- Offrir la possibilité de choisir entre une réunion virtuelle (via plateformes comme Google Meet, Microsoft Teams) ou présentielle (dans les locaux de l’entreprise).
- Permettre l’annulation des réservations sous certaines conditions (annulation 48 heures à l’avance).
- Intégrer un système de notification pour la confirmation et les rappels des réunions.

## Technologies

- **Backend** : Laravel (PHP)
- **Frontend** : Blade (templates Laravel), HTML5, CSS3, JavaScript
- **Base de données** : MySQL
- **Authentification** : Authentification sécurisée from scratch avec validation des données front et back
- **Serveur** : Apache

## Fonctionnalités

### Authentification et Gestion des Utilisateurs

- Authentification via ID d'utilisateur/email.
- Gestion des rôles utilisateurs (administrateur, employé).
- Système de récupération de mot de passe et gestion de session sécurisée.
- Tableau de bord utilisateur pour consulter les réservations passées et à venir.

### Réservation de Salles de Réunion

#### Réunion Virtuelle

- Choix entre différentes plateformes (Google Meet, Microsoft Teams, etc.).
- Sélection de la date, de l'heure et de la durée (maximale) de la réunion.
- Génération automatique du lien de réunion après réservation et envoi d'une confirmation par email.

#### Réunion en Présentiel

- Sélection de la date, de l'heure et de la durée de la réunion (max 2 heures).
- Choix de l'équipement nécessaire (tableau blanc, laptop, projecteur, etc.).
- Vérification de la disponibilité des équipements avant la réservation.

### Annulation de Réunion

- Annulation de la réunion au moins 48 heures avant la date prévue.
- Les réservations ne peuvent pas être modifiées ni annulées après ce délai.

### Notifications

- Email de confirmation envoyé après chaque réservation avec les détails (type de réunion, date, heure, durée, équipements).
- Rappels envoyés 24 heures avant la réunion par email ou notification.

### Gestion des Salles et Équipements

- Gestion des salles de réunion (capacité, localisation, équipements disponibles).
- Disponibilité en temps réel des salles et des équipements.
- Historique des réservations pour chaque salle.

### Administration

- Rôle administrateur pour gérer les utilisateurs, salles et équipements.
- Accès à un calendrier global des réservations.
- Gestion des utilisateurs et des droits (ajout, modification, suppression).

## Contraintes

### Contraintes Techniques

- L'application doit être responsive pour une utilisation sur PC ou smartphone.
- Utilisation de Laravel pour le backend et la gestion des bases de données.
- Respect des règles de sécurité pour l'authentification et la gestion des sessions.
- Mise en place de tests unitaires et fonctionnels pour garantir la stabilité de l’application.

## Installation

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/ton-repository.git
   cd /meetroom
   composer install
   npm install
   php artisan key:generate
   php artisan migrate
   php artisan serve

Utilisation
Accéder à l'application via http://localhost:8000.
Se connecter avec les identifiants d'un utilisateur valide.
Réserver des salles, choisir les équipements nécessaires, et gérer les réservations via le tableau de bord.
Contribuer
Les contributions sont les bienvenues ! Veuillez soumettre des pull requests pour toute amélioration ou correction. Assurez-vous de tester vos modifications et de respecter les conventions de codage.

Licence
Ce projet est sous la Licence MIT.

Contact
Pour toute question ou demande d'assistance, veuillez contacter Mohamedhaki70@gmail.com.






