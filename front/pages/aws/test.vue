<script setup lang="ts">
const Url = 'http://localhost:80/api/aws/test'
interface Test {
  message: String;
};

const response = await fetch(Url) as any;

console.log(response.json());
</script>
<template>
</template>