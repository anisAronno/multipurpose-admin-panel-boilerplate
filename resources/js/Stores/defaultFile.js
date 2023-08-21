import { reactive } from "vue";


const site_url = route()?.t?.url;  
export default reactive({
    logo: `${site_url}/storage/defaults/logo.png`,
    placeholder: `${site_url}/storage/defaults/placeholder.png`,
    avatar: `${site_url}/storage/defaults/avatar.png`,
    banner: `${site_url}/storage/defaults/banner.png`,
    fav_icon: `${site_url}/storage/defaults/fav_icon.png`,
    site_url: site_url,
});
