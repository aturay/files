<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Поиск в словаре</title>
    <style>
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Поиск в словаре</h1>

    <label for="searchInput">Введите слово на русском:</label>
    <input type="text" id="searchInput" placeholder="Слово на русском">
    <button id="searchButton">Поиск</button>

    <div id="results">
        <h2>Результаты поиска:</h2>
        <ul id="resultsList"></ul>
    </div>

    <script>
        let dictionaryData = null;

        // Загрузка словаря из JSON-файла
        fetch('https://raw.githubusercontent.com/aturay/files/master/dictionary.json')
            .then(response => response.json())
            .then(data => {
                dictionaryData = data;
            })
            .catch(error => console.error('Ошибка загрузки словаря:', error));

        const searchInput = document.getElementById('searchInput');
        const resultsList = document.getElementById('resultsList');

        searchInput.addEventListener('input', () => {
            const searchWord = searchInput.value.trim().toLowerCase();
            resultsList.innerHTML = '';

            if (searchWord.length >= 2 && dictionaryData) {
                // Поиск совпадений в словаре
                const matches = dictionaryData.filter(entry => entry["Слово"].toLowerCase().includes(searchWord));

                if (matches.length > 0) {
                    // Вывод результатов поиска
                    matches.forEach(match => {
                        const listItem = document.createElement('li');
                        const boldWord = document.createElement('strong');
                        boldWord.textContent = match["Слово"];
                        listItem.appendChild(boldWord);
                        listItem.innerHTML += `, Слово (англ.): ${match["Слово (англ.)"]}, Категория: ${match["Категория"]}, Перевод 1: ${match["Перевод 1"]}, Транскрипция 1: ${match["Транскрипция 1"]}, Перевод 2: ${match["Перевод 2"]}, Транскрипция 2: ${match["Транскрипция 2"]}`;
                        resultsList.appendChild(listItem);
                    });
                } else {
                    const noResultsItem = document.createElement('li');
                    noResultsItem.textContent = 'Нет совпадений.';
                    resultsList.appendChild(noResultsItem);
                }
            }
        });
    </script>
</body>
</html>
