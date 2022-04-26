<template>

    <Head title="Ships" />
    <BreezeAuthenticatedMapLayout>

        <!-- <div id="map" class="h-screen w-screen z-0"></div> -->
        <!-- <div id="map" class="absolute w-4/5 h-4/5 z-0"></div> -->
        <div id="map" class="absolute w-full h-[91%] z-0"></div>

    </BreezeAuthenticatedMapLayout>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import BreezeAuthenticatedMapLayout from '@/Layouts/AuthenticatedMap.vue'

import { format, getTime, subDays } from 'date-fns';
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import icon from 'leaflet/dist/images/marker-icon.png';

export default {
    components: {
        BreezeAuthenticatedMapLayout,
        Head,
    },
    props: {
        api_key: String,
    },
    data() {
        return {
            format,
            getTime,
            subDays,
            zoom: 10,
            device: undefined,
            devices: [],
            filterDevice: '',
            deviceMessages: [],
            deviceLabel: '',
            telemetryHistory: undefined,
            mapCenter: [6.9218335, 79.7861647],
            mapDiv: '',
            mapPolyLine: undefined,
            mapMarker: undefined,
            showTable: false,
            showTeleHistory: false,
            latLngs: [],
        }
    },
    mounted() {
        this.setupLeafletMap();
    },
    methods: {
        setupLeafletMap() {
            let DefaultIcon = L.icon({
                iconUrl: icon,
                iconSize: [25, 41],
                iconAnchor: [12.5, 41],
                // iconRetinaUrl: iconRetina,
                // shadowUrl: iconShadow
            });

            L.Marker.prototype.options.icon = DefaultIcon;
            this.mapDiv = L.map("map").setView(this.mapCenter, 3);
            L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap</a>'
                    + ' | &copy; <a href="http://hazdetect.com">HazDetect</a>'
            }
            ).addTo(this.mapDiv);

            // L.control.zoom({position: 'bottomleft'}).addTo(this.mapDiv);
            L.control.scale({ imperial: true, metric: true }).addTo(this.mapDiv);
            this.mapDiv.zoomControl.setPosition('bottomleft');

            // L.marker({ lon: 80.6437899, lat: 16.5248417 }).bindPopup('The center of the world').addTo(this.mapDiv);
        },
    },
}
</script>scr
