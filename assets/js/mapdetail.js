const stukken = document.querySelectorAll(".stuk");
const textHeader = document.getElementById('text-change');
const textDesc = document.getElementById('text-desc');
const defaultDesc = textDesc.dataset.desc;
const defaultTekst = textHeader.dataset.default;


stukken.forEach(stuk => {
  // Maak de stukken klikbaar
  stuk.addEventListener("click", event => {
    toggleStuk(event.currentTarget);
  });

  // Maak de stukken focusable en afhandelbaar met toetsenbord
  stuk.addEventListener("keydown", event => {
    if (event.key === "Enter") {
      toggleStuk(event.currentTarget);
    } else if (event.key === "Escape") {
      resetStukken();
    }
  });
});

document.addEventListener("keydown", event => {
  if (event.key === "Escape") {
    resetStukken();
  }
});

function toggleStuk(geklikteEl) {
  const geklikteElName = geklikteEl.dataset.naam;
  const geklikteElDesc = geklikteEl.dataset.desc;

  if (geklikteEl.classList.contains("increase")) {
    textHeader.textContent = defaultTekst;
    textDesc.innerHTML =  defaultDesc;
  } else {
    textHeader.textContent = geklikteElName; 
    textDesc.innerHTML = geklikteElDesc;
  }

  geklikteEl.classList.toggle("increase");

  const tempStukken = Array.from(stukken);
  const index = tempStukken.indexOf(geklikteEl);
  tempStukken.splice(index, 1);

  tempStukken.forEach(anderStuk => {
    anderStuk.classList.toggle("hide");
  });
}

function resetStukken() {
  textHeader.textContent = defaultTekst;
  textDesc.innerHTML =  defaultDesc;
  stukken.forEach(stuk => {
    stuk.classList.remove("increase", "hide");
  });
}
