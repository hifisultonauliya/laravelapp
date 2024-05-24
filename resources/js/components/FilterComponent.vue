<template>
  <div class="custom-filters">
    <b-container fluid="lg">
      <div class="filter-box-top">
        <h3>I'm looking for...</h3>
      </div>
      <div class="filter-box-bottom">
        <b-row class="filters">
            <b-col cols="3">
                <p class="labelFilter">Product Type</p>
                <v-select 
                  class="inputFilter"
                  :options="masterProductType"
                  placeholder="ALL"
                  :reduce="d => d.code"
                  label="text"
                  v-model="localFilters.productType"
                  v-on:input="updateLocalFilterProductType"
                  searchable
                >
                  <template #option="option">
                    {{ option.text }} <span class="optionQty">{{ option.qty }}</span>
                  </template>
                  <template #selected-option="option">
                    {{ option.text }} ({{ option.qty }})
                  </template>
                </v-select>
            </b-col>
            <b-col cols="3">
                <p class="labelFilter">Grade</p>
                <v-select 
                  class="inputFilter"
                  :options="masterGrade"
                  placeholder="ALL"
                  :reduce="d => d.code"
                  label="text"
                  v-model="localFilters.grade"
                  v-on:input="updateLocalFilterGrade"
                  searchable
                >
                  <template #option="option">
                    {{ option.text }} <span class="optionQty">{{ option.qty }}</span>
                  </template>
                  <template #selected-option="option">
                    {{ option.text }} ({{ option.qty }})
                  </template>
                </v-select>
            </b-col>
            <b-col cols="3">
                <p class="labelFilter">Size</p>
                <v-select 
                  class="inputFilter"
                  :options="masterSize"
                  placeholder="ALL"
                  :reduce="d => d.code"
                  label="text"
                  v-model="localFilters.size"
                  v-on:input="updateLocalFilterSize"
                  searchable
                >
                  <template #option="option">
                    {{ option.text }} <span class="optionQty">{{ option.qty }}</span>
                  </template>
                  <template #selected-option="option">
                    {{ option.text }} ({{ option.qty }})
                  </template>
                </v-select>
            </b-col>
            <b-col cols="3">
                <p class="labelFilter">Connection</p>
                <v-select 
                  class="inputFilter"
                  :options="masterConnection"
                  placeholder="ALL"
                  :reduce="d => d.code"
                  label="text"
                  v-model="localFilters.connection"
                  v-on:input="updateLocalFilterConnection"
                  searchable
                >
                  <template #option="option">
                    {{ option.text }} <span class="optionQty">{{ option.qty }}</span>
                  </template>
                  <template #selected-option="option">
                    {{ option.text }} ({{ option.qty }})
                  </template>
                </v-select>
            </b-col>
        </b-row>
        <b-row class="filter-button">
          <button type="button" class="btn btn-lg custom-search-btn w-100 h-100" @click="fetchProducts()" form="searchPipes">
              <div class="d-flex justify-content-center d-md-block text-md-center">
                  <span class="icon-search mb-0 mr-2 mb-md-2 mr-md-0"></span>
                  <p class="mb-0"><strong>Find</strong></p>
              </div>
          </button>
        </b-row>
      </div>

      <div class="table-div">
        <div v-if="loading" class="loading-div">
          <b-spinner type="grow"></b-spinner>
        </div>
        <div v-if="!loading && !data.length">
          <p>No Data Available...</p>
        </div>
        <div class="table-custom" v-if="!loading && data.length">
          <b-table striped hover :items="data"></b-table>
        </div>
      </div>
      
    </b-container>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
  data() {
    return {
      data: [],
      loading: false,
      localFilters: {
        productType: null,
        size: null,
        grade: null,
        connection: null,
      }
    };
  },
  computed: {
    ...mapGetters([
      'allMasters', 
      'getFilters',
      'masterProductType', 
      'masterSize',
      'masterConnection',
      'masterGrade'
    ]),
  },
  methods: {
    ...mapActions(['fetchMasters', 'setFilters']),
    updateLocalFilterProductType(input){
      console.log("updateLocalFilterProductType", input)
      console.log("Filter", this.localFilters)
      this.setFilters(this.localFilters)
      this.data = []
    },
    updateLocalFilterGrade(input){
      console.log("updateLocalFilterGrade", input)
      console.log("Filter", this.localFilters)
      this.setFilters(this.localFilters)
      this.data = []
    },
    updateLocalFilterSize(input){
      console.log("updateLocalFilterSize", input)
      console.log("Filter", this.localFilters)
      this.setFilters(this.localFilters)
      this.data = []
    },
    updateLocalFilterConnection(input){
      console.log("updateLocalFilterConnection", input)
      console.log("Filter", this.localFilters)
      this.setFilters(this.localFilters)
      this.data = []
    },
    async fetchProducts() {
      let self = this
      self.loading = true
      try {
        const response = await axios.get('/api/products', {

          params: {
            productType: self.localFilters.productType,
            size: self.localFilters.size,
            grade: self.localFilters.grade,
            connection: self.localFilters.connection,
          }
        });

        console.log("data", response.data)
        this.data = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }

      self.loading = false
    }
  },
  mounted() {
    console.log("allmasters", this.allMasters, this.allMasters.length)
    console.log("masterProductType", this.masterProductType)
    console.log("masterSize", this.masterSize)
    console.log("masterConnection", this.masterConnection)
    console.log("masterGrade", this.masterGrade)
    console.log("getFilters", this.getFilters)

    // setup saved data filter
    this.localFilters.productType = this.getFilters.productType
    this.localFilters.size = this.getFilters.size
    this.localFilters.grade = this.getFilters.grade
    this.localFilters.connection = this.getFilters.connection

    if(this.allMasters.length == 0){
        this.fetchMasters();
    }
  }
};
</script>
<style>
.labelFilter{
  position: absolute;
  z-index: 2;
  padding-top: 15px;
  padding-left: 10px;
}

.inputFilter .vs__dropdown-toggle{
  height: 75px;
  border-radius: .5rem;
}
.inputFilter .vs__selected,.inputFilter .vs__search{
  padding-top: 20px;
  font-size: 14px;
  font-weight: bold;
  color: var(--orange);
}
.inputFilter.vs--open .vs__selected{
  display: none;
}
.inputFilter .vs__actions .vs__clear{
  position: absolute;
  top: 33px;
  right: 5px;
  z-index: 2;
}
.inputFilter .vs__actions .vs__open-indicator{
  position: absolute;
  top: 23px;
  right: 10px;
  fill: var(--orange);
}

.custom-filters{
  position: relative;
  top: -100px;
}

.filter-box-top{
  width: 300px;
  height: 0;
  border-radius: 10px 0px 0px 0px;
  border-bottom: 50px solid white;
  border-right: 50px solid transparent;
}
.filter-box-top h3{
  padding:13px;
}
.filter-box-bottom{
  background: white;
  padding: 15px;
  border-radius: 0px 10px 10px 10px;
}
.optionQty{
  color: var(--orange);
  float: right;
}

.filters{
  width: calc(100% - 60px);
  float: left;
}
.filters > .col-3{
  padding-right: 0px;
}
.filter-button{
  height: 75px;
  padding-left: 25px;
}
.loading-div{
  text-align: center;
  padding: 10%;
  color: var(--orange);
}

/* style sementara */
.table-div{
  padding: 15px;
  background: white;
  margin-top: 10px;
  border-radius: 10px;
}

.table-custom{
  height: 400px;
  overflow-x: auto;
}
</style>