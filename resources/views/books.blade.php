<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livres</title>
</head>
<body>
    <h1>Liste des livres</h1>

    <div id="books-list"></div>

    <script>
        fetch('http://127.0.0.1:8003/api/books', {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(result => {
            const booksList = document.getElementById('books-list');

            result.data.forEach(book => {
                booksList.innerHTML += `
                    <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
                        <h3>${book.title}</h3>
                        <p>${book.author ?? ''}</p>
                    </div>
                `;
            });
        })
        .catch(error => {
            console.error('Erreur :', error);
        });
    </script>
</body>
</html>