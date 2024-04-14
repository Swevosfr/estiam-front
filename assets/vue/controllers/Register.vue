<template>
  <div>
    <h1>Inscription</h1>
    <div class="square-container">
      <form @submit.prevent="register">
        <div>
          <label for="username">Nom d'utilisateur:</label>
          <input type="text" id="username" v-model="username" required />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" v-model="email" required />
        </div>
        <div>
          <label for="password">Mot de passe:</label>
          <input type="password" id="password" v-model="password" required />
        </div>
        <button type="submit">S'inscrire</button>
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
      username: "",
      email: "",
      password: "",
      error: "",
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post("http://192.168.90.3/api/register", {
          username: this.username,
          email: this.email,
          password: this.password,
        });

        // Redirection vers la page de connexion en cas d'inscription réussie
        window.location.href = "/login";
      } catch (error) {
        // Affichage de l'erreur en cas d'échec de l'inscription
        this.error = error.response.data.message;
      }
    },
  },
};
</script>

<style scoped>
.square-container {
  width: 400px; /* Taille du conteneur */
  margin: 0 auto;
  padding: 20px;
  background-color: #f0f0f0;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Styles pour le titre */
h1 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
}

/* Styles pour les champs de saisie */
input {
  width: calc(100% - 20px); /* Largeur moins le padding */
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

/* Styles pour le bouton de soumission */
button {
  width: calc(100% - 20px); /* Largeur moins le padding */
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
  text-align: center;
}
</style>
