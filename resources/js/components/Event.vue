<template>
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">{{ title }}</h5>
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
    },
    computed: {
        formattedDate() {
            const [year, month, day] = this.date.split("-");
            return `${day}/${month}/${year}`;
        },
    },
};
</script>

<style scoped>
.card {
    max-width: 500px;
    margin: auto;
}
</style>