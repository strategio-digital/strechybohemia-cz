import {google} from "google-maps";
import {Loader} from "@googlemaps/js-api-loader";

export const LoadGoogleMapApi = () => {
    const loader = new Loader({
        //@ts-ignore
        apiKey: window.envs.GOOGLE_MAPS_API_KEY,
        version: "weekly",
        language: 'cs',
        libraries: ['places']
    });

    return loader.load();
}

export const CreateContactMap = () => {
    const home = new google.maps.LatLng(49.3746801, 14.7361147);

    const mapSettings = {
        center: home,
        zoom: 7,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false
    };

    const markerSettings = {
        //anchorPoint: new google.maps.Point(0, 100),
        position: home,
        icon: '/temp/static/img/map-marker-contacts.svg'
    };

    // Contact map
    new google.maps.Marker({
        ...markerSettings,
        icon: '/temp/static/img/map-marker-contacts.svg',
        map: new google.maps.Map(document.getElementById("google-map-contacts") as HTMLElement, {
            ...mapSettings,
            zoom: 12,
            styles: [{
                stylers: [
                    {saturation: -100},
                    {lightness: 0}
                ]
            }]
        })
    });
}

export const CreateServiceMapCfg = () => {
    const home = new google.maps.LatLng(49.3746801, 14.7361147);
    const mapSettings = {
        center: home,
        zoom: 7,

        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        rotateControl: false,
        fullscreenControl: false
    };

    const routeSettings = {
        origin: home,
        travelMode: google.maps.TravelMode.DRIVING,
        avoidFerries: true,
        avoidHighways: false,
        avoidTolls: true,
        durationInTraffic: true,
        provideRouteAlternatives: true,
    };

    const markerSettings = {
        //anchorPoint: new google.maps.Point(0, 100),
        position: home,
        icon: {
            url: '/temp/static/img/map-marker.svg',
            size: new google.maps.Size(80, 100)
        }
    };

    const autocompleteSettings = {
        origin: home,
        componentRestrictions: {
            country: "cz"
        }
    };

    return {home, mapSettings, markerSettings, routeSettings, autocompleteSettings}
}