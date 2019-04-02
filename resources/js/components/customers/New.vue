<template>
    <div>
        <form @submit.prevent="add">
            <div class="form-group">
                <label for="inputName">Name</label>
                <input type="text" class="form-control" id="inputName" v-model="customer.name" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="email" class="form-control" id="inputEmail" v-model="customer.email"
                       placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label for="inputPhone">Phone</label>
                <input type="text" class="form-control" id="inputPhone" v-model="customer.phone"
                       placeholder="Enter Phone">
            </div>
            <div class="form-group">
                <label for="inputWebsite">Website</label>
                <input type="text" class="form-control" id="inputWebsite" v-model="customer.website"
                       placeholder="Enter Website">
            </div>
            <router-link to="/customers" class="btn">Cancel</router-link>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <div class="alert alert-danger mt-3" role="alert" v-if="errors">
            <ul>
                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                    <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
    import validate from 'validate.js'

    export default {
        name: 'customer-new',
        data() {
            return {
                customer: {
                    name: '',
                    email: '',
                    phone: '',
                    website: ''
                },
                errors: null
            }
        },
        computed: {
            currentUser(){
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            add() {
                this.errors = null;
                const constraints = this.getConstraints();

                const errors = validate(this.$data.customer, constraints);
                if (errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/customers', this.$data.customer, {
                    headers: {
                        "Authorization": `Bearer ${this.currentUser.token}`
                    }
                }).then((response) => {
                    this.$router.push('/customers');
                })
            },
            getConstraints() {
                return {
                    name: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be a least 3 characters ling'
                        }
                    },
                    email: {
                        presence: true,
                        email: true
                    },
                    phone: {
                        presence: true,
                        numericality: true,
                        length: {
                            minimum: 10,
                            message: 'Must be a least 10 characters ling'
                        }
                    },
                    website: {
                        presence: true,
                        url: true
                    },
                }
            }
        }
    }
</script>