<template>
  <div v-if="payment.state === 'paid'">
    <p class="mt-4">Děkujeme za objednávku.</p>
    <p><span class="fw-bold text-success">Objednávka byla úspěšně uhrazena</span>, teď prosím vyčkejte, servisní technik se s Vámi spojí.</p>
    <p class="text-danger">Veškeré podrobnosti jsme <span class="fw-bold">odeslali na Váš e-mail</span> (prosím, zkontrolujte si i složku SPAM).</p>
  </div>
  <div v-else-if="payment.state === 'canceled'">
    <p class="text-danger fw-bold mt-4 mb-0">Objednávku se nepodařilo dokončit.</p>
    <p>Vytvořte prosím novou objednávku a nebo nás kontaktujte.</p>
    <button class="btn btn-lg py-3 px-4 fw-bold btn-warning shadow mt-4" @click="backwardClick">
      <span class="fs-6">Vytvořit novou objednávku</span>
    </button>
  </div>
  <div v-else-if="payment.state === 'waiting'">
    <p class="mt-4">Děkujeme za objednávku.</p>
    <p class="fw-bold text-danger">Aktuálně čekáme na zaplacení objednávky.</p>
    <p>Veškeré podrobnosti jsme <span class="fw-bold">odeslali na Váš e-mail</span> (prosím, zkontrolujte si i složku SPAM).</p>
    <a v-if="payment.gw_url" :href="payment.gw_url" class="btn btn-lg py-3 px-4 fw-bold btn-warning shadow mt-4">
      <span class="fs-6">Zaplatit objednávku on-line</span>
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"></path>
      </svg>
    </a>
  </div>
</template>

<script type="ts">
import { defineComponent } from "vue";
import { gtmTrackPurchase } from "../../../typescript/Plugins/Measurement";
import Axios from "../../../typescript/Plugins/Axios";
export default defineComponent({
  props: ['payment', 'submitHandler', 'resetHandler'],
  methods: {
    backwardClick() {
      this.resetHandler();
      this.submitHandler('', 1)
    }
  },
  async mounted() {
    if (this.payment.state === 'waiting' || this.payment.state === 'paid') {
      const response = await Axios().post('order/store-in-gtm', { id: this.payment.order_id });
      if (!response.data.gtm_already_stored) {
        gtmTrackPurchase(
            response.data.product_id,
            response.data.product_name,
            response.data.order_id,
            response.data.price_with_tax,
            response.data.price_without_tax,
            response.data.tax,
            response.data.currency,
        );
      }
    }
  }
})
</script>