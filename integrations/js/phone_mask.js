// Phone mask
const country = document.cookie.match(/country=(.+?)(;|$)/)[1];

const phoneInputs = document.querySelectorAll('input[name="phone"]');
for (let i = 0; i < phoneInputs.length; i++) {
  let phoneInput = phoneInputs[i];
  let inp = intlTelInput(phoneInput, {
    initialCountry: country,
    autoFormat: true,
    nationalMode: false,
    allowDropdown: false,
    utilsScript: './phone_mask_utils.js',
  });

  phoneInput.addEventListener('click', function (event) {
    if (phoneInput.value.length === 0) {
      countryData = inp.getSelectedCountryData();
      dialCode = countryData.dialCode;
      phoneInput.value = '+' + dialCode;
    }
  });

  phoneInput.addEventListener('input', function (event) {
    let formatedNumber = intlTelInputUtils.formatNumber(
      inp.getNumber(),
      null,
      intlTelInputUtils.numberFormat.INTERNATIONAL
    );
    phoneInput.value = formatedNumber;
  });
}