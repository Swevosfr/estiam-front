<!-- Template de votre page de connexion -->
<template>
  <div>
    <h1>Connexion</h1>
    <div class="square-container">
      <form @submit.prevent="login">
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="email" required />
        </div>
        <div>
          <label for="password">Mot de passe:</label>
          <input type="password" id="password" v-model="password" required />
        </div>
        <button type="submit">Se connecter</button>
        <a href="/register" class="btn btn-secondary"
          >Pas de compte ? Inscrivez vous ici !</a
        >
      </form>
    </div>

    <p v-if="error">{{ error }}</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      email: "",
      password: "",
      error: "",
    };
  },
  methods: {
    async login() {
      try {
        const response = await axios.post("http://192.168.90.3/api/login", {
          email: this.email,
          password: this.password,
        });

        // Stocker l'ID de l'utilisateur dans le stockage local
        localStorage.setItem("userId", response.data.user.id);
        // Redirection vers la page de tableau de bord en cas de succès
        window.location.href = "/home";
      } catch (error) {
        // Affichage de l'erreur en cas d'échec de connexion
        this.error = error.response.data.message;
      }
    },
  },
};
</script>
<style scoped>
.square-container {
  width: 400px; /* Taille du conteneur */
  height: 400px; /* Taille du conteneur */
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  background-color: #f9f9f9;
  /* Centrer verticalement et horizontalement */
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

/* Styles pour le titre */
h1 {
  text-align: center;
  margin-bottom: 20px;
}

/* Styles pour le formulaire */
form {
  width: 100%;
}

/* Styles pour les étiquettes des champs */
label {
  font-weight: bold;
  margin-bottom: 5px;
}

/* Styles pour les champs de saisie */
input {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding-right: 10px;
}

/* Styles pour le bouton de soumission */
button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}

/* Styles pour les messages d'erreur */
.error {
  color: red;
  margin-top: 10px;
}
</style>
