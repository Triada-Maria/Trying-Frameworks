<template>
    <div class="card mb-3">
        <!-- Event Image -->
        <img :src="image" class="card-img-top" alt="Event Image" />

        <div class="card-header">
            <!-- Clickable Title -->
            <h5 class="card-title" @click="handleTitleClick" style="cursor: pointer;">
                {{ title }}
            </h5>
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Date:</strong> {{ formattedDate }}</p>
            <p class="card-text"><strong>Description:</strong> {{ description }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "Event",
    props: {
        id: {
            type: Number,
            required: true,
        },
        title: {
            type: String,
            required: true,
        },
        date: {
            type: String,
            required: true,
        },
        description: {
            type: String,
            required: true,
        },
        image: {
            type: String,
            required: true,
        },
        onTitleClick: {
            type: Function,
            required: true,
        },
    },
    computed: {
        formattedDate() {
            const [year, month, day] = this.date.split("-");
            return `${day}/${month}/${year}`;
        },
    },
    methods: {
        handleTitleClick() {
            this.onTitleClick({
                id: this.id,
                title: this.title,
                date: this.date,
                description: this.description,
            });
        },
    },
};
</script>

<style scoped>
.card {
    height: 100%; /* Allow the card to fill the carousel item */
    max-width: 500px; /* Optional: Limit the width of the card */
    margin: auto; /* Center the card horizontally */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center content vertically */
    align-items: center; /* Center content horizontally */
    text-align: center; /* Center-align the text */
}

.card-img-top {
    height: 200px; /* Set a fixed height for the image */
    object-fit: cover; /* Ensure the image covers the area */
    border-radius: 5px; /* Optional: Add rounded corners */
}

.card-header {
    width: 100%; /* Ensure the header spans the full width */
    text-align: center; /* Center-align the header text */
}

.card-title {
    color: #007bff;
    text-decoration: underline;
    cursor: pointer;
    transition: color 0.3s ease;
}

.card-title:hover {
    color: #0056b3;
}
</style>