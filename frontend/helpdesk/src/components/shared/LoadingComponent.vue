<template>
  <div class="wrapperLoading">
    <div class="loader">
    </div>
    <text class="txtLoading">{{ txtLoading }}</text>
  </div>
</template>

<script>

export default {
  props:['txtLoading']
}
</script>

<style>
* {
  font-family: "Noto Sans", sans-serif !important
}
  .txtLoading{
    z-index: 2;
    font-size: 22px;
    font-weight: 600;
    color: #fff;
    margin-top: 30px;
  }
  .wrapperLoading{
    flex-direction: column;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(100, 100, 100, 0.5);
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
    bottom: 0px;
  }
  .loader {
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid #1c9648;
    width: 50px;
    height: 50px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;
  }

  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>
