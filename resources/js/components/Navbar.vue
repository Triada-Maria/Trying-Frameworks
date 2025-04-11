<!--Navbar.vue-->
<template>
    <nav class="navbar navbar-expand-lg navbar-acm">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center gap-2" href="https://www.instagram.com/acmauth" target="_blank">
                <img :src="logo" alt="Logo" height="50" class="brand-logo me-2" />
                <span>ACM Auth</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item me-3">
                        <router-link class="nav-link" :class="{ active: $route.name === 'home' }" to="/home">Home</router-link>
                    </li>
                    <li class="nav-item me-3">
                        <router-link class="nav-link" :class="{ active: $route.name === 'events' }" to="/events">Events</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
    const logo = '/images/LogoACM.png'
</script>

<style scoped>
    .navbar-acm {
        background: linear-gradient(45deg, #0069bf, #03a5fc);
    }
    .navbar-brand {
        color: #ffffff;
        font-size: 1.5rem;
        font-weight: bold;
        transition: transform 0.3s ease;
    }
    .navbar-brand:hover {
        transform: scale(1.05);
    }
    .nav-link {
        color: #ffffff;
        font-size: 1.5rem;
        transition: transform 0.3s ease, text-decoration 0.3s ease;
    }
    .nav-link:hover {
        transform: scale(1.1);
        text-decoration: underline;
    }
    .nav-link.active {
        text-decoration: underline;
        color: #ffffff;
    }
    .brand-logo {
        max-width: 50px;
        height: auto;
    }
    .container-fluid {
        padding-left: 0;
        padding-right: 0;
    }
</style>