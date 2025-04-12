<script setup lang="ts">
import { onMounted } from 'vue';
import { Carousel } from 'bootstrap'; 
import Event from '../components/Event.vue';
import { ref } from 'vue';

const events = [
  { id: 1, title: "Vue.js Workshop", date: "2023-11-15", description: "Learn Vue.js from the basics to advanced concepts.", image: "https://via.placeholder.com/500x300" },
  { id: 2, title: "React.js Conference", date: "2023-12-01", description: "Join us for the latest trends in React.js.", image: "https://via.placeholder.com/500x300" },
  { id: 3, title: "Angular Meetup", date: "2023-12-10", description: "Meetup for Angular enthusiasts to network.", image: "https://via.placeholder.com/500x300" },
  { id: 4, title: "JavaScript Summit", date: "2023-12-20", description: "The future of JavaScript and where it's headed.", image: "https://via.placeholder.com/500x300" }
];

onMounted(() => {
  // Re-initialize carousel manually in case Bootstrap missed it
  const el = document.getElementById('eventsCarousel');
  if (el) {
    // @ts-ignore
    new Carousel(el); // if using TypeScript, you might need to ignore types here
  }
});

const selectedEvent = ref<{ id: number; title: string; date: string; description: string } | null>(null);

// Show event details when button is clicked
const showEventDetails = (event) => {
  selectedEvent.value = event;
};

const closeEventDetails = () => {
  selectedEvent.value = null;
};

</script>


<!--Events.vue-->
<template>
    <div class="container mt-4">
        <h1>Upcoming Events</h1>
        <p>Here is a list of events...</p>

        <!-- Full-Page Dimmed Background -->
        <div v-if="selectedEvent" class="full-page-dimmed-background"></div>

        <!-- Bootstrap Carousel -->
        <div id="eventsCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Carousel Items -->
            <div class="carousel-inner">
                <div
                    v-for="(event, index) in events"
                    :key="event.id"
                    class="carousel-item"
                    :class="{ active: index === 0 }"
                >
                    <div class="d-flex justify-content-center">
                        <Event
                            :id="event.id"
                            :title="event.title"
                            :date="event.date"
                            :description="event.description"
                            :image="event.image"
                            :onTitleClick="showEventDetails"
                        />
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#eventsCarousel"
                data-bs-slide="prev"
            >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#eventsCarousel"
                data-bs-slide="next"
            >
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Event Details Overlay -->
        <div v-if="selectedEvent" class="event-details">
            <!-- Close Button -->
            <button class="close-btn" @click="closeEventDetails">X</button>
            <h3>{{ selectedEvent.title }}</h3>
            <p>{{ selectedEvent.date }}</p>
            <p>{{ selectedEvent.description }}</p>
        </div>
    </div>
</template>

<!-- Add this CSS to your component or global styles -->
<style>
.card {
    height: 100%; /* Allow the card to fill the carousel item */
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.carousel-control-prev,
.carousel-control-next {
  border: none;
  outline: none;
  background: none;
  box-shadow: none;
}

/* Triangle shapes */
.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-image: none; /* Remove default icon */
  width: 0;
  height: 0;
  border-style: solid;
}

.carousel-control-prev-icon {
  border-width: 15px 20px 15px 0;
  border-color: transparent #85909c transparent transparent; /* Change to your preferred color */
}

.carousel-control-next-icon {
  border-width: 15px 0 15px 20px;
  border-color: transparent transparent transparent #85909c; /* Change to your preferred color */
}

/* Optional: Add hover effect */
.carousel-control-prev:hover,
.carousel-control-next:hover {
  background-color: rgba(40, 52, 65, 0.1); /* Optional: add hover effect */
}
.event-row {
  display: flex;
  justify-content: space-evenly; /* Distribute space evenly between events */
  flex-wrap: nowrap; /* Prevent wrapping to a new row */
}

.event-btn {
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.event-btn:hover {
  background-color: #0056b3;
}

#eventsCarousel {
    position: relative;
}

/* Full-page dimmed background */
.full-page-dimmed-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.86); /* Semi-transparent black */
    z-index: 5; /* Ensure it appears below the event details but above the rest of the page */
}

/* Event Details Overlay */
.event-details {
    position: fixed;
    top: 50%; /* Center vertically */
    left: 50%; /* Center horizontally */
    transform: translate(-50%, -50%); /* Adjust for centering */
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 10; /* Ensure it appears above the dimmed background */
    text-align: center;
    width: 80%; /* Optional: Adjust width as needed */
    max-width: 600px; /* Optional: Limit maximum width */
}

/* Close Button */
.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 20px;
    font-weight: bold;
    color: #333;
    cursor: pointer;
    z-index: 11; /* Ensure it appears above the overlay */
    transition: color 0.3s ease;
}

.close-btn:hover {
    color: #ff0000; /* Change color on hover */
}

</style>