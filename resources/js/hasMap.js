export default {

    data() {
        return {
            location: null,
            marker: null,
            map: null
        }
    },

    methods: {
        /**
         * Init the gmap
         */
        initGmaps() {
            this.map = new google.maps.Map(this.$refs.map, {
                center: this.field.defaultCoordinates || {lat: -34.397, lng: 150.644},
                zoom: this.field.zoom || 8
            });
        },

        /**
         * Set an active location
         */
        setLocation(location) {
            this.clearMarker();
            this.map.panTo(this.location.latlng);
            this.marker = new google.maps.Marker({
                position: this.location.latlng,
                map: this.map
            });
        },

        /**
         * Clear the gmap's marker
         */
        clearMarker() {
            if(!this.marker) return;

            this.marker.setMap(null);
            this.marker = null;
        },
    }

}
