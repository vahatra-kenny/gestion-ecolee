<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    etudiants: Array,
    absents: Array,
    classes: Array,
    professeurs: Array,
});

const selectedClasse = ref("");
const selectedProf = ref("");
const date = ref("");
const heureDebut = ref("");
const heureFin = ref("");
const selectedAbsents = ref([]);

const selectedEtudiant = ref(null);

// Formulaire ajout étudiant
const formEtudiant = useForm({ nom: "" });
function ajouterEtudiant() {
    formEtudiant.post("/enseignant/etudiants", {
        preserveScroll: true,
        onSuccess: () => formEtudiant.reset(),
    });
}

// Supprimer étudiant
function supprimerEtudiant(id) {
    if (confirm("Supprimer cet étudiant ?")) {
        formEtudiant.delete(`/enseignant/etudiants/${id}`);
    }
}

// Marquer présence/absence
function toggleAbsence(etudiant) {
    const index = selectedAbsents.value.findIndex((e) => e.id === etudiant.id);
    if (index === -1) {
        selectedAbsents.value.push(etudiant);
    } else {
        selectedAbsents.value.splice(index, 1);
    }
}

// Enregistrer la présence
function enregistrerPresence() {
    const absentIds = selectedAbsents.value.map((e) => e.id);
    formEtudiant.post("/enseignant/presence", {
        preserveScroll: true,
        data: {
            classe: selectedClasse.value,
            professeur: selectedProf.value,
            date: date.value,
            heure_debut: heureDebut.value,
            heure_fin: heureFin.value,
            absents: absentIds,
        },
        onSuccess: () => (selectedAbsents.value = []),
    });
}
</script>

<template>
    <div class="page-bg">
        <nav class="navbar">
            <h1>INPF - Informatique de Gestion</h1>
            <ul>
                <li><a href="/dashboard">Dashboard</a></li>
                <li>
                    <a href="/enseignant/emplois-du-temps">Emplois Du Temps</a>
                </li>
                <li><a href="/enseignant/notes">Notes</a></li>
                <li>
                    <a href="/enseignant/presence" class="active">Présence</a>
                </li>
            </ul>
        </nav>
        <button @click="$inertia.visit('/dashboard')">⬅ Retour</button>

        <div class="container grid">
            <!-- Colonne gauche -->
            <div class="left">
                <h2 class="section-title">Liste des étudiants</h2>

                <div class="filters">
                    <select v-model="selectedClasse" class="input">
                        <option disabled value="">-- Classe --</option>
                        <option v-for="c in props.classes" :key="c">
                            {{ c }}
                        </option>
                    </select>
                    <select v-model="selectedProf" class="input">
                        <option disabled value="">-- Professeur --</option>
                        <option v-for="p in props.professeurs" :key="p">
                            {{ p }}
                        </option>
                    </select>
                    <input type="date" v-model="date" class="input" />
                    <input type="time" v-model="heureDebut" class="input" />
                    <input type="time" v-model="heureFin" class="input" />
                </div>

                <ul>
                    <li
                        v-for="e in props.etudiants"
                        :key="e.id"
                        class="student-item"
                    >
                        {{ e.nom }}
                        <div class="actions">
                            <button
                                @click="toggleAbsence(e)"
                                :class="
                                    selectedAbsents.includes(e)
                                        ? 'btn-danger'
                                        : 'btn-primary'
                                "
                            >
                                {{
                                    selectedAbsents.includes(e)
                                        ? "Absent"
                                        : "Présent"
                                }}
                            </button>
                            <button
                                @click="supprimerEtudiant(e.id)"
                                class="btn-secondary"
                            >
                                🗑
                            </button>
                        </div>
                    </li>
                </ul>

                <div class="form">
                    <input
                        v-model="formEtudiant.nom"
                        placeholder="Nom étudiant"
                        class="input"
                    />
                    <button @click="ajouterEtudiant" class="btn-primary">
                        ➕ Ajouter étudiant
                    </button>
                </div>
            </div>

            <!-- Colonne droite -->
            <div class="right">
                <h2 class="section-title">Absents</h2>
                <ul>
                    <li
                        v-for="a in selectedAbsents"
                        :key="a.id"
                        class="absent-item"
                    >
                        {{ a.nom }}
                    </li>
                </ul>
                <p><strong>Total Abs :</strong> {{ selectedAbsents.length }}</p>
                <button @click="enregistrerPresence" class="btn-warning">
                    💾 Enregistrer
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.page-bg {
    min-height: 100vh;
    background: url("/images/images (3).jpeg") no-repeat center center fixed;
    background-size: cover;
    padding: px;
    font-family: "Inter", sans-serif;
}
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 16px 32px;
    border-radius: 12px;
    margin-bottom: 24px;
}
.navbar h1 {
    font-size: 20px;
    font-weight: bold;
}
.navbar ul {
    display: flex;
    gap: 24px;
    list-style: none;
}
.navbar a {
    text-decoration: none;
    color: #007bff;
    font-weight: 600;
}
.navbar a.active {
    color: #0056b3;
    text-decoration: underline;
}

.container.grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    background: rgb(175, 218, 245);
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}
.container {
    max-width: 3090px;
}

.section-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 16px;
    text-align: center;
}

.filters {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 16px;
}

.student-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f0f4ff;
    padding: 10px 14px;
    border-radius: 8px;
    margin-bottom: 8px;
}

.absent-item {
    background: #ffe5e5;
    padding: 8px 12px;
    border-radius: 6px;
    margin-bottom: 6px;
}

.actions {
    display: flex;
    gap: 8px;
}

.form {
    display: flex;
    gap: 12px;
    margin-top: 16px;
}

.input {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.btn-primary,
.btn-secondary,
.btn-warning,
.btn-danger {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
}

.btn-primary {
    background: #007bff;
    color: white;
}
.btn-secondary {
    background: #6c757d;
    color: white;
}
.btn-warning {
    background: #ffc107;
    color: black;
}
.btn-danger {
    background: #dc3545;
    color: white;
}
</style>
