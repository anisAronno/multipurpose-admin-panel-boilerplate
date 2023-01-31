import { reactive } from "vue";


const site_url = route()?.t?.url;  
export default reactive({
    logo: `${site_url}/storage/images/defaults/logo.png`,
    placeholder: `${site_url}/storage/images/defaults/placeholder.png`,
    avatar: `${site_url}/storage/images/defaults/avatar.png`,
    banner: `${site_url}/storage/images/defaults/banner.png`,
    fav_icon: `${site_url}/storage/images/defaults/fav_icon.png`,
    site_url: site_url,
});
