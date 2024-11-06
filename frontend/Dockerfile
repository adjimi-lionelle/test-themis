# Utiliser une image Node.js pour le frontend Vue.js
FROM node:16-alpine AS build-stage

# Définir le répertoire de travail
WORKDIR /app

# Copier uniquement les fichiers package.json et package-lock.json
COPY package*.json ./

# Augmenter le délai d'attente et mettre à jour npm pour éviter les erreurs de connexion
RUN npm install -g npm@latest \
    && npm config set fetch-retry-maxtimeout 120000

# Installer les dépendances en mode silencieux pour réduire les logs
RUN npm install --prefer-offline --no-audit

# Copier tout le code source
COPY . .

# Construire l'application pour la production
RUN npm run build

# Étape finale pour servir l'application avec un serveur statique
FROM node:16-alpine AS production-stage
WORKDIR /app

# Installer un serveur statique
RUN npm install -g serve

# Copier les fichiers de construction depuis l'étape de construction
COPY --from=build-stage /app/dist /app/dist

# Exposer le port utilisé par serve
EXPOSE 5000

# Lancer l'application
CMD ["serve", "-s", "dist"]
