<template>
    <default-field :field="field">
        <template slot="field">
            <a
                    class="mb-4 inline-block font-bold cursor-pointer mr-2 animate-text-color select-none"
                    :class="{ 'text-60': localeKey !== currentLocale, 'text-primary border-b-2': localeKey === currentLocale }"
                    :key="`a-${localeKey}`"
                    v-for="(locale, localeKey) in field.locales"
                    @click="changeLocale(localeKey)"
            >
                {{ locale }}
            </a>

            <input
                    :id="field.attribute"
                    :dusk="field.attribute"
                    :type="inputType"
                    :min="inputMin"
                    :max="inputMax"
                    :step="inputStep"
                    :pattern="inputPattern"
                    v-model="value[currentLocale]"
                    class="w-full form-control form-input form-input-bordered"
                    :class="errorClasses"
                    :placeholder="field.name"
            />

            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],
        props: ['resourceName', 'resourceId', 'field'],
        data() {
            return {
                locales: Object.keys(this.field.locales),
                currentLocale: null,
            }
        },
        mounted() {
            this.currentLocale = this.locales[0] || null

            Nova.$on('translatable-change-locale', l => this.currentLocale = l);
        },
        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || {}
            },
            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                Object.keys(this.value).forEach(locale => {
                    formData.append(this.field.attribute + '[' + locale + ']', this.value[locale] || '')
                })
            },
            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value[this.currentLocale] = value
            },
            changeLocale(locale) {
                Nova.$emit('translatable-change-locale', locale);
            }
        }
    }
</script>