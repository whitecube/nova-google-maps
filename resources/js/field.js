Nova.booting((Vue, router, store) => {
  Vue.component('index-nova-google-maps', require('./components/IndexField'))
  Vue.component('detail-nova-google-maps', require('./components/DetailField'))
  Vue.component('form-nova-google-maps', require('./components/FormField'))
})
