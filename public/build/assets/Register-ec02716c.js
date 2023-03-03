import{v as c,c as _,w as d,o as g,a as o,u as s,X as w,b as t,d as u,t as f,z as v,n as V,e as y}from"./app-eea0771b.js";import{_ as m,a as i}from"./InputLabel-f2981d79.js";import{_ as b}from"./PrimaryButton-a2add19b.js";import{_ as n}from"./TextInput-e684ca7e.js";import{_ as k}from"./GuestLayout-49c0ac37.js";import"./ApplicationLogo-828cdc5d.js";import"./defaultFile-c5d6515b.js";import"./Toast-04f17637.js";import"./toast-6aa89247.js";const h=["onSubmit"],$={class:"mt-4"},q={class:"mt-4"},x={class:"mt-4"},U={class:"flex items-center justify-end mt-4"},T={__name:"Register",setup(B){const e=c({name:"",email:"",password:"",password_confirmation:"",terms:!1}),p=()=>{e.post(route("register"),{onFinish:()=>e.reset("password","password_confirmation")})};return(r,a)=>(g(),_(k,null,{default:d(()=>[o(s(w),{title:"Register"}),t("form",{onSubmit:y(p,["prevent"])},[t("div",null,[o(m,{for:"name",value:r.__("register.form.name")},null,8,["value"]),o(n,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(e).name,"onUpdate:modelValue":a[0]||(a[0]=l=>s(e).name=l),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),o(i,{class:"mt-2",message:s(e).errors.name},null,8,["message"])]),t("div",$,[o(m,{for:"email",value:r.__("register.form.email")},null,8,["value"]),o(n,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":a[1]||(a[1]=l=>s(e).email=l),required:"",autocomplete:"username"},null,8,["modelValue"]),o(i,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),t("div",q,[o(m,{for:"password",value:r.__("register.form.password")},null,8,["value"]),o(n,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":a[2]||(a[2]=l=>s(e).password=l),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(i,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),t("div",x,[o(m,{for:"password_confirmation",value:r.__("register.form.confirm_password")},null,8,["value"]),o(n,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:s(e).password_confirmation,"onUpdate:modelValue":a[3]||(a[3]=l=>s(e).password_confirmation=l),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(i,{class:"mt-2",message:s(e).errors.password_confirmation},null,8,["message"])]),t("div",U,[o(s(v),{href:r.route("login"),class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:d(()=>[u(f(r.__("register.login_link")),1)]),_:1},8,["href"]),o(b,{class:V(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:d(()=>[u(f(r.__("register.submit")),1)]),_:1},8,["class","disabled"])])],40,h)]),_:1}))}};export{T as default};