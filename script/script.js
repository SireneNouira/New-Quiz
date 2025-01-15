document.addEventListener('click', (event) => {
    if (event.target.id === 'next-question') {
        const button = event.target;
        const currentIndex = parseInt(button.dataset.current, 10);
        const qcmId = 1; // Remplace par l'ID dynamique du QCM si nécessaire

        fetch('path/to/ajax/endpoint', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ qcmId, currentQuestionIndex: currentIndex + 1 })
        })
            .then(response => response.text())
            .then(html => {
                document.querySelector('main').innerHTML = html;
            })
            .catch(error => console.error('Erreur AJAX :', error));
    }
});