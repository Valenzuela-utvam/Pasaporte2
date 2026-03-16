
function onScanSuccess(decodedText, decodedResult) {
    html5QrcodeScanner.clear();
    
    const resultDiv = document.getElementById('qr-reader-results');
    resultDiv.innerHTML = `<div class="alert alert-success">Código detectado: <strong>${decodedText}</strong></div>`;
    
    if (decodedText.startsWith("mat:")) {
        console.log("Procesando Matrícula:", decodedText.split(":")[1]);
    } else {
        console.log("Procesando ID de sistema:", decodedText.split(":")[1]);
    }
}


let html5QrcodeScanner = new Html5QrcodeScanner(
    "qr-reader", { fps: 10, qrbox: 250 }
);

function toggleLector() {
    const readerDiv = document.getElementById('qr-reader');
    
    // Si está oculto o no tiene estilo definido, lo mostramos
    if (readerDiv.style.display === "none" || readerDiv.style.display === "") {
        readerDiv.style.display = "block";
        html5QrcodeScanner.render(onScanSuccess);
    } else {
        readerDiv.style.display = "none";
        html5QrcodeScanner.clear();
    }
}