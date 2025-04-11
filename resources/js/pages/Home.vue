<!--Home.vue-->
<template>
    <div class="container mt-4">
        <h1>This is the ACM website</h1>
        <h2>This is the homepage</h2>
        <h3>Click on "Events"</h3>
    </div>
    <div>
        <PopupButton
      buttonText="Δες πληροφορίες"
      modalTitle="Πληροφορίες Χρήστη"
    >
      <p>Εδώ μπορείς να δεις λεπτομέρειες για τον χρήστη ή ό,τι άλλο θες.</p>
    </PopupButton>
    </div>
</template>

<script>
import PopupButton from '../components/PopupButton.vue';

export default {
  components: {
    PopupButton
  }
};
</script>