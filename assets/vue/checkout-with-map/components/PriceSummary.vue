<template>
  <div class="row g-3 mt-3 mb-4 fw-bold align-items-end">
    <div class="col-7">
      <div class="text-white badge bg-success" :style="price === 0 ? 'opacity: .3' : ''">
        <span class="text-decoration-line-through">{{ discountPrice }} Kč</span> sleva {{ discount }} %
      </div>
      <div class="display-4 fw-bold">{{ price }} Kč</div>
      <div>Cena vč 15 % DPH</div>
    </div>
    <div class="col-5 text-end text-secondary">
      <div class="display-4 fw-bold">{{ zone }}.</div>
      <div>Tarifní pásmo</div>
    </div>
  </div>
</template>

<script type="ts">
import {defineComponent} from "vue";

export default defineComponent({
  props: [
    'price',
    'discountPrice',
    'discount',
    'zone',
    'ui'
  ]
})
</script>