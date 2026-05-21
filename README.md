#  Synergy Medical Assistant

**SynergyAI** est une plateforme médicale intelligente combinant une application web Laravel et une API de diagnostic basée sur l’IA (FastAPI + RAG). Elle permet aux patients de décrire leurs symptômes en langage naturel et aux professionnels (ou administrateurs) de gérer les utilisateurs, consulter les logs et analyser les pré-diagnostics.

##  Architecture du projet

Le projet comporte:

- **Application Laravel** (PHP) : Gère l’authentification, l’interface utilisateur, le tableau de bord patient/admin, et sert les pages web.
- **API Synergy** : Reçoit les symptômes + données biométriques, interroge une base vectorielle et un LLM (Groq), retourne un pré-diagnostic structuré (5 maladies les plus probables, pourcentages, explications, urgence).


## 🚀 Fonctionnalités

- **Chatbot médical** : interface de dialogue pour saisir les symptômes (langage naturel) et données biométriques (température, fréquence cardiaque, tension).
- **Pré-diagnostic IA** : retourne un tableau récapitulatif, les 3 maladies les plus probables avec pourcentage et explication, ainsi qu’une alerte urgence si nécessaire.
- **Espace patient** : tableau de bord personnel (à développer selon vos besoins).
- **Interface d’administration** : gestion des utilisateurs (liste, suppression), consultation des logs système, modification du profil admin.
- **Sécurité** : authentification Laravel, middleware admin, chiffrement des données sensibles.

## 🛠️ Prérequis

- **PHP ≥ 8.1** + Composer
- **Node.js & NPM** (pour les assets si besoin)
- **Python ≥ 3.10** + pip
- **Base de données** (MySQL, PostgreSQL, SQLite)
- **Compte Groq** (gratuit) pour obtenir une clé API

## 📥 Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/votre-org/synergy-medical-assistant.git
cd synergy-medical-assistant
python -m venv venv
source venv/bin/activate  # sur Windows : venv\Scripts\activate
pip install -r requirements.txt