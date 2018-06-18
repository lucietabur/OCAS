$(document).ready(function() {

  //ajouter au parent de legend une div. ajouter legend a cette div

  // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.

  // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
  let container = $('div#stagiaires_0').parent().parent().parent();
  let nb_elem = container.children().length;

  if (nb_elem > 0) {
      // S'il existe des stagiaires
      for (let i = 0; i < nb_elem; i++) {
        // console.log(nb_elem);
        // on ajoute le numero du stagiaire a chaque bloc
        let block = $('div#stagiaires_'+i).parent().parent();
        // console.log(block);
        block.addClass('repeated_stagiaire')
        block.children('legend').text('Stagiaire n° '+(i+1));
        //$('div#stagiaire_'+i).
      }
  }
});
