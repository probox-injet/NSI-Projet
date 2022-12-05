@echo off
git init
git add README.md
git commit -m "initialisation du projet"
git remote add origin https://github.com/probox-injet/NSI-Projet.git
git push -u origin main
pause