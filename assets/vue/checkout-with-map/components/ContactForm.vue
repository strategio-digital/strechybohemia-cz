<template>
  <form @submit.prevent="submitHandler('next')">

    <div v-if="ui.buyingPackage" class="form-floating mb-3">
      <select @input="changePackage" class="form-select" id="package" ref="packageRef">
        <option v-for="option in packages" :value="option.key" :selected="package">
          {{ option.name + ' - ' + option.price + ' Kč' }}
        </option>
      </select>
      <label for="package">
        <span class="text-danger">*</span> Zvolte balíček
      </label>
    </div>

    <div class="form-floating mb-3">
      <input
          @change="resetHandler"
          :value="address"
          ref="autocompleteRef"
          name="place"
          id="place"
          type="text"
          class="form-control"
          autocomplete="no"
      />
      <label for="place">
        <span class="text-danger">*</span> Zadejte {{ ui.buyingPackage ? 'místo kontroly' : 'místo opravy' }}
      </label>
    </div>

    <div class="form-floating mb-3">
      <input @input="changePhone" :value="phone" type="text" class="form-control"
             :class="!phoneValid ? 'is-invalid' : ''" id="phone" placeholder="Zadejte telefon">
      <label for="phone">* Zadejte telefon</label>
      <div class="invalid-feedback">
        Zadejte číslo v platném formátu př: +420 123 321 123.
      </div>
    </div>

    <div class="form-floating mb-3">
      <input @input="changeEmail" :value="email" type="text" class="form-control"
             :class="!emailValid ? 'is-invalid' : ''" id="email" placeholder="Zadejte e-mail">
      <label for="email">* Zadejte e-mail</label>
      <div class="invalid-feedback">
        Zadejte e-mail v platném formátu.
      </div>
    </div>

    <button
        :disabled="!valid"
        :class="valid ? 'btn-warning shadow' : 'btn-secondary'"
        type="submit"
        class="btn btn-lg w-100 py-3 fw-bold"
    >
      <span class="fs-6">Objednat {{ ui.buyingPackage ? 'revizní kontrolu' : 'servisního technika' }}</span>

      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-short"
           viewBox="0 0 16 16">
        <path fill-rule="evenodd"
              d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
      </svg>
    </button>
  </form>
</template>

<script type="ts">
import {defineComponent} from "vue";
import {isEmail, isPhone} from "../../../typescript/Helpers/Validator";

export default defineComponent({
  props: ['phone', 'email', 'package', 'address', 'resetHandler', 'submitHandler', 'ui', 'fullPrice'],
  emits: [
    'update:phone',
    'update:email',
    'update:package:selected',
    'update:package:price'
  ],
  async beforeMount() {
    if (this.ui.buyingPackage) {
      this.packages = Object.keys(this.ui.packages).map(key => {
        return {
          key: key,
          price: this.ui.packages[key].price,
          name: this.ui.packages[key].name
        }
      }).filter((value => value.price !== null));

      const key = this.packages[0].key;
      this.emitPackage(key);

      Array.from(document.querySelectorAll('[data-select-package]')).forEach(node => {
        node.addEventListener('click', () => {
          this.$refs.packageRef.value = node.dataset.selectPackage;
          this.emitPackage(node.dataset.selectPackage);
        });
      });
    }
  },
  methods: {
    changePhone(event) {
      this.$emit('update:phone', event.target.value)
    },
    changeEmail(event) {
      this.$emit('update:email', event.target.value)
    },
    changePackage(event) {
      const key = event.target.value;
      this.emitPackage(key);
    },
    emitPackage(key) {
      this.$emit('update:package:selected', key);
      this.$emit('update:package:price', this.$data.packages.filter(value => value.key === key)[0].price);
    }
  },
  computed: {
    emailValid() {
      if (this.email !== '@') {
        return isEmail(this.email);
      }
      return true;
    },
    phoneValid() {
      if (this.phone !== '+420 ') {
        return isPhone(this.phone);
      }
      return true;
    },
    valid() {
      return this.address && this.phone !== '+420 ' && this.phoneValid && this.email !== '@' && this.emailValid && this.fullPrice > 0;
    }
  },
  data() {
    return {
      packages: [],
    }
  }
})
</script>