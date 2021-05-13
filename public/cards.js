const link = "https://api.apify.com/v2/key-value-stores/lFItbkoNDXKeSWBBA/records/LATEST?disableRedirect=true";
const regionLink = "https://covid19-api-philippines.herokuapp.com/api/top-regions"
let myArray = [];
let caseByRegion = [];
let regionalLastUpdate;
const nationalUpdate = document.getElementById('nationalDate')
const regionalUpdate = document.getElementById('regionalDate')
const cardInfected = document.getElementById('card_two')
const cardTested = document.getElementById('card_three')
const cardRecovered = document.getElementById('card_four')
const cardDeceased = document.getElementById('card_five')
const cardActive = document.getElementById('card_six')
const cardUnique = document.getElementById('card_seven')
const parentList = document.getElementById('parentList')
const casesList = document.getElementById('casesList');
const recoveredList = document.getElementById('recoveredList');
const deathList = document.getElementById('deathList');
const table = document.getElementById('table');

