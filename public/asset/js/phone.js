document.addEventListener("DOMContentLoaded", function() {
    var input = document.getElementById('phone');
    var countryCodeInput = document.getElementById('phoneCode');

    // Initialize intlTelInput
    var iti = window.intlTelInput(input, {
        initialCountry: "ma",
        separateDialCode: true,
        preferredCountries: ['ma', 'fr', 'us'],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
    });

    // Update country code when user selects a country
    input.addEventListener("countrychange", function() {
        var countryData = iti.getSelectedCountryData();
        countryCodeInput.value = "+" + countryData.dialCode;
    });

    // Save full number format on form submit
    document.querySelector("form").addEventListener("submit", function() {
        input.value = iti.getNumber(); // Save full international number
    });
});
