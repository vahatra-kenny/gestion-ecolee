<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});
</script>

<template>
    <div class="page-bg">
        <div class="card">
            <h2 class="title">Connexion</h2>

            <form @submit.prevent="form.post(route('login'))" class="form">
                <!-- Email -->
                <input
                    v-model="form.email"
                    type="email"
                    placeholder="Email"
                    class="input"
                />
                <span v-if="form.errors.email" class="error">{{
                    form.errors.email
                }}</span>

                <!-- Mot de passe -->
                <input
                    v-model="form.password"
                    type="password"
                    placeholder="Mot de passe"
                    class="input"
                />
                <span v-if="form.errors.password" class="error">{{
                    form.errors.password
                }}</span>

                <!-- Se souvenir -->
                <label class="remember">
                    <input type="checkbox" v-model="form.remember" />
                    Se souvenir de moi
                </label>

                <!-- Boutons -->
                <button
                    type="submit"
                    class="btn-primary"
                    :disabled="form.processing"
                >
                    Se connecter
                </button>
                <a href="/register" class="btn-secondary">S'inscrire</a>
                <a href="/forgot-password" class="link"
                    >Mot de passe oublié ?</a
                >
            </form>
        </div>
    </div>
</template>

<style scoped>
/* Fond dégradé bleu */
.page-bg {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: url("/images/images (8).jpeg") no-repeat center center fixed;
    background-size: cover;
    padding: 24px;
}

/* Carte blanche */
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

.error {
    color: red;
    font-size: 13px;
}

.remember {
    font-size: 14px;
    color: #2f3b4a;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* Bouton bleu */
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

/* Bouton orange */
.btn-secondary {
    display: block;
    text-align: center;
    background: orange;
    color: #ffffff;
    padding: 0.75rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
}

.btn-secondary:hover {
    background: #e69500;
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
