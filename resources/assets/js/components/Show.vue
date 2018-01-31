<template>

    <div class="modal " :class="openModal">

          <div class="modal-background"></div>

          <div class="modal-card">

            <header class="modal-card-head">

                <p class="modal-card-title">Detail Entry #{{ user.id }} </p>

              <button class="delete" aria-label="close" @click="close"></button>

            </header>

            <section class="modal-card-body">

                <li class="panel-block">
                        <label class="column is-2">ID: </label> {{ user.id }}
                </li>
                    
                <li class="panel-block">
                        <label class="column is-2">Name: </label> {{ user.name }}
                </li>
                <li class="panel-block">
                        <label class="column is-2">Phone: </label> {{ user.phone }}
                </li>
                <li class="panel-block">
                        <label class="column is-2">Email: </label> {{ user.email }}
                </li>

            </section>

            <footer class="modal-card-foot">

              <button class="button" @click="close">Cancel</button>

            </footer>

          </div>
    </div>

</template>

<script>

export default {
    
    props: ['openModal', 'user'], 

    data() {
            
        return {
        
            errMsg: '',
            errors: {}
        }

    }, 

    methods: {
    
        save() {

            console.log('save()...');
            console.log(this.user);

            axios.post('/phonebook', this.user).then((response) => {
                this.user = { name:'', phone:'', email:''};
                this.$emit('refresh');
                this.close();
            })
            .catch((error) => this.errors = error.response.data.errors)
        },
    
        close() {

            this.$emit('closeRequest');
        }
    }, 

    created() { 
        console.log('Show() created');
    }, 

    mounted() { 
        console.log('Show() mounted');
    }

    
}

</script>
