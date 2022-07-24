/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */

import ThumbGen from "../../vendor/strategio/contentio-sdk/assets/typescript/Components/ThumbGen";
import FormValidator from "../../vendor/strategio/contentio-sdk/assets/typescript/Utils/FormValidator";
import ContactForm from "../../vendor/strategio/contentio-sdk/assets/typescript/Components/ContactForm";
import CookieConsent from "../../vendor/strategio/contentio-sdk/assets/typescript/Plugins/CookieConsent";
import {SetupOptions} from "../../vendor/strategio/contentio-sdk/assets/typescript/Utils/FormValidator/types";

import Bootstrap from "./Plugins/Bootstrap";
import lightGallery from "lightgallery";
import lgThumbnail from "lightgallery/plugins/thumbnail";
import {LoadGoogleMapApi, CreateContactMap} from "./Plugins/GoogleMaps";
import {hideMenuOnScroll} from "./Plugins/SmoothScroll";

import {createApp} from "vue";
import CheckoutWithMap from "../vue/checkout-with-map/CheckoutWithMap.vue";
import CarrerJobs from "./Components/CarrerJobs";
import CarrerForm from "./Components/CarrerForm";

(async () => {
    CookieConsent();

    // Smooth Scroll hide menu
    hideMenuOnScroll();

    // Init Bootstrap
    Bootstrap();

    // Career jobs
    CarrerJobs();

    // Light gallery
    const galleryContainer = document.querySelector('[data-gallery-container]');
    let onThumbnailCreate = null;

    if (galleryContainer) {
        const lg = lightGallery(galleryContainer as HTMLElement, {
            plugins: [lgThumbnail],
            licenseKey: 'your_license_key',
            speed: 200,
        });

        onThumbnailCreate = (params: any, src: string) => {
            const index = lg.index;
            const items = lg.getItems();
            if (items.filter(item => item.src === src).length > 0) {
                lg.updateSlides(items, index);
            }
        }
    }

    // Thumbnail generator
    if (onThumbnailCreate) {
        ThumbGen(onThumbnailCreate);
    } else {
        ThumbGen();
    }

    // Subscribe From validation rules
    const settings: SetupOptions = {
        errorClasses: 'is-invalid',
        neutralClasses: 'is-neutral',
        alertSuccessBg: 'bg-light text-success fw-bold mb-3 p-3 rounded-3 text-start',
        alertErrorBg: 'bg-light text-danger fw-bold mb-3 p-3 rounded-3 text-start',
        alertIcon: `
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-circle-fill me-2" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg>`,
        hiddenClass: 'd-none',
        antispamMessage: 'Vyčkejte 15 vteřin a odešlete zprávu znovu. Tímto se bráníme proti spamu, děkujeme za pochopení.',
        antispamDelay: 15 * 1000
    }

    ContactForm(FormValidator({
        ...settings,
        errorClasses: 'is-invalid',
        neutralClasses: 'is-neutral',
        alertSuccessBg: 'bg-success text-white fw-bold mb-3 p-3 rounded-3 text-start',
        alertErrorBg: 'bg-danger text-white fw-bold mb-3 p-3 rounded-3 text-start',
    }), document.getElementById('contactForm') as HTMLFormElement, [
        {
            name: 'name',
            rules: [
                {type: 'min', message: 'Jméno musí obsahovat alespoň 3 znaky.', param: {min: 3}},
                {type: 'max', message: 'Jméno může obsahovat maximálně 100 znaků', param: {max: 100}},
                {type: 'required', message: 'Jméno je povinné.'},
            ],
        },
        {
            name: 'email',
            rules: [
                {type: 'required', message: 'E-mail je povinný.'},
                {type: 'email', message: 'E-mail musí být v platném formátu.'},
            ],
        },
        {
            name: 'phone',
            rules: [
                {type: 'min', message: 'Telefon musí mít alespoň 9 znaků.', param: {min: 9}},
                {type: 'phone', message: 'Telefon musí být v platném formátu.'},
                {type: 'required', message: 'Telefon je povinný.'},
            ],
        },
        {
            name: 'city',
            rules: [
                {type: 'min', message: 'Místo realizace musí obsahovat alespoň 2 znaky.', param: {min: 2}},
                {type: 'max', message: 'Místo realizace může obsahovat maximálně 100 znaků', param: {max: 100}},
                {type: 'required', message: 'Místo realizace je povinné.'},
            ],
        },
        {
            name: 'message',
            rules: [
                {type: 'min', message: 'Zpráva musí obsahovat alespoň 10 znaků.', param: {min: 10}},
                {type: 'max', message: 'Zpráva může obsahovat maximálně 2 300 znaků', param: {max: 2300}},
                {type: 'required', message: 'Zpráva je povinná.'},
            ],
        }
    ]);

    CarrerForm(FormValidator({
        ...settings,
        errorClasses: 'is-invalid',
        neutralClasses: 'is-neutral',
        alertSuccessBg: 'bg-success text-white fw-bold mb-3 p-3 rounded-3 text-start',
        alertErrorBg: 'bg-danger text-white fw-bold mb-3 p-3 rounded-3 text-start',
    }), document.getElementById('careerForm') as HTMLFormElement, [
        {
            name: 'phone',
            rules: [
                {type: 'min', message: 'Telefon musí mít alespoň 9 znaků.', param: {min: 9}},
                {type: 'phone', message: 'Telefon musí být v platném formátu.'},
                {type: 'required', message: 'Telefon je povinný.'},
            ],
        },
        {
            name: 'salary',
            rules: [
                {type: 'required', message: 'Plat je povinný.'},
            ],
        },
        {
            name: 'jobName',
            rules: [
                {type: 'required', message: 'Pozice je povinná.'},
            ],
        },
    ])


    // Google map
    if (document.getElementById('google-map-contacts')) {
        await LoadGoogleMapApi();
        CreateContactMap();
    }

    const app = document.getElementById('checkout-with-map');
    if (app) {
        createApp(CheckoutWithMap, {...app.dataset}).mount(`#checkout-with-map`);
    }
})();