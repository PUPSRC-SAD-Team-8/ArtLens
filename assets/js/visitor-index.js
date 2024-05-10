import { AirDatepicker } from '../node_modules/air-datepicker/air-datepicker.js';
import { AirDatepickerLocale } from '../node_modules/air-datepicker/locale/en.js';

let loginUnameInput = document.querySelector('form[action="login.php"] input[name="uname"]');
let loginPasswrdInput = document.querySelector('form[action="login.php"] input[name="pass"]');

function debounce(callback, timeout) {
    let timer;
    return function (event) {
        clearTimeout(timer);
        timer = setTimeout(() => {
            callback(event);
        }, timeout);
    };
}


var login = {}


login.USERNAME_VALIDATION = {
    attributes: {
        type: 'text',
        pattern: /^[a-zA-Z _\-]{1,50}$/,
        required: true,
        max_length: 30,
    }
}

const EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const EMAIL_REGEX_STRING = EMAIL_REGEX.toString().slice(1, -1);

login.EMAIL_VALIDATION = {
    trailing: {
        '-+': '-',    // Replace consecutive dashes with a single dash
        '\\.+': '.',  // Replace consecutive periods with a single period
        ' +': ''     // Removes Consecutive spaces
    },
    attributes: {
        type: 'email',
        pattern: /^\S+$|^$/,   // May issue sa regex ko ahahha
        required: true,
        max_length: 255,
    }
}

const CHECK_EMAIL = new InputValidator(login.EMAIL_VALIDATION);

loginUnameInput.addEventListener('input', debounce(function (event) {
    console.log('Input value:', event.target.value);
    try {

        if (CHECK_EMAIL.validate(loginUnameInput)) {
            event.target.classList.remove('is-invalid');
        } else {
            event.target.classList.add('is-invalid');

        }
    } catch (error) {
        console.error('Validation error:', error);
    }
}, 400));


let today = new Date();
today.setDate(today.getDate());

let todayDatetime = new Date().toISOString().split("T")[0] + "T" + today.toTimeString().split(" ")[0];

let oneYearAhead = new Date();
oneYearAhead.setFullYear(oneYearAhead.getFullYear() + 1);
oneYearAhead.setMonth(oneYearAhead.getMonth() + 1, 0);
oneYearAhead.setHours(23, 59, 59, 999);

function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    var fitsLeft = (rect.left >= 0 && rect.left <= $(window).width());
    var fitsTop = (rect.top >= 0 && rect.top <= $(window).height());
    var fitsRight = (rect.right >= 0 && rect.right <= $(window).width());
    var fitsBottom = (rect.bottom >= 0 && rect.bottom <= $(window).height());
    return {
        bottom: fitsBottom,
        top: fitsTop,
        left: fitsLeft,
        right: fitsRight,
        all: (fitsLeft && fitsTop && fitsRight && fitsBottom)
    };
}


var datePickerInst = new AirDatepicker('#dati', {
    classes: 'col-10 col-md-5 col-xl-4',
    position: "top right",
    locale: AirDatepickerLocale.get('en'),
    timepicker: true,
    minView: 'years',
    minDate: today,
    maxDate: oneYearAhead,
    buttons: ['today', 'clear'],
    isMobile: false,
    autoClose: false,
    dateFormat: "MMM dd, yyyy",
    timeFormat: "\t h : mm AA",
    onSelect: function (obj) {

        let inputEvent = new Event('input', {
            bubbles: true,
            cancelable: true,
        });

        let datetimeInput = document.querySelector('form[action="booking.php"] input[name="dati"]');
        obj.datepicker.$el.dispatchEvent(inputEvent);
        try {
            // if (obj.date) {
            datetimeInput.value = obj.date.toISOString();
            // }
        } catch (e) {

        }
        console.log('hidden value is' + datetimeInput.value);



    },

});

var booking = {}

booking.orgNameInput = document.querySelector('form[action="booking.php"] input[name="onam"]');
booking.emailInput = document.querySelector('form[action="booking.php"] input[name="emal"]');
booking.mobNumInput = document.querySelector('form[action="booking.php"] input[name="monu"]');
booking.numMaleInput = document.querySelector('form[action="booking.php"] input[name="numa"]');
booking.numFemaleInput = document.querySelector('form[action="booking.php"] input[name="nufe"]');
booking.bookDateInput = document.querySelector('form[action="booking.php"] #dati');
booking.otherInput = document.querySelector('form[action="booking.php"] input[name="othe"]');


booking.ORG_VALIDATION = {
    trailing: {
        '-+': '-',    // Replace consecutive dashes with a single dash
        '\\.+': '.',  // Replace consecutive periods with a single period
        ' +': ''     // Removes Consecutive spaces
    },
    attributes: {
        type: 'text',
        pattern: /[a-zA-Z .\-]{1,255}/,
        required: true,
        max_length: 255,
    }
}

const CHECK_ORG_NAME = new InputValidator(booking.ORG_VALIDATION);

booking.orgNameInput.addEventListener('input', debounce(function (event) {
    console.log('Input value:', event.target.value);
    try {

        if (CHECK_ORG_NAME.validate(event.target)) {
            event.target.classList.remove('is-invalid');
        } else {
            event.target.classList.add('is-invalid');

        }
    } catch (error) {
        console.error('Validation error:', error);
    }
}, 400));

booking.emailInput.addEventListener('input', debounce(function (event) {
    console.log('Input value:', event.target.value);
    try {

        if (CHECK_EMAIL.validate(event.target)) {
            event.target.classList.remove('is-invalid');
        } else {
            event.target.classList.add('is-invalid');

        }
    } catch (error) {
        console.error('Validation error:', error);
    }
}, 400));

booking.MOB_NUM_VALIDATION = {
    attributes: {
        type: 'tel',
        pattern: /^\d+$/,
        required: true,
        max_length: 15,
        min_length: 7,
    }
}

const CHECK_MOB_NUM = new InputValidator(booking.MOB_NUM_VALIDATION);

booking.mobNumInput.addEventListener('input', debounce(function (event) {
    console.log('Input value:', event.target.value);
    try {

        if (CHECK_MOB_NUM.validate(event.target)) {
            event.target.classList.remove('is-invalid');
        } else {
            event.target.classList.add('is-invalid');

        }
    } catch (error) {
        console.error('Validation error:', error);
    }
}, 400));

booking.VISITOR_COUNT_VALIDATION = {
    attributes: {
        type: 'number',
        required: true,
        min: 0,
        max: 32_767,
        max_length: 5,
    }
}

const CHECK_VISITOR_COUNT = new InputValidator(booking.VISITOR_COUNT_VALIDATION);

booking.numMaleInput.addEventListener('input', debounce(function (event) {
    console.log('Input value:', event.target.value);
    try {

        if (CHECK_VISITOR_COUNT.validate(event.target)) {
            event.target.classList.remove('is-invalid');
        } else {
            event.target.classList.add('is-invalid');

        }
    } catch (error) {
        console.error('Validation error:', error);
    }
}, 400));

booking.numFemaleInput.addEventListener('input', debounce(function (event) {
    console.log('Input value:', event.target.value);
    try {

        if (CHECK_VISITOR_COUNT.validate(event.target)) {
            event.target.classList.remove('is-invalid');
        } else {
            event.target.classList.add('is-invalid');

        }
    } catch (error) {
        console.error('Validation error:', error);
    }
}, 400));

booking.VISITOR_BOOK_VALIDATION = {
    attributes: {
        type: 'text',
        required: true,
        min: todayDatetime,
        read_only: true,

    }
}

console.log(todayDatetime);
const CHECK_BOOK_DATE = new InputValidator(booking.VISITOR_BOOK_VALIDATION);

booking.bookDateInput.addEventListener('input', debounce(function (event) {
    console.log('Input value:', event.target.value);
    try {

        if (CHECK_BOOK_DATE.validate(event.target)) {
            event.target.classList.remove('is-invalid');
        } else {
            event.target.classList.add('is-invalid');

        }
    } catch (error) {
        console.error('Validation error:', error);
    }
}, 400));

var visitorLog = {}

visitorLog.emailInput = document.querySelector('form[action="log.php"] input[name="email1"]');
visitorLog.mobNumInput = document.querySelector('form[action="log.php"] input[name="monu1"]');

visitorLog.emailInput.addEventListener('input', debounce(function (event) {
    console.log('Input value:', event.target.value);
    try {

        if (CHECK_EMAIL.validate(event.target)) {
            event.target.classList.remove('is-invalid');
        } else {
            event.target.classList.add('is-invalid');

        }
    } catch (error) {
        console.error('Validation error:', error);
    }
}, 400));

visitorLog.mobNumInput.addEventListener('input', debounce(function (event) {
    console.log('Input value:', event.target.value);
    try {

        if (CHECK_MOB_NUM.validate(event.target)) {
            event.target.classList.remove('is-invalid');
        } else {
            event.target.classList.add('is-invalid');

        }
    } catch (error) {
        console.error('Validation error:', error);
    }
}, 400));