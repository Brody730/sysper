document.getElementById('uploadForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío tradicional del formulario

    let formData = new FormData();
    let fileInput = document.getElementById('csv_file').files[0];
    formData.append('csv_file', fileInput);

    fetch('process.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('response').innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('response').innerHTML = 'Ocurrió un error al procesar el archivo.';
    });
});
