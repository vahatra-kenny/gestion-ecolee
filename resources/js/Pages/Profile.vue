<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    current_password: "",
});
</script>

<template>
    <div class="page-bg">
        <div class="card">
            <h2 class="title">Profil utilisateur</h2>

            <!-- Informations du profil -->
            <section class="section">
                <h3 class="section-title">Informations du profil</h3>
                <p class="section-desc">
                    Modifiez votre nom et votre adresse email.
                </p>

                <input
                    v-model="form.name"
                    type="text"
                    placeholder="Nom"
                    class="input"
                />
                <input
                    v-model="form.email"
                    type="email"
                    placeholder="Email"
                    class="input"
                />

                <button class="btn-primary">Enregistrer</button>
            </section>

            <!-- Mot de passe -->
            <section class="section">
                <h3 class="section-title">Modifier le mot de passe</h3>
                <p class="section-desc">
                    Utilisez un mot de passe long et sécurisé.
                </p>

                <input
                    v-model="form.current_password"
                    type="password"
                    placeholder="Mot de passe actuel"
                    class="input"
                />
            </section>
        </div>
    </div>
</template>

<style scoped>
.page-bg {
    min-height: 100vh;
    background: url("/images/bg.jpeg") no-repeat center center fixed;
    background-size: cover;
    padding: px;
    font-family: "Inter", sans-serif;
}

.card {
    width: 100%;
    max-width: 500px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 32px;
}

.title {
    font-size: 24px;
    font-weight: bold;
    color: #1f2d3d;
    text-align: center;
    margin-bottom: 24px;
}

.section {
    margin-bottom: 32px;
}

.section-title {
    font-size: 18px;
    font-weight: 600;
    color: #2f3b4a;
    margin-bottom: 6px;
}

.section-desc {
    font-size: 14px;
    color: #6c7a89;
    margin-bottom: 12px;
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
    margin-bottom: 12px;
}

.btn-primary {
    width: 100%;
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
</style>
