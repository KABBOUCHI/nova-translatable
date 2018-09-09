Nova.booting((Vue, router) => {
    Vue.config.devtools = true;
    Vue.component('form-translatable-text', require('./components/Form/TextField'));
    Vue.component('form-translatable-textarea', require('./components/Form/TextAreaField'));
})
