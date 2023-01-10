import { reactive } from "vue";


const site_url = route()?.t?.url;  
export default reactive({
    logo: `${site_url}/uploads/defaults/logo.png`,
    placeholder: `${site_url}/uploads/defaults/placeholder.png`,
    avatar: `${site_url}/uploads/defaults/avatar.png`,
    banner: `${site_url}/uploads/defaults/banner.png`,
    fav_icon: `${site_url}/uploads/defaults/fav_icon.png`,
});
