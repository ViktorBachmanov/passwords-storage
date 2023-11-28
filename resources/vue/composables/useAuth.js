import { ref, computed } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
// import { useToast } from "vue-toast-notification";
// import "vue-toast-notification/dist/theme-sugar.css";

const user = ref(null);


// const $toast = useToast();

export function useAuth() {

  const router = useRouter()

  router.beforeEach(async (to, from) => {
    if (to.name !== "login") {
        const result = await getUser();
        if (!result) {
            return false;
        }
    }
    // ...
    // explicitly return false to cancel the navigation
    // return false
});

    async function logout() {
        try {
            await axios.post("/api/logout");
            user.value = null;
            router.replace({ name: "login" });
        } catch (error) {
            // console.error(error);
            // $toast.error("Ошибка");
        }
    }

    async function getUser() {
        if (user.value) {
            return user.value;
        }

        try {
            const response = await axios.get("/api/user");
            user.value = response.data;
        } catch (error) {}

        return user.value;
    }

    
    const isAuthenticated = computed(() => {
        return user.value ? true : false;
    });

    const userName = computed(() => user.value?.name)

    
    return {
        logout,
        getUser,
        userName,
        isAuthenticated,
    };
}