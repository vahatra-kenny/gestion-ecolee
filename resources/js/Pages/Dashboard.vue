<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Gestion Informatique INPF" />

    <div class="page-bg">
        <!-- Barre supérieure -->
        <header class="topbar">
            <div class="left">
                <h1 class="title">Gestion Informatique INPF</h1>
                <nav class="nav-links">
                    <Link href="/enseignant/emplois-du-temps" class="nav-link">
                        Emplois du temps
                    </Link>

                    <Link href="/enseignant/notes" class="nav-link">
                        Notes
                    </Link>
                    <Link href="/enseignant/presence" class="nav-item"
                        >Présence
                    </Link>
                </nav>
            </div>

            <!-- Menu profil -->
            <div class="profile-menu">
                <details>
                    <summary class="profile-summary">Profil</summary>
                    <div class="dropdown">
                        <Link href="/profile" class="dropdown-item"
                            >Profile</Link
                        >
                        <Link
                            href="/logout"
                            method="post"
                            as="button"
                            class="dropdown-item"
                            >Log Out</Link
                        >
                    </div>
                </details>
            </div>
        </header>

        <!-- Image au centre -->

        <div class="image-box">
            <img
                src="/images/orientation.jpg"
                alt="Orientation universitaire"
                class="center-image"
            />
        </div>

        <!-- Contenu principal -->
        <main class="content-box">
            <p class="welcome animated-text">page d`IGM 2026 ©</p>
        </main>
    </div>
</template>

<style scoped>
.page-bg {
    min-height: 100vh;
    background: linear-gradient(180deg, #66b2ff 0%, #007bff 100%);
    margin: 0;
    padding: 0;
    font-family: "Segoe UI", sans-serif;
}

/* Barre supérieure */
.topbar {
    background: white;
    padding: 16px 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
}

.left {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.title {
    margin: 0;
    font-size: 26px;
    font-weight: bold;
    color: #1f2d3d;
}

.nav-links {
    margin-top: 10px;
    display: flex;
    gap: 20px;
}

.nav-item {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
}

.nav-item:hover {
    text-decoration: underline;
}

/* Menu profil */
.profile-menu {
    position: relative;
    font-size: 16px;
}

.profile-summary {
    cursor: pointer;
    font-weight: 600;
    color: #007bff;
}

.dropdown {
    position: absolute;
    right: 0;
    margin-top: 6px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 6px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.dropdown-item {
    display: block;
    padding: 8px 12px;
    font-size: 15px;
    color: #2f3b4a;
    text-decoration: none;
}

.dropdown-item:hover {
    background: #f0f2f5;
}

/* Image centrée */
.image-box {
    display: flex;
    justify-content: center;
    margin: 40px 0;
}

.center-image {
    max-width: 300px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* Contenu principal */
.content-box {
    margin: 20px auto;
    max-width: 600px;
    background: white;
    padding: 32px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.welcome {
    font-size: 18px;
    color: #2f3b4a;
}
.image-box {
    display: flex;
    justify-content: center;
    margin: 40px 0 20px;
}

.center-image {
    display: block;
    width: 100%; /* prend toute la largeur disponible */
    max-width: 800px; /* limite à 800px pour éviter qu’elle soit trop énorme */
    margin: 20px auto;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}
.welcome {
    font-size: 22px;
    font-weight: bold;
    color: #007bff;
}

/* Classe animation */
.animated-text {
    animation: fadeBounce 2s ease-in-out infinite;
}

/* Définition de l’animation */
@keyframes fadeBounce {
    0% {
        transform: translateY(0);
        opacity: 0.3;
    }
    50% {
        transform: translateY(-15px);
        opacity: 1;
    }
    100% {
        transform: translateY(0);
        opacity: 0.3;
    }
}
</style>
