import flatpickr from 'flatpickr-jalali-support';
import { Persian } from 'flatpickr-jalali-support/dist/l10n/fa.js';
import moment from 'moment-jalaali';

flatpickr.localize(Persian);
window.flatpickr = flatpickr;

function getCurrentThemeClass() {
    return document.documentElement.classList.contains('dark') ? 'dark' : 'light';
}

function safeLivewireDispatch(name, value) {
    const waitForLivewire = () => {
        const componentId = document.querySelector('[wire\\:id]')?.getAttribute('wire:id');
        const component = componentId ? window.Livewire?.find(componentId) : null;

        if (component && name) {
            console.log('✅ Safe dispatch to:', name, value);
            component.set(name, value);
        } else {
            setTimeout(waitForLivewire, 100); // retry every 100ms until Livewire is ready
        }
    };

    waitForLivewire();
}

window.initJalaliFlatpickr = function (element, options = {}) {
    const getTheme = () => document.documentElement.classList.contains('dark') ? 'dark' : 'light';

    const defaultOptions = {
        mode: 'range',
        enableTime: true,
        time_24hr: true,
        dateFormat: 'Y-m-d',
        locale: 'fa',
    };

    const flatpickrOptions = {
        ...defaultOptions,
        ...options,
    };

    const fp = flatpickr(element, {
        ...flatpickrOptions,

        onReady(selectedDates, dateStr, instance) {
            const theme = getTheme();
            instance.calendarContainer.classList.remove('dark', 'light');
            instance.calendarContainer.classList.add(theme);
        },

        onOpen(selectedDates, dateStr, instance) {
            const theme = getTheme();
            instance.calendarContainer.classList.remove('dark', 'light');
            instance.calendarContainer.classList.add(theme);
        },

        onChange(selectedDates, dateStr) {
            if (!options.name) return;

            if (selectedDates.length === 2) {
                const fromShamsi = flatpickr.formatDate(selectedDates[0], 'Y-m-d');
                const toShamsi = flatpickr.formatDate(selectedDates[1], 'Y-m-d');
                const from = moment(fromShamsi, 'jYYYY-jMM-jDD').format('YYYY-MM-DD');
                const to = moment(toShamsi, 'jYYYY-jMM-jDD').format('YYYY-MM-DD');
                safeLivewireDispatch(options.name, { from, to });

            } else if (selectedDates.length === 1) {
                const dateShamsi = flatpickr.formatDate(selectedDates[0], 'Y-m-d');
                const miladi = moment(dateShamsi, 'jYYYY-jMM-jDD').format('YYYY-MM-DD');
                safeLivewireDispatch(options.name, miladi);
            }
        },
    });

    return fp;
};