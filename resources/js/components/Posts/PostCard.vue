<template>
  <div class="card my-3">
    <div class="card-header">
      <h4>{{ post.title }}</h4>
      <address>
        Scritto da: {{ post.author ? post.author.name : "Anonimo" }}
      </address>
    </div>
    <div class="card-body">
      <p>{{ post.content }}</p>
    </div>
    <div
      class="card-footer bg-white d-flex justify-content-end align-items-center"
    >
      <time
        ><small
          >Pubblicato il: {{ getFormattedDate(post.created_at) }}</small
        ></time
      >
      <span
        class="badge ml-2 badge-pill p-1"
        :class="`badge-${post.category ? post.category.color : 'light'}`"
        >{{ post.category ? post.category.name : "nessuna" }}</span
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "PostCard",
  props: ["post"],
  methods: {
    getFormattedDate(date) {
      const postDate = new Date(date);
      let day = postDate.getDate();
      let month = postDate.getMonth() + 1;
      const year = postDate.getFullYear();

      if (day < 10) day = "0" + day;
      if (month < 10) month = "0" + month;

      return `${day}/${month}/${year}`;
    },
  },
};
</script>
