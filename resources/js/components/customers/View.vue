<template>
    <div>
        <div class="form-group">
            <label>Name</label><br>
            {{ customer.name }}
        </div>
        <div class="form-group">
            <label>Email</label><br>
            {{ customer.email }}
        </div>
        <div class="form-group">
            <label>Phone</label><br>
            {{ customer.phone }}
        </div>
        <div class="form-group">
            <label>Website</label>
            {{ customer.website }}
        </div>
        <router-link to="/customers" class="btn btn-primary">Back to list customers</router-link>
    </div>
</template>
<script>
    export default {
        name: 'view-customer',
        created() {
            axios.get(`/api/customers/${this.$route.params.id}`, {
                headers: {
                    "Authorization": `Bearer ${this.currentUser.token}`
                }
            }).then((response) => {
                this.customer = response.data.customer;
            })
        },
        data() {
            return {
                customer: null
            }
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        }
    }
</script>