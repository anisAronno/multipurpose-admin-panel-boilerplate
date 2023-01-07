import { reactive } from "vue";


const image = route()?.t?.url;  
export default reactive({
    logo: `${image}/uploads/settings/logo.png`,
    placeholder: `${image}/uploads/placeholder.png`,
    avatar: `${image}/uploads/users/avatar.png`
});
