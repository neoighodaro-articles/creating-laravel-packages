<div class="container" id="review">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>Add review</h4>
                    <div class="form-group">
                        <input type="text" v-model="username" class="form-control col-4" placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" v-model="comment" placeholder="Enter your review"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="button" v-on:click="addPageReview" v-bind:disabled="isDisabled" class="btn btn-success" value="Add Review" />
                    </div>
                    <hr />
                    <h4>Display reviews</h4>
                    <div v-for="review in reviews">
                        <strong>@{{ review.username }}</strong>
                        <p>@{{ review.comment }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    Pusher.logToConsole = true;
    var review = new Vue({
        el: '#review',
        data: {
            username: null,
            comment: null,
            path: window.location.pathname,
            isDisabled: false,
            reviews: [],
            page: [],
        },
        methods: {
            subscribe() {
                var pusher = new Pusher('{{ env('PUSHER_APP_KEY')}}', {
                    cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                });
                pusher.subscribe('page-' + this.page.id)
                    .bind('new-review', this.fetchPageReviews());
            },
            fetchPageReviews() {
                var vm = this;
                var url = '{{ route('pagereview.index') }}' + '?path=' + this.path;

                fetch(url)
                  .then(function(response) {
                      return response.json()
                  })
                  .then(function(json) {
                      vm.page = json.page
                      vm.reviews = json.reviews
                      vm.subscribe();
                  })
            },
            addPageReview(event) {
                event.preventDefault();
                this.isDisabled = true;
                const token = document.head.querySelector('meta[name="csrf-token"]');
                const data = {
                    path: this.path,
                    comment: this.comment,
                    username: this.username,
                };
                fetch('{{ route('pagereview.store') }}', {
                    body: JSON.stringify(data),
                    credentials: 'same-origin',
                    headers: {
                        'content-type': 'application/json',
                        'x-csrf-token': token.content,
                    },
                    method: 'POST',
                    mode: 'cors',
                }).then(response => {
                    this.isDisabled = false;
                    if (response.ok) {
                        this.username = '';
                        this.comment = '';
                        this.fetchPageReviews();
                    }
                })
            },            
        },
        created() {
            this.fetchPageReviews();
        }
    });
</script>