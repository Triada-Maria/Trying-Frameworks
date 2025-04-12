<!--Navbar.vue-->
<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-navbar">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand d-flex align-items-center gap-2 text-dark" href="https://www.instagram.com/acmauth" target="_blank">
                <img :src="logo" alt="Logo" height="50" class="brand-logo me-2" />
                <span>ACM Auth</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item me-3">
                        <router-link class="nav-link text-dark" :class="{ active: $route.name === 'home' }" to="/home">Home</router-link>
                    </li>
                    <li class="nav-item me-3">
                        <router-link class="nav-link text-dark" :class="{ active: $route.name === 'events' }" to="/events">Events</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
const logo = '/images/LogoACM.png';
</script>

<style scoped>
/* Sticky Navbar */
.sticky-navbar {
    position: sticky; /* Make the navbar sticky */
    top: 0; /* Stick to the top of the viewport */
    z-index: 1000; /* Ensure it stays above other elements */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow for better visibility */
}

/* Keep the navbar background blue */
.navbar-dark.bg-primary {
    background: linear-gradient(45deg, #0069bf, #03a5fc); /* Blue gradient */
}

/* Change text color to white */
.navbar-brand {
    color: #ffffff !important; /* Keep the text color white */
    font-size: 2rem; /* Increase the font size */
    font-weight: 300; /* Make the text thinner */
    transition: transform 0.3s ease;
}

.navbar-brand:hover {
    transform: scale(1.05); /* Slightly enlarge on hover */
}

.nav-link {
    color: #ffffff !important; /* Change the link text color to white */
    font-size: 1.5rem;
    transition: transform 0.3s ease, text-decoration 0.3s ease;
}

.nav-link:hover {
    transform: scale(1.1);
    text-decoration: underline;
}

.nav-link.active {
    text-decoration: underline;
    color: #ffffff !important; /* Ensure active link is also white */
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