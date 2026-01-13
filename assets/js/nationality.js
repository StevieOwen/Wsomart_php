const select = document.getElementById('nationality');

fetch('https://restcountries.com/v3.1/all?fields=name,cca2')
  .then(res => res.json())
  .then(data => {
    // Sort countries alphabetically
    data.sort((a, b) => a.name.common.localeCompare(b.name.common));
    
    data.forEach(country => {
      const opt = document.createElement('option');
      opt.value = country.cca2; // e.g., "US"
      opt.textContent = country.name.common; // e.g., "United States"
      select.appendChild(opt);
    });
  });