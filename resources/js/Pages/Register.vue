<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    nom: "",
    prenom: "",
    email: "",
    password: "",
    password_confirmation: "",
    role: "etudiant",
});
</script>

<template>
    <div class="register-container">
        <h1>Inscription</h1>

        <form @submit.prevent="form.post(route('register'))">
            <input v-model="form.nom" placeholder="Nom" />
            <input v-model="form.prenom" placeholder="Prénom" />
            <input v-model="form.email" type="email" placeholder="Email" />
            <input
                v-model="form.password"
                type="password"
                placeholder="Mot de passe"
            />
            <input
                v-model="form.password_confirmation"
                type="password"
                placeholder="Confirmer mot de passe"
            />

            <div class="roles">
                <label
                    ><input type="radio" value="etudiant" v-model="form.role" />
                    Étudiant</label
                >
                <label
                    ><input
                        type="radio"
                        value="enseignant"
                        v-model="form.role"
                    />
                    Enseignant</label
                >
                <label
                    ><input type="radio" value="admin" v-model="form.role" />
                    Admin</label
                >
            </div>

            <button type="submit">S'inscrire</button>
            <a href="/login">Déjà inscrit ?</a>
        </form>
    </div>
</template>
