<template>

    <div class="modal " :class="openModal">

          <div class="modal-background"></div>

          <div class="modal-card">

            <header class="modal-card-head">

              <p class="modal-card-title">Add New Entry </p>

              <button class="delete" aria-label="close" @click="close"></button>

            </header>

            <section class="modal-card-body">

                <!-- Content ... -->
                <div class="field">
                     <label class="label">Name</label>
                     <div class="control">
                         <input class="input" :class="{'is-danger': errors.name}" type="text" placeholder="Name" v-model="user.name" @click="errors.name=''" >
                    </div>
                    <small v-if="errors.name" class="has-text-danger">{{ errors.name[0] }}</small>
                </div>
                <div class="field">
                     <label class="label">Phone No.</label>
                     <div class="control">
                         <input class="input" :class="{'is-danger': errors.phone}" type="text" placeholder="Phone" v-model="user.phone" @click="errors.phone=''">
                    </div>
                    <small v-if="errors.phone" class="has-text-danger">{{ errors.phone[0] }}</small>
                </div>
                <div class="field">
                     <label class="label">E-mail</label>
                     <div class="control">
                         <input class="input" :class="{'is-danger': errors.email}" type="email" placeholder="E-mail" v-model="user.email" @click="errors.email=''">
                    </div>
                    <small v-if="errors.email" class="has-text-danger">{{ errors.email[0] }}</small>
                </div>

            </section>

            <footer class="modal-card-foot">

              <button class="button is-success" @click="save">Save changes</button>

              <button class="button" @click="close">Cancel</button>

            </footer>

          </div>
    </div>

</template>

<script>

export default {
    
    props: ['openModal'], 

    data() {
            
        return {
        
            user: { name: '', phone: '', email: '' },
            
            errMsg: '',
            errors: {}
        }

    }, 

    methods: {
    
        save() {

            console.log('save()...');
            console.log(this.user);
            //var $vm = this;


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
    }

    
}

</script>
