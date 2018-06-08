$(document).ready(function() {
  //ajouter au parent de legend une div. ajouter legend a cette div
  $('#detail').parent().prepend('<div class="col-sm-2" id="wrapper"></div>');
  $('#wrapper').parent().css("flex-wrap","nowrap");
  $('#wrapper').parent().css("display","flex");
  $('#wrapper').parent().css("justify-content","space-between");
  $('#wrapper').prepend($('<a href="#" id="add_formation" class="btn btn-primary">Ajouter une formation</a>'));
  $('#wrapper').prepend($('#detail'));


  // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
  let $container = $('div#ocasbundle_stagiaire_detail_session');

  // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
  nb_elem = $container.children().length;

  // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
  $('#add_formation').click(function(e) {
    addFormation($container);
    e.preventDefault(); // évite qu'un # apparaisse dans l'URL
    return false;
  });

  // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'un nouvelle-au stagiaire par exemple).
  if (nb_elem > 0) {
      // S'il existe déjà des sessions
      $container.children('div').children('legend').each(function(index) {
      // on ajoute le numero de la formation a chacune
      this.textContent='Formation n° '+(index+1);

      // on ajoute un lien de suppression pour chacune d'entre elles
    });
    $container.children('div').each(function(){
      addDeleteLink($(this));
    })
  }
});

  // La fonction qui ajoute un formulaire DetailType
  function addFormation($container) {

    // Dans le contenu de l'attribut « data-prototype », on remplace :
    // - le texte "__name__label__" qu'il contient par le label du champ
    // - le texte "__name__" qu'il contient par le numéro du champ
    let template = $container.attr('data-prototype')
      .replace(/__name__label__/g, 'Formation n°' + (nb_elem+1))
      .replace(/__name__/g,        nb_elem);

    // On crée un objet jquery qui contient ce template
    let $prototype = $(template);
    // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
    addDeleteLink($prototype);

    // On ajoute le prototype modifié à la fin de la balise <div>
    $container.append($prototype);

    disableElem($prototype.find('select.select_session'));

    // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
    nb_elem++;
}

  //desactive et vide le champ
  function disableElem(elem){
    elem.attr('disabled','disabled');
    elem.html('');
  }

  function addError(errorThrown,session){
    disableElem(session);

    if ($('p.error').length ===0){
      $('label.select_libelle').parent().append('<p class="error">'+errorThrown+'</p>');
    }
  }

  function updateList(liste_response,session){
    $('label.select_libelle').parent().find('p').remove();
    session.html('');
    session.removeAttr('disabled');
    // session.append("<option value=''></option>");
    for (var i = 0; i < liste_response.length; i++) {
      let libelle = liste_response[i]['libelle_formation'];
      let date = formatDate(liste_response[i]['date_seance'].date);
      let groupe = '';
      console.log(liste_response[i]['groupe']);
      if (liste_response[i]['groupe'] !== null) {
        groupe = ' - groupe '+liste_response[i]['groupe'];
      } else {
        groupe = '';
      }
      session.append('<option value="'+ liste_response[i]['id'] +'"> '+date+ groupe+' - '+ libelle+' </option>');
    }
  }

  // string date de yyyy-mm-dd hh:mm:ssss vers jj/mm/aaaa
  function formatDate(date){
    date = date.split(' ')[0];
    split_date = date.split('-');
    date= split_date[2]+'/'+split_date[1]+'/'+split_date[0];
    return date;
  }

  // La fonction qui ajoute un lien de suppression d'une catégorie
  function addDeleteLink($prototype) {
    // Création du lien
    let $deleteLink = $('<a href="#" class="btn btn-danger">Retirer</a>');
    let $saveLink = $('<a type="button" id="libelle_session" class="btn btn-primary">Enregistrer</a>');
    // Ajout du lien
    $prototype.append($deleteLink);
    $prototype.append($saveLink);
    // Ajout du listener sur le clic du lien pour effectivement supprimer la catégorie
    $deleteLink.click(function(e) {
      $prototype.remove();
      nb_elem-=1;
      e.preventDefault(); // évite qu'un # apparaisse dans l'URL
      return false;
    });

    // Ajout du listener sur le clic du lien pour submit la catégorie
    $saveLink.click(function(e) {
      console.log("do");
      e.preventDefault(); // évite qu'un # apparaisse dans l'URL
      let parent = $saveLink.parent().children("div.col-sm-10").find("div :first-child")
      let session = parent.parent().children('div.form-group.row div.col-sm-10 select.select_session');
      let libelle = parent.children('select option:selected')[0].text;
      $.ajax({
        method: "POST",
        url: '/stagiaire/'+libelle+'/search',
        dataType: "html",
        data: libelle
    }).done( function(response) {
        console.log("done");
        let liste_response = JSON.parse(response);
        updateList(liste_response,session);

    }).fail(function(jxh,textmsg,errorThrown){
      console.log('fail');
        if (errorThrown == 'Not Found'){
          errorThrown="Pas de session correspondante";
        };
      addError(errorThrown,session);
    });
    })
  }
