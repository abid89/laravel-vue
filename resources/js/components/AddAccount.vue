<template>
    <div>
        <h3 class="text-center">Bank Account Create</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addAccount">
                    <div class="form-group">
                        <label>Account Name</label>
                        <input type="text" class="form-control" v-model="account.account_name">
                        <span v-if="errors.account_name" class="errors">{{errors.account_name[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label>Select Bank</label>
                        <select class='form-control' v-model='account.financial_organization_id'>
                            <option v-for='data in banks' :value='data.id'>{{ data.name }}</option>
                        </select>
                        <span v-if="errors.financial_organization_id" class="errors">{{errors.financial_organization_id[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label>Account No</label>
                        <input type="text" class="form-control" v-model="account.account_no">
                        <span v-if="errors.account_no" class="errors">{{errors.account_no[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label>Branch</label>
                        <input type="text" class="form-control" v-model="account.branch">
                        <span v-if="errors.branch" class="errors">{{errors.branch[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label>Account Type</label>
                        <select class='form-control' v-model='account.account_type'>
                            <option value="1">Saving Account</option>
                            <option value="2">Current Account</option>
                            <option value="3">Join Account</option>
                        </select>
                        <span v-if="errors.account_type" class="errors">{{errors.account_type[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label>Swift Code</label>
                        <input type="text" class="form-control" v-model="account.swift_code">
                        <span v-if="errors.swift_code" class="errors">{{errors.swift_code[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label>Route No</label>
                        <input type="text" class="form-control" v-model="account.route_no">
                        <span v-if="errors.route_no" class="errors">{{errors.route_no[0]}}</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                account: {},
                banks: [],
                errors:[]
            }
        },
        methods: {
            getbanks: function(){
                axios.get('/api/getbanks')
                    .then(function (response) {
                        this.banks = response.data;
                    }.bind(this));
            },
            addAccount() {

                this.axios
                    .post('/api/account/add', this.account)
                    .then(response => (
                        this.$router.push({name: 'home'})
                        //console.log(response.data)
                    ))
                    .catch(error =>{
                        if(error.response.status==422){
                            this.errors=error.response.data.errors
                        }
                    })
                    .finally(() => this.loading = false)
            }
        },
        created: function(){
            this.getbanks()
        }
    }
</script>