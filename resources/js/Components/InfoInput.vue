<template>
  <input
    v-on:keyup.enter="sendVal"
    v-model="newVal"
    type="number"
    :placeholder="val"
    class="px-1 md:px-4 py-2 font-semibold bg-gray-100 border border-gray-300 rounded-lg w-12 md:w-24 text-center "
  />
</template>

<script>
export default {
  data() {
    return {
      newVal: "",
    };
  },
  props: {
    val: Number,
    name: String,
    //   model: String,
  },
  methods: {
    sendVal() {
      this.$emit("getVal", { newVal: this.newVal, attrName: this.name });
    },
  },
};
</script>

<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type="number"] {
  -moz-appearance: textfield;
}
</style>