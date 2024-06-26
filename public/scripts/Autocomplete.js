class Autocomplete {

    constructor(input, suggestions, url, page = null) {
        // Initialize attributes
        this.input = input;
        this.suggestions = suggestions;
        this.url = url
        this.idArticle = null;
        // Bind functions to the class
        this.fetchMot = this.fetchMot.bind(this);
        this.hideSuggestions = this.hideSuggestions.bind(this);
        this.createAndHydrateDivs = this.createAndHydrateDivs.bind(this);
        // Create event listeners
        this.input.addEventListener('input', async () => {
            this.input.dataset.selected = 'false'
            this.fetchMot()
        });
        this.page = page
    }

    async fetchMot() {
        const mot = this.input.value;

        if (mot.length < 2) {
            this.suggestions.style.display = 'none';
            // Return null if the word is too short
            return null;
        }

        try {
            const response = await fetch(this.url + `?mot=${encodeURIComponent(mot)}`);
            const data = await response.json();
            this.suggestions.innerHTML = '';

            if (data.length > 0) {
                this.suggestions.style.display = 'block';

                data.forEach(item => this.createAndHydrateDivs(item));
            } else {
                this.suggestions.style.display = 'none';
                // Return null if there are no results
                return null;
            }
        } catch (error) {
            console.error('Error fetching suggestions:', error);
        }
    }

    createAndHydrateDivs(item) {
        const liGlobale = document.createElement('li');
        const divNom = document.createElement('div');
        const divRefStock = document.createElement('div');

        if (this.page == null) {
            divNom.innerHTML = '<strong>' + item.label + '</strong>';
            divRefStock.innerHTML = '<strong> Ref : </strong>' + item.reference + '<strong> / Stock : </strong>' + item.stock;
        } else {
            divRefStock.style.borderBottom = "solid 1px black"
            divNom.innerHTML = '<strong>' + item.reference + '</strong>';
            divRefStock.innerHTML = '<strong>' + item.abreviation + '</strong>'
        }
        liGlobale.addEventListener('click', () => {
            this.idArticle = item.id;
            this.input.value = this.page == null ? item.label : item.reference;
            this.suggestions.style.display = 'none';
            this.input.dataset.selected = 'true'
            this.input.dataset.idArticle = item.id
        });

        liGlobale.appendChild(divNom);
        liGlobale.appendChild(divRefStock);
        this.suggestions.appendChild(liGlobale);
    }

    hideSuggestions(event) {
        if (this.input.contains(event.target)) {
            this.suggestions.style.display = 'none';
        }
    }
}