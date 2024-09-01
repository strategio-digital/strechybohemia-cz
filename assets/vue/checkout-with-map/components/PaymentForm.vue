<template>
  <form @submit.prevent="makePayment" class="mt-4">

    <div class="border p-3 mb-4 rounded bg-light">
      <p class="mb-2 fw-bold text-danger">Objednávka {{
          ui.buyingPackage ? 'revizní kontroly' : 'servisního technika'
        }}</p>
      <p class="text-black-50 mb-1">
        Místo {{ ui.buyingPackage ? 'kontroly' : 'opravy' }}:
        <span class="text-dark">{{ form.address }}</span>
      </p>
      <p class="text-black-50 mb-1">
        Cena bez DPH:
        <span class="text-dark">{{ fullPrice }} Kč</span>
      </p>
    </div>

    <div class="h5 mb-3">Zvolte způsob úhrady</div>

    <div class="form-check mb-3">
      <input class="form-check-input" type="radio" name="payment" :value="'bank_transfer'" id="payment-1"
             @input="changePayment" :checked="payment.type === 'bank_transfer'">
      <label class="form-check-label" for="payment-1">
        Převodem na účet
        <span class="d-block small text-black-50">(úhrada může trvat i několik dní)</span>
      </label>
    </div>

    <p class="mt-3 mb-0 text-black-50 small">
      Odesláním objednávky souhlasíte s <a :href="ui.termsAndConditionsPath" target="_blank" class="link-secondary">obchodními
      podmínkami</a>
      a&nbsp;<a :href="ui.termsPersonalDataPath" target="_blank" class="link-secondary">podmínkami ochrany osobních
      údajů</a>.
    </p>

    <button type="submit" class="btn btn-lg w-100 py-3 fw-bold mt-3" :disabled="payment.type === '' || loading"
            :class="payment.type === '' ? 'btn-secondary' : 'btn-warning shadow'">
      <svg v-if="loading" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 38 38" class="me-2">
        <defs>
          <linearGradient x1="8.042%" y1="0%" x2="65.682%" y2="23.865%" id="a">
            <stop stop-color="#333" stop-opacity="0" offset="0%"/>
            <stop stop-color="#333" stop-opacity=".631" offset="63.146%"/>
            <stop stop-color="#333" offset="100%"/>
          </linearGradient>
        </defs>
        <g fill="none" fill-rule="evenodd">
          <g transform="translate(1 1)">
            <path d="M36 18c0-9.94-8.06-18-18-18" id="Oval-2" stroke="url(#a)" stroke-width="2">
              <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="0.9s"
                                repeatCount="indefinite"/>
            </path>
            <circle fill="#fff" cx="36" cy="18" r="1">
              <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="0.9s"
                                repeatCount="indefinite"/>
            </circle>
          </g>
        </g>
      </svg>
      <svg v-if="!loading" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
           class="bi bi-check" viewBox="0 0 16 16">
        <path
            d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
      </svg>
      <span class="fs-6">Dokončit objednávku</span>
    </button>
  </form>
</template>

<script type="ts">
import {defineComponent} from "vue";
import Axios from "../../../typescript/Plugins/OldApiAxios";
import {smoothScroll} from "../../../typescript/Plugins/SmoothScroll";

export default defineComponent({
  props: ['submitHandler', 'payment', 'fullPrice', 'map', 'form', 'billing', 'package', 'ui'],
  emits: [
    'update:payment',
  ],
  methods: {
    changePayment(event) {
      this.$emit('update:payment', {...this.payment, type: event.target.value});
    },
    async makePayment() {
      this.loading = true;

      const post = {
        return_url: this.ui.returnUrl,
        payment: this.payment.type,
        distance: this.map.distance,

        address: this.form.address,
        phone: this.form.phone,
        email: this.form.email,

        name: this.billing.name,
        street: this.billing.street,
        city: this.billing.city,
        zip: this.billing.zip,

        company_id: this.billing.companyId !== '' ? this.billing.companyId : undefined,
        company_vat_id: this.billing.companyVat !== '' ? this.billing.companyVat : undefined,

        package: this.package.selected
      }

      try {
        const anchor = document.getElementById('objednavka');
        const createOrderRes = await Axios().post('order/create', post);

        if (this.payment.type === 'online_payment' && createOrderRes.data.gw_url !== null) {
          _gopay.checkout({gatewayUrl: createOrderRes.data.gw_url, inline: true}, async () => {
            const orderResp = await Axios().get(`order/gopay-notify?id=${createOrderRes.data.gopay_payment_id}`);
            this.$emit('update:payment', {
              ...this.payment,
              gw_url: orderResp.data.gw_url,
              state: orderResp.data.state,
              order_id: createOrderRes.data.order_id
            });

            smoothScroll.animateScroll(anchor);
            this.submitHandler('next');
            this.loading = false;
          });
        } else {
          this.$emit('update:payment', {...this.payment, state: 'waiting', order_id: createOrderRes.data.order_id});
          this.submitHandler('next');
        }
      } catch (error) {
        smoothScroll.animateScroll(anchor);
        this.loading = false;
        alert(error);
      }
    }
  },
  data() {
    return {
      loading: false
    }
  }
})
</script>