import{v as p,c as d,w as i,o as l,a as s,u as o,X as k,b as r,t as a,f as y,g as c,d as m,n as x,e as h,r as v}from"./app-4dfa7f3b.js";import{_ as b,a as w}from"./InputLabel-fec82426.js";import{_ as V}from"./PrimaryButton-2b535c8b.js";import{_ as B}from"./TextInput-fb418c8e.js";import{_ as $}from"./GuestLayout-ac5d3072.js";import"./ApplicationLogo-77a8e36b.js";import"./defaultFile-2b6c57d3.js";import"./Toast-645f4c7b.js";import"./toast-ded66f04.js";const C={class:"mb-4 text-sm text-gray-600 dark:text-gray-400"},N={key:0,class:"mb-4 font-medium text-sm text-green-600 dark:text-green-400"},S=["onSubmit"],j={class:"flex items-center justify-end mt-4"},F={class:"flex items-center justify-between mt-5 space-x-2"},U={__name:"ForgotPassword",props:{status:String,canRegister:Boolean},setup(n){const t=p({email:""}),g=()=>{t.post(route("password.email"))};return(e,f)=>{const u=v("Link");return l(),d($,null,{default:i(()=>[s(o(k),{title:"Forgot Password"}),r("div",C,a(e.__("forget.heading")),1),n.status?(l(),y("div",N,a(n.status),1)):c("",!0),r("form",{onSubmit:h(g,["prevent"])},[r("div",null,[s(b,{for:"email",value:e.__("forget.form.email")},null,8,["value"]),s(B,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:o(t).email,"onUpdate:modelValue":f[0]||(f[0]=_=>o(t).email=_),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),s(w,{class:"mt-2",message:o(t).errors.email},null,8,["message"])]),r("div",j,[s(V,{class:x({"opacity-25":o(t).processing}),disabled:o(t).processing},{default:i(()=>[m(a(e.__("forget.link")),1)]),_:1},8,["class","disabled"])]),r("div",F,[s(u,{class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800",href:e.route("login")},{default:i(()=>[m(a(e.__("forget.login_link_text")),1)]),_:1},8,["href"]),n.canRegister?(l(),d(u,{key:0,href:e.route("register"),class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:i(()=>[m(a(e.__("forget.registration_link")),1)]),_:1},8,["href"])):c("",!0)])],40,S)]),_:1})}}};export{U as default};