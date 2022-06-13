    <template>
      <div name="snackbars">
        <v-snackbar v-model="show" :color="color" :timeout="timeout" :top="'top'" style="z-index: 100000 !important;">
          {{ text }}
    
          <template  slot="action" slot-scope="attrs">
            <v-btn dark text v-bind="attrs" @click="show = false">
              Close
            </v-btn>
          </template>
        </v-snackbar>
      </div>
    </template>
    
    <script>
    export default {
      created() {
        this.$store.subscribe((mutation, state) => {
          if (mutation.type === "SET_IS_ERROR_MESSAGE") {
            this.text = state.errorMessage;
            this.color = 'red';
            this.timeout = 4000;
            this.show = true;
          }
          if (mutation.type === "SET_IS_SUCCESS_MESSAGE") {
            this.text = state.successMessage;
            this.color = 'green';
            this.timeout = 4000;
            this.show = true;
          }
        });
      },
      data() {
        return {
          show: false,
          color: "red",
          text: "",
          timeout: null,
        };
      },
    };
    </script>