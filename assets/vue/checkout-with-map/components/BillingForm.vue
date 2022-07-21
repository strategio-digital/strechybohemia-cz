<template>
  <div class="h5 mt-4">Zadejte fakturační údaje</div>
  <form @submit.prevent="submitHandler('next')" class="mt-3">
    <div class="form-floating mb-3">
      <input @input="changeName" :value="billing.name" :class="!nameValid ? 'is-invalid' : ''"
             placeholder="Jméno a příjmení" type="text" class="form-control" id="name">
      <label for="name">* Jméno a příjmení</label>
      <div class="invalid-feedback">
        Jméno a příjmení je povinné
      </div>
    </div>

    <div class="form-floating mb-3">
      <input @input="changeStreet" :value="billing.street" :class="!streetValid ? 'is-invalid' : ''"
             placeholder="Ulice a číslo popisné" type="text" class="form-control" id="street">
      <label for="street">* Ulice a číslo popisné</label>
      <div class="invalid-feedback">
        Ulice a číslo popisné je povinné
      </div>
    </div>

    <div class="form-floating mb-3">
      <input @input="changeCity" :value="billing.city" :class="!cityValid ? 'is-invalid' : ''"
             placeholder="Obec / město" type="text" class="form-control" id="city">
      <label for="city">* Obec / město</label>
      <div class="invalid-feedback">
        Obec je povinná
      </div>
    </div>

    <div class="form-floating mb-3">
      <input @input="changeZip" :value="billing.zip" :class="!zipValid ? 'is-invalid' : ''" placeholder="PSČ"
             type="text" class="form-control" id="zip">
      <label for="zip">* PSČ</label>
      <div class="invalid-feedback">
        Zadejte platené PSČ (bez mezer)
      </div>
    </div>

    <div class="form-floating mb-3">
      <input @input="changeCompanyId" :value="billing.companyId" :class="!companyIdValid ? 'is-invalid' : ''"
             placeholder="IČO" type="text" class="form-control" id="company_id">
      <label for="company_id">IČO</label>
      <div class="invalid-feedback">
        Zadejte platné IČO (bez mezer)
      </div>
    </div>

    <div class="form-floating mb-3">
      <input
          @input="changeCompanyVat"
          :value="billing.companyVat"
          :class="!companyVatValid ? 'is-invalid' : ''"
          :disabled="!companyIdValid || billing.companyId.trim() === ''"
          placeholder="DIČ"
          type="text"
          class="form-control"
          id="company_vat"
      >
      <label for="company_vat">DIČ</label>
      <div class="invalid-feedback">
        Zadejte platné DIČ (bez mezer)
      </div>
    </div>

    <button
        :disabled="!valid"
        :class="valid ? 'btn-warning shadow' : 'btn-secondary'"
        type="submit"
        class="btn btn-lg w-100 py-3 fw-bold"
    >
      <span class="fs-6">Zvolit způsob úhrady</span>
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
import {isCompanyId, isVatId, isZipCode} from "../../../typescript/Helpers/Validator";

export default defineComponent({
  props: ['billing', 'submitHandler'],
  emits: [
    'update:billing',
  ],
  methods: {
    changeName(event) {
      this.$emit('update:billing', {...this.billing, name: event.target.value});
    },
    changeStreet(event) {
      this.$emit('update:billing', {...this.billing, street: event.target.value});
    },
    changeCity(event) {
      this.$emit('update:billing', {...this.billing, city: event.target.value});
    },
    changeZip(event) {
      this.$emit('update:billing', {...this.billing, zip: event.target.value});
    },
    changeCompanyId(event) {
      this.$emit('update:billing', {...this.billing, companyId: event.target.value});
    },
    changeCompanyVat(event) {
      this.$emit('update:billing', {...this.billing, companyVat: event.target.value});
    }
  },
  computed: {
    nameValid() {
      if (this.billing.name.trim() !== '') {
        return this.billing.name.trim().length >= 3;
      }
      return true;
    },
    streetValid() {
      if (this.billing.street.trim() !== '') {
        return this.billing.street.trim().length >= 3;
      }
      return true;
    },
    cityValid() {
      if (this.billing.city.trim() !== '') {
        return this.billing.city.trim().length >= 3;
      }
      return true;
    },
    zipValid() {
      if (this.billing.zip.trim() !== '') {
        return isZipCode(this.billing.zip);
      }
      return true;
    },
    companyIdValid() {
      if (this.billing.companyId.trim() !== '') {
        return isCompanyId(this.billing.companyId);
      }
      return true;
    },
    companyVatValid() {
      if (this.billing.companyVat.trim() !== '') {
        return isVatId(this.billing.companyVat);
      }
      return true;
    },
    valid() {
      return this.billing.name.trim() !== '' && this.nameValid
          && this.billing.street.trim() !== '' && this.streetValid
          && this.billing.city.trim() !== '' && this.cityValid
          && this.billing.zip.trim() !== '' && this.zipValid
          && this.companyIdValid
          && this.companyVatValid
    }
  }
})
</script>