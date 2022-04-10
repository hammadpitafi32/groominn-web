import { useCookies } from "vue3-cookies";
import { createStore } from "vuex";

const { cookies } = useCookies();

const store = createStore({
    state: {
        auth: false,
    },
    actions:{
        setAuth(context){
            let token = cookies.get('token');
            if(token){
                context.state.auth = true;
            } else {
                context.state.auth = false;
            }
        }
    }
})

export default store;