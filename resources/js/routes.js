import AllAccounts from './components/AllAccounts.vue';
import AddAccount from './components/AddAccount.vue';
import EditAccount from './components/EditAccount.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllAccounts
    },
    {
        name: 'add',
        path: '/add',
        component: AddAccount
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditAccount
    }
];