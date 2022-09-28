// BACK TOP TOP FONCTIONNALITE
const backToTop = document.querySelector(backToTop);
// Configuration d'une fonction pour l'affichage du bouton back to top avec l'injection de la classe "show"
const scrollFunction = () => {
  let y = window.scrollY;
  if (y > 0) {
    backToTop.classList.add("show");
  } else {
    backToTop.classList.remove("show");
  }
};

// Appel de la fonction "scrollFunction" dans un évènement au scroll, pour l'affichage du bouton back to top
window.addEventListener("scroll", scrollFunction);

// Création d'une fonction pour animé le scroll de la page. On part sur une valeur de 10 pour un scroll lent et un effet smooth
const scrollToTop = () => {
  const position =
    document.documentElement.scrollTop || document.body.scrollTop;

  if (position > 0) {
    window.requestAnimationFrame(scrollToTop);
    window.scrollTo(0, position - position / 10);
  }
};

// Appel des fonctions scrollToTop au click
backToTop.onclick = function (e) {
  scrollToTop();
};

// Activation de la fonctionnalité back to top au click
window.addEventListener("click", (e) => {
  document.body.animate({ scrollY: 0 }, "300");
});
