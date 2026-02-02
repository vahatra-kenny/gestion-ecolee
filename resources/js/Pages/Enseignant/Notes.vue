<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    etudiants: Array,
    notes: Array,
});

const selectedEtudiant = ref(null);

// Formulaire ajout étudiant
const formEtudiant = useForm({ nom: "" });
function ajouterEtudiant() {
    formEtudiant.post("/enseignant/etudiants", {
        preserveScroll: true,
        onSuccess: () => formEtudiant.reset(),
    });
}

// Sélectionner un étudiant
function ouvrirNotes(etudiant) {
    selectedEtudiant.value = etudiant;
}

// Formulaire ajout note
const formNote = useForm({
    module: "",
    note: "",
    coefficient: "",
});
function ajouterNote() {
    if (!selectedEtudiant.value) return;
    formNote.post(`/enseignant/notes/${selectedEtudiant.value.id}`, {
        preserveScroll: true,
        onSuccess: () => formNote.reset(),
    });
}

// Calculs
function calculNC(note, coef) {
    return note && coef ? note * coef : 0;
}
function calculTotal(notes) {
    return notes.reduce((acc, n) => acc + n.note * n.coefficient, 0);
}
function calculMoyenne(notes) {
    const totalCoef = notes.reduce((acc, n) => acc + n.coefficient, 0);
    return totalCoef ? (calculTotal(notes) / totalCoef).toFixed(2) : 0;
}
</script>

<template>
    <div class="page-bg">
        <nav class="navbar">
            <h1>INPF - Informatique de Gestion</h1>
            <ul>
                <li>
                    <a href="/enseignant/emplois-du-temps">Emplois Du Temps</a>
                </li>
                <li><a href="/enseignant/notes" class="active">Notes</a></li>
                <li>
                    <a href="/enseignant/presence">Présence</a>
                </li>
            </ul>
        </nav>
        <button @click="$inertia.visit('/dashboard')">⬅ Retour</button>
        <div class="container grid">
            <!-- Colonne gauche -->
            <div class="left">
                <h2 class="section-title">Liste des étudiants</h2>
                <ul>
                    <li
                        v-for="e in props.etudiants"
                        :key="e.id"
                        class="student-item"
                    >
                        {{ e.nom }}
                        <button @click="ouvrirNotes(e)" class="btn-primary">
                            Notes
                        </button>
                    </li>
                </ul>
                <div class="form">
                    <input
                        v-model="formEtudiant.nom"
                        placeholder="Nom étudiant"
                        class="input"
                    />
                    <button @click="ajouterEtudiant" class="btn-secondary">
                        Ajouter étudiant
                    </button>
                </div>
            </div>

            <!-- Colonne droite -->
            <div class="right" v-if="selectedEtudiant">
                <h2 class="section-title">
                    Notes de {{ selectedEtudiant.nom }}
                </h2>

                <!-- Formulaire ajout note -->
                <div class="form-note">
                    <input
                        v-model="formNote.module"
                        placeholder="Module"
                        class="input"
                    />
                    <input
                        v-model="formNote.note"
                        type="number"
                        min="0"
                        max="20"
                        placeholder="Note"
                        class="input"
                    />
                    <input
                        v-model="formNote.coefficient"
                        type="number"
                        min="1"
                        placeholder="Coefficient"
                        class="input"
                    />
                    <button @click="ajouterNote" class="btn-primary">
                        Ajouter note
                    </button>
                </div>

                <!-- Tableau des notes -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Module</th>
                            <th>Note</th>
                            <th>Coefficient</th>
                            <th>N×C</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="n in props.notes.filter(
                                (x) => x.etudiant_id === selectedEtudiant.id,
                            )"
                            :key="n.id"
                        >
                            <td>{{ n.module }}</td>
                            <td>{{ n.note }}</td>
                            <td>{{ n.coefficient }}</td>
                            <td>{{ calculNC(n.note, n.coefficient) }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Totaux -->
                <div class="totals">
                    <p>
                        <strong>Total :</strong>
                        {{
                            calculTotal(
                                props.notes.filter(
                                    (x) =>
                                        x.etudiant_id === selectedEtudiant.id,
                                ),
                            )
                        }}
                    </p>
                    <p>
                        <strong>Moyenne :</strong>
                        {{
                            calculMoyenne(
                                props.notes.filter(
                                    (x) =>
                                        x.etudiant_id === selectedEtudiant.id,
                                ),
                            )
                        }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap");

.page-bg {
    min-height: 100vh;
    background: linear-gradient(180deg, #66b2ff 0%, #007bff 100%);
    padding: 40px;
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
    grid-template-columns: 1fr 2fr;
    gap: 32px;
    background: white;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    max-width: 3090px;
}
.container {
    max-width: 3090px;
}

.section-title {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 16px;
    text-align: center;
    color: #333;
}

.student-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f0f4ff;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 10px;
    font-size: 16px;
}

.form,
.form-note {
    display: flex;
    gap: 12px;
    margin-top: 20px;
}

.input {
    flex: 1;
    padding: 10px 14px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
    transition: border-color 0.3s;
}
.input:focus {
    border-color: #007bff;
    outline: none;
}

.btn-primary,
.btn-secondary,
.btn-warning,
.btn-danger {
    padding: 8px 14px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-primary {
    background: #007bff;
    color: white;
}
.btn-primary:hover {
    background: #0056b3;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}
.btn-secondary:hover {
    background: #5a6268;
}

.btn-warning {
    background: #ffc107;
    color: black;
}
.btn-danger {
    background: #dc3545;
    color: white;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 15px;
}
.table th,
.table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}
.table th {
    background: #f7f9fc;
    font-weight: 600;
}

.totals {
    margin-top: 20px;
    font-size: 17px;
    font-weight: bold;
    color: #333;
}
</style>
