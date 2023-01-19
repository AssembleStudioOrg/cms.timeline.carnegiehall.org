<template>
  <!-- eslint-disable -->
  <a v-bind:href="url" class="api-link" target="_blank">
    <span>Open API link</span>
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      width="20"
      height="20"
      class="w-6 h-6"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
      />
    </svg>
  </a>
</template>

<style lang="scss" scope>
.api-link {
  display: flex;
  align-items: center;
  justify-content: end;
  font-size: 12px;
  text-decoration: none;
  color: #9b9b9b;
  padding: 1rem 0 2rem 0;

  &:hover {
    color: #656565;
  }
}

span {
  margin-right: 5px;
}
</style>

<script>
/* eslint-disable */
export default {
  props: ["base", "name", "entity"],
  computed: {
    url() {
      try {
        const base = this.base.startsWith("http")
          ? this.base
          : `http://${this.base}`;
        const url = new URL(`api/v2/${this.name}/${this.entity}`, base);
        return url.toString();
      } catch (error) {
        console.error(
          { error, base: this.base, name: this.name, entity: this.entity },
          "error building url"
        );
        return "";
      }
    },
  },
  mounted() {},
};
</script>
