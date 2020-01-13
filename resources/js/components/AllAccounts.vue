<template>
    <div>
        <h3 class="text-center">All Accounts</h3><br/>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Account Name</th>
                <th>Bank</th>
                <th>Account No</th>
                <th>Branch</th>
                <th>Account Type</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="account in accounts" :key="account.id">
                <td>{{ account.account_name }}</td>
                <td>{{ account.bank_name }}</td>
                <td>{{ account.account_no }}</td>
                <td>{{ account.branch }}</td>
                <td v-if="account.account_type === 1">Saving Account</td>
                <td v-if="account.account_type === 2">Current Account</td>
                <td v-if="account.account_type === 3">Join Accounts</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edit', params: { id: account.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteAccount(account.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                accounts: []
            }
        },
        created() {
            this.axios
                .get('/api/accounts')
                .then(response => {
                    this.accounts = response.data;
                });
        },
        methods: {
            deleteAccount(id) {
                this.axios
                    .delete(`/api/account/delete/${id}`)
                    .then(response => {
                        let i = this.accounts.map(item => item.id).indexOf(id); // find index of your object
                        this.accounts.splice(i, 1)
                    });
            }
        }
    }
</script>