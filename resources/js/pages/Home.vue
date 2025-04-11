<!--Home.vue-->
<template>
    <div class="text-center">
        <h1>This is the ACM website</h1>
        <h2>This is the homepage</h2>
        <h3>Click on the logo</h3>
        <h3>Click on "Events"</h3>
    </div>
    <div class="d-flex justify-content-center">
        <PopupButton
      buttonText="Join us!!"
      modalTitle="Φόρμα συμμετοχής"
    >
      <p>Εδώ θα βρίσκονται τα πεδία της φόρμας συμμετοχής</p>
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