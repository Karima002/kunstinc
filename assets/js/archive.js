// document.addEventListener('DOMContentLoaded', function() {
//   // Log een bericht om te bevestigen dat de DOM is geladen
//   console.log('Hello');

//   // Haal de select-element en de annual-item secties op
//   const selectYear = document.getElementById('select-annual-year');
//   const annualItems = document.querySelectorAll('.annual-item');

//   selectYear.addEventListener('change', function() {
//     const selectedYear = selectYear.value;

//     // Loop door alle annual-items
//     annualItems.forEach(function(item) {
//       // Haal het jaartal uit de h4 binnen de annual-item sectie
//       const year = item.querySelector('h4').textContent.match(/\d{4}/)[0];

//       // Toon of verberg de item op basis van de geselecteerde waarde
//       if (selectedYear === 'all' || year === selectedYear) {
//         item.style.display = 'block';
//       } else {
//         item.style.display = 'none';
//       }
//     });
//   });

//   // Trigger de change event bij het laden om de juiste items weer te geven
//   selectYear.dispatchEvent(new Event('change'));
// });
