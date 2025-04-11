<script setup lang="ts">
import Event from '../components/Event.vue';
</script>

<!--Events.vue-->
<template>
    <div class="container mt-4">
        <h1>Upcoming Events</h1>
        <p>Here is a list of events...</p>
        <p>Testing this before events</p>
        <Event
            title="Event 1"
            date="2023-10-01"
            description="Description for Event 1"
        />
        <Event
            title="Event 2"
            date="2023-09-15"
            description="Description for Event 2"
        />
        <Event
            title="Event 3"
            date="2023-08-20"
            description="Description for Event 3"
        />
        <p>Testing this after events</p>
        <p>Testing before events bar</p>
        <p>Testing after events bar</p>
    </div>
</template>