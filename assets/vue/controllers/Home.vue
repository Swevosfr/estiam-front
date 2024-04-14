<template>
  <div class="mdp-list">
    <h2>Liste des mots de passe</h2>
    <table>
      <thead>
        <tr>
          <th>Nom du site/service</th>
          <th colspan="2">Mot de passe</th>
          <th>Note</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="mdp in mdps" :key="mdp.id">
          <td>{{ mdp.nom }}</td>
          <td>{{ mdp.showPassword ? mdp.motDePasse : "******" }}</td>
          <td>
            <button
              @click="togglePasswordVisibility(mdp)"
              class="password-button"
            >
              {{ mdp.showPassword ? "Masquer" : "Afficher" }}
            </button>
          </td>
          <td>{{ mdp.note }}</td>
          <td>
            <button
              @click="openEditModal(mdp)"
              class="password-button-modifier"
            >
              Modifier
            </button>
            <button
              @click="deleteMdp(mdp.id)"
              class="password-button-supprimer"
            >
              Supprimer
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Modal pour la modification -->
    <div v-if="showEditModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="closeEditModal">&times;</span>
        <h3>Modifier le mot de passe</h3>
        <label for="edit-nom">Nom :</label>
        <input type="text" v-model="editedMdp.nom" id="edit-nom" />
        <label for="edit-mot-de-passe">Mot de passe :</label>
        <input
          type="password"
          v-model="editedMdp.motDePasse"
          id="edit-mot-de-passe"
        />
        <label for="edit-note">Note :</label>
        <textarea v-model="editedMdp.note" id="edit-note"></textarea>
        <button @click="saveEditedMdp" class="button_enregistrer">
          Enregistrer
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
//commenting
export default {
  data() {
    return {
      mdps: [],
      showEditModal: false,
      editedMdp: {},
    };
  },
  mounted() {
    this.fetchMdps();
  },
  methods: {
    async fetchMdps() {
      try {
        const userId = localStorage.getItem("userId");
        const response = await axios.get(
          `http://192.168.90.3/api/mdp/${userId}`
        );
        this.mdps = response.data.map((mdp) => ({
          ...mdp,
          showPassword: false,
        }));
        console.log(response.data);
      } catch (error) {
        console.error(
          "Erreur lors de la récupération des mots de passe:",
          error
        );
      }
    },
    togglePasswordVisibility(mdp) {
      mdp.showPassword = !mdp.showPassword;
    },
    async deleteMdp(id) {
      try {
        await axios.delete(`http://192.168.90.3/api/mdp/${id}`);
        this.mdps = this.mdps.filter((mdp) => mdp.id !== id);
        console.log("Mot de passe supprimé avec succès");
      } catch (error) {
        console.error("Erreur lors de la suppression du mot de passe:", error);
        alert(
          "Une erreur s'est produite lors de la suppression du mot de passe. Veuillez réessayer."
        );
      }
    },
    openEditModal(mdp) {
      this.editedMdp = { ...mdp }; // Copie du mot de passe à modifier
      this.showEditModal = true;
    },
    closeEditModal() {
      this.showEditModal = false;
    },
    async saveEditedMdp() {
      try {
        await axios.put(
          `http://192.168.90.3/api/mdp/${this.editedMdp.id}`,
          this.editedMdp
        );
        this.showEditModal = false;
        console.log("Mot de passe modifié avec succès");

        // Rafraîchir la page après une modification réussie
        this.fetchMdps();
      } catch (error) {
        console.error("Erreur lors de la modification du mot de passe:", error);
        alert(
          "Une erreur s'est produite lors de la modification du mot de passe. Veuillez réessayer."
        );
      }
    },
  },
};
</script>

<style scoped>
.mdp-list {
  max-width: 800px;
  margin: 0 auto;
}
.test {
  color: blue;
}

table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background-color: #f5f5f5;
}

th,
td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

th {
  text-align: left;
}

tr:hover {
  background-color: #f2f2f2;
}

.password-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
}

.password-button:hover {
  background-color: #0056b3;
}

.password-button-modifier {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
}

.button_enregistrer {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
}

.password-button-supprimer {
  background-color: red;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
  margin: 10px;
}

.modal {
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: #fefefe;
  padding: 20px;
  border: 1px solid #888;
  width: 40%;
  border-radius: 10px;
}

.modal-content label {
  display: block;
  margin-bottom: 10px;
}

.modal-content input,
.modal-content textarea {
  width: calc(100% - 20px);
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 5px;
  margin-bottom: 15px;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.modal-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 5px;
  cursor: pointer;
  margin-right: 10px;
}

.modal-button:hover {
  background-color: #0056b3;
}
</style>
