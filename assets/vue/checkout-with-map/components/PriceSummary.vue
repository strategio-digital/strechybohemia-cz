<template>
  <div class="row g-3 mt-3 mb-4 fw-bold align-items-end">
    <div class="col-7">
      <div class="display-4 fw-bold">{{ price }} Kč</div>
      <div>Cena bez DPH</div>
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