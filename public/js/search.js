new Vue({

    el: 'body',

    data: {
        articles: [],
        pictures: [],
        loading: false,
        noresult: '',
        query: ''
    },

    methods: {
        searcharticle: function() {
            // Clear the error message.
            this.noresult = '';
            // Empty the articles array so we can fill it with the new articles.
            this.articles = [];
            // Set the loading property to true, this will display the "Searching..." button.
            this.loading = true;

            // Making a get request to our API and passing the query to it.
            this.$http.get('/api/search/article?q=' + this.query).then((response) => {
                // If there was an error set the error message, if not fill the articles array.
                response.body.error ? this.noresult = response.body.error : this.articles = response.body;
                // The request is finished, change the loading to false again.
                this.loading = false;
                // Clear the query.
                this.query = '';
            });
        },
        searchgallery: function() {
            // Clear the error message.
            this.noresult = '';
            // Empty the pictures array so we can fill it with the new pictures.
            this.pictures = [];
            // Set the loading property to true, this will display the "Searching..." button.
            this.loading = true;

            // Making a get request to our API and passing the query to it.
            this.$http.get('/api/search/gallery?q=' + this.query).then((response) => {
                // If there was an error set the error message, if not fill the pictures array.
                response.body.error ? (this.noresult = response.body.error) : (this.pictures = response.body);
                // The request is finished, change the loading to false again.
                this.loading = false;
                // Clear the query.
                this.query = '';
            });
        }
    }

});