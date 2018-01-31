<template>

    <div class="modal " :class="openModal">

          <div class="modal-background"></div>

          <div class="modal-card">

            <header class="modal-card-head">

                <p class="modal-card-title">Remove Entry #{{ user.id }} </p>

              <button class="delete" aria-label="close" @click="close"></button>

            </header>

            <section class="modal-card-body">
                        
                <div class="notification is-info">
                      Are you sure you want to delete this entry?
                </div>

            </section>

            <footer class="modal-card-foot">

              <button class="button is-success" @click="remove">Yes</button>

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
    
        remove() {

            console.log('update()...');
            console.log(this.user);

            axios.delete(`/phonebook/${this.user.id}`, this.user).then((response) => {
                //this.user = { name:'', phone:'', email:''};
                this.$emit('refresh');
                this.close();
            })
            .catch((error) => this.errors = error.response.data.errors)
        },
    
        close() {

            this.$emit('closeRequest');
        }
    }

    
}

</script>
