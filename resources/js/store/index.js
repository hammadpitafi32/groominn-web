import { useCookies } from "vue3-cookies";
import { createStore } from "vuex";
import { logout } from "../api";

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
                context.state.myShop = null;
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
        }
    }
})

export default store;