# on a nos stagiaires
# on a nos sessions
# on a les intervenants
#on a la liste des formateurs de chaque session

import utils

def writeAllData(annee):
    partie2=open("import_to_db/partie2/"+annee+"-2.sql","w")
    access=open("export access/dump"+annee+".sql","r")
    for ligne in access:
        ## parcourir detail feuille
        if "INSERT INTO `detail feuille`" in ligne:
            mots=utils.tsplit(ligne,(',','('))
            for i in range (len(mots)):
                if "VALUES" in mots[i]:
                    j=i
                    # get infos detail
                    num=mots[j+1]
                    nom=mots[j+2]
                    h_present=utils.timeToDecimal(mots[j+3].split(' ')[-1].strip("'"))
                    h_absent=utils.timeToDecimal(mots[j+4].split(' ')[-1].split("'")[0])
                    h_facture=utils.timeToDecimal(mots[j+5].split(' ')[-1].split("'")[0])
                    motif=mots[j+6]
                    type_formation='NULL'
                    session_id=0

                    php = open("partie2-in.sql","r")
                    for ligne_php in php:
                        ## parcourir session phpmyadmin
                        if "INSERT INTO `session`" in ligne_php:
                            mots_php=utils.tsplit(ligne_php,(",","("))
                            stagiaire_id=0
                            php_session_id=mots_php[13]
                            php_formation_id=mots_php[14]
                            php_num=mots_php[15].split(' ')[-1] ##retirer l'espace
                            # si num emargement de access == num_emargement de phpmyadmin
                            if num == php_num:
                                session_id=php_session_id
                        # parcourir stagiaire phpmyadmin
                        if "INSERT INTO `stagiaire`" in ligne_php:

                            mots_php=utils.tsplit(ligne_php,(","))
                            php_nom=mots_php[13]
                            # si nom prenom detail ~= nom prenom phpmyadmin
                            if utils.highsimilar(nom,php_nom):
                                # get id stagiaire
                                ##rechercher dans la liste partie1_stagiaire le stagiaire

                                partie1_stagiaire=open("import_to_db/partie1/partie1_stagiaire","r")
                                for ligne_prerequis in partie1_stagiaire:
                                    mots_stagiaire=utils.tsplit(ligne_prerequis,(",",")"))
                                    if utils.highsimilar(nom,mots_stagiaire[0]):

                                        # recuperer son id
                                        stagiaire_id=mots_php[10].split('(')[-1]
                                        partie2.write("INSERT INTO `detail_session` (session_id,stagiaire_id,h_present,h_absent,h_facture,motif_absence) VALUES (")
                                        partie2.write(str(session_id)+","+str(stagiaire_id)+","+h_present+","+h_absent+","+h_facture+","+motif+"\n")
                                partie1_stagiaire.close()
                        ## insert detail session
                    php.close()

    ## dans liste session_intervenant
    partie1_formateur_session=open("import_to_db/partie1/partie1_formateur_session")
    for ligne_formateur in partie1_formateur_session:
        mots_formateur=utils.tsplit(ligne_formateur,(",",")"))
        formateur_num=mots_formateur[0].strip('(').strip("'")
        formateur_nom=mots_formateur[1]
        ##parcourir phpmyadmin
        php = open("partie2-in.sql","r")
        for ligne_php in php:
            ## parcourir session phpmyadmin
            mots_php=utils.tsplit(ligne_php,(",","("))
            if "INSERT INTO `intervenant`" in ligne_php:
                if utils.highsimilar(formateur_nom,mots_php[5]):
                    formateur_id=mots_php[4]
            if "INSERT INTO `session`" in ligne_php:
                ## si num_emargement identique
                session_num=mots_php[15].split(' ')[-1]
                if formateur_num==session_num:
                    formateur_session_id=mots_php[13]
                    partie2.write("INSERT INTO `session_intervenant` (session_id,intervenant_id) VALUES (")
                    partie2.write(str(formateur_session_id)+","+str(formateur_id)+");\n")
    partie1_formateur_session.close()

    print("inserer dans phpmyadmin")
    print("enregistrer dans phpmyadmin.sql")
    print("faire une copie (facultatif)")
    print("lancer partie1 de l'annee precedente")



writeAllData("2008")
