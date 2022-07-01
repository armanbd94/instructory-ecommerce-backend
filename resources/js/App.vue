<template>
    <component :is="this.$route.meta.layout || 'div'">
      <router-view />
    </component>
</template>

<script>
export default {
  name: "App",
};
</script>

<style>
.active-link {
  color: red !important;
}
.exact-active-link {
  color: blue !important;
  font-weight: bold;
}
</style>