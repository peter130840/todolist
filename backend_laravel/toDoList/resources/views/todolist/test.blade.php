<div id="vm">
  <input v-model="txt">
  @{{ txt }}
</div>

<script src="/js/app.js">>
new Vue({
  el: '#vm',
  data: {
    txt: '123'
  }
})
</script>