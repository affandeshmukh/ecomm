document.addEventListener('DOMContentLoaded', () => {
    const cardContainer = document.getElementById('card-container');

    // Simulate fetching data from a database
    const cardsData = [
        {
            imgSrc: 'https://via.placeholder.com/286x180',
            title: 'Card title 1',
            text: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
            link: '#'
        },
        {
            imgSrc: 'https://via.placeholder.com/286x180',
            title: 'Card title 2',
            text: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
            link: '#'
        },
        {
            imgSrc: 'https://via.placeholder.com/286x180',
            title: 'Card title 3',
            text: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
            link: '#'
        },
        {
            imgSrc: 'https://via.placeholder.com/286x180',
            title: 'Card title 4',
            text: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
            link: '#'
        },
        {
            imgSrc: 'https://via.placeholder.com/286x180',
            title: 'Card title 5',
            text: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
            link: '#'
        },
        {
            imgSrc: 'https://via.placeholder.com/286x180',
            title: 'Card title 6',
            text: 'Some quick example text to build on the card title and make up the bulk of the card\'s content.',
            link: '#'
        }
    ];

    // Function to create a card element
    const createCard = (card) => {
        const cardElement = document.createElement('div');
        cardElement.className = 'card';
        cardElement.innerHTML = `
            <img src="${card.imgSrc}" alt="Card image">
            <div class="card-body">
                <h5 class="card-title">${card.title}</h5>
                <p class="card-text">${card.text}</p>
                <a href="${card.link}" class="btn">Go somewhere</a>
            </div>
        `;
        return cardElement;
    };

    // Append cards to the container
    cardsData.forEach(cardData => {
        const cardElement = createCard(cardData);
        cardContainer.appendChild(cardElement);
    });
});
