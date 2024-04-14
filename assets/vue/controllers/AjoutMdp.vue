<template>
  <div class="add-password-form">
    <h2>Ajouter un mot de passe</h2>
    <form @submit.prevent="submitForm">
      <div>
        <label for="nom">Nom du site/service:</label>
        <input type="text" id="nom" v-model="nom" required />
      </div>
      <div>
        <label for="mot_de_passe">Mot de passe:</label>
        <input
          type="password"
          id="mot_de_passe"
          v-model="motDePasse"
          required
        />
      </div>
      <div>
        <label for="note">Note (facultatif):</label>
        <textarea id="note" v-model="note"></textarea>
      </div>
      <button type="submit">Ajouter</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nom: "",
      motDePasse: "",
      note: "",
    };
  },
  methods: {
    async submitForm() {
      
      try {
        const userId = localStorage.getItem("userId");
        const response = await fetch(`http://192.168.90.3/api/mdp/${userId}`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            nom: this.nom,
            mot_de_passe: this.motDePasse,
            note: this.note,
          }),
        });
        const data = await response.json();
        console.log(data); // Afficher la réponse du serveur (facultatif)
        // Réinitialiser le formulaire après l'ajout du mot de passe
        this.nom = "";
        this.motDePasse = "";
        this.note = "";
        // Rediriger vers une autre page si nécessaire
        // this.$router.push('/dashboard');
      } catch (error) {
        console.error("Erreur lors de l'ajout du mot de passe:", error);
      }
    },
  },
};
</script>

<style scoped>
.add-password-form {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
}

.add-password-form h2 {
  text-align: center;
  margin-bottom: 20px;
}

.add-password-form form div {
  margin-bottom: 15px;
}

.add-password-form label {
  font-weight: bold;
}

.add-password-form input,
.add-password-form textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.add-password-form button {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.add-password-form button:hover {
  background-color: #0056b3;
}
</style>
