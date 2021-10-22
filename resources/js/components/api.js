import Vue from 'vue/dist/vue.js';

export default {
    _container: null,
    init() {
        this._container = document.querySelector('[data-vue]');
        if (!this._container) {
            return;
        }

        console.log(this._container);
        new Vue({
            el: this._container,
            delimiters: ['${', '}'],
            data: {
                apiUrl: 'https://www.barnehagefakta.no/api/',
                orgid: this._container.getAttribute('data-vue'),
                kindergartens: [],
                filteredKindergartens: [],
                sortedKindergartens: []
            },
            created() {
                let fetchUrl = this.apiUrl + 'Location';
                if (this.orgid) {
                    fetchUrl = this.apiUrl + 'Barnehage/orgnr/' + this.orgid;
                }

                console.log(this.orgid)
                fetch(fetchUrl)
                .then(response => response.json())
                .then(data => {
                    this.kindergartens = data;
                    console.log(this.kindergartens);
                    if (!this.orgid) {
                        this.update();
                    }
                });
            },
            methods: {
                update() {
                    this.filteredKindergartens = this.kindergartens.slice(0, 10);
                    this.sortedKindergartens = this.kindergartens.sort((a,b) => {
                        return a.eierform > b.eierform ? -1 : (a.eierform < b.eierform) ? 1 : 0;;
                    });
                }
            }
        })
    }
}