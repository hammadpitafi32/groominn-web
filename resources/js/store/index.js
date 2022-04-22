import { useCookies } from "vue3-cookies";
import { createStore } from "vuex";
import { logout } from "../api";
import router from '../router/router';

const { cookies } = useCookies();

const store = createStore({
    state: {
        auth: false,
        name: '',
        role: '',
        shop: '',
    },
    actions: {
        setAuth(context) {
            let token = cookies.get('token');
            let user = cookies.get('user');

            if (token && user) {
                context.state.auth = true;
                context.state.name = user.name;
                context.state.role = user.role;
                context.state.shop = user.is_shop;
            } else {
                context.state.auth = false;
                context.state.name = '';
                context.state.role = '';
                context.state.shop = '';
            }
        },
        setLogin(context, data) {
            cookies.set('token', data.token, "1d");
            cookies.set('user', data.data, "1d");
            context.dispatch('setAuth');
        },
        setLogout(context) {
            logout().then(() => {
                cookies.remove('token');
                cookies.remove('user');
                context.dispatch('setAuth');
            });
        },
        redirection(context) {
            if (context.state.role === 'Provider' && context.state.shop) {
                router.push('/my-shop')
            } else if (context.state.role === 'Provider' && !context.state.shop) {
                router.push('/add-shop')
            } else if (context.state.role === 'Client') {
                router.push('/')
            }
        },
        clientRedirection(context) {
            if (!context.state.auth) {
                router.push('/login')
            } else if (context.state.role === 'Provider') {
                router.push('/my-shop')
            }
        }
    }
})

export default store;