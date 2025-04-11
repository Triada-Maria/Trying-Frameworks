<template>
    <div>
        <b-container>
            <b-row>
                <b-col>
                    <h3 class="text-center my-4">Event List</h3>
                </b-col>
            </b-row>
            <b-row>
                <b-col v-for="event in events" :key="event.id" cols="12" md="6" lg="4">
                    <Event
                        :title="event.title"
                        :date="event.date"
                        :description="event.description"
                    />
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>

<script>
import Event from "./Event.vue";

export default {
    name: "EventBar",
    components: {
        Event,
    },
    data() {
        return {
            events: [],
        };
    },
    mounted() {
        this.fetchEvents();
    },
    methods: {
        async fetchEvents() {
            try {
                const response = await axios.get("/api/events");
                this.events = response.data;
            } catch (error) {
                console.error("Error fetching events:", error);
            }
        },
    },
};
</script>

<style scoped>
.text-center {
    text-align: center;
}
</style>