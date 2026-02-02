<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});
</script>

<template>
    <link
        rel="stylesheet"
        href="/gestion-ecole/public/images/orientation.jpg"
    />
    <div class="login-container">
        <h1>Connexion</h1>

        <form @submit.prevent="form.post(route('login'))">
            <input v-model="form.email" type="email" placeholder="Email" />
            <span v-if="form.errors.email" class="error">{{
                form.errors.email
            }}</span>

            <input
                v-model="form.password"
                type="password"
                placeholder="Mot de passe"
            />
            <span v-if="form.errors.password" class="error">{{
                form.errors.password
            }}</span>

            <label>
                <input type="checkbox" v-model="form.remember" /> Se souvenir de
                moi
            </label>

            <button type="submit">Se connecter</button>
            <a href="/register">S'inscrire</a>
            <a href="/forgot-password">Mot de passe oublié ?</a>
        </form>
    </div>
</template>
