# 📚 Plateforme de Gestion de Cours en Ligne

Ce projet est une application web permettant aux visiteurs, étudiants, enseignants et administrateurs d'interagir autour de la création, consultation et gestion de cours en ligne. Le système inclut des fonctionnalités spécifiques selon le rôle de l'utilisateur, un back office pour l'administration, et respecte des standards techniques avancés comme l'OOP, le polymorphisme et la gestion sécurisée des sessions.

---

## 🔍 Table des matières

- [Fonctionnalités Front Office](#fonctionnalités-front-office)
- [Fonctionnalités Back Office](#fonctionnalités-back-office)
- [Fonctionnalités Transversales](#fonctionnalités-transversales)
- [Exigences Techniques](#exigences-techniques)
- [Technologies Utilisées](#technologies-utilisées)
- [Installation](#installation)
- [Captures d'Écran (optionnel)](#captures-décran-optionnel)
- [Crédits](#crédits)

---

## 🧑‍🏫 Fonctionnalités Front Office

### 👤 Visiteur
- Consultation du catalogue des cours avec pagination
- Recherche de cours par mots-clés
- Création d’un compte avec choix du rôle (Étudiant ou Enseignant)

### 🎓 Étudiant
- Visualisation du catalogue des cours
- Recherche et consultation des détails d’un cours (description, contenu, enseignant, etc.)
- Inscription à un cours (après authentification)
- Accès à la section “Mes cours” pour consulter les cours rejoints

### 🧑‍🏫 Enseignant
- Ajout de nouveaux cours avec :
  - Titre, description, contenu (vidéo ou document), tags, catégorie
- Gestion des cours (modifier, supprimer, consulter les inscriptions)
- Accès à une section “Statistiques” :
  - Nombre d’étudiants inscrits
  - Nombre de cours publiés

---

## ⚙️ Fonctionnalités Back Office

### 👮 Administrateur
- Validation des comptes enseignants
- Gestion des utilisateurs (activer, suspendre, supprimer)
- Gestion des contenus :
  - Cours, catégories, tags
  - Insertion en masse de tags pour gagner du temps
- Statistiques globales :
  - Nombre total de cours
  - Répartition des cours par catégorie
  - Cours avec le plus d’étudiants
  - Top 3 des enseignants

---

## 🔁 Fonctionnalités Transversales

- Relation **many-to-many** entre cours et tags
- Utilisation du **polymorphisme** dans les méthodes `ajouterCours()` et `afficherCours()`
- Système d’authentification et d’autorisation pour sécuriser les routes sensibles
- Contrôle d'accès basé sur le rôle de l'utilisateur

---

## 🧱 Exigences Techniques

- Application des principes **POO** (encapsulation, héritage, polymorphisme)
- Base de données relationnelle avec relations :
  - One-to-many
  - Many-to-many
- Utilisation des **sessions PHP** pour gérer l’état des utilisateurs connectés
- Système de validation des données utilisateur côté serveur pour renforcer la sécurité

---

## 🛠️ Technologies Utilisées

- PHP (oop)
- PostgreSQL ou MySQL
- HTML, Tailwind css
- JavaScript

---
