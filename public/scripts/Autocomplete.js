class Autocomplete {

    constructor(input, suggestions , url) {
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
        this.input.addEventListener('input', async () => this.fetchMot() );
    }

    async fetchMot() {
        const mot = this.input.value;

        if (mot.length < 2) {
            this.suggestions.style.display = 'none';
            // Return null if the word is too short
            return null;
        }

        try {
            const response = await fetch(  this.url + `?mot=${encodeURIComponent(mot)}` );
            const data = await response.json();
            this.suggestions.innerHTML = '';

            if (data.length > 0) {
                this.suggestions.style.display = 'block';

                data.forEach(item => this.createAndHydrateDivs( item )) ;
            } else {
                this.suggestions.style.display = 'none';
                // Return null if there are no results
                return null;
            }
        } catch (error) {
            console.error('Error fetching suggestions:', error);
        }
    }

    createAndHydrateDivs( item ) {
        const liGlobale = document.createElement('li');
        const divNom = document.createElement('div');
        const divRefStock = document.createElement('div');

        divNom.innerHTML = '<strong>' + item.label + '</strong>';
        divRefStock.innerHTML = '<strong> Ref : </strong>' + item.reference + '<strong> / Stock : </strong>' + item.stock;

        liGlobale.addEventListener('click', () => {
            this.idArticle = item.id;
            this.input.value = item.label;
            this.suggestions.style.display = 'none';
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