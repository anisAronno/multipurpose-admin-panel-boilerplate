import { reactive, ref } from "vue";
import { countries as countryData } from "../data/countries.json";

/**--------------------
 * User Country Select
 * --------------------*/

let countryArr = Object.values(countryData);
let timeZoneArr = Object.keys(countryData);

let userCountry = {};
let userTimeZone;

if (Intl) {
  userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
  userCountry = countryData[userTimeZone];
}

/** -------------------
 * Variable
 * ------------------*/

const timeZoneList = ref(timeZoneArr); 
const countries = reactive([
  ...new Map(countryArr.map((item) => [item["country"], item])).values(),
]);

   

/**--------------------------------------
 * @Export Data and
 * Variable Data
 * --------------------------------------*/

export function useCountries() {
  return {
      countries,
      timeZoneArr,
      userTimeZone,
      userCountry,
  };
}
