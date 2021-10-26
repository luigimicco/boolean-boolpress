<template>
  <header>
    <h1 class="text-center">Benvenuti su {{ title }}</h1>
  </header>
</template>

<script>
export default {
  name: "Header",
  props: ["title"],
};
</script>

<style scoped>
header {
  color: forestgreen;
}
</style>