function showError(element, message) {
    element.classList.add('error');
    const errorElement = document.getElementById(element.id + 'Error');
    console.log(message);
    errorElement.textContent = message;
}

function resetErrors() {
    const errorElements = document.querySelectorAll('.error');
    errorElements.forEach(function(element) {
        element.classList.remove('error');
    });

    const errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(function(element) {
        element.textContent = '';
    });
}

document.getElementById('newsForm').addEventListener('submit', function(event) {
    event.preventDefault();

    resetErrors();

    let dobarUnos = true;

    const naslov = document.getElementById('naslov');
    const sazetak = document.getElementById('sazetak');
    const tekst = document.getElementById('tekst');
    const slika = document.getElementById('slika');
    const kategorija = document.getElementById('kategorija');

    let msg = "";

    if (naslov.value.length < 5 || naslov.value.length > 30) {
        dobarUnos = false;
        msg = 'Naslov mora imati između 5 i 30 znakova.';
        showError(naslov, msg);
    }
    if (sazetak.value.length < 10 || sazetak.value.length > 100) {
        dobarUnos = false;
        msg = 'Sazetak mora imati između 10 i 100 znakova.';
        showError(sazetak, msg);
    }

    if (tekst.value.trim() === '') {
        dobarUnos = false;
        msg = 'Tekst vijesti nesmije biti prazan.'
        showError(tekst, msg);
    }

    if (kategorija.value === '') {
        dobarUnos = false;
        msg = 'Morate odabrati kategoriju.';
        showError(kategorija, msg);
    }

    if (dobarUnos) {
        this.submit();
    }
});