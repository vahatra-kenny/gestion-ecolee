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
    <div class="page-bg">
        <div class="card">
            <h2 class="title">Inscription</h2>

            <form @submit.prevent="form.post(route('register'))" class="form">
                <input
                    v-model="form.nom"
                    type="text"
                    placeholder="Nom"
                    class="input"
                />
                <input
                    v-model="form.prenom"
                    type="text"
                    placeholder="Prénom"
                    class="input"
                />
                <input
                    v-model="form.email"
                    type="email"
                    placeholder="Email"
                    class="input"
                />
                <input
                    v-model="form.password"
                    type="password"
                    placeholder="Mot de passe"
                    class="input"
                />
                <input
                    v-model="form.password_confirmation"
                    type="password"
                    placeholder="Confirmer mot de passe"
                    class="input"
                />

                <div class="radio-row">
                    <label class="radio-item">
                        <input
                            type="radio"
                            value="etudiant"
                            v-model="form.role"
                        />
                        <span>Étudiant</span>
                    </label>
                    <label class="radio-item">
                        <input
                            type="radio"
                            value="enseignant"
                            v-model="form.role"
                        />
                        <span>Enseignant</span>
                    </label>
                    <label class="radio-item">
                        <input type="radio" value="admin" v-model="form.role" />
                        <span>Admin</span>
                    </label>
                </div>

                <button
                    type="submit"
                    class="btn-primary"
                    :disabled="form.processing"
                >
                    S'inscrire
                </button>
                <a href="/login" class="link">Déjà inscrit ?</a>
            </form>
        </div>
    </div>
</template>

<style scoped>
/* Fond dégradé bleu */
.page-bg {
    background: url("/public/images/orientation.jpg");
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(180deg, #66b2ff 0%, #007bff 100%);
    padding: 24px;
}

/* Carte blanche centrée */
.card {
    width: 100%;
    max-width: 420px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    padding: 28px;
}

.title {
    margin: 0 0 18px;
    text-align: center;
    font-size: 22px;
    font-weight: 700;
    color: #1f2d3d;
}

.form {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

/* Champs */
.input {
    width: 100%;
    height: 44px;
    padding: 0 12px;
    border: 1px solid #d7dee7;
    border-radius: 8px;
    background: #fff;
    color: #1f2d3d;
    font-size: 14px;
}

.input::placeholder {
    color: #7a8aa0;
}

/* Radios horizontaux */
.radio-row {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    padding: 8px 10px;
    border: 1px solid #d7dee7;
    border-radius: 8px;
    background: #f9fbff;
}

.radio-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #2f3b4a;
}

/* Bouton principal */
.btn-primary {
    height: 44px;
    border: none;
    border-radius: 8px;
    background: #007bff;
    color: #ffffff;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
}

.btn-primary:hover {
    background: #0069d9;
}

/* Lien bas */
.link {
    display: block;
    text-align: center;
    color: #007bff;
    text-decoration: underline;
    font-size: 14px;
    margin-top: 6px;
}
</style>
