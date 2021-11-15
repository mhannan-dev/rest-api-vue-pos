<template>
</template>
<script>
export default {
  created() {
    localStorage.removeItem("token");
    localStorage.removeItem("user");
    //Redirect to dashboard route
    this.$router.push('/');
    this.$toast.success({
      title: "Success",
      message: "Sign out successfully",
    });
  },
};
</script>
