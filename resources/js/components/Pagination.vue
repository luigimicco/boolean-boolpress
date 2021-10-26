<template>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li
        class="page-item"
        v-if="currentPage > 1"
        @click="$emit('onPageChange', currentPage - 1)"
      >
        <a class="page-link">Precedente</a>
      </li>
      <li
        v-for="n in lastPage"
        :key="n"
        class="page-item"
        :class="{ active: currentPage === n }"
        @click="$emit('onPageChange', n)"
      >
        <a class="page-link">{{ n }}</a>
      </li>
      <li
        class="page-item"
        v-if="lastPage > currentPage"
        @click="$emit('onPageChange', currentPage + 1)"
      >
        <a class="page-link">Successiva</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "Pagination",
  props: ["lastPage", "currentPage"],
};
</script>

<style scoped>
.page-item {
  cursor: pointer;
}
</style>