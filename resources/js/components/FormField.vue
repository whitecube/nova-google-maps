<template>
    <default-field :field="field" :errors="errors" :full-width-content="true">
        <template slot="field">
            <input
                ref="input"
                :id="field.name"
                type="text"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value"
            />

            <div class="whitecube-gmap mt-2" ref="map"></div>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import Places from 'places.js';
import HasMap from '../hasMap';

export default {
    mixins: [FormField, HandlesValidationErrors, HasMap],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            places: null,
        }
    },

    mounted() {
        this.initPlaces();
        this.initGmaps();

        if(this.location) {
            // Add a little delay to fix panTo not registering on update
            setTimeout(() => {
                this.places.setVal(this.location.value);
                this.setLocation(this.location);
            }, 100);
        }
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.location = JSON.parse(this.field.value);
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            let location = null;

            if(this.location) {
                location = {
                    administrative: this.location.administrative,
                    city: this.location.city,
                    country: this.location.country,
                    countryCode: this.location.countryCode,
                    county: this.location.county,
                    latlng: this.location.latlng,
                    name: this.location.name,
                    postcode: this.location.postcode,
                    query: this.location.query,
                    suburb: this.location.suburb,
                    type: this.location.type,
                    value: this.location.value
                };
            }

            formData.append(this.field.attribute, JSON.stringify(location) || '');
        },

        /**
         * Init the places API input
         */
        initPlaces() {
            this.places = Places({
                appId: null,
                apiKey: null,
                container: this.$refs.input
            });

            this.places.on('change', this.onSuggestion.bind(this));
            this.places.on('clear', this.onClear.bind(this));
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value;
        },

        /**
         * Handle a new Algolia Places suggestion
         */
        onSuggestion(e) {
            if(!e.suggestion) return;

            this.location = e.suggestion;
            this.setLocation(this.location);
        },

        /**
         * Handle an Algolia Places clear event
         */
        onClear() {
            this.location = null;
            this.clearMarker();
        }
    },
}
</script>

<style scoped>
    .whitecube-gmap {
        height: 300px;
    }
</style>
