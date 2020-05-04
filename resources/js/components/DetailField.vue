<template>
    <panel-item :field="field" >
        <template slot="value">
            <div>
                <p class="text-90" v-if="location">{{ location.value }}</p>
                <div class="whitecube-gmap mt-4" ref="map"></div>
            </div>
        </template>
    </panel-item>
</template>

<script>
import HasMap from '../hasMap';

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
    mixins: [HasMap],

    mounted() {
        this.location = JSON.parse(this.field.value);
        this.initGmaps();

        if(this.location) {
            // Add a little delay to fix panTo not registering on update
            setTimeout(() => {
                this.setLocation(this.location);
            }, 100);
        }
    }
}
</script>

<style scoped>
    .whitecube-gmap {
        height: 300px;
    }
</style>
