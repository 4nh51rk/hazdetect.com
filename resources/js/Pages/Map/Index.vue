<template>

    <Head title="Ships" />
    <BreezeAuthenticatedMapLayout>

        <div id="map" class="absolute w-full h-[91%] z-0"></div>

        <!-- <div class="fixed w-6 h-6 bg-red-400 text-center top-[97%] bottom-1/2 left-1/2 z-50">^</div> -->
        <button class="fixed w-6 h-12 bg-red-400 text-center top-[97%] bottom-1/2 left-1/2 z-50">^</button>

    </BreezeAuthenticatedMapLayout>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import BreezeAuthenticatedMapLayout from '@/Layouts/AuthenticatedMap.vue'

import { format, getTime, subDays } from 'date-fns';
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import icon from 'leaflet/dist/images/marker-icon.png';
import BatteryFull from '@/Components/FontAwesome/Regular/BatteryFull.vue';
import CalendarClock from '@/Components/FontAwesome/Regular/CalendarClock.vue';
import Container from '@/Components/FontAwesome/Regular/Container.vue';
import DropletPercent from '@/Components/FontAwesome/Regular/DropletPercent.vue';
import Heat from '@/Components/FontAwesome/Regular/Heat.vue';
import LocationCrosshairs from '@/Components/FontAwesome/Regular/LocationCrosshairs.vue';
import Ship from '@/Components/FontAwesome/Regular/Ship.vue';
import TemperatureHalf from '@/Components/FontAwesome/Regular/TemperatureHalf.vue';

export default {
    components: {
        BreezeAuthenticatedMapLayout,
        Head,
        BatteryFull,
        CalendarClock,
        Container,
        DropletPercent,
        Heat,
        LocationCrosshairs,
        Ship,
        TemperatureHalf
    },
    props: {
        apiKey: String,
        devices: Array,
    },
    data() {
        return {
            format,
            getTime,
            subDays,
            zoom: 10,
            device: undefined,
            // devices: [],
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
        this.connectWebSocket();
        // this.getDevices();
        this.setupLeafletMap();

        // this.$options.sockets.onmessage = this.webSocketMessages;
        // this.devices.forEach((device, index) => {
        //     this.devices[index].ship = `ship_${index}`
        // })
    },
    methods: {
        connectWebSocket() {
            const token = this.apiKey
            this.$connect(`ws://${import.meta.env.VITE_THINGSBOARD}/api/ws/plugins/telemetry?token=${token}`);
            setTimeout(() => {
                // console.log(this.$store.state.wsocket.socket.isConnected);
                // this.sendWebSocketCmd();
            }, 3000);
            // this.isSocketConnected = this.$store.state.wsocket.socket.isConnected;
        },

        // sendWebSocketCmd() {
        //     var webSocketCmd = {
        //         attrSubCmds: [],
        //         historyCmds: [],
        //         tsSubCmds: [],
        //     }

        //     this.devices.forEach((device, index) => {
        //         var subscriptionId = `2${index}22`;
        //         device.ws = { subscriptionId: subscriptionId };
        //         if (device.label !== null) {
        //             // console.log(device.label);
        //             webSocketCmd.tsSubCmds.push({
        //                 entityType: "DEVICE",
        //                 entityId: device.id.id,
        //                 scope: "LATEST_TELEMETRY",
        //                 cmdId: subscriptionId,
        //             });
        //         }
        //     });

        //     this.$socket.sendObj(webSocketCmd)
        // },

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
            // L.control.scale({ imperial: true, metric: true }).addTo(this.mapDiv);
            // this.mapDiv.zoomControl.setPosition('bottomleft');

            // L.marker({ lon: 80.6437899, lat: 16.5248417 }).bindPopup('The center of the world').addTo(this.mapDiv);
        },
    },
}
</script>scr
