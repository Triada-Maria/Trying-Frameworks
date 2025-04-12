<template>

    <!-- Future Events Section -->
    <div class="future-events mt-5">
        <h2>Future Events</h2>
        <p>Click on an event to see its details:</p>

        <!-- Navigation Bar for Future Events -->
        <div class="event-row">
            <div class="event-list">
                <Event
                    v-for="event in futureEvents"
                    :key="event.id"
                    :id="event.id"
                    :title="event.title"
                    :date="event.date"
                    :description="event.description"
                    :image="event.image"
                    :onTitleClick="openModal"
                    @click="openModal(event)"
                    class="future-event-item"
                />
            </div>
        </div>

    <div class="text-center">
        <h1>Recent Events</h1>
        <p>Here is a list of events...</p>

    </div>

    <!-- Modal for Event Details -->
    <div v-if="selectedEvent" class="modal-overlay" @click.self="closeModal">
        <div class="modal-content">
            <!-- Close Button -->
            <button class="close-btn" @click="closeModal">X</button>

            <!-- Event Image -->
            <img :src="selectedEvent.image" alt="Event Image" class="modal-image" />

            <!-- Event Title -->
            <h3>{{ selectedEvent.title }}</h3>

            <!-- Event Date -->
            <p><strong>Date:</strong> {{ selectedEvent.date }}</p>

            <!-- Event Description -->
            <p>{{ selectedEvent.description }}</p>
        </div>
    </div>

    <!-- Past Events Section -->
    <div class="past-events mt-5">
        <h2>Past Events</h2>
        <p>Take a look at our past events:</p>

        <!-- Year Filter -->
        <div class="year-filter">
            <label for="year-select">Filter by Year:</label>
            <select id="year-select" v-model="selectedYear" @change="filterEventsByYear">
                <option value="">All Years</option>
                <option v-for="year in availableYears" :key="year" :value="year">
                    {{ year }}
                </option>
            </select>
        </div>

        <!-- Bootstrap Carousel -->
        <div id="pastEventsCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Carousel Items -->
            <div class="carousel-inner">
                <div
                    v-for="(event, index) in filteredPastEvents"
                    :key="event.id"
                    class="carousel-item"
                    :class="{ active: index === 0 }"
                >
                    <div class="carousel-image-container" @click="openPastEventModal(event)">
                        <h3>{{ event.title }}</h3>
                        <img :src="event.image" class="d-block mx-auto" :alt="event.title" />
                        <p class="event-date">{{ new Date(event.date).toLocaleDateString() }}</p> <!-- Move the date below the image -->
                        <p>{{ event.description }}</p>
                    </div>
                </div>
            </div>

            <!-- Carousel Controls -->
            <button
                class="carousel-control-prev"
                type="button" 
                data-bs-target="#pastEventsCarousel"
                data-bs-slide="prev"
            >
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button
                class="carousel-control-next"
                type="button" 
                data-bs-target="#pastEventsCarousel"
                data-bs-slide="next"
            >
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Modal for Past Event Details -->
    <div v-if="selectedPastEvent" class="modal-overlay" @click.self="closePastEventModal">
        <div class="modal-content past-event-modal">
            <!-- Close Button -->
            <button class="close-btn" @click="closePastEventModal">X</button>

            <!-- Event Image -->
            <img :src="selectedPastEvent.image" alt="Event Image" class="modal-image" />

            <!-- Event Title -->
            <h3>{{ selectedPastEvent.title }}</h3>

            <!-- Event Date -->
            <p><strong>Date:</strong> {{ selectedPastEvent.date }}</p>

            <!-- Event Description -->
            <p>{{ selectedPastEvent.description }}</p>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import Event from '../components/Event.vue';

// Events data
const events = [
    { id: 1, title: "Vue.js Workshop", date: "2023-11-15", description: "Learn Vue.js from the basics to advanced concepts.", image: "https://via.placeholder.com/500x300" },
    { id: 2, title: "React.js Conference", date: "2023-12-01", description: "Join us for the latest trends in React.js.", image: "https://via.placeholder.com/500x300" },
    { id: 3, title: "Angular Meetup", date: "2022-12-10", description: "Meetup for Angular enthusiasts to network.", image: "https://via.placeholder.com/500x300" },
    { id: 4, title: "JavaScript Summit", date: "2022-12-20", description: "The future of JavaScript and where it's headed.", image: "https://via.placeholder.com/500x300" },
    { id: 5, title: "Web Development Bootcamp", date: "2025-11-25", description: "A hands-on bootcamp for modern web development.", image: "https://via.placeholder.com/500x300" },
    { id: 6, title: "Frontend Frameworks Conference", date: "2025-10-15", description: "Explore the latest in frontend frameworks.", image: "https://via.placeholder.com/500x300" },
    { id: 7, title: "Fullstack Developer Meetup", date: "2025-09-05", description: "Meetup for fullstack developers to share knowledge.", image: "https://via.placeholder.com/500x300" },
    { id: 8, title: "JavaScript Deep Dive", date: "2025-08-20", description: "Advanced JavaScript concepts and techniques.", image: "https://via.placeholder.com/500x300" },
    { id: 9, title: "CSS for Modern Web", date: "2025-07-10", description: "Learn modern CSS techniques and tools.", image: "https://via.placeholder.com/500x300" },
    { id: 10, title: "Backend Development Summit", date: "2025-06-30", description: "Focus on backend technologies and trends.", image: "https://via.placeholder.com/500x300" },
    { id: 11, title: "Past Event in 2025", date: "2025-01-15", description: "An event that already happened in 2025.", image: "https://via.placeholder.com/500x300" },
    { id: 12, title: "AI & Machine Learning Conference", date: "2024-05-10", description: "Explore the latest trends in AI and machine learning.", image: "https://via.placeholder.com/500x300" },
    { id: 13, title: "Cloud Computing Summit", date: "2024-11-20", description: "Learn about the future of cloud computing.", image: "https://via.placeholder.com/500x300" }
];

// Reactive state
interface Event {
    id: number;
    title: string;
    date: string;
    description: string;
    image: string;
}

const selectedEvent = ref<Event | null>(null);
const selectedPastEvent = ref<Event | null>(null);
const selectedYear = ref<string | null>(null);

// Computed properties
const futureEvents = computed(() => {
    const today = new Date();
    return events.filter(event => new Date(event.date) > today);
});

const pastEvents = computed(() => {
    const today = new Date();
    return events.filter(event => new Date(event.date) <= today);
});

const availableYears = computed<number[]>(() => {
    const years = new Set<number>();
    pastEvents.value.forEach(event => {
        const year = new Date(event.date).getFullYear();
        years.add(year);
    });
    return Array.from(years).sort((a, b) => b - a);
});

const filteredPastEvents = computed(() => {
    if (!selectedYear.value) {
        return pastEvents.value;
    }
    return pastEvents.value.filter(event => new Date(event.date).getFullYear() === parseInt(selectedYear.value || '0'));
});

// Methods
const showEventDetails = (event) => {
    selectedEvent.value = event;
};

const closeEventDetails = () => {
    selectedEvent.value = null;
};

const openModal = (event) => {
    selectedEvent.value = event;
};

const closeModal = () => {
    selectedEvent.value = null;
};

const openPastEventModal = (event) => {
    selectedPastEvent.value = event;
};

const closePastEventModal = () => {
    selectedPastEvent.value = null;
};

const filterEventsByYear = () => {
    // This method is intentionally left blank as the filtering is handled by the computed property
};

// Prevent default scrolling behavior on carousel buttons
onMounted(() => {
    const prevButton = document.querySelector('.carousel-control-prev');
    const nextButton = document.querySelector('.carousel-control-next');

    if (prevButton) {
        prevButton.addEventListener('click', (e) => e.preventDefault());
    }

    if (nextButton) {
        nextButton.addEventListener('click', (e) => e.preventDefault());
    }
});
</script>

<style scoped>
html, body {
    height: 100%;
    overflow-y: auto; /* Enable vertical scrolling */
}

.future-events h2,
.future-events p {
    margin-left: 20px; /* Add margin to move the text to the right */
}

.card {
    height: 100%; /* Allow the card to fill the carousel item */
    width: 400px; /* Adjust the width */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: center;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.card-img-top {
    width: 100%; /* Make the image fill the card width */
    height: auto; /* Maintain aspect ratio */
    max-height: 300px; /* Optional: Limit the maximum height */
    object-fit: cover; /* Ensure the image fits nicely */
}

.event-row {
    display: flex;
    overflow-x: auto; /* Enable horizontal scrolling */
    gap: 20px; /* Add spacing between events */
    padding: 10px; /* Add padding for better spacing */
    position: sticky; /* Make the navigation bar sticky */
    top: 0; /* Stick to the top of the viewport */
    background-color: white; /* Add a background color */
    z-index: 10; /* Ensure it stays above other elements */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: Add a shadow for better visibility */
}

.event-row::-webkit-scrollbar {
    height: 8px; /* Adjust scrollbar height */
}

.event-row::-webkit-scrollbar-thumb {
    background-color: #ccc; /* Style the scrollbar thumb */
    border-radius: 4px;
}

.event-row::-webkit-scrollbar-thumb:hover {
    background-color: #aaa; /* Change color on hover */
}

.event-list {
    display: flex;
    flex-direction: row; /* Ensure items are in a row */
    gap: 20px; /* Add spacing between items */
    white-space: nowrap; /* Prevent wrapping to a new row */
}

.future-event-item {
    display: flex;
    flex-direction: column; /* Stack items vertically */
    align-items: center; /* Center-align the content horizontally */
    justify-content: flex-start; /* Align content to the top */
    width: 300px; /* Set a fixed width for each event card */
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    padding: 15px; /* Add padding for better spacing */
    background-color: #fff; /* Add a white background */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    text-align: center; /* Center-align text inside the container */
    height: auto; /* Allow the height to adjust dynamically */
    min-height: 350px; /* Set a minimum height to ensure consistency */
}

.future-event-item img {
    display: block; /* Ensure the image is treated as a block element */
    margin: 0 auto; /* Center the image horizontally */
    max-width: 100%; /* Ensure the image doesn't exceed the card width */
    height: auto; /* Maintain aspect ratio */
    max-height: 200px; /* Limit the maximum height */
    object-fit: cover; /* Ensure the image fits nicely */
    margin-bottom: 10px; /* Add spacing below the image */
    border-radius: 5px; /* Optional: Add rounded corners to the image */
}

.future-event-item h3 {
    font-size: 1.2rem; /* Adjust the font size for the title */
    margin-bottom: 10px; /* Add spacing below the title */
    text-align: center; /* Center-align the title */
}

.future-event-item p {
    font-size: 0.9rem; /* Adjust the font size for the description */
    color: #555; /* Use a subtle color for the text */
    margin: 0; /* Remove default margins */
    overflow: hidden; /* Prevent overflow */
    text-overflow: ellipsis; /* Add ellipsis for long text */
    white-space: normal; /* Allow text to wrap */
    word-wrap: break-word; /* Break long words if necessary */
}

.future-events {
    min-height: 200px; /* Ensure the parent container has height */
    overflow: visible; /* Ensure no overflow restrictions */
}

/* Modal Overlay */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8); /* Dimmed background */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Modal Content */
.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    width: 90%;
    text-align: center;
    position: relative;
}

/* Smaller Modal Content for Past Events */
.modal-content.past-event-modal {
    max-width: 500px; /* Reduce the maximum width */
    padding: 15px; /* Reduce padding */
    font-size: 0.9rem; /* Slightly smaller font size */
}

.modal-content.past-event-modal img {
    max-height: 200px; /* Limit the image height */
    object-fit: cover; /* Ensure the image fits nicely */
    margin-bottom: 15px; /* Add spacing below the image */
}

/* Modal Image */
.modal-image {
    width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 20px;
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
    transition: color 0.3s ease;
}

.close-btn:hover {
    color: #ff0000; /* Change color on hover */
}

.past-events {
    margin-top: 100px; /* Increase the space above the Past Events section */
    margin-bottom: 100px; /* Add extra space at the bottom */
}

.past-events h2 {
    margin-top: 20px; /* Add spacing above the "Past Events" text */
}

.carousel-item img {
    height: 400px;
    object-fit: cover;
}

.carousel-caption {
    background-color: rgba(0, 0, 0, 0.6);
    padding: 10px;
    border-radius: 5px;
    text-align: center; /* Center-align the text */
}

.carousel-caption h5,
.carousel-caption p {
    text-align: center; /* Center-align the title and description */
    margin: 0; /* Remove any default margins */
}

.carousel-inner {
    display: block; /* Reset to default block layout for Bootstrap */
    width: 100%; /* Ensure the carousel spans the full width */
}

.carousel-item {
    display: none; /* Hide all items by default */
    text-align: center; /* Center-align the text inside each item */
    width: 100%; /* Ensure the item spans the full width */
}

.carousel-item.active {
    display: block; /* Show only the active item */
}

.carousel-image-container {
    display: flex;
    flex-direction: column; /* Stack items vertically */
    align-items: center; /* Center-align the content horizontally */
    justify-content: center; /* Vertically center the content */
    width: 80%; /* Reduce the width of the event frame */
    max-width: 500px; /* Limit the maximum width of the event frame */
    margin: 0 auto; /* Center the container horizontally */
    text-align: center; /* Center-align text inside the container */
    background-color: #fff; /* Add a white background to make it stand out */
    border: 1px solid #ddd; /* Add a light border */
    border-radius: 10px; /* Add rounded corners */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    padding: 10px; /* Reduce padding inside the container */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Add hover effects */
}

.carousel-image-container img {
    max-height: 200px; /* Further reduce the image height */
    object-fit: cover; /* Ensure the image fits nicely */
    border-radius: 5px; /* Optional: Add rounded corners to the image */
    margin-bottom: 10px; /* Add spacing below the image */
}

.carousel-image-container:hover {
    transform: scale(1.05); /* Slightly enlarge on hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Make the shadow more prominent on hover */
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: transparent; /* Remove the grey circle */
    width: 40px; /* Adjust the size */
    height: 40px;
}

.carousel-control-prev-icon:hover,
.carousel-control-next-icon:hover {
    background-color: darkgrey; /* Darker grey on hover */
}

.carousel-control-prev-icon::before,
.carousel-control-next-icon::before {
    color: grey; /* Change the arrow color to grey */
    font-size: 20px; /* Adjust the size of the arrow */
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-image: none; /* Remove the default Bootstrap arrow background */
    width: 40px; /* Adjust the size */
    height: 40px;
}

.carousel-control-prev-icon::before,
.carousel-control-next-icon::before {
    content: ''; /* Remove the default arrow content */
    display: inline-block;
    border: solid grey; /* Set the arrow color to grey */
    border-width: 0 4px 4px 0; /* Create the arrow shape */
    padding: 8px;
    transform: rotate(135deg); /* Rotate for the left arrow */
}

.carousel-control-next-icon::before {
    transform: rotate(-45deg); /* Rotate for the right arrow */
}

.carousel-control-prev-icon:hover,
.carousel-control-next-icon:hover {
    background-color: transparent; /* Ensure no background on hover */
}

.event-date {
    font-size: 1rem;
    color: #555; /* Grey color for the date */
    margin: 10px 0; /* Add spacing above and below the date */
    font-style: italic; /* Optional: Make the date italic */
}

.year-filter {
    margin-bottom: 20px; /* Add spacing below the filter */
    display: flex;
    align-items: center;
    justify-content: center; /* Center the filter horizontally */
    gap: 10px;
    text-align: center; /* Center-align the text */
}

.year-filter label {
    font-weight: bold;
}

.year-filter select {
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ddd;
}
</style>