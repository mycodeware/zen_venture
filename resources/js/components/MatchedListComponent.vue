<template>
    <div class="matches_dv">
        <div class="row justify-content-center mb-3">
            <div class="col-md-3 col-sm-6 col-10 px-1 mb-2 mb-md-0" v-for="(type, key) in types">
                <button type="button" class="button_green btn btn-info btn-block h-100" v-on:click="selectType(key)">{{ type }}</button>
            </div>
        </div>
        <h3 class="mt-5">{{ selected_display }}</h3>
        <form>
            <div v-if="selected_type=='investor'" class="row mb-3">
                <div class="col-md-6">
                    <select v-model="filterCountry" class="form-control form-control-sm">
                        <option value="">All Countries</option>
                        <option v-for="(country, key) in countries" :value="key">{{ country }}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select v-model="filterRound" class="form-control form-control-sm">
                        <option value="">All Investment Rounds</option>
                        <option v-for="(round, key) in investmentRounds" :value="key">{{ round }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div v-on:click="filter()" class="btn btn-secondary btn-sm">Filter</div>
                </div>
            </div>
            <div v-if="selected_type=='company'" class="row mb-3">
                <div class="col-md-6">
                    <select v-model="filterCountry" class="form-control form-control-sm">
                        <option value="">All Countries</option>
                        <option v-for="(country, key) in countries" :value="key">{{ country }}</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select v-model="filterPurpose" class="form-control form-control-sm">
                        <option value="">All Purposes</option>
                        <option v-for="(purpose, key) in selected_type_purposes" :value="key">{{ purpose }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div v-on:click="filter()" class="btn btn-secondary btn-sm">Filter</div>
                </div>
            </div>
            <div v-if="selected_type=='startup'" class="row mb-3">
                <div class="col-md-4">
                    <select v-model="filterCountry" class="form-control form-control-sm">
                        <option value="">All Countries</option>
                        <option v-for="(country, key) in countries" :value="key">{{ country }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select v-model="filterRound" class="form-control form-control-sm">
                        <option value="">All Investment Rounds</option>
                        <option v-for="(round, key) in investmentRounds" :value="key">{{ round }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select v-model="filterPurpose" class="form-control form-control-sm">
                        <option value="">All Purposes</option>
                        <option v-for="(purpose, key) in selected_type_purposes" :value="key">{{ purpose }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div v-on:click="filter()" class="btn btn-secondary btn-sm">Filter</div>
                </div>
            </div>
            <div v-if="selected_type=='professional'" class="row mb-3">
                <div class="col-md-4">
                    <select v-model="filterCountry" class="form-control form-control-sm">
                        <option value="">All Countries</option>
                        <option v-for="(country, key) in countries" :value="key">{{ country }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select v-model="filterProfession" class="form-control form-control-sm">
                        <option value="">All Professions</option>
                        <option v-for="(profession, key) in professions" :value="key">{{ profession.name }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select v-model="filterPurpose" class="form-control form-control-sm">
                        <option value="">All Purposes</option>
                        <option v-for="(purpose, key) in selected_type_purposes" :value="key">{{ purpose }}</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div v-on:click="filter()" class="btn btn-secondary btn-sm">Filter</div>
                </div>
            </div>
        </form>
        <div class="row" v-if="selected_type">
            <div class="col-sm-6">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        <li class="page-item" :class="{disabled: current_page <= 1}">
                            <a @click="turnPage(1)" class="page-link" aria-label="First">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">First</span>
                            </a>
                        </li>
                        <li class="page-item" :class="{disabled: current_page <= 1}">
                            <a @click="turnPage(current_page - 1)" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">&lt;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item" v-for="page in pages" :key="page" :class="{active: page === current_page}">
                            <a @click="turnPage(page)" class="page-link">{{page}}</a>
                        </li>
                        <li class="page-item" :class="{disabled: current_page >= last_page}">
                            <a @click="turnPage(current_page + 1)" class="page-link" aria-label="Next">
                                <span aria-hidden="true">&gt;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                        <li class="page-item" :class="{disabled: current_page >= last_page}">
                            <a @click="turnPage(last_page)" class="page-link" aria-label="Last">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Last</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-sm-6 text-right">Total {{total}} : {{from}} - {{to}}</div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover" v-if="selected_type=='investor'">
              <thead>
                  <tr>
                      <th scope="col" class="text-nowrap"></th>
                      <th scope="col" class="text-nowrap" v-for="th in selected_ths">{{ th }}</th>
                  </tr>
              </thead>
              <tbody>
                  <tr class="table-selectable" v-for="row_data in data" v-on:click="jumpToDetail(row_data.user.name)">
                      <td><img v-if="row_data.identified==identified" src="/img/identified.png" alt="identified" class="icon"/></td>
                      <td>{{ row_data.company_name }}</td>
                      <td>{{ row_data.country_name }}</td>
                      <td>{{ row_data.round_start_name }} - {{ row_data.round_end_name }}</td>
                      <td>{{ row_data.scale_start_name }} - {{ row_data.scale_end_name }}</td>
                  </tr>
              </tbody>
          </table>
          <table class="table table-bordered table-hover" v-if="selected_type=='company'">
              <thead>
                  <tr>
                      <th scope="col" class="text-nowrap"></th>
                      <th scope="col" class="text-nowrap" v-for="th in selected_ths">{{ th }}</th>
                  </tr>
              </thead>
              <tbody>
                  <tr class="table-selectable" v-for="row_data in data" v-on:click="jumpToDetail(row_data.user.name)">
                      <td><img v-if="row_data.identified==identified" src="/img/identified.png" alt="identified" class="icon"/></td>
                      <td>{{ row_data.company_name }}</td>
                      <td>{{ row_data.country_name }}</td>
                      <td>
                          <ul>
                              <li v-for="purpose in row_data.purposes">{{ purpose.purpose_name }}</li>
                          </ul>
                      </td>
                  </tr>
              </tbody>
          </table>
          <table class="table table-bordered table-hover" v-if="selected_type=='startup'">
              <thead>
                  <tr>
                      <th scope="col" class="text-nowrap"></th>
                      <th scope="col" class="text-nowrap" v-for="th in selected_ths">{{ th }}</th>
                  </tr>
              </thead>
              <tbody>
                  <tr class="table-selectable" v-for="row_data in data" v-on:click="jumpToDetail(row_data.user.name)">
                      <td><img v-if="row_data.identified==identified" src="/img/identified.png" alt="identified" class="icon"/></td>
                      <td>{{ row_data.company_name }}</td>
                      <td>{{ row_data.country_name }}</td>
                      <td>{{ row_data.investment_round_name }}</td>
                      <td>
                          <ul>
                              <li v-for="purpose in row_data.purposes">{{ purpose.purpose_name }}</li>
                          </ul>
                      </td>
                  </tr>
              </tbody>
          </table>
          <table class="table table-bordered table-hover" v-if="selected_type=='professional'">
              <thead>
                  <tr>
                      <th scope="col" class="text-nowrap"></th>
                      <th scope="col" class="text-nowrap" v-for="th in selected_ths">{{ th }}</th>
                  </tr>
              </thead>
              <tbody>
                  <tr class="table-selectable" v-for="row_data in data" v-on:click="jumpToDetail(row_data.user.name)">
                      <td><img v-if="row_data.identified==identified" src="/img/identified.png" alt="identified" class="icon"/></td>
                      <td>{{ row_data.country_name }}</td>
                      <td>{{ row_data.profession_name }}</td>
                      <td>{{ row_data.qualification }}</td>
                      <td>
                          <ul>
                              <li v-for="purpose in row_data.purposes">{{ purpose.purpose_name }}</li>
                          </ul>
                      </td>
                  </tr>
              </tbody>
          </table>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            "types",
            "typeThs",
            "countries",
            "investmentRounds",
            "professions",
            "typesPurposes",
            "iniParams",
            "identified",
        ],
        data() {
            return {
                data: [],
                selected_display: '',
                selected_type: '',
                selected_type_purposes: [],
                selected_ths: [],
                current_page: 1,
                filtered_country: '',
                filtered_round: '',
                filtered_profession: '',
                filtered_purpose: '',
                last_page: 1,
                total: 1,
                from: 0,
                to: 0,
                filterCountry: '',
                filterRound: '',
                filterProfession: '',
                filterPurpose: '',
            }
        },
        methods: {
            getList: function(selectedType, page) {
                var filter_params = '';
                if (this.filtered_country != '') filter_params = filter_params + '&country=' + this.filtered_country;
                if (this.filtered_round != '') filter_params = filter_params + '&round=' + this.filtered_round;
                if (this.filtered_profession != '') filter_params = filter_params + '&profession=' + this.filtered_profession;
                if (this.filtered_purpose != '') filter_params = filter_params + '&purpose=' + this.filtered_purpose;
                axios.get("/api/getList/"+selectedType+"?page=" + page + filter_params)
                    .then(response => {
                        this.data = response.data.data;
                        this.selected_type = selectedType;
                        this.selected_type_purposes = this.typesPurposes[selectedType];
                        this.selected_display = this.types[selectedType];
                        this.selected_ths = this.typeThs[selectedType];
                        this.current_page = response.data.current_page;
                        this.last_page = response.data.last_page;
                        this.total = response.data.total;
                        this.from = response.data.from;
                        this.to = response.data.to;
                    })
                    .catch(function(error) {
                        this.data = [];
                        this.selected_type = '';
                        this.selected_type_purposes = [];
                        this.selected_display = '';
                        this.filterCountry = '';
                        this.filterRound = '';
                        this.filterProfession = '';
                        this.filterPurpose = '';
                        alert('Error');
                    });
                var path = location.pathname;
                window.history.pushState(null, null, path + '?type=' + selectedType + '&page=' + page + filter_params);
            },
            selectType(type) {
                this.data = [];
                this.selected_type = '';
                this.selected_type_purposes = [];
                this.filtered_country = '';
                this.filterCountry = '';
                this.filtered_round = '';
                this.filterRound = '';
                this.filtered_profession = '';
                this.filterProfession = '';
                this.filtered_purpose = '';
                this.filterPurpose = '';
                this.getList(type, 1);
            },
            turnPage(page) {
                if (page >= 1 && page <= this.last_page) this.getList(this.selected_type, page)
            },
            filter() {
                this.filtered_country = this.filterCountry;
                this.filtered_round = this.filterRound;
                this.filtered_profession = this.filterProfession;
                this.filtered_purpose = this.filterPurpose;
                this.getList(this.selected_type, 1)
            },
            jumpToDetail: function(name) {
                document.location = window.location.pathname+"/"+name;
            }
        },
        mounted: function() {
            this.current_page = this.iniParams['page']? this.iniParams['page']: 1;
            this.filterCountry = this.filtered_country = this.iniParams['country']? this.iniParams['country']: '';
            this.filterRound = this.filtered_round = this.iniParams['round']? this.iniParams['round']: '';
            this.filterProfession = this.filtered_profession = this.iniParams['profession']? this.iniParams['profession']: '';
            this.filterPurpose = this.filtered_purpose = this.iniParams['purpose']? this.iniParams['purpose']: '';
            if (typeof this.types[this.iniParams['type']] != 'undefined') this.getList(this.iniParams['type'], this.current_page);
        },
        computed: {
            pages() {
                let start = _.max([this.current_page - 2, 1])
                let end = _.min([start + 5, this.last_page + 1])
                start = _.max([end - 5, 1])
                return _.range(start, end)
            },
        }
    };
</script>
