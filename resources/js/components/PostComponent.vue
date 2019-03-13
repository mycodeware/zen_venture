<template>
    <div>
        <div class="whts_nw_wrpr whts_nw_wrpr2">
            <div class="row">
                <div class="col-md-6 col-sm-6" v-for="row_data in data">
                  <div class="dt_txt">
                    <span>{{ row_data.published_at | moment }}</span>
                    <p>{{ row_data.text }}</p>
                  </div>
                  </div>
            </div>
        </div>
        
        <div class="mr_pst text-center">

      <div class="row">

        <div class="col-sm-6 col-xs-6 text-left" :class="{disabled: current_page >= last_page}">

      <a @click="change(current_page + 1)">Older Posts</a>

    </div>

        <div class="col-sm-6 col-xs-6 text-right" :class="{disabled: current_page <= 1}">

      <a @click="change(current_page - 1)">Newer Posts</a>

    </div>

    </div>

    </div>
    </div>
</template>
<script>
    import moment from 'moment';
    export default {
        data() {
            return {
                data: [],
                current_page: 1,
                last_page: 1,
                total: 1,
                from: 0,
                to: 0
            }
        },
        methods: {
            getPosts: function(page) {
                axios.get("api/getPosts?page="+page)
                    .then(response => {
                        this.data = response.data.data;
                        this.current_page = response.data.current_page;
                        this.last_page = response.data.last_page;
                        this.total = response.data.total;
                        this.from = response.data.from;
                        this.to = response.data.to;
                    })
                    .catch(function(error) {
                        this.data = [];
                        alert('Error');
                    });
            },
            change(page) {
                if (page >= 1 && page <= this.last_page) this.getPosts(page)
            },
        },
        mounted: function() {
            this.getPosts(1);
        },
        computed: {
            pages() {
                let start = _.max([this.current_page - 2, 1])
                let end = _.min([start + 5, this.last_page + 1])
                start = _.max([end - 5, 1])
                return _.range(start, end)
            },
        },
        filters: {
            moment: function (date) {
                return moment(date).format('Do MMMM, YYYY');
            }
        }
    };
</script>