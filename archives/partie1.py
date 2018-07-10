#!/usr/bin/python
# -*- coding: utf-8 -*-

######
## fonctionnement
## on lance la partie 1  sur le fichier sql de la base Access
## verifier s'il existe des agences, des libellés de formation et des intervenants qui ne sont pas encore dans la base
## si c'est le cas alors il faut commencer par les rentrer dans la base
## pour les agences : les rentrer a la main et ajouter l'id dans la liste de if
## pour les libellés de formation : lancer le script et insérer les requetes dans la base apres avoir verifier qu'elle n'existe pas sous un nom différent
## pour les intervenants
## on import le nouveau fichier sql (annee-1.sql) dans la nouvelle base
## on recupere les données de la nouvelle base (partie2-in.sql) (on a donc les ## données avec un id)
## on lance la partie 2 sur le fichier 2
## on importe les données de annee-2.sql dans la nouvelle base
########

import utils

def findLibelleId(libelle,libelle_php):
    libelle_formation_id=0


    if libelle in '30ÈMES JOURNÉES PROFESSIONNELLES ANACFOC' or '30ÈMES JOURNÉES PROFESSIONNELLES ANACFOC' in libelle:
        libelle_formation_id=8

    if libelle in 'ACCOMPAGNEMENT AU DOSSIER "RAEP"' or 'ACCOMPAGNEMENT AU DOSSIER "RAEP"' in libelle:
        libelle_formation_id=303
    if libelle in 'ACCOMPAGNEMENT AU DOSSIER @RAEP@' or  'ACCOMPAGNEMENT AU DOSSIER @RAEP@' in libelle:
        libelle_formation_id=303

    if libelle in 'ACCOMPAGNEMENT DÉPLOIEMENT PROGRE DANS LES GRETA' or 'ACCOMPAGNEMENT DÉPLOIEMENT PROGRE DANS LES GRETA' in libelle:
        libelle_formation_id=322

    if libelle in 'ACCOMPAGNEMENT DES CANDIDATS AUX CONCOURS CPIF' or 'ACCOMPAGNEMENT DES CANDIDATS AUX CONCOURS CPIF' in libelle:
        libelle_formation_id=242

    if libelle in 'ACCOMPAGNEMENT ENTREPRISE : PRATIQUES ET OUTILS' or 'ACCOMPAGNEMENT ENTREPRISE : PRATIQUES ET OUTILS' in libelle:
        libelle_formation_id=323

    if libelle in 'ACCOMPAGNEMENT INDIVIDUALISÉ PROGRÉ' or 'ACCOMPAGNEMENT INDIVIDUALISÉ PROGRÉ' in libelle:
        libelle_formation_id=324

    if libelle in 'ACCOMPAGNEMENT PÉDAGOGIQUE SUR SITE' or 'ACCOMPAGNEMENT PÉDAGOGIQUE SUR SITE' in libelle:
        libelle_formation_id=304

    if libelle in 'ACCOMPAGNER DES PARCOURS INDIVIDUEL DE FORMATION' or 'ACCOMPAGNER DES PARCOURS INDIVIDUEL DE FORMATION' in libelle:
        libelle_formation_id=268

    if libelle in 'ACCOMPAGNER LES STAGIAIRES EN SITUATION D@ADDICTION' or 'ACCOMPAGNER LES STAGIAIRES EN SITUATION D@ADDICTION' in libelle:
        libelle_formation_id=20

    if libelle in 'ACCOMPAGNER UN PARCOURS INDIVIDUEL DE FORMATION' or 'ACCOMPAGNER UN PARCOURS INDIVIDUEL DE FORMATION' in libelle:
        libelle_formation_id=325
    if libelle in 'ACCUEIL DES NOUVEAUX PERSONNELS DANS LE RÉSEAU DES GRETA' or 'ACCUEIL DES NOUVEAUX PERSONNELS DANS LE RÉSEAU DES GRETA' in libelle:
        libelle_formation_id=9
    if libelle in 'ACCUEIL DES NOUVEAUX PERSONNELS DAN SLE RÉSEAU DES GRETA' or 'ACCUEIL DES NOUVEAUX PERSONNELS DAN SLE RÉSEAU DES GRETA' in libelle:
        libelle_formation_id=9

    if libelle in 'ACCUEIL DES PUBLICS' or 'ACCUEIL DES PUBLICS' in libelle:
        libelle_formation_id=326

    if libelle in 'ACCUEIL TÉLÉPHONIQUE ET PHYSIQUE' or 'ACCUEIL TÉLÉPHONIQUE ET PHYSIQUE' in libelle:
        libelle_formation_id=215

    if libelle in 'ACCUEILLIR ET PRENDRE EN CHARGE UN PUBLIC DIFFICILE' or 'ACCUEILLIR ET PRENDRE EN CHARGE UN PUBLIC DIFFICILE' in libelle:
        libelle_formation_id=10
    if libelle in 'ACCUEILLIR ET PRENDRE EN CHARGE UN PUBLIC EN SITUATION DIFFI' or 'ACCUEILLIR ET PRENDRE EN CHARGE UN PUBLIC EN SITUATION DIFFI' in libelle:
        libelle_formation_id=10

    if libelle in 'ACTION COMMERCIALE - NIVEAU 2' or 'ACTION COMMERCIALE - NIVEAU 2' in libelle:
        libelle_formation_id=12

    if libelle in 'ACTIVOLOG : APPRENDRE À APPRENDRES EN ACTES' or 'ACTIVOLOG : APPRENDRE À APPRENDRES EN ACTES' in libelle:
        libelle_formation_id=327

    if libelle in 'ACTIVOLOG : RETOUR DE PRATIQUES' or 'ACTIVOLOG : RETOUR DE PRATIQUES' in libelle:
        libelle_formation_id=328

    if libelle in 'ACTUALISATION DES COMPÉTENCES DES ACCOMPAGNATEURS VAE' or 'ACTUALISATION DES COMPÉTENCES DES ACCOMPAGNATEURS VAE' in libelle:
        libelle_formation_id=329

    if libelle in 'ACTUALITÉ DE LA DE LA FORMATION PROFESSIONNELLE CONTINUE' or 'ACTUALITÉ DE LA DE LA FORMATION PROFESSIONNELLE CONTINUE' in libelle:
        libelle_formation_id=269

    if libelle in 'ACTUALITÉ DE LA RÈGLEMENTATION SUR LA FORMATION PROFESSIONNE' or 'ACTUALITÉ DE LA RÈGLEMENTATION SUR LA FORMATION PROFESSIONNE' in libelle:
        libelle_formation_id=334

    if libelle in 'ADAPTATION DES PRATIQUES D@AUDIT AU CIBC' or 'ADAPTATION DES PRATIQUES D@AUDIT AU CIBC' in libelle:
        libelle_formation_id=305

    if libelle in 'AGORA PROJECT'  or 'AGORA PROJECT' in libelle:
        libelle_formation_id=270

    if libelle in 'ANIMER UN RÉSEAU SOCIAL' or 'ANIMER UN RÉSEAU SOCIAL' in libelle:
        libelle_formation_id=335

    if libelle in 'ANIMER UNE CLASSE VIRTUELLE' or 'ANIMER UNE CLASSE VIRTUELLE' in libelle:
        libelle_formation_id=245

    if libelle in 'ANIMER UN CLASSE VIRTUELLE' or 'ANIMER UN CLASSE VIRTUELLE' in libelle:
        libelle_formation_id=245

    if libelle in 'ANIMER UNE SITUATION DIDACTISÉE...... DES COMPÉTENCES CLÉS' or 'ANIMER UNE SITUATION DIDACTISÉE...... DES COMPÉTENCES CLÉS' in libelle:
        libelle_formation_id=306

    if libelle in 'APP CENTRE DE RESOURCES ET FOAD' or 'APP CENTRE DE RESOURCES ET FOAD' in libelle:
        libelle_formation_id=336

    if libelle in 'APPEL D@OFFRE : ANALYSE ET COMPRÉHENSION DES DOCUMENTS' or 'APPEL D@OFFRE : ANALYSE ET COMPRÉHENSION DES DOCUMENTS' in libelle:
        libelle_formation_id=337

    if libelle in 'APPRENDRE À APPRENDRE' or 'APPRENDRE À APPRENDRE' in libelle:
        libelle_formation_id=338

    if libelle in 'APPROCHE ACTIONNELLE EN FRANÇAIS ET HISTOIRE-GÉO' or 'APPROCHE ACTIONNELLE EN FRANÇAIS ET HISTOIRE-GÉO' in libelle:
        libelle_formation_id=339

    if libelle in 'APPROCHE PROCESSUS ET MANUEL QUALITÉ' or 'APPROCHE PROCESSUS ET MANUEL QUALITÉ' in libelle:
        libelle_formation_id=340

    if libelle in 'APPROPRIATION DE LA MALLETTE PÉDAGOGIQUE ECOFAB' or 'APPROPRIATION DE LA MALLETTE PÉDAGOGIQUE ECOFAB' in libelle:
        libelle_formation_id=265

    if libelle in 'ASSURER LA MISSION DE FORMATEUR-RÉFÉRENT PÉDAGOGIQUE' or 'ASSURER LA MISSION DE FORMATEUR-RÉFÉRENT PÉDAGOGIQUE' in libelle:
        libelle_formation_id=13
    if libelle in 'ASSURER LA MISSION DE FORMATEUR -RÉFÉRENT PÉDAQGOGIQUE' or 'ASSURER LA MISSION DE FORMATEUR -RÉFÉRENT PÉDAQGOGIQUE' in libelle:
        libelle_formation_id=13

    if libelle in 'ASSURER LES FONCTIONS DE COORDONNATEUR ORGANISME' or 'ASSURER LES FONCTIONS DE COORDONNATEUR ORGANISME' in libelle:
        libelle_formation_id=341

    if libelle in 'AUDIT INTERNE ET RÉFÉRENTIEL RBP-X50-762' or 'AUDIT INTERNE ET RÉFÉRENTIEL RBP-X50-762' in libelle:
        libelle_formation_id=271

    if libelle in 'AUDITEUR GRETAPLUS' or 'AUDITEUR GRETAPLUS' in libelle:
        libelle_formation_id=344

    if libelle in 'AUDITS NATIONAUX ET ACADÉMIQUES' or 'AUDITS NATIONAUX ET ACADÉMIQUES' in libelle:
        libelle_formation_id=345

    if libelle in 'AUTRE LECTURE DES RÉFÉRENTIELS' or 'AUTRE LECTURE DES RÉFÉRENTIELS' in libelle:
        libelle_formation_id=346

    if libelle in 'BAC PRO 3 ANS ET NOUVEAUX PROGRAMMES' or 'BAC PRO 3 ANS ET NOUVEAUX PROGRAMMES' in libelle:
        libelle_formation_id=347

    if libelle in 'BAC PRO 3 ANS ET STI' or 'BAC PRO 3 ANS ET STI' in libelle:
        libelle_formation_id=348

    if libelle in 'CAP CUISINE' or 'CAP CUISINE' in libelle:
        libelle_formation_id=349

    if libelle in 'CAP MODULARISATION CUISINE' or 'CAP MODULARISATION CUISINE' in libelle:
        libelle_formation_id=350

    if libelle in 'CAP PETITE ENFANCE' or 'CAP PETITE ENFANCE' in libelle:
        libelle_formation_id=351

    if libelle in 'CCF EN LANGUES VIVANTES' or 'CCF EN LANGUES VIVANTES' in libelle:
        libelle_formation_id=352

    if libelle in 'CENTRE DE RESSOURCES : MUTATIONS ET DÉVELOPPEMENTS ?' or 'CENTRE DE RESSOURCES : MUTATIONS ET DÉVELOPPEMENTS ?' in libelle:
        libelle_formation_id=353

    if libelle in 'CENTRE DE RESSOURCES : ORGANISER SA VEILLE PROFESSIONNELLE' or 'CENTRE DE RESSOURCES : ORGANISER SA VEILLE PROFESSIONNELLE' in libelle:
        libelle_formation_id=14

    if libelle in 'CENTRE DE RESSOURCES : QUELLES PRATIQUES ?' or 'CENTRE DE RESSOURCES : QUELLES PRATIQUES ?' in libelle:
        libelle_formation_id=354

    if libelle in 'CERTIFICATION CLÉA : HARMONISER LES PRATIQUES D@ÉVALUATION' or 'CERTIFICATION CLÉA : HARMONISER LES PRATIQUES D@ÉVALUATION' in libelle:
        libelle_formation_id=6
    if libelle in 'HARMONISER LES PRATIQUES D@ÉVALUATION' or 'HARMONISER LES PRATIQUES D@ÉVALUATION' in libelle:
        libelle_formation_id=6

    if libelle in 'CHANTIER "RESSOURCES EXCEL 2007"' or 'CHANTIER "RESSOURCES EXCEL 2007"' in libelle:
        libelle_formation_id=355

    if libelle in 'CIBC - DOCUMENT DE SYNTHÈSE : CONFRONTER ET ANALYSER SA PRAT' or 'CIBC - DOCUMENT DE SYNTHÈSE : CONFRONTER ET ANALYSER SA PRAT' in libelle:
        libelle_formation_id=356
    if libelle in 'CIBC - DOCUMENT DE SYNTHÈSE : CONFRONTER ET ANALYSER SA PRATIQUE' or 'CIBC - DOCUMENT DE SYNTHÈSE : CONFRONTER ET ANALYSER SA PRATIQUE' in libelle:
        libelle_formation_id=1

    if libelle in 'CIBC : ÉCHANGES DE PRATIQUES' or 'CIBC : ÉCHANGES DE PRATIQUES' in libelle:
        libelle_formation_id=307

    if libelle in 'CIBC : HARMONISATION DES SYNTHÈSES DE BILAN DE COMPÉTENCES' or 'CIBC : HARMONISATION DES SYNTHÈSES DE BILAN DE COMPÉTENCES' in libelle:
        libelle_formation_id=259

    if libelle in 'CIBC : MODULARITÉ DU BILAN' or 'CIBC : MODULARITÉ DU BILAN' in libelle:
        libelle_formation_id=388

    if libelle in 'CIBC : SYNTHÈSE BILAN DE COMPÉTENCES' or 'CIBC : SYNTHÈSE BILAN DE COMPÉTENCES' in libelle:
        libelle_formation_id=308

    if libelle in 'CIBC : TESTING' or 'CIBC : TESTING' in libelle:
        libelle_formation_id=263

    if libelle in 'CIBC@ BILAN' or 'CIBC@ BILAN' in libelle:
        libelle_formation_id=267

    if libelle in 'CIVITAS : PERFECTIONNEMENT RH' or 'CIVITAS : PERFECTIONNEMENT RH' in libelle:
        libelle_formation_id=505

    if libelle in 'COMMUNICATION ET CIRCUITS INTERNES ET EXTERNES D@INFORMATION' or 'COMMUNICATION ET CIRCUITS INTERNES ET EXTERNES D@INFORMATION' in libelle:
        libelle_formation_id=393

    if libelle in 'COMMUNICATION GRAPHIQUE' or 'COMMUNICATION GRAPHIQUE' in libelle:
        libelle_formation_id=394

    if libelle in 'COMMUNICATION  PRESSE'  or 'COMMUNICATION  PRESSE' in libelle:
        libelle_formation_id=395

    if libelle in 'COMPRENDRE ET RÉFLÉCHIR' or 'COMPRENDRE ET RÉFLÉCHIR' in libelle:
        libelle_formation_id=396

    if libelle in 'CONCEVOIR ET ANIMER UNE..... COMPÉTENCES CLÉS - ERREFOM' or 'CONCEVOIR ET ANIMER UNE..... COMPÉTENCES CLÉS - ERREFOM' in libelle:
        libelle_formation_id=309

    if libelle in 'CONDUIRE UN CHANTIER FORMATION ELANS' or 'CONDUIRE UN CHANTIER FORMATION ELANS' in libelle:
        libelle_formation_id=401

    if libelle in 'CONSEIL À L@INTERNE - NIVEAU 2' or 'CONSEIL À L@INTERNE - NIVEAU 2' in libelle:
        libelle_formation_id=15

    if libelle in 'CONSTRUCTION D@UNE SITUATION EN CCF' or 'CONSTRUCTION D@UNE SITUATION EN CCF' in libelle:
        libelle_formation_id=402

    if libelle in 'CONSTRUIRE - CONDUIRE UNE SÉQUENCE DE FORMATION' or 'CONSTRUIRE - CONDUIRE UNE SÉQUENCE DE FORMATION' in libelle:
        libelle_formation_id=403

    if libelle in 'CONSTRUIRE - CONDUIRE UNE SÉQUENCE PÉDAGOGIQUE' or 'CONSTRUIRE - CONDUIRE UNE SÉQUENCE PÉDAGOGIQUE' in libelle:
        libelle_formation_id=276

    if libelle in 'CONSTRUIRE ET ANIMER UN PARCOURS DE FORMATION MULTIMODAL' or 'CONSTRUIRE ET ANIMER UN PARCOURS DE FORMATION MULTIMODAL' in libelle:
        libelle_formation_id=404

    if libelle in 'CONSTRUIRE ET ANIMER UN PARTENARIAT' or 'CONSTRUIRE ET ANIMER UN PARTENARIAT' in libelle:
        libelle_formation_id=405

    if libelle in 'CONSTRUIRE UN SCÉNARIO PÉDAGOGIQUE MULTIMODAL' or 'CONSTRUIRE UN SCÉNARIO PÉDAGOGIQUE MULTIMODAL' in libelle:
        libelle_formation_id=310

    if libelle in 'CRÉATION DE SUPPORTS DE PRÉSENTATION DYNAMIQUE' or 'CRÉATION DE SUPPORTS DE PRÉSENTATION DYNAMIQUE' in libelle:
        libelle_formation_id=248

    if libelle in 'CRÉER DES RESSOURCES PÉDAGOGIQUES NUMÉRIQUES' or 'CRÉER DES RESSOURCES PÉDAGOGIQUES NUMÉRIQUES' in libelle:
        libelle_formation_id=311

    if libelle in 'DD : CHANGEMENT CLIMATIQUE EN NORMANDIE' or 'DD : CHANGEMENT CLIMATIQUE EN NORMANDIE' in libelle:
        libelle_formation_id=3
    if libelle in 'DÉVELOPPEMENT DURABLE : CHANGEMENT CLIMATIQUE EN NORMARNDIE' or 'DÉVELOPPEMENT DURABLE : CHANGEMENT CLIMATIQUE EN NORMARNDIE' in libelle:
        libelle_formation_id=3

    if libelle in 'DÉCOUVERTE ET INTÉGRATION DU MODULE E-LEARNING T\\@PRO' or 'DÉCOUVERTE ET INTÉGRATION DU MODULE E-LEARNING T\\@PRO' in libelle:
        libelle_formation_id=216
    if libelle in 'DÉCOUVERTE ET INTÉGRATION DU MODULE E-LEARNING T@PRO' or 'DÉCOUVERTE ET INTÉGRATION DU MODULE E-LEARNING T@PRO' in libelle:
        libelle_formation_id=216

    if libelle in 'DÉMARCHE ACTIONNELLE EN ANGLAIS : ÉVALUATION DES STAGIAIRES' or 'DÉMARCHE ACTIONNELLE EN ANGLAIS : ÉVALUATION DES STAGIAIRES' in libelle:
        libelle_formation_id=249

    if libelle in 'DÉMARCHE ACTIONNELLE EN FORMATION D@ANGLAIS' or 'DÉMARCHE ACTIONNELLE EN FORMATION D@ANGLAIS' in libelle:
        libelle_formation_id=312

    if libelle in 'DÉMARCHE GPEC : COMPÉTENCES ATTENDUES' or 'DÉMARCHE GPEC : COMPÉTENCES ATTENDUES' in libelle:
        libelle_formation_id=277

    if libelle in 'DÉMARCHE PRAP POUR CFC' or 'DÉMARCHE PRAP POUR CFC' in libelle:
        libelle_formation_id=313

    if libelle in 'DES COMPÉTENCES ET DES INGÉNIERIES' or 'DES COMPÉTENCES ET DES INGÉNIERIES' in libelle:
        libelle_formation_id=278

    if libelle in 'DÉVELOPPEMENT DES COMPÉTENCES ÉCO-CITOYENNES' or 'DÉVELOPPEMENT DES COMPÉTENCES ÉCO-CITOYENNES' in libelle:
        libelle_formation_id=266

    if libelle in 'DÉVELOPPEMENT DURABLE : CHANGEMENT CLIMATIQUE EN NORMANDIE' or 'DÉVELOPPEMENT DURABLE : CHANGEMENT CLIMATIQUE EN NORMANDIE' in libelle:
        libelle_formation_id=16

    if libelle in 'DÉVELOPPER DES COMPÉTENCES ÉCO-CITOYENNES' or 'DÉVELOPPER DES COMPÉTENCES ÉCO-CITOYENNES' in libelle:
        libelle_formation_id=314

    if libelle in 'DEVENIR ÉVALUATEUR B2I ADULTES' or 'DEVENIR ÉVALUATEUR B2I ADULTES' in libelle:
        libelle_formation_id=17

    if libelle in 'DEVENIR FORMATEUR HABILITÉ À LA PRATIQUE DU CCF' or 'DEVENIR FORMATEUR HABILITÉ À LA PRATIQUE DU CCF' in libelle:
        libelle_formation_id=74
    if libelle in 'DEVENIR FORMATEUR HABILITÉ À LA PRATIQUE DU CFF' or 'DEVENIR FORMATEUR HABILITÉ À LA PRATIQUE DU CFF' in libelle:
        libelle_formation_id=74

    if libelle in 'DEVENIR FORMATEUR PRAXIBAT' or 'DEVENIR FORMATEUR PRAXIBAT' in libelle:
        libelle_formation_id=261

    if libelle in 'DISPOSITIF RÉUSSIR  PFB  PFG : APPRENDRE À APPRENDRE' or 'DISPOSITIF RÉUSSIR  PFB  PFG : APPRENDRE À APPRENDRE' in libelle:
        libelle_formation_id=11

    if libelle in 'ECHANGES DE PRATIQUES SUR LE POSITIONNEMENT PÉDAGO. DES STAG' or 'ECHANGES DE PRATIQUES SUR LE POSITIONNEMENT PÉDAGO. DES STAG' in libelle:
        libelle_formation_id=315

    if libelle in 'ECO-CONSTRUCTION' or 'ECO-CONSTRUCTION' in libelle:
        libelle_formation_id=414

    if libelle in 'EDUCATION AUX ÉCRANS' or 'EDUCATION AUX ÉCRANS' in libelle:
        libelle_formation_id=257

    if libelle in 'EFFICACITÉ ÉNERGÉTIQUE' or 'EFFICACITÉ ÉNERGÉTIQUE' in libelle:
        libelle_formation_id=506

    if libelle in 'ELABORER UN PROJET DE FORMATION ÉCO-CITOYEN' or 'ELABORER UN PROJET DE FORMATION ÉCO-CITOYEN' in libelle:
        libelle_formation_id=417

    if libelle in 'ELABORER UN RÉFÉRENTIEL DE COMPÉTENCES' or 'ELABORER UN RÉFÉRENTIEL DE COMPÉTENCES' in libelle:
        libelle_formation_id=418

    if libelle in 'ENSEIGNER ET ÉVALUER LA PRÉVENTION SANTÉ ENVIRONNEMENT (PSE)' or 'ENSEIGNER ET ÉVALUER LA PRÉVENTION SANTÉ ENVIRONNEMENT (PSE)' in libelle:
        libelle_formation_id=279

    if libelle in 'ETRE ÉCO-CITOYEN DANS SON ESPACE DE TRAVAIL' or 'ETRE ÉCO-CITOYEN DANS SON ESPACE DE TRAVAIL' in libelle:
        libelle_formation_id=217

    if libelle in 'EVALUER LES ACQUIS DE FORMATION ET LES RECONNAÎTRE' or 'EVALUER LES ACQUIS DE FORMATION ET LES RECONNAÎTRE' in libelle:
        libelle_formation_id=280

    if libelle in 'EVOLUTION JURIDIQUE DE LA FORMATION CONTINUE DES ADULTES' or 'EVOLUTION JURIDIQUE DE LA FORMATION CONTINUE DES ADULTES' in libelle:
        libelle_formation_id=218

    if libelle in 'EVOLUTION JURIDIQUE DE LA FORMATION PROFESSIONNELLE CONTINUE' or 'EVOLUTION JURIDIQUE DE LA FORMATION PROFESSIONNELLE CONTINUE' in libelle:
        libelle_formation_id=421

    if libelle in 'EXAMINATEUR DCL ANGLAIS' or 'EXAMINATEUR DCL ANGLAIS' in libelle:
        libelle_formation_id=422

    if libelle in 'EXCEL MACRO VBA' or 'EXCEL MACRO VBA' in libelle:
        libelle_formation_id=254

    if libelle in 'EXPLOITER EGRETA - VERSION 6' or 'EXPLOITER EGRETA - VERSION 6' in libelle:
        libelle_formation_id=423

    if libelle in 'FAIRE FACE AUX SITUATIONS D@ACCUEIL DIFFICILES' or 'FAIRE FACE AUX SITUATIONS D@ACCUEIL DIFFICILES' in libelle:
        libelle_formation_id=424

    if libelle in 'FEEBAT 3.1 ET 3.2 : ISOLATION DES MURS - PLANCHERS....' or 'FEEBAT 3.1 ET 3.2 : ISOLATION DES MURS - PLANCHERS.' in libelle:
        libelle_formation_id=281

    if libelle in 'FEEBAT 5.2 : METTRE EN OEUVRE DES BÂTIMENTS RT 2012' or 'FEEBAT 5.2 : METTRE EN OEUVRE DES BÂTIMENTS RT 2012' in libelle:
        libelle_formation_id=282

    if libelle in 'FOAD SUR LA PRÉVENTION DES RISQUES PROFESSIONNELS (PRP)' or 'FOAD SUR LA PRÉVENTION DES RISQUES PROFESSIONNELS (PRP)' in libelle:
        libelle_formation_id=256

    if libelle in 'FONCTION ACCUEIL : MIEUX ORIENTER LES PUBLICS' or 'FONCTION ACCUEIL : MIEUX ORIENTER LES PUBLICS' in libelle:
        libelle_formation_id=425

    if libelle in 'FORMATEURS ET DÉMARCHE COMMERCIALE' or 'FORMATEURS ET DÉMARCHE COMMERCIALE' in libelle:
        libelle_formation_id=426

    if libelle in 'FORMATION À L@OUTIL CRM SUGAR' or 'FORMATION À L@OUTIL CRM SUGAR' in libelle:
        libelle_formation_id=316

    if libelle in 'FORMATION DE FORMATEURS RÉFÉRENTS PÉDAGOGIQUES' or 'FORMATION DE FORMATEURS RÉFÉRENTS PÉDAGOGIQUES' in libelle:
        libelle_formation_id=283

    if libelle in 'FORMATION DES CHEFS D@ÉTABLISSEMENT ARRIVANT EN GRETA' or 'FORMATION DES CHEFS D@ÉTABLISSEMENT ARRIVANT EN GRETA' in libelle:
        libelle_formation_id=321

    if libelle in 'FORMATION DES CONSEILLERS EN FORMATION CONTINUE STAGIAIRE' or 'FORMATION DES CONSEILLERS EN FORMATION CONTINUE STAGIAIRE' in libelle:
        libelle_formation_id=284

    if libelle in 'FORMATION GFC RCBC' or 'FORMATION GFC RCBC' in libelle:
        libelle_formation_id=285

    if libelle in 'FORMATION  INFOGRAPHIE' or 'FORMATION  INFOGRAPHIE' in libelle:
        libelle_formation_id=286

    if libelle in 'INFOGRAPHIE' or 'INFOGRAPHIE' in libelle:
        libelle_formation_id=286

    if libelle in 'FORMATION PRAP IBC' or 'FORMATION PRAP IBC' in libelle:
        libelle_formation_id=504

    if libelle in 'FORMATION SUGAR CRM' or 'FORMATION SUGAR CRM' in libelle:
        libelle_formation_id=219

    if libelle in 'GESTION ADMINISTRATIVE DU FINANCEMENT DU CPF' or 'GESTION ADMINISTRATIVE DU FINANCEMENT DU CPF' in libelle:
        libelle_formation_id=220

    if libelle in 'GFA - ATTITUDES PROFESSIONNELLES ET IMAGE DE SOI' or 'GFA - ATTITUDES PROFESSIONNELLES ET IMAGE DE SOI' in libelle:
        libelle_formation_id=238

    if libelle in 'GFA - HARMONISATION DES PRATIQUES EN CENTRE DE RESSOURCES' or 'GFA - HARMONISATION DES PRATIQUES EN CENTRE DE RESSOURCES' in libelle:
        libelle_formation_id=250

    if libelle in 'GFA - L@ÉVALUATION DES ACQUIS EN FIN DE FORMATION' or 'GFA - L@ÉVALUATION DES ACQUIS EN FIN DE FORMATION' in libelle:
        libelle_formation_id=258

    if libelle in 'GFA - POSITIONNEMENT PÉDAGOGIQUE PFB/PFG' or 'GFA - POSITIONNEMENT PÉDAGOGIQUE PFB/PFG' in libelle:
        libelle_formation_id=255

    if libelle in 'GFA - SITUATIONS DIDACTISÉES EN SANITAIRE ET SOCIAL' or 'GFA - SITUATIONS DIDACTISÉES EN SANITAIRE ET SOCIAL' in libelle:
        libelle_formation_id=247

    if libelle in 'GFA BUREAUTIQUE : OFFRE DE FORMATION TOSA DIGITAL' or 'GFA BUREAUTIQUE : OFFRE DE FORMATION TOSA DIGITAL' in libelle:
        libelle_formation_id=221

    if libelle in 'GFA COMPTABILITÉ : LES TRAVAUX D\\@INVENTAIRE' or 'GFA COMPTABILITÉ : LES TRAVAUX D\\@INVENTAIRE' in libelle:
        libelle_formation_id=222

    if libelle in 'GFA DFTLV - CONSTRUCTION DE SITUATIONS DIDACTISÉES À VISÉE..' or 'GFA DFTLV - CONSTRUCTION DE SITUATIONS DIDACTISÉES À VISÉE.' in libelle:
        libelle_formation_id=243

    if libelle in 'GFA NUMÉRIQUE - UTILISATION DES RÉSEAUX SOCIAUX EN FORMATION' or 'GFA NUMÉRIQUE - UTILISATION DES RÉSEAUX SOCIAUX EN FORMATION' in libelle:
        libelle_formation_id=253

    if libelle in 'GFA ORIENTATION-INSERTION - APPRENDRE À APPRENDRE' or 'GFA ORIENTATION-INSERTION - APPRENDRE À APPRENDRE' in libelle:
        libelle_formation_id=251

    if libelle in 'GROUPE DE TRAVAIL MULTIMODALITÉ - POSITIONNEMENT' or 'GROUPE DE TRAVAIL MULTIMODALITÉ - POSITIONNEMENT' in libelle:
        libelle_formation_id=287

    if libelle in 'GROUPE DE TRAVAIL RH MANAGEMENT' or 'GROUPE DE TRAVAIL RH MANAGEMENT' in libelle:
        libelle_formation_id=431

    if libelle in 'HABILITATION DES ÉVALUATEURS B2I ADULTES' or 'HABILITATION DES ÉVALUATEURS B2I ADULTES' in libelle:
        libelle_formation_id=262

    if libelle in 'HABILITATION DES FORMATEURS À LA PRATIQUE DU CCF' or 'HABILITATION DES FORMATEURS À LA PRATIQUE DU CCF' in libelle:
        libelle_formation_id=264

    if libelle in 'HABILITATION ÉLECTRIQUE BO-B1-BC-BR' or 'HABILITATION ÉLECTRIQUE BO-B1-BC-BR' in libelle:
        libelle_formation_id=432

    if libelle in 'INCIDENCE DU NUMÉRIQUE DANS LES PRATIQUES DE CFC' or 'INCIDENCE DU NUMÉRIQUE DANS LES PRATIQUES DE CFC' in libelle:
        libelle_formation_id=223
    if libelle in 'INTÉGRER L@UTILISATION DES TABLETTES NUMÉRIQUES...'  or 'INTÉGRER L@UTILISATION DES TABLETTES NUMÉRIQUES.' in libelle:
        libelle_formation_id=7
    if libelle in 'INTÉGRER L@UTILISATION DE TABLETTES NUMÉRIQUES DANS SA PRATI'  or 'INTÉGRER L@UTILISATION DE TABLETTES NUMÉRIQUES DANS SA PRATI' in libelle:
        libelle_formation_id=7

    if libelle in 'INTÉGRER LA MULTIMODALITÉ DANS MES PRATIQUES PÉDAGOGIQUES' or 'INTÉGRER LA MULTIMODALITÉ DANS MES PRATIQUES PÉDAGOGIQUES' in libelle:
        libelle_formation_id=224

    if libelle in 'INTÉGRER LES RÉSEAUX SOCIAUX AU QUOTIDIEN DANS SON TRAVAIL' or 'INTÉGRER LES RÉSEAUX SOCIAUX AU QUOTIDIEN DANS SON TRAVAIL' in libelle:
        libelle_formation_id=225

    if libelle in 'JOURNÉE DE FORMATION PRAP' or 'JOURNÉE DE FORMATION PRAP' in libelle:
        libelle_formation_id=288

    if libelle in 'JOURNÉE DE SENSIBILISATION PRAXIBAT - PAROIS OPAQUES ET VENT' or 'JOURNÉE DE SENSIBILISATION PRAXIBAT - PAROIS OPAQUES ET VENT' in libelle:
        libelle_formation_id=435

    if libelle in 'JOURNÉE DES ACCOMPAGNATEURS VAE' or 'JOURNÉE DES ACCOMPAGNATEURS VAE' in libelle:
        libelle_formation_id=436

    if libelle in 'JOURNÉE SUR LA LOI DE 2005' or 'JOURNÉE SUR LA LOI DE 2005' in libelle:
        libelle_formation_id=437

    if libelle in 'JOURNÉES PROFESSIONNELLES ANACFOC' or 'JOURNÉES PROFESSIONNELLES ANACFOC' in libelle:
        libelle_formation_id=289

    if libelle in 'L@ACCOMPAGNEMENT DANS UN DISPOSITIF DE FORMATION MULTIMODAL' or 'L@ACCOMPAGNEMENT DANS UN DISPOSITIF DE FORMATION MULTIMODAL' in libelle:
        libelle_formation_id=438

    if libelle in 'L@ACCOMPAGNEMENT DES DEMANDEURS D@EMPLOI' or 'L@ACCOMPAGNEMENT DES DEMANDEURS D@EMPLOI' in libelle:
        libelle_formation_id=439

    if libelle in 'L@ACCOMPAGNEMENT VAE DES DIPLÔMES DE LA DRJSCS' or 'L@ACCOMPAGNEMENT VAE DES DIPLÔMES DE LA DRJSCS' in libelle:
        libelle_formation_id=440

    if libelle in 'L@APPROCHE ACTIONNELLE EN LANGUES VIVANTES' or 'L@APPROCHE ACTIONNELLE EN LANGUES VIVANTES' in libelle:
        libelle_formation_id=441

    if libelle in 'L@ÉGALITÉ PROFESSIONNELLE EN ENTREPRISE' or 'L@ÉGALITÉ PROFESSIONNELLE EN ENTREPRISE' in libelle:
        libelle_formation_id=442

    if libelle in 'L@ENTRETIEN D@AIDE ET D@EXPLICITATION' or 'L@ENTRETIEN D@AIDE ET D@EXPLICITATION' in libelle:
        libelle_formation_id=443

    if libelle in 'L@ENTRETIEN D@EXPLICITATION' or 'L@ENTRETIEN D@EXPLICITATION' in libelle:
        libelle_formation_id=244

    if libelle in 'L\\@INTÉGRATION DE L\\@APPROCHE NUMÉRIQUE DANS LE BÂTIMENT' or 'L\\@INTÉGRATION DE L\\@APPROCHE NUMÉRIQUE DANS LE BÂTIMENT' in libelle:
        libelle_formation_id=226

    if libelle in 'LA CARTE HEURISTIQUE : UN OUTIL PÉDAGOGIQUE' or 'LA CARTE HEURISTIQUE : UN OUTIL PÉDAGOGIQUE' in libelle:
        libelle_formation_id=246

    if libelle in 'LES PROCÉDURES RÉGLEMENTAIRES POUR UNE FORMATION DIPLOMANTES' or 'LES PROCÉDURES RÉGLEMENTAIRES POUR UNE FORMATION DIPLOMANTES' in libelle:
        libelle_formation_id=507

    if libelle in 'LES SIMULATIONS GLOBALES' or 'LES SIMULATIONS GLOBALES' in libelle:
        libelle_formation_id=481

    if libelle in 'LES SITUATIONS PROFESSIONNELLES COMME CONSTRUCTION DES APPRE' or 'LES SITUATIONS PROFESSIONNELLES COMME CONSTRUCTION DES APPRE' in libelle:
        libelle_formation_id=482

    if libelle in 'LUTTER CONTRE L@ILLETTRISME AVEC LES PARENTS' or 'LUTTER CONTRE L@ILLETTRISME AVEC LES PARENTS' in libelle:
        libelle_formation_id=290

    if libelle in 'MAC HABILITATION ÉLECTRIQUE' or 'MAC HABILITATION ÉLECTRIQUE' in libelle:
        libelle_formation_id=511

    if libelle in 'MAC SST (MAINTIEN ET ACTUALISATION DES CONNAISSANCES)' or 'MAC SST (MAINTIEN ET ACTUALISATION DES CONNAISSANCES)' in libelle:
        libelle_formation_id=483

    if libelle in 'MAÎTRISE DES COMPÉTENCES CLÉS ET DU RCCSP' or 'MAÎTRISE DES COMPÉTENCES CLÉS ET DU RCCSP' in libelle:
        libelle_formation_id=484

    if libelle in 'MANAGEMENT : COMPOSANTES ET THÉMATIQUES' or 'MANAGEMENT : COMPOSANTES ET THÉMATIQUES' in libelle:
        libelle_formation_id=291

    if libelle in 'METTRE EN OEUVRE DES ACTIVITÉS D@EXPRESSION ORALE' or 'METTRE EN OEUVRE DES ACTIVITÉS D@EXPRESSION ORALE' in libelle:
        libelle_formation_id=19

    if libelle in 'METTRE EN OEUVRE LE BYOD DANS UN CONTEXTE ÉDUCATIF' or 'METTRE EN OEUVRE LE BYOD DANS UN CONTEXTE ÉDUCATIF' in libelle:
        libelle_formation_id=228

    if libelle in 'METTRE EN OEUVRE LE CV DU FUTUR' or 'METTRE EN OEUVRE LE CV DU FUTUR' in libelle:
        libelle_formation_id=292

    if libelle in 'MISE EN PLACE DU BAC PRO PILOTE DE LIGNE DE PRODUCTION (PLP)' or 'MISE EN PLACE DU BAC PRO PILOTE DE LIGNE DE PRODUCTION (PLP)' in libelle:
        libelle_formation_id=239

    if libelle in 'MODULARISATION CAP CUISINE' or 'MODULARISATION CAP CUISINE' in libelle:
        libelle_formation_id=448

    if libelle in 'MODULARISATION DU CAP INSTALLATEUR THERMIQUE' or 'MODULARISATION DU CAP INSTALLATEUR THERMIQUE' in libelle:
        libelle_formation_id=449

    if libelle in 'MUTUALISATION DES OUTILS ESPOIR' or 'MUTUALISATION DES OUTILS ESPOIR' in libelle:
        libelle_formation_id=450

    if libelle in 'NOUVEAU RÉFÉRENTIEL DOMAINE PROFESSIONNELLE DU CAP CIP' or 'NOUVEAU RÉFÉRENTIEL DOMAINE PROFESSIONNELLE DU CAP CIP' in libelle:
        libelle_formation_id=451

    if libelle in 'ORGANISATION DU TRAVAIL ET MANAGEMENT D@ÉQUIPE' or 'ORGANISATION DU TRAVAIL ET MANAGEMENT D@ÉQUIPE' in libelle:
        libelle_formation_id=293

    if libelle in 'PERMIS DE LIRE' or 'PERMIS DE LIRE' in libelle:
             libelle_formation_id=294

    if libelle in 'PERSONNELS ENTRANTS : CULTURE PROFESSIONNELLE' or 'PERSONNELS ENTRANTS : CULTURE PROFESSIONNELLE' in libelle:
        libelle_formation_id=295

    if libelle in 'PRATIQUER LA CERTIFICATION D@UN DIPLÔME EN CCF' or 'PRATIQUER LA CERTIFICATION D@UN DIPLÔME EN CCF' in libelle:
        libelle_formation_id=296

    if libelle in 'PRÉPARATION À LA CERTIFICATION C2I-N2E' or 'PRÉPARATION À LA CERTIFICATION C2I-N2E' in libelle:
        libelle_formation_id=229
    if libelle in 'PRÉPARATION À LA CERTIFICATION C2I N2E' or 'PRÉPARATION À LA CERTIFICATION C2I N2E' in libelle:
        libelle_formation_id=229

    if libelle in 'PRÉPARATION AUDIT FONGÉCIF DU CIBC' or 'PRÉPARATION AUDIT FONGÉCIF DU CIBC' in libelle:
        libelle_formation_id=260

    if libelle in 'PRÉPARER  SUIVRE  ÉVALUATION ET EXPLOITER LES PÉRIODES EN MI' or 'PRÉPARER  SUIVRE  ÉVALUATION ET EXPLOITER LES PÉRIODES EN MI' in libelle:
        libelle_formation_id=231

    if libelle in 'PRÉPARER SUIVRE ÉVALUER ET EXPLOITER LES PÉRIODES DE FORMATION' or 'PRÉPARER SUIVRE ÉVALUER ET EXPLOITER LES PÉRIODES DE FORMATION' in libelle:
        libelle_formation_id=230

    if libelle in 'PRÉSENTATION BAC PRO GESTION ADMINISTRATION' or 'PRÉSENTATION BAC PRO GESTION ADMINISTRATION' in libelle:
        libelle_formation_id=297

    if libelle in 'PRÉVENTION DES FATIGUES ET RISQUES LIÉS AU TRAVAIL SUR ÉCRAN' or 'PRÉVENTION DES FATIGUES ET RISQUES LIÉS AU TRAVAIL SUR ÉCRAN' in libelle:
        libelle_formation_id=232
    if libelle in 'PRÉVENTION DES FATIGUES LIÉES AU TRAVAIL SUR ÉCRAN DE VISUAL' or 'PRÉVENTION DES FATIGUES LIÉES AU TRAVAIL SUR ÉCRAN DE VISUAL' in libelle:
        libelle_formation_id=232

    if libelle in 'PRISE DE FONCTION D@ASSISTANTE COMMERCIALE' or 'PRISE DE FONCTION D@ASSISTANTE COMMERCIALE' in libelle:
        libelle_formation_id=456

    if libelle in 'PROFESSIONNALISATION AU SEIN DU GRETA' or 'PROFESSIONNALISATION AU SEIN DU GRETA' in libelle:
        libelle_formation_id=457

    if libelle in 'PROGRE - FORMATION PERSONNES RESSOURCES' or 'PROGRE - FORMATION PERSONNES RESSOURCES' in libelle:
        libelle_formation_id=458

    if libelle in 'PROGRÉ : ADMINISTRATEURS' in libelle or 'PROGRÉ : ADMINISTRATEURS' in libelle:
        libelle_formation_id=459

    if libelle in 'PROGRÉ : CFC' or 'PROGRÉ : CFC' in libelle:
        libelle_formation_id=460

    if libelle in 'PROGRÉ : CONCEPTS - ORGANISATION ET TERMINOLOGIE' or 'PROGRÉ : CONCEPTS - ORGANISATION ET TERMINOLOGIE' in libelle:
        libelle_formation_id=461

    if libelle in 'PROGRÉ : FORMATION DES AGENTS COMPTABLES' or 'PROGRÉ : FORMATION DES AGENTS COMPTABLES' in libelle:
        libelle_formation_id=462

    if libelle in 'PROGRÉ : MODULE DE FACTURATION' or 'PROGRÉ : MODULE DE FACTURATION' in libelle:
        libelle_formation_id=463

    if libelle in 'PROGRÉ : PERSONNEL ADMINISTRATIF' or 'PROGRÉ : PERSONNEL ADMINISTRATIF' in libelle:
        libelle_formation_id=464

    if libelle in 'PROJET D@ÉQUIPE : ANIMER UNE CLASSE VIRTUELLE' or 'PROJET D@ÉQUIPE : ANIMER UNE CLASSE VIRTUELLE' in libelle:
        libelle_formation_id=233

    if libelle in 'RÉALISER LE TUTORAT À DISTANCE OU E-TUTORAT - ERREFOM' or 'RÉALISER LE TUTORAT À DISTANCE OU E-TUTORAT - ERREFOM' in libelle:
        libelle_formation_id=465

    if libelle in 'RECONNAÎTRE LES ACQUIS DE FORMATION' or 'RECONNAÎTRE LES ACQUIS DE FORMATION' in libelle:
        libelle_formation_id=466

    if libelle in 'RECYCLAGE DES FORMATEURS PRÉVENTION DES RISQUES PROF. (INRS)' or 'RECYCLAGE DES FORMATEURS PRÉVENTION DES RISQUES PROF. (INRS)' in libelle:
        libelle_formation_id=241

    if libelle in 'RÉFÉRENTIEL DES MISSIONS DE COORDINATION' or 'RÉFÉRENTIEL DES MISSIONS DE COORDINATION' in libelle:
        libelle_formation_id=298

    if libelle in 'REGROUPEMENT DES FORMATEURS RÉFÉRENTS PÉDAGOGIQUES' or 'REGROUPEMENT DES FORMATEURS RÉFÉRENTS PÉDAGOGIQUES' in libelle:
        libelle_formation_id=237
    if libelle in 'RENCONTRES FFFOD' or 'RENCONTRES FFFOD' in libelle:
        libelle_formation_id=510
    if libelle in 'RH  MANAGEMENT' or 'RH  MANAGEMENT' in libelle:
        libelle_formation_id=2
    if libelle in 'S@APPROPRIER LE NOUVEAU RÉFÉRENTIEL EDUFORM' or 'S@APPROPRIER LE NOUVEAU RÉFÉRENTIEL EDUFORM' in libelle:
        libelle_formation_id=5

    if libelle in 'S@APPROPRIER LE RÉFÉRENTIEL D@UN DIPLÔME OU D@UN TITRE' or 'S@APPROPRIER LE RÉFÉRENTIEL D@UN DIPLÔME OU D@UN TITRE' in libelle:
        libelle_formation_id=299

    if libelle in 'S@APPROPRIER LES OUTILS WEB 2.0' or 'S@APPROPRIER LES OUTILS WEB 2.0' in libelle:
        libelle_formation_id=469

    if libelle in 'S@APPROPRIER UN SYSTÈME DE RESSOURCES D@AUTOFORMATION' or 'S@APPROPRIER UN SYSTÈME DE RESSOURCES D@AUTOFORMATION' in libelle:
        libelle_formation_id=470

    if libelle in 'S@EXERCER À L@ANALYSE DU TRAVAIL' or 'S@EXERCER À L@ANALYSE DU TRAVAIL' in libelle:
        libelle_formation_id=471

    if libelle in "S#OUVRIR À L#EUROPE" or "S#OUVRIR À L#EUROPE" in libelle:
        libelle_formation_id=472

    if libelle in 'SAVOIR UTILISER LA GOOGLE SUITE' or 'SAVOIR UTILISER LA GOOGLE SUITE' in libelle:
        libelle_formation_id=473

    if libelle in "SE FORMER À L@AUDIT INTERNE" or "SE FORMER À L@AUDIT INTERNE" in libelle:
        libelle_formation_id=234

    if libelle in 'SÉMINAIRE DES PRÉSIDENTS-CESUP' or 'SÉMINAIRE DES PRÉSIDENTS-CESUP' in libelle:
        libelle_formation_id=508

    if libelle in 'TERRITOIRE II : ENJEUX ET COMPÉTENCES' or 'TERRITOIRE II : ENJEUX ET COMPÉTENCES' in libelle:
        libelle_formation_id=235

    if libelle in 'TEST OUTILS FOAD 2J PROCESS' or 'TEST OUTILS FOAD 2J PROCESS' in libelle:
        libelle_formation_id=497

    if libelle in 'TRANSFERT "FLUIDES FRIGORIGÈNES"' or 'TRANSFERT "FLUIDES FRIGORIGÈNES"' in libelle:
        libelle_formation_id=498

    if libelle in 'TRAVAUX E-GRETA' or 'TRAVAUX E-GRETA' in libelle:
        libelle_formation_id=499

    if libelle in 'TVE - CONDUITE DE PRESTATIONS ET ÉCHANGES DE PRATIQUES' or 'TVE - CONDUITE DE PRESTATIONS ET ÉCHANGES DE PRATIQUES' in libelle:
        libelle_formation_id=300

    if libelle in 'TVE - FORMATION DES LIVRABLES' or 'TVE - FORMATION DES LIVRABLES' in libelle:
        libelle_formation_id=301

    if libelle in 'TVE - QUALITÉ DES LIVRABLES' or 'TVE - QUALITÉ DES LIVRABLES' in libelle:
        libelle_formation_id=302

    if libelle in 'UTILISATION DE LA PLATEFORME E-GRET@ - NIVEAU 1' or 'UTILISATION DE LA PLATEFORME E-GRET@ - NIVEAU 1' in libelle:
        libelle_formation_id=502

    if libelle in 'UTILISATION DE LA PLATEFORME FORM@GRETA - NIVEAU AVANCÉ' or 'UTILISATION DE LA PLATEFORME FORM@GRETA - NIVEAU AVANCÉ' in libelle:
        libelle_formation_id=252

    if libelle in 'UTILISATION DE LA PLATEFORME FORM@GRETA - NIVEAU DÉBUTANT' or 'UTILISATION DE LA PLATEFORME FORM@GRETA - NIVEAU DÉBUTANT' in libelle:
        libelle_formation_id=240
    if libelle in 'UTILISER LA GOOGLE SUITE - NIVEAU 2' or 'UTILISER LA GOOGLE SUITE - NIVEAU 2' in libelle:
        libelle_formation_id=4

    if libelle in 'UTILISER LA PLATEFORME E-GRETA - DÉCOUVERTE' or 'UTILISER LA PLATEFORME E-GRETA - DÉCOUVERTE' in libelle:
        libelle_formation_id=476

    if libelle in 'UTILISER LES TABLETTES NUMÉRIQUES DANS UN CONTEXTE ÉDUCATIF' or 'UTILISER LES TABLETTES NUMÉRIQUES DANS UN CONTEXTE ÉDUCATIF' in libelle:
        libelle_formation_id=477

    if libelle in 'VAE : ACCOMPAGNEMENT DU DEAVS' or 'VAE : ACCOMPAGNEMENT DU DEAVS' in libelle:
        libelle_formation_id=478

    if libelle in 'VAE : ACOMPAGNER À LA PRÉPARATION DU DEAES' or 'VAE : ACOMPAGNER À LA PRÉPARATION DU DEAES' in libelle:
        libelle_formation_id=236

    if libelle in 'VAE EN ENTREPRISE - FORMATION DES CFC' or 'VAE EN ENTREPRISE - FORMATION DES CFC' in libelle:
        libelle_formation_id=359
    if libelle in 'L@EXPRESSION ORALE PROFESSIONNELLE' or  'L@EXPRESSION ORALE PROFESSIONNELLE' in libelle:
        libelle_formation_id=550
    if libelle in 'ACCOMPAGNEMENT AU RAEP' or  'ACCOMPAGNEMENT AU RAEP' in libelle:
        libelle_formation_id=303
    if libelle in 'ACCUEILLIR DES PUBLICS DIFFICILES' or  'ACCUEILLIR DES PUBLICS DIFFICILES' in libelle:
        libelle_formation_id=10
    if libelle in 'ACCUEILLIR LES NOUVEAUX PERSONNELS DANS LE RÉSEAU DES GRETA' or  'ACCUEILLIR LES NOUVEAUX PERSONNELS DANS LE RÉSEAU DES GRETA' in libelle:
        libelle_formation_id=9
    if libelle in 'ADAPTATION DES PRATIQUES D@AUDIT AU CIBC' or  'ADAPTATION DES PRATIQUES D@AUDIT AU CIBC' in libelle:
        libelle_formation_id=305
    if libelle in 'APPEL D@OFFRE : ANALYSE ET COMPRÉHENSION DES DOCUMENTS' or  'APPEL D@OFFRE : ANALYSE ET COMPRÉHENSION DES DOCUMENTS' in libelle:
        libelle_formation_id=337
    if libelle in 'AUDIT INTERNE' or  'AUDIT INTERNE' in libelle:
        libelle_formation_id=512
    if libelle in 'AUDIT INTERNET ET RÉFÉRENTIEL RBP-X50-762' or  'AUDIT INTERNET ET RÉFÉRENTIEL RBP-X50-762' in libelle:
        libelle_formation_id=271
    if libelle in 'CHANTIER @RESSOURCES EXCEL 2007@' or  'CHANTIER @RESSOURCES EXCEL 2007@' in libelle:
        libelle_formation_id=355
    if libelle in 'CIBC@BILAN' or  'CIBC@BILAN' in libelle:
        libelle_formation_id=267
    if libelle in 'CIVITAS - MODULE @N4DS@' or  'CIVITAS - MODULE @N4DS@' in libelle:
        libelle_formation_id=513
    if libelle in 'CLÉA - FORMATION @EVALUATION@' or  'CLÉA - FORMATION @EVALUATION@' in libelle:
        libelle_formation_id=514
    if libelle in 'COMMUNICATION ET CIRCUITS INTERNES ET EXTERNES D@INFORMATION' or  'COMMUNICATION ET CIRCUITS INTERNES ET EXTERNES D@INFORMATION' in libelle:
        libelle_formation_id=393
    if libelle in 'COMMUNICATION PRESSE' or  'COMMUNICATION PRESSE' in libelle:
        libelle_formation_id=395
    if libelle in 'CONCEVOIR UN DISPOSITIF DE FORMATION MULTIMODAL' or  'CONCEVOIR UN DISPOSITIF DE FORMATION MULTIMODAL' in libelle:
        libelle_formation_id=612
    if libelle in 'CONSEIL À L@INTERNE - NIVEAU 2' or  'CONSEIL À L@INTERNE - NIVEAU 2' in libelle:
        libelle_formation_id=15
    if libelle in 'CONSTRUCTION D@UNE SITUATION EN CCF' or  'CONSTRUCTION D@UNE SITUATION EN CCF' in libelle:
        libelle_formation_id=402
    if libelle in 'CONTRATS DE TRAVAIL DANS LES GRETA' or  'CONTRATS DE TRAVAIL DANS LES GRETA' in libelle:
        libelle_formation_id=521
    if libelle in 'CULTURE PROFESSIONNELLE' or  'CULTURE PROFESSIONNELLE' in libelle:
        libelle_formation_id=611
    if libelle in 'DE LA TRE À LA NÉGOCIATION DU CONTRAT DE TRAVAIL' or  'DE LA TRE À LA NÉGOCIATION DU CONTRAT DE TRAVAIL' in libelle:
        libelle_formation_id=522
    if libelle in 'DÉCOUVRIR LA DÉMARCHE @COMPÉTENCES@' or  'DÉCOUVRIR LA DÉMARCHE @COMPÉTENCES@' in libelle:
        libelle_formation_id=523
    if libelle in 'DÉCOUVRIR LA DÉMARCHE COMPÉTENCES' or  'DÉCOUVRIR LA DÉMARCHE COMPÉTENCES' in libelle:
        libelle_formation_id=523
    if libelle in 'DÉMARCHE ACTIONNELLE EN FORMATION D@ANGLAIS' or  'DÉMARCHE ACTIONNELLE EN FORMATION D@ANGLAIS' in libelle:
        libelle_formation_id=312
    if libelle in 'DÉMARCHE PORTFOLIO À ORIENTATION GPEC' or  'DÉMARCHE PORTFOLIO À ORIENTATION GPEC' in libelle:
        libelle_formation_id=277
    if libelle in 'DÉVELOPPEMENT DURABLE ET ÉCO-CITOYENNETÉ' or  'DÉVELOPPEMENT DURABLE ET ÉCO-CITOYENNETÉ' in libelle:
        libelle_formation_id=524
    if libelle in 'DISPOSITIF ORIENTATION' or  'DISPOSITIF ORIENTATION' in libelle:
        libelle_formation_id=525
    if libelle in 'DYNAMISE ET OPTIMISER LE TRAVAIL D@ÉQUIPE' or  'DYNAMISE ET OPTIMISER LE TRAVAIL D@ÉQUIPE' in libelle:
        libelle_formation_id=526
    if libelle in 'ELABORATION D@UN DOCUMENT DE COMMUNICATION' or  'ELABORATION D@UN DOCUMENT DE COMMUNICATION' in libelle:
        libelle_formation_id=527
    if libelle in "ELABORATION DES DOSSIERS TECHNIQUES D@EVALUATION"  or  "ELABORATION DES DOSSIERS TECHNIQUES D@EVALUATION"  in libelle:
        libelle_formation_id=528
    if libelle in 'ETRE FORMATEUR À L@ÈRE DU NUMÉRIQUE' or  'ETRE FORMATEUR À L@ÈRE DU NUMÉRIQUE' in libelle:
        libelle_formation_id=529
    if libelle in 'ETRE MÉDIATEUR DU DÉCROCHAGE SCOLAIRE' or  'ETRE MÉDIATEUR DU DÉCROCHAGE SCOLAIRE' in libelle:
        libelle_formation_id=530
    if libelle in 'FAIRE FACE AUX SITUATIONS D@ACCUEIL DIFFICILES' or  'FAIRE FACE AUX SITUATIONS D@ACCUEIL DIFFICILES' in libelle:
        libelle_formation_id=424
    if libelle in 'FORMATION À L@OUTIL CRM SUGAR' or  'FORMATION À L@OUTIL CRM SUGAR' in libelle:
        libelle_formation_id=316
    if libelle in 'FORMATION AU PROGICIEL AGE' or  'FORMATION AU PROGICIEL AGE' in libelle:
        libelle_formation_id=531
    if libelle in 'FORMATION DE FORMATEURS ACTIVOLOG' or  'FORMATION DE FORMATEURS ACTIVOLOG' in libelle:
        libelle_formation_id=532
    if libelle in 'FORMATION DE FORMATEURS DE TUTEURS' or  'FORMATION DE FORMATEURS DE TUTEURS' in libelle:
        libelle_formation_id=533
    if libelle in 'FORMATION DES ACTEURS DU DIALOGUE SOCIAL' or  'FORMATION DES ACTEURS DU DIALOGUE SOCIAL' in libelle:
        libelle_formation_id=534
    if libelle in 'FORMATION DES CHEFS D@ÉTABLISSEMENT ARRIVANT EN GRETA' or  'FORMATION DES CHEFS D@ÉTABLISSEMENT ARRIVANT EN GRETA' in libelle:
        libelle_formation_id=321
    if libelle in 'FORMATION ERIC@S - CIVITAS' or  'FORMATION ERIC@S - CIVITAS' in libelle:
        libelle_formation_id=535
    if libelle in 'FORMATION ESPOIR (CFC ET COORDONNATEURS)'  or  'FORMATION ESPOIR (CFC ET COORDONNATEURS)'  in libelle:
        libelle_formation_id=536
    if libelle in 'FORMATION ESPOIR (FORMATEURS)'  or  'FORMATION ESPOIR (FORMATEURS)'  in libelle:
        libelle_formation_id=537
    if libelle in 'FORMATION GAPAIE' or  'FORMATION GAPAIE' in libelle:
        libelle_formation_id=538
    if libelle in 'FORMATION INFOGRAPHIE' or  'FORMATION INFOGRAPHIE' in libelle:
        libelle_formation_id=547
        if libelle in 'INFOGRAPHIE' or  'INFOGRAPHIE' in libelle:
            libelle_formation_id=547
    if libelle in 'FORMATION POWERPOINT' or  'FORMATION POWERPOINT' in libelle:
        libelle_formation_id=539
    if libelle in 'FRANÇAIS - LANGUE SECONDE' or  'FRANÇAIS - LANGUE SECONDE' in libelle:
        libelle_formation_id=540
    if libelle in 'GESTION MENTALE ET MODE D@APPRENTISSAGE' or  'GESTION MENTALE ET MODE D@APPRENTISSAGE' in libelle:
        libelle_formation_id=541
    if libelle in 'GFA - L@ÉVALUATION DES ACQUIS EN FIN DE FORMATION' or  'GFA - L@ÉVALUATION DES ACQUIS EN FIN DE FORMATION' in libelle:
        libelle_formation_id=258
    if libelle in 'GFA DFTLV @ CONSTRUCTION DE SITUATIONS DIDACTISÉES....@' or  'GFA DFTLV @ CONSTRUCTION DE SITUATIONS DIDACTISÉES....@' in libelle:
        libelle_formation_id=243
    if libelle in 'GFA ORIENTATION-INSERTION @ATTITUDES EN SITUATIONS PROF. ET' or  'GFA ORIENTATION-INSERTION @ATTITUDES EN SITUATIONS PROF. ET' in libelle:
        libelle_formation_id=542
    if libelle in 'GOSPEL' or  'GOSPEL' in libelle:
        libelle_formation_id=543
    if libelle in 'HABILITATION B2I ADULTES' or  'HABILITATION B2I ADULTES' in libelle:
        libelle_formation_id=262
    if libelle in 'HABILITATION DES FORMATEURS À L@ÉVALUATINO DU B2I ADULTES' or  'HABILITATION DES FORMATEURS À L@ÉVALUATINO DU B2I ADULTES' in libelle:
        libelle_formation_id=262
    if libelle in 'HABILITATION DES FORMATEURS À L@ÉVALUATION DU B2I ADULTES' or  'HABILITATION DES FORMATEURS À L@ÉVALUATION DU B2I ADULTES' in libelle:
        libelle_formation_id=262
    if libelle in 'HABILITATION MONTAGE D@ÉCHAFAUDAGES' or  'HABILITATION MONTAGE D@ÉCHAFAUDAGES' in libelle:
        libelle_formation_id=544
    if libelle in 'ILLETTRISME ET HANDICAP' or  'ILLETTRISME ET HANDICAP' in libelle:
        libelle_formation_id=545
    if libelle in 'INDIVIDUALISATION DANS LES FORMATIONS EN LANGUES' or  'INDIVIDUALISATION DANS LES FORMATIONS EN LANGUES' in libelle:
        libelle_formation_id=546
    if libelle in 'INFOGRAPHIE : INDESIGN - PHOTOSHOP - ILLUSTRATOR' or  'INFOGRAPHIE : INDESIGN - PHOTOSHOP - ILLUSTRATOR' in libelle:
        libelle_formation_id=547
    if libelle in 'INFORMATION/RÉUNION FOREM' or  'INFORMATION/RÉUNION FOREM' in libelle:
        libelle_formation_id=548
    if libelle in 'INGÉNIERIE - NIVEAU 2' or  'INGÉNIERIE - NIVEAU 2' in libelle:
        libelle_formation_id=549
    if libelle in 'Intégrer la multimodalité - Gpe 6' or  'Intégrer la multimodalité - Gpe 6' in libelle:
        libelle_formation_id=224
    if libelle in 'INTERVENIR EN FORMATION À L@INTERNATIONAL' or  'INTERVENIR EN FORMATION À L@INTERNATIONAL' in libelle:
        libelle_formation_id=614
    if libelle in 'JOURNÉE DE PROFESSIONNALISATION DES ACCOMPAGNATEURS VAE' or  'JOURNÉE DE PROFESSIONNALISATION DES ACCOMPAGNATEURS VAE' in libelle:
        libelle_formation_id=436
    if libelle in 'L@ACCOMPAGNEMENT DANS UN DISPOSITIF DE FORMATION MULTIMODAL' or  'L@ACCOMPAGNEMENT DANS UN DISPOSITIF DE FORMATION MULTIMODAL' in libelle:
        libelle_formation_id=438
    if libelle in 'L@ACCOMPAGNEMENT DES DEMANDEURS D@EMPLOI' or  'L@ACCOMPAGNEMENT DES DEMANDEURS D@EMPLOI' in libelle:
        libelle_formation_id=439
    if libelle in 'L@ACCOMPAGNEMENT VAE DES DIPLÔMES DE LA DRJSCS' or  'L@ACCOMPAGNEMENT VAE DES DIPLÔMES DE LA DRJSCS' in libelle:
        libelle_formation_id=440
    if libelle in 'L@APPROCHE ACTIONNELLE EN LANGUES VIVANTES' or  'L@APPROCHE ACTIONNELLE EN LANGUES VIVANTES' in libelle:
        libelle_formation_id=441
    if libelle in 'L@ÉGALITÉ PROFESSIONNELLE EN ENTREPRISE' or  'L@ÉGALITÉ PROFESSIONNELLE EN ENTREPRISE' in libelle:
        libelle_formation_id=442
    if libelle in 'L@ENTRETIEN D@AIDE ET D@EXPLICITATION' or  'L@ENTRETIEN D@AIDE ET D@EXPLICITATION' in libelle:
        libelle_formation_id=443
    if libelle in 'L@ENTRETIEN D@EXPLICITATION' or  'L@ENTRETIEN D@EXPLICITATION' in libelle:
        libelle_formation_id=244
    if libelle in 'L@ÉVALUATION DES ACQUIS EN FIN DE FORMATION' or  'L@ÉVALUATION DES ACQUIS EN FIN DE FORMATION' in libelle:
        libelle_formation_id=613
    if libelle in 'L@EXPRESSION ORALE PROFESSIONNELLE' or  'L@EXPRESSION ORALE PROFESSIONNELLE' in libelle:
        libelle_formation_id=550
    if libelle in 'L@HUMIDITIÉ DANS LE BÂTIMENT' or  'L@HUMIDITIÉ DANS LE BÂTIMENT' in libelle:
        libelle_formation_id=551
    if libelle in 'L@INTELLIGENCE ÉCONOMIQUE' or  'L@INTELLIGENCE ÉCONOMIQUE' in libelle:
        libelle_formation_id=552
    if libelle in 'L@UTILISATION DES TECHNIQUES THÉÂTRALES AVEC UN PUBLIC ADULT' or  'L@UTILISATION DES TECHNIQUES THÉÂTRALES AVEC UN PUBLIC ADULT' in libelle:
        libelle_formation_id=553
    if libelle in 'LA VEILLE DOCUMENTAIRE DANS LE DISPOSITIF RÉUSSIR' or  'LA VEILLE DOCUMENTAIRE DANS LE DISPOSITIF RÉUSSIR' in libelle:
        libelle_formation_id=554
    if libelle in 'LANGUES VIVANTES : QUELLES CERTIFICATIONS ? POUR QUELS PUBLI' or  'LANGUES VIVANTES : QUELLES CERTIFICATIONS ? POUR QUELS PUBLI' in libelle:
        libelle_formation_id=555
    if libelle in 'LE CLÉA OU SOCLE DE CONNAISSANCES ET DE COMPÉTENCES PROFE.' or  'LE CLÉA OU SOCLE DE CONNAISSANCES ET DE COMPÉTENCES PROFE.' in libelle:
        libelle_formation_id=556
    if libelle in 'LE TRIBUNAL DES MÉTIERS' or  'LE TRIBUNAL DES MÉTIERS' in libelle:
        libelle_formation_id=557
    if libelle in 'LÉGITIMITÉ À PARLER DU HANDICAP' or  'LÉGITIMITÉ À PARLER DU HANDICAP' in libelle:
        libelle_formation_id=558
    if libelle in 'LES CFC ET LA VAE EN ENTREPRISE' or  'LES CFC ET LA VAE EN ENTREPRISE' in libelle:
        libelle_formation_id=559
    if libelle in 'LES ÉCRITS PROFESSIONNELS' or  'LES ÉCRITS PROFESSIONNELS' in libelle:
        libelle_formation_id=560
    if libelle in 'LES FONDAMENTAUX DU MÉTIER DE FORMATEUR  GRETA' or  'LES FONDAMENTAUX DU MÉTIER DE FORMATEUR  GRETA' in libelle:
        libelle_formation_id=561
    if libelle in 'LES MUTATIONS DE LA FORMATION PROFESSIONNELLE' or  'LES MUTATIONS DE LA FORMATION PROFESSIONNELLE' in libelle:
        libelle_formation_id=562
    if libelle in 'LUTTER CONTRE L@ILLETTRISME AVEC LES PARENTS' or  'LUTTER CONTRE L@ILLETTRISME AVEC LES PARENTS' in libelle:
        libelle_formation_id=290
    if libelle in 'MANAGEMENT DES AGENCES' or  'MANAGEMENT DES AGENCES' in libelle:
        libelle_formation_id=563
    if libelle in 'MANAGER DES PROJETS' or  'MANAGER DES PROJETS' in libelle:
        libelle_formation_id=564
    if libelle in 'MARCHÉS PUBLICS : RÉPONSES ET SUIVI' or  'MARCHÉS PUBLICS : RÉPONSES ET SUIVI' in libelle:
        libelle_formation_id=565
    if libelle in 'METTRE EN OEUVRE UNE FORMATION DIPLÔMANTE' or  'METTRE EN OEUVRE UNE FORMATION DIPLÔMANTE' in libelle:
        libelle_formation_id=586
    if libelle in 'MISE EN PLACE DU BAC PRO PILOTE DE LIGNE DE PRODUCTION' or  'MISE EN PLACE DU BAC PRO PILOTE DE LIGNE DE PRODUCTION' in libelle:
        libelle_formation_id=239
    if libelle in 'ORGANISATION DU TRAVAIL ET MANAGEMENT D@ÉQUIPE' or  'ORGANISATION DU TRAVAIL ET MANAGEMENT D@ÉQUIPE' in libelle:
        libelle_formation_id=293
    if libelle in 'ORGANISATION ET GESTION DU TEMPS' or  'ORGANISATION ET GESTION DU TEMPS' in libelle:
        libelle_formation_id=587
    if libelle in 'PARTENARIATS : ENJEUX ET COMPÉTENCES' or  'PARTENARIATS : ENJEUX ET COMPÉTENCES' in libelle:
        libelle_formation_id=588
    if libelle in 'PARTENARIATS : NOUVEAUX ENJEUX - NOUVELLES COMPÉTENCES' or  'PARTENARIATS : NOUVEAUX ENJEUX - NOUVELLES COMPÉTENCES' in libelle:
        libelle_formation_id=589
    if libelle in 'PERFECTIONNEMENT À L@AUDIT INTERNE' or  'PERFECTIONNEMENT À L@AUDIT INTERNE' in libelle:
        libelle_formation_id=590
    if libelle in 'PERMIS DE FORMER' or  'PERMIS DE FORMER' in libelle:
        libelle_formation_id=591
    if libelle in 'PILOTER UN DISPOSITIF PAR LA RENTABILITÉ / GÉRER LA COMPENSA' or  'PILOTER UN DISPOSITIF PAR LA RENTABILITÉ / GÉRER LA COMPENSA' in libelle:
        libelle_formation_id=593
    if libelle in 'PILOTER UN DISPOSITIF PAR LA RENTABILITÉ / GÉRER LA COMPENSA' or  'PILOTER UN DISPOSITIF PAR LA RENTABILITÉ / GÉRER LA COMPENSA' in libelle:
        libelle_formation_id=593
    if libelle in 'POWERPOINT : OUTIL DE COMMUNICATION' or  'POWERPOINT : OUTIL DE COMMUNICATION' in libelle:
        libelle_formation_id=594
    if libelle in 'PRATIQUER LA CERTIFICATION D@UN DIPLÔME EN CCF' or  'PRATIQUER LA CERTIFICATION D@UN DIPLÔME EN CCF' in libelle:
        libelle_formation_id=296
    if libelle in 'PRÉPARATION À L@ORAL DES CANDIDATS AUX CONCOURS RÉSERVÉS' or  'PRÉPARATION À L@ORAL DES CANDIDATS AUX CONCOURS RÉSERVÉS' in libelle:
        libelle_formation_id=595
    if libelle in 'PRESAGE 2007' or  'PRESAGE 2007' in libelle:
        libelle_formation_id=596
    if libelle in 'PRÉSENTATION DU DISPOSITIF DE FOAD DU RÉSEAU DES GRETA' or  'PRÉSENTATION DU DISPOSITIF DE FOAD DU RÉSEAU DES GRETA' in libelle:
        libelle_formation_id=597
    if libelle in 'PRISE DE FONCTION D@ASSISTANTE COMMERCIALE' or  'PRISE DE FONCTION D@ASSISTANTE COMMERCIALE' in libelle:
        libelle_formation_id=456
    if libelle in 'RÉPONDRE AUX ENJEUX D@UN COMITÉ DE PILOTAGE' or  'RÉPONDRE AUX ENJEUX D@UN COMITÉ DE PILOTAGE' in libelle:
        libelle_formation_id=598
    if libelle in 'RÉUNION COORDONNATEUR ORGANISME FOAD' or  'RÉUNION COORDONNATEUR ORGANISME FOAD' in libelle:
        libelle_formation_id=599
    if libelle in 'RÉUNION DES TUTEURS DES CFC STAGIAIRES' or  'RÉUNION DES TUTEURS DES CFC STAGIAIRES' in libelle:
        libelle_formation_id=600
    if libelle in 'RÉUNION ENI / E-GRETA' or  'RÉUNION ENI / E-GRETA' in libelle:
        libelle_formation_id=601
    if libelle in 'RÉUNION RÉFÉRENTS PAFOC' or  'RÉUNION RÉFÉRENTS PAFOC' in libelle:
        libelle_formation_id=602
    if libelle in 'RÉUNION RÉGIONALE @HABILITATIONS ÉLECTRIQUES@' or  'RÉUNION RÉGIONALE @HABILITATIONS ÉLECTRIQUES@' in libelle:
        libelle_formation_id=603
    if libelle in 'RH MANAGEMENT' or  'RH MANAGEMENT' in libelle:
        libelle_formation_id=2
    if libelle in 'S@APPROPRIER LE RÉFÉRENTIEL D@UN DIPLÔME OU D@UN TITRE' or  'S@APPROPRIER LE RÉFÉRENTIEL D@UN DIPLÔME OU D@UN TITRE' in libelle:
        libelle_formation_id=299
    if libelle in 'S@APPROPRIER LES GRANDS PRINCIPES DE L@ENTRETIEN D@EXPLICIT' or  'S@APPROPRIER LES GRANDS PRINCIPES DE L@ENTRETIEN D@EXPLICIT' in libelle:
        libelle_formation_id=244
    if libelle in 'S@APPROPRIER LES OUTILS WEB 2.0' or  'S@APPROPRIER LES OUTILS WEB 2.0' in libelle:
        libelle_formation_id=469
    if libelle in 'S@APPROPRIER UN SYSTÈME DE RESSOURCES D@AUTOFORMATION' or  'S@APPROPRIER UN SYSTÈME DE RESSOURCES D@AUTOFORMATION' in libelle:
        libelle_formation_id=470
    if libelle in 'S@EXERCER À L@ANALYSE DU TRAVAIL' or  'S@EXERCER À L@ANALYSE DU TRAVAIL' in libelle:
        libelle_formation_id=471
    if libelle in 'S@OUVRIR À L@EUROPE' or  'S@OUVRIR À L@EUROPE' in libelle:
        libelle_formation_id=472
    if libelle in 'SE FORMER À L@AUDIT INTERNE' or  'SE FORMER À L@AUDIT INTERNE' in libelle:
        libelle_formation_id=234
    if libelle in 'SÉMINAIRE @TRAVAIL EN ÉQUIPE@' or  'SÉMINAIRE @TRAVAIL EN ÉQUIPE@' in libelle:
        libelle_formation_id=604
    if libelle in 'SÉMINAIRE BUREAUTIQUE' or  'SÉMINAIRE BUREAUTIQUE' in libelle:
        libelle_formation_id=605
    if libelle in 'SENSIBILISATION À LA NOTION DE HANDICAP' or  'SENSIBILISATION À LA NOTION DE HANDICAP' in libelle:
        libelle_formation_id=593
    if libelle in 'SENSIBILISATION À UNE ORGANISATION ÉCO-RESPONSABLE' or  'SENSIBILISATION À UNE ORGANISATION ÉCO-RESPONSABLE' in libelle:
        libelle_formation_id=606
    if libelle in 'TRANSFERT @FLUIDES FRIGORIGÈNES@' or  'TRANSFERT @FLUIDES FRIGORIGÈNES@' in libelle:
        libelle_formation_id=498
    if libelle in 'UN OUTILLAGE POUR LES COMPÉTENCES CLÉS' or  'UN OUTILLAGE POUR LES COMPÉTENCES CLÉS' in libelle:
        libelle_formation_id=607
    if libelle in 'UTILISATION DE L@APPROCHE COMPÉTENCES CLÉS ET DU RCCSP' or  'UTILISATION DE L@APPROCHE COMPÉTENCES CLÉS ET DU RCCSP' in libelle:
        libelle_formation_id=608
    if libelle in 'UTILISER LA GOOGLE SUITE' or  'UTILISER LA GOOGLE SUITE' in libelle:
        libelle_formation_id=609
    if libelle in 'UTILISER LA PLATEFORME E-GRETA - APPROFONDISSEMENT' or  'UTILISER LA PLATEFORME E-GRETA - APPROFONDISSEMENT' in libelle:
        libelle_formation_id=610
    if libelle in 'VAE : ACCOMPAGNEMENT DU DEAS' or  'VAE : ACCOMPAGNEMENT DU DEAS' in libelle:
        libelle_formation_id=236
    if libelle in 'VAE - ACCOMPAGNER À L A PRÉPARATION DU DEAES' or  'VAE - ACCOMPAGNER À L A PRÉPARATION DU DEAES' in libelle:
        libelle_formation_id=236
    if libelle in 'PRÉPARER À LA CERTIFICATION CLÉA' or  'PRÉPARER À LA CERTIFICATION CLÉA' in libelle:
        libelle_formation_id=616
    if libelle in 'PLANS SOCIAUX ET CELLULES DE RECLASSEMENT' or  'PLANS SOCIAUX ET CELLULES DE RECLASSEMENT' in libelle:
        libelle_formation_id=303

    return libelle_formation_id

def writeAllData(annee):
    partie1=open("import_to_db/partie1/"+annee+"-1.sql","w")
    partie1_stagiaire=open("import_to_db/partie1/partie1_stagiaire","w")
    partie1_formateur_session=open("import_to_db/partie1/partie1_formateur_session","w")
    formateurs=open("formateurs","w")
    access=open("export access/dump"+annee+".sql","r")
    liste_formation=[] #pour la partie 2
    liste_formateur=[]
    liste_formateur_session=[] #pour la partie 2
    liste_libelle=[]
    #parcourir tout
    for ligne in access:
        #dans stagiaire
        if "INSERT INTO `stagiaire`" in ligne:
            mots=utils.tsplit(ligne,(','))
            statut=mots[-4]
            for i in range (len(mots)):
                if "VALUES" in mots[i]:
                    j=i
                    present=False
                    #stagiaire
                    nom=mots[j+1]
                    numfiche=mots[j+2]
                    # parcourir phpmyadmin
                    phpmyadmin = open("phpmyadmin.sql","r")
                    for ligne_php in phpmyadmin:
                        if "INSERT INTO `stagiaire`" in ligne_php:
                            if nom in ligne_php:
                                present=True
                    phpmyadmin.close()
                    # si le nom du stagiaire n'existe pas dans phpmyadmin
                    if not present:
                        # on recupere tout et on crée le stagiaire
                        if numfiche==' 1': #pour eviter les doublons
                            fonction=mots[j+3]
                            secteur=mots[j+5] #a verifier
                            ville=mots[j+6]
                            naissance=mots[j+8]
                            titre=mots[j+9]
                            nationalite=mots[j+12]
                            # print(mots[j+30:j+35])
                            nom_agence=mots[j+40]
                            adresse_agence=mots[j+41]
                            statut=mots[j+75]
                            pourcentage=mots[j+77]
                            # date_debut=mots[j+21].split(' ')[0]+"'"
                            # date_fin=mots[j+22].split(' ')[0]+"'"
                            libelle=mots[j+30].upper()
                            liste_formation+=[(nom,libelle,secteur)]

                            #attribution de l'id statut selon le statut
                            if statut==" 'Contractuel CDI'":
                                statut_id='1'
                            elif statut==" 'Contractuel CDD'":
                                statut_id='2'
                            elif statut==" 'Titulaire'":
                                statut_id='3'
                            elif statut==" 'Vacataire'":
                                statut_id='4'
                            else:
                                statut_id='NULL'
                                # print(statut)

                            #  attribution de l'agence_id selon l'adresse de l'agence
                            if "Lycée Jean Guehenno" in adresse_agence:
                                id_agence=32
                            if "Lyc\xc3\xa9e Modeste Leroy" in adresse_agence:
                                id_agence=20
                            if "Lycée Pierre et Marie Curie" in adresse_agence:
                                id_agence=21
                            elif "49 avenue P. Ch. de Foucauld" in adresse_agence:
                                id_agence=28
                            elif "Lycée Arcisse de Caumont" in adresse_agence:
                                id_agence=29
                            elif "Collège Nelson Mandela" in adresse_agence:
                                id_agence=11
                            elif "Lycée Albert Sorel" in adresse_agence:
                                id_agence=15
                            elif "Lycée Paul Cornu" in adresse_agence:
                                id_agence=16
                            elif "Lycée Jules Vernes" in adresse_agence or "Lyc\xc3\xa9e Jules Verne 12 rue Lucien Bossoutrot" in adresse_agence:
                                id_agence=10
                            elif 'LYC\xc3\x89E LAPLACE' in adresse_agence:
                                id_agence=9
                            elif "Lycée Jean Jooris" in adresse_agence:
                                id_agence=14
                            elif "139 Rue de la Délivrande" in adresse_agence:
                                id_agence=9
                            elif "Lycée Alexis de Tocqueville" in adresse_agence:
                                id_agence=24
                            elif "Lycée Emile Littré" in adresse_agence:
                                id_agence=22
                            elif "1.a rue Georges Fauvel" in adresse_agence:
                                id_agence=43
                            elif "40 avenue du Mont aux Malades" in adresse_agence:
                                id_agence=27
                            elif "11 boulevard de Verdun" in adresse_agence:
                                id_agence=23
                            elif "18 Avenue de la République" in adresse_agence:
                                id_agence=25
                            elif "Rue de la Crète" in adresse_agence:
                                print('id_agence= julliot de la morandiere Granville')
                            elif "48 rue du Bengale" in adresse_agence:
                                print(nom_agence)
                                print(adresse_agence)
                                print('id_agence greta ddu calvados la folie')
                            elif "Lycée Guibray" in adresse_agence:
                                id_agence=13
                            elif "1 chemin des Vallées - BP 83 " in adresse_agence:
                                id_agence=47
                            elif "10 rue du Général Margueritte BP 43516" in adresse_agence:
                                id_agence=45
                            elif "139 Rue de la Délivande BP 32" in adresse_agence:
                                id_agence=9
                            elif "16 rue Pierre Huet - CS 30269 " in adresse_agence:
                                id_agence=34
                            elif "181 AVENUE Général Leclerc" in adresse_agence:
                                id_agence=33
                            elif "8 rue René Vivien BP 176" in adresse_agence:
                                id_agence=40
                            elif "Chemin des Bruyères - BP 90011 " in adresse_agence:
                                id_agence=46
                            elif "CITIS 15 avenue de Cambridge" in adresse_agence:
                                id_agence=36
                            elif "DAFCO" in adresse_agence:
                                id_agence=35
                            elif "EREA Yvonne Guégan 1 Route de Colombelle" in adresse_agence:
                                id_agence=41
                            elif "1.a rue Georges Fauvel " in adresse_agence:
                                id_agence=43
                            elif "Lycée F. Buisson 6 rue Houzeau" in adresse_agence:
                                id_agence=40
                            elif "Lycée Jean Guehenno Allée Eugène Cabrol - BP 34" in adresse_agence:
                                id_agence=32
                            elif "Lycée Maréchal Leclerc 30 rue Jean-Henri Fabre - BP 360" in adresse_agence:
                                id_agence=37
                            elif "Lycée Mézeray 6 place Robert Dugué" in adresse_agence:
                                id_agence=38
                            elif "Lycée Modeste Leroy 32 rue Pierre Brossolette" in adresse_agence:
                                id_agence=6
                            elif "GIP FCIP" in nom_agence:
                                id_agence=8
                            elif "Rectorat 2 - DAFPIC 2 rue du Docteur Fleury" in adresse_agence:
                                id_agence=14
                            elif "168 rue Caponière" in adresse_agence:
                                if nom_agence=="DAFPIC":
                                    id_agence=17
                                elif nom_agence=="CAFOC":
                                    id_agence=18
                                elif "DAFCO" in nom_agence:
                                    id_agence=35
                                elif nom_agence=="RECTORAT DE CAEN":
                                    print("rectorat de caen")
                                    id_agence="NULL"
                                else:
                                    # print(nom_agence)
                                    id_agence="NULL"
                            else:
                                phpmyadmin = open("phpmyadmin.sql","r")
                                for ligne_php in phpmyadmin:
                                    if nom_agence in ligne_php:
                                        pass
                                    else:
                                        # print('NON',nom,nom_agence)
                                        id_agence="NULL"
                                        # break
                                phpmyadmin.close()

                            partie1.write("INSERT INTO `stagiaire` (statut_id,agence_id,nom,secteur, fonction,ville,naissance,titre,nationalite,quotite)")
                            partie1.write(" VALUES ("+statut_id+","+str(id_agence)+","+nom+","+secteur+","+fonction+","+ville+","+naissance+","+titre+","+nationalite+","+pourcentage+");\n")
                    #formation
                    #que le stagiaire existe ou non on recupere le nom et la date de la formation qu'il a suivi



    # dans feuille emargement
        if "INSERT INTO `feuille émargement`" in ligne:
            mots=utils.tsplit(ligne,(","))
            for i in range(len(mots)):
                if "VALUES" in mots[i]:
                    j=i
                    num=mots[j].split('(')[-1]
                    date_seance=mots[j+1]
                    libelle=mots[j+2]
                    module=mots[j+3]
                    formateur=mots[j+4]
                    if "NULL" not in mots[j+5]:
                        duree=utils.dateTimeToTime(mots[j+5])
                    else: duree=mots[j+5]
                    horaire=mots[j+6].split(" ")[-1]
                    if "NULL" not in mots[j+7]:
                        date_retour=mots[j+7].split(' ')[1]+"'"
                    else: date_retour=mots[j+7]
                    lieu=mots[j+8]
                    liste_formateur_session+=[(num,formateur)]

                #verifier phpmyadmin si on trouve un libelle_formation ressemblant
                    libelle_formation_id=0
                    php_libelle = open("phpmyadmin.sql","r")
                    for ligne_php in php_libelle:

                        if "INSERT INTO `libelle_formation`" in ligne_php:
                            mots_php=utils.tsplit(ligne_php,(",","("))
                            libelle_php=mots_php[4]
                            if utils.highsimilar(libelle_php,libelle):
                                libelle_formation_id=mots_php[3]
                            else:
                                libelle_formation_id=findLibelleId(libelle,libelle_php)
                                if libelle_formation_id==0 and libelle not in liste_libelle and libelle!='NULL':
                                    liste_libelle+=[libelle]

                    php_libelle.close()
                    # if libelle_formation_id!=0  and libelle_formation_id!="0":
                    if '2018' in date_seance:
                        edite='0'
                    else: edite='1'
                    partie1.write("INSERT INTO `session` (libelle_formation_id,num_emargement,date_debut,date_fin,groupe,duree,date_retour,lieu,observation,feuille_edite,mission_edite)")
                    partie1.write(" VALUES ("+str(libelle_formation_id)+","+num+","+date_seance+",NULL ,NULL"+","+duree+","+date_retour+","+lieu+","+"NULL"+","+edite+","+edite+");\n")
                    # print(libelle_formation_id)



                    #on garde le libelle dans observation
                    #insert session

                    #comparer dans phpmyadmin
                    phpmyadmin = open("phpmyadmin.sql","r")
                    for ligne_php in phpmyadmin:
                        present=False
                        if "INSERT INTO `intervenant`" in ligne_php:
                            mots_php=utils.tsplit(ligne_php,(",","("))
                            formateur_php=mots[5]
                            if utils.highsimilar(formateur,formateur_php):
                                present=True
                        #si formateur n'existe pas
                        if not present and formateur not in liste_formateur:
                            liste_formateur+=[formateur]
                    phpmyadmin.close()

    for f in liste_formateur:
        formateurs.write('INSERT INTO `intervenant` VALUES ('+f+');\n')

    partie1_prerequis=open("libelles.sql","w")
    for l in liste_libelle:
        partie1_prerequis.write("INSERT INTO `libelle_formation` (libelle) VALUES ("+ l+");\n")
    # partie1_formateur_session.write("#intervenant et numero demargement\n")
    for i in liste_formateur_session:
        partie1_formateur_session.write(str(i)+"\n")
    # partie1_stagiaire.write("#stagiaire, libelle formation, date debut, date fin\n")
    for s in liste_formation:
        partie1_stagiaire.write(str(s)+"\n")
    partie1.close()
    partie1_stagiaire.close()
    partie1_formateur_session.close()
    access.close()

    print("inserer dans phpmyadmin")
    print("enregistrer dans partie2-in.sql")
    print("lancer partie2")



writeAllData('2008')

##lancement de toutes les annes a la suite
# for i in range (2008,2017+1):
#     print(str(i))
#     writeAllData(str(i))
