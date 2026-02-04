<script setup>
import { useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    items: {
        type: Array,
        default: () => [],
    },
});

const classes = ["1ère année", "2ème année", "3ème année"];
const mois = ["Novembre", "Décembre", "Janvier"];
const modulesDisponibles = [
    "Analyse et conception UML",
    "Base de données avancée",
    "Développement Web",
    "Programmation orientée objet",
];

const form = useForm({
    classe: "",
    mois: "",
    nouveauModule: "",
    planning: [],
});

function ajouterModule() {
    if (!form.nouveauModule) return;
    form.planning.push({
        date: "",
        heureDebut: "",
        heureFin: "",
        module: form.nouveauModule,
    });
    form.nouveauModule = "";
}

function enregistrer() {
    // ⚠️ Si tu n’utilises pas Ziggy, mets directement l’URL :
    form.post("/enseignant/emplois-du-temps/enregistrer");
}

const itemsParDate = computed(() => {
    const map = {};
    (props.items || []).forEach((i) => {
        if (!map[i.date]) map[i.date] = [];
        map[i.date].push(i);
    });
    return map;
});
</script>

<template>
    <div class="page-bg">
        <nav class="navbar">
            <h1>INPF - Informatique de Gestion</h1>
            <ul>
                <li>
                    <a href="/enseignant/emplois-du-temps" class="active"
                        >Emplois Du Temps</a
                    >
                </li>
                <li><a href="/enseignant/notes">Notes</a></li>
                <li>
                    <a href="/enseignant/presence">Présence</a>
                </li>
            </ul>
        </nav>
        <button @click="$inertia.visit('/dashboard')" class="btn-secondary">
            ⬅ Retour
        </button>

        <div class="container">
            <h1 class="title">Emplois du Temps – INPF</h1>

            <!-- Sélecteurs -->
            <div class="selectors">
                <select v-model="form.classe" class="select">
                    <option disabled value="">Sélectionner une classe</option>
                    <option v-for="c in classes" :key="c">{{ c }}</option>
                </select>

                <select v-model="form.mois" class="select">
                    <option disabled value="">Sélectionner un mois</option>
                    <option v-for="m in mois" :key="m">{{ m }}</option>
                </select>
            </div>

            <!-- Modules -->
            <div class="modules">
                <h2 class="section-title">Modules disponibles</h2>
                <ul>
                    <li v-for="mod in modulesDisponibles" :key="mod">
                        {{ mod }}
                    </li>
                </ul>

                <input
                    v-model="form.nouveauModule"
                    placeholder="Nom du module"
                    class="input"
                />
                <button @click="ajouterModule" class="btn">Ajouter</button>
            </div>

            <!-- Planning -->
            <div class="planning">
                <h2 class="section-title">Planning à enregistrer</h2>
                <div
                    v-for="(item, index) in form.planning"
                    :key="index"
                    class="planning-item"
                >
                    <input v-model="item.date" type="date" class="input" />
                    <input
                        v-model="item.heureDebut"
                        type="time"
                        class="input"
                    />
                    <input v-model="item.heureFin" type="time" class="input" />
                    <input v-model="item.module" class="input" />
                </div>
            </div>

            <button @click="enregistrer" class="btn-primary">
                Enregistrer
            </button>

            <!-- Modules déjà enregistrés -->
            <div class="existing">
                <h2 class="section-title">Modules enregistrés</h2>
                <div
                    v-for="(list, date) in itemsParDate"
                    :key="date"
                    class="day"
                >
                    <h3 class="day-title">{{ date }}</h3>
                    <ul>
                        <li v-for="i in list" :key="i.id">
                            {{ i.heure_debut }}–{{ i.heure_fin }} •
                            {{ i.module }} • {{ i.classe }} ({{ i.mois }})
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.page-bg {
    min-height: 100vh;
    background: url("/images/images (4).jpeg") no-repeat center center fixed;
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
.container {
    max-width: 1000px;
    margin: auto;
    background: rgb(175, 218, 245);
    border-radius: 12px;
    padding: 32px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}
.title {
    font-size: 28px;
    font-weight: bold;
    color: #1f2d3d;
    margin-bottom: 24px;
    text-align: center;
}
.selectors {
    display: flex;
    gap: 16px;
    margin-bottom: 24px;
}
.select {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}
.modules {
    margin-bottom: 32px;
}
.section-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 12px;
}
.input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}
.btn {
    background: #007bff;
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 8px;
}
.btn-primary {
    width: 100%;
    background: #007bff;
    color: white;
    padding: 12px;
    font-weight: bold;
    border-radius: 8px;
    margin-top: 24px;
}
.planning-item {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 2fr;
    gap: 12px;
    margin-bottom: 12px;
}
.existing {
    margin-top: 32px;
}
.day {
    background: #f7f9fc;
    border-radius: 8px;
    padding: 12px;
    margin-bottom: 12px;
}
.day-title {
    font-weight: 600;
    margin-bottom: 8px;
}
</style>
