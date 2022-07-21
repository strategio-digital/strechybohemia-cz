<template>
  <div class="row">
    <div class="col-md-7 col-xl-6 col-xxl-5">
      <div class="bg-white p-4 p-lg-5 shadow-lg rounded-3" style="min-height: 740px">
        <h2 class="h4 mb-0">
          <span class="fw-bold">Objednávka</span> {{ ui.buyingPackage ? 'revizní kontroly' : 'servisního technika' }}
        </h2>
        <div :class="ui.step > 1 ? 'd-none' : ''">
          <PriceSummary
              :price="fullPrice"
              :discount="pricing.discount"
              :discount-price="discountPrice"
              :zone="map.zone"
              :ui="ui"
          />

          <ContactForm
              :reset-handler="reset"
              :submit-handler="nextStep"
              v-model:phone="form.phone"
              v-model:email="form.email"
              v-model:package:selected="package.selected"
              v-model:package:price="package.price"
              :address="form.address"
              :full-price="fullPrice"
              :ui="ui"
              ref="contactFormRef"
          />
        </div>
        <div v-if="ui.step === 2">
          <BillingForm
              :submit-handler="nextStep"
              v-model:billing="billing"
          />
        </div>
        <div v-if="ui.step === 3">
          <PaymentForm
              :submit-handler="nextStep"
              v-model:payment="payment"
              :full-price="fullPrice"
              :map="map"
              :form="form"
              :billing="billing"
              :package="package"
              :ui="ui"
          />
        </div>
        <div v-if="ui.step === 4">
          <ThankYou
              :submit-handler="nextStep"
              :reset-handler="reset"
              :payment="payment"
          />
        </div>

        <div class="mt-3 text-center d-flex justify-content-between" v-if="ui.step > 1 && ui.step < 4">
          <span class="small text-black-50">(krok <span class="fw-bold">{{ ui.step }}</span> ze 3)</span>
          <a @click.prevent="nextStep('back')" class="link-secondary" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg><span>zpět</span>
          </a>
        </div>

        <div class="mt-4" v-if="ui.step === 1">
          <a href="/temp/static/img/mapa-pasem.pdf" target="_blank" class="link-secondary">
            <span>Přehled tarifních pásem</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="ms-1">
              <path fill-rule="evenodd" d="M6.364 13.5a.5.5 0 0 0 .5.5H13.5a1.5 1.5 0 0 0 1.5-1.5v-10A1.5 1.5 0 0 0 13.5 1h-10A1.5 1.5 0 0 0 2 2.5v6.636a.5.5 0 1 0 1 0V2.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v10a.5.5 0 0 1-.5.5H6.864a.5.5 0 0 0-.5.5z"/>
              <path fill-rule="evenodd" d="M11 5.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793l-8.147 8.146a.5.5 0 0 0 .708.708L10 6.707V10.5a.5.5 0 0 0 1 0v-5z"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-5 col-xl-6 col-xxl-7">
      <div ref="gmapRef" class="w-100 h-100 mt-3 mt-md-0 shadow-lg rounded-3" style="min-height: 300px"></div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { google } from "google-maps";
import Axios from "../../typescript/Plugins/Axios";
import { getHaversineDistance } from "../../typescript/Helpers/Map";
import { CreateServiceMapCfg } from "../../typescript/Plugins/GoogleMaps";
import PriceSummary from "./components/PriceSummary.vue";
import ContactForm from "./components/ContactForm.vue";
import BillingForm from "./components/BillingForm.vue";
import PaymentForm from "./components/PaymentForm.vue";
import ThankYou from "./components/ThankYou.vue";
import {smoothScroll} from "../../typescript/Plugins/SmoothScroll";

export default defineComponent({
  components: {
    ThankYou,
    PaymentForm,
    BillingForm,
    ContactForm,
    PriceSummary
  },
  computed: {
    fullPrice(): number {
      if (this.package.selected !== null && this.pricing.price === 0) {
        return 0;
      }
      return this.pricing.price + this.package.price;
    },
    discountPrice(): number {
      return this.fullPrice * (100 + this.getDiscount()) / 100;
    },
  },
  methods: {
    getDiscount(): number {
      return this.pricing.discount;
    },
    reset(): void {
      this.form.address = '';
      this.pricing.price = 0;
      this.map.zone = 0;
      this.map.distance = 0
      this.map.haversineDistance = 0;
      this.map.duration = "0 minut";
      this.map.durationInTraffic = "0 minut";
      this.payment = {
          type: "",
          state: null,
          gw_url: null,
          order_id: null
      }
    },
    nextStep(step = 'next', to:number|null = null): void {
      if (!to) {
        if (step === 'next') {
          this.ui.step++;
        } else {
          this.ui.step--;
        }
      } else {
        this.ui.step = to;
      }

      const anchor = document.getElementById('objednavka');
      smoothScroll.animateScroll(anchor);
    }
  },

  data() {
    return {
      ui: {
        buyingPackage: false,
        step: 1,
      },
      pricing: {
        discount: 30,
        price: 0,
      },
      package: {
        selected: null,
        price: 0,
      },
      map: {
        zone: 0,
        distance: 0,
        haversineDistance: 0,
        duration: "0 minut",
        durationInTraffic: "0 minut",
      },
      form: {
        phone: "+420 ",
        email: "@",
        address: "",
      },
      billing: {
        name: "",
        street: "",
        city: "",
        zip: "",
        companyId: "",
        companyVat: ""
      },
      payment: {
        type: "",
        state: null,
        gw_url: null,
        order_id: null
      }
    }
  },

  beforeMount() {
    this.ui.buyingPackage = window.location.pathname === '/pravidelny';
  },

  async mounted() {
    const urlParams = new URLSearchParams(window.location.search);
    const paymentId = urlParams.get('id');

    if (urlParams.get('thanks')) {
      if (urlParams.get('id')) {
        const response = await Axios().get(`order/gopay-notify?id=${paymentId}`);
        this.payment.state = response.data.state;
        this.payment.gw_url = response.data.gw_url;
        this.payment.order_id = response.data.order_id;
      }
      this.ui.step = 3;
      this.nextStep();
    }

    const serviceMapCfg = CreateServiceMapCfg();

    // @ts-ignore
    const input = this.$refs.contactFormRef.$refs.autocompleteRef;
    const autocomplete = new google.maps.places.Autocomplete(input, serviceMapCfg.autocompleteSettings);
    const map = new google.maps.Map(this.$refs.gmapRef as HTMLDivElement, serviceMapCfg.mapSettings);
    const marker = new google.maps.Marker({ map, ...serviceMapCfg.markerSettings });

    autocomplete.addListener('place_changed', () => {
      const place = autocomplete.getPlace();

      if (place.geometry === undefined) {
        marker.setVisible(false);
        return 0;
      }

      if (typeof place.formatted_address !== "undefined") {
        this.form.address = place.formatted_address;
      }

      const directionsService = new google.maps.DirectionsService();
      const destination = place.geometry.location;
      const viewport = place.geometry.viewport;

      directionsService.route({ ...serviceMapCfg.routeSettings, destination }, async (response) => {
        const directionsData = response.routes[0].legs[0];
        const haversineDistance = getHaversineDistance(serviceMapCfg.home, destination);

        marker.setPosition(destination);
        marker.setVisible(true);

        map.fitBounds(viewport);
        map.setCenter(destination);
        map.setZoom(17);

        const distance = directionsData.distance.value / 1000;
        const data = (await Axios().post('service/price', { distance: distance })).data;

        this.pricing.price = data.price.value;
        this.map.zone = data.zone;
        this.map.distance = distance;
        this.map.haversineDistance = parseFloat(haversineDistance.toFixed(2));
        this.map.duration = directionsData.duration.text;
        this.map.durationInTraffic = directionsData.duration_in_traffic.text;
      });
    });
  }
});
</script>