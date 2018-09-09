Nova.booting((Vue, router) => {
    Vue.config.devtools = true;

    Vue.component('index-translatable-text', require('./components/Index/TextField'));
    Vue.component('form-translatable-text', require('./components/Form/TextField'));
    Vue.component('detail-translatable-text', require('./components/Detail/TextField'));

    Vue.component('index-translatable-textarea', require('./components/Index/TextAreaField'));
    Vue.component('form-translatable-textarea', require('./components/Form/TextAreaField'));
    Vue.component('detail-translatable-textarea', require('./components/Detail/TextAreaField'));

})
