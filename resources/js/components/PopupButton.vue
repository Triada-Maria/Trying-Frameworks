<template>
    <div>
      <!-- Το κουμπί -->
      <button class="btn btn-primary" @click="showModal = true">
        {{ buttonText }}
      </button>
  
      <!-- Το Modal -->
      <div v-if="showModal" class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">{{ modalTitle }}</h5>
              <button type="button" class="btn-close" @click="showModal = false"></button>
            </div>
            <div class="modal-body">
              <slot>
                <!-- Αν δεν δοθεί περιεχόμενο, δείχνει αυτό -->
                <p>Περιεχόμενο popup</p>
              </slot>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" @click="showModal = false">Κλείσιμο</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'PopupButton',
    props: {
      buttonText: {
        type: String,
        default: 'Click'
      },
      modalTitle: {
        type: String,
        default: 'Title'
      }
    },
    data() {
      return {
        showModal: false
      };
    }
  };
  </script>
  