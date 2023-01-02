import { useCookies } from "vue3-cookies";
import { createStore } from "vuex";
import { logout } from "../api";
import { getAllCategories } from "../api";
import router from "../router/router";

const { cookies } = useCookies();

const store = createStore({
    state: {
        auth: false,
        name: "",
        role: "",
        shop: "",
        avatar:"",
        allCategories: null,
        isTimeAdded:false,
    },
    actions: {
        setAuth(context) {
            let token = cookies.get("token");
            let user = cookies.get("user");
          
            if (token && user) {
                context.state.auth = true;
                context.state.name = user.name;
                context.state.role = user.role;
                context.state.shop = user.is_shop;
                context.state.avatar = user.avatar;
                context.state.isTimeAdded = user.isTimeAdded;
            } else {
                context.state.auth = false;
                context.state.name = "";
                context.state.role = "";
                context.state.shop = "";
                context.state.avatar = "";
                context.state.isTimeAdded =false;
            }
        },
        setLogin(context, data) {
            cookies.set("token", data.token, "1d");
            cookies.set("user", data.data, "1d");
            context.dispatch("setAuth");
        },
        setLogout(context) {
            logout().then(() => {
                cookies.remove("token");
                cookies.remove("user");
                context.dispatch("setAuth");
                router.push("/login");
            });
        },
        redirection(context) {
            if (context.state.role === "Provider" && context.state.shop) {
                router.push("/my-shop");
            } else if (
                context.state.role === "Provider" &&
                !context.state.shop
            ) {
                router.push("/add-shop");
            } else if (context.state.role === "Client") {
                router.push("/");
            }
        },
        clientRedirection(context) {
            if (context.state.role === "Provider") {
                router.push("/my-shop");
            }
        },
        providerRedirection(context) {
            if (context.state.role === "Provider") {
                if (context.state.shop) {
                    router.push("/my-shop");
                } else {
                    router.push("/add-shop");
                }
            } else if (context.state.role === "Client") {
                router.push("/my-shop");
            }
        },
        getCategories(context) {
            getAllCategories().then((res) => {
                context.state.allCategories = res.data.data;
            });
        },
    },
});

export default store;
