## Transformation Access vers SQL
Ouvrir « Bullzip MS Access to Mysql »
Fichier source : « D:\archives ocas\archives\OCAS 2018\gretacod.mdb »
Fichier destination : D:\archives ocas\dump2016.sql

## Scripts

Sur linux. `mdp : root`
 En console en root (mdp compte ltabur: root)
```atom /media/sf_D_DRIVE/archives ocas/adaptation/propre```
Le script se décompose en 2 parties. La premiere écrit les requetes d'insertion des stagiaires et des feuilles d'émargement, les intervenants, la deuxieme ecrit les liens entre les sessions, les stagiaires et les intervenants.

### Execution des scripts

1. Dans atom, ouvrir le fichier partie1.py
2. aller à la fin du script et changer l'argument de la fonction par : `writeAllData('2018')`
3. importer 2018-1.sql dans la base « ocas-sf »  `(mdp:root)`
4. exporter toute la base vers partie2-in.sql
5. Ouvrir « partie2.py »
6. aller à la fin du script et changer l'argument de la fonction par : `writeAllData('2018')`
7. lancer le script
8. importer 2018-2.sql dans la base « ocas-sf »
