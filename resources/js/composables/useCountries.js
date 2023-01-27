import { reactive, ref } from "vue";
import { countries as countryData } from "../data/countries.json";

/**--------------------
 * User Country Select
 * --------------------*/

let countryArr = Object.values(countryData);
let timeZoneArr = Object.keys(countryData); 

let userCountry = {};
let userTimeZone;
let userLanguages;

if (Intl) {
  userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
  userCountry = countryData[userTimeZone];
  userLanguages = countryData[userTimeZone].languages.code;
}
 
/** -------------------
 * Variable
 * ------------------*/

const timeZoneList = ref(timeZoneArr); 

 
const countryWithCode = reactive([
    ...new Map(countryArr.map((item) => [item["country"], item])).values(),
]);
   
const countries = ref(countryWithCode.map((a) => a.country));

/**--------------------------------------
 * @Export Data and
 * Variable Data
 * --------------------------------------*/

export function useCountries() {
  return {
      userCountry,
      timeZoneList,
      userTimeZone,
      countries,
      countryWithCode, 
  };
}

/**
 * 
 * @param {*} existingLanguages 
 * @returns 
 */
export function useLanguage(existingLanguages) {
    const languageArray = [];
    const seenLabels = new Set();
    for (const obj of countryWithCode) {
        if (
            !obj.languages.code ||
            !obj.languages.name ||
            !obj.languages.native
        ) {
            continue;
        }
        if (seenLabels.has(obj.languages.name)) {
            continue;
        }

        if (!existingLanguages.includes(obj.languages.code)) {
            continue;
        }

        seenLabels.add(obj.languages.name);
        languageArray.push({
            value: obj.languages.code,
            label: obj.languages.name,
        });
    }

    return languageArray;
}