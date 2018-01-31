<template>

<div>

     <nav class="panel column is-offset-2 is-8">
      <p class="panel-heading">
       VueJS Phonebook

        <button class="button is-primary is-small is-outlined is-pulled-right" @click="openAdd">
          Add New
        </button>

        <span class="is-pulled-right" v-if="loading">
            <i class="fa fa-refresh fa-spin fa-1x fa-fw"></i>
            <span class="sr-only">Loading...</span>
        </span>
        <div class="is-clearfix"></div>
      </p>

      <div class="panel-block">
        <p class="control has-icons-left">
          <input class="input " type="text" placeholder="search" v-model="searchQuery">
          <span class="icon is-small is-left">
            <i class="fa fa-search"></i>
          </span>
        </p>
      </div>

      <a v-for="item,key in filteredList" class="panel-block">
        
        <span class="column is-9">
            {{ key }}. {{ item.name }}
        </span>

        <span class="panel-icon column is-1">
            <i class="has-text-danger fa fa-trash-o" aria-hidden="true" @click="openRemove(item)"></i>
        </span>
        <span class="panel-icon column is-1">
            <i class="has-text-info fa fa-edit" aria-hidden="true" @click="openEdit(item)"></i>
        </span>
        <span class="panel-icon column is-1">
            <i class="has-text-primary fa fa-eye" aria-hidden="true" @click="openShow(item)"></i>
        </span>
        
      </a>

      <div class="panel-block">
        <button class="button is-link is-outlined is-fullwidth">
          reset all filters
        </button>
      </div>
    </nav>


    <Add :openModal="addActive" @closeRequest='close' @refresh="fetchAll"></Add>
    <Show :openModal="showActive" @closeRequest='close' :user="user"></Show>
    <Edit :openModal="editActive" @closeRequest='close' :user="user"></Edit>
    <Remove :openModal="removeActive" @closeRequest='close' :user="user" @refresh="fetchAll"></Remove>

</div>

</template>


<script>

let Add = require('./Add.vue');
let Show = require('./Show.vue');
let Edit = require('./Edit.vue');
let Remove = require('./Remove.vue');

export default { 
    
    data() { 

        return {
            addActive: '',
            showActive: '',
            editActive: '',
            removeActive: '',
            items: [], 
            user: {},
            loading:false,
            searchQuery: ''
        }
    }, 

    components: { Add, Show, Edit, Remove }, 

    methods: {
        openAdd() { 
            this.addActive = 'is-active';
        },

        openShow(user) {
            console.log('openShow()...');
            console.log(user);
            this.showActive = 'is-active';
            this.user = user;
        }, 

        openEdit(user) {
            console.log('openEdit()...');
            console.log(user);
            this.editActive = 'is-active';
            this.user = user;
        }, 

        openRemove(user) {
            console.log('openRemove()...');
            console.log(user);
            this.removeActive = 'is-active';
            this.user = user;
        }, 

        close() { 
            this.addActive = '';
            this.showActive = '';
            this.editActive = '';
            this.removeActive = '';
        }, 

        fetchAll() {
            
            // Optionally the request above could also be done as
            axios.get('/phonebook')
                .then((response) => this.items = response.data )
                .catch((error) => this.errors = error.response.data.errors)
        }
    }, 

    computed: {
        filteredList() {
            return this.items.filter(item => {
                return item.name.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
                    item.phone.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    item.email.toLowerCase().includes(this.searchQuery.toLowerCase());
            })
        }
    },

    created() { 
        console.log('Home created()...');
        this.fetchAll();
    }, 

    mounted() {
        console.log('Home mounted()...');
    }
}

</script>
