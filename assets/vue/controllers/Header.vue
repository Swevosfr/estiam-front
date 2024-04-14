<template>
  <nav class="header-nav">
    <a href="/home" class="nav-link">Home</a>
    <a href="/ajouter_mdp" class="nav-link">Ajouter des mdp</a>

    <a href="#" class="nav-link" @click="logout">Déconnexion</a>
  </nav>
</template>

<script>
export default {
  methods: {
    logout() {
      // Rediriger vers la page de connexion
      window.location.href = "/login";
    },
  },
};
</script>

<style>
.header-nav {
  background-color: #007bff; /* Couleur de fond bleue */
  padding: 10px 20px; /* Espacement intérieur */
  display: flex; /* Affichage en ligne */
  justify-content: center; /* Centrer horizontalement */
  align-items: center; /* Centrer verticalement */
  position: sticky; /* Rendre le header sticky */
  top: 0; /* Fixer le header en haut de la fenêtre */
  z-index: 1000; /* Assurer que le header est au-dessus de tout autre contenu */
}

.nav-link {
  margin-right: 20px; /* Marge à droite entre les liens */
  padding: 10px 15px; /* Espacement intérieur des liens */
  text-decoration: none; /* Supprimer la décoration du texte */
  color: white; /* Couleur du texte blanc */
  font-weight: bold; /* Texte en gras */
  border-radius: 5px; /* Bord arrondi */
  transition: background-color 0.3s ease; /* Transition en douceur lors du survol */
}

.nav-link:hover {
  background-color: #0056b3; /* Couleur de fond bleu foncé au survol */
}
</style>
