import{v as f,c as _,w as p,o as w,a as o,u as e,X as v,b as l,d as V,t as g,n as b,e as k}from"./app-4dfa7f3b.js";import{_ as i,a as m}from"./InputLabel-fec82426.js";import{_ as y}from"./PrimaryButton-2b535c8b.js";import{_ as n}from"./TextInput-fb418c8e.js";import{_ as S}from"./GuestLayout-ac5d3072.js";import"./ApplicationLogo-77a8e36b.js";import"./defaultFile-2b6c57d3.js";import"./Toast-645f4c7b.js";import"./toast-ded66f04.js";const $=["onSubmit"],q={class:"mt-4"},B={class:"mt-4"},N={class:"flex items-center justify-end mt-4"},F={__name:"ResetPassword",props:{email:String,token:String},setup(u){const d=u,s=f({token:d.token,email:d.email,password:"",password_confirmation:""}),c=()=>{s.post(route("password.store"),{onFinish:()=>s.reset("password","password_confirmation")})};return(t,a)=>(w(),_(S,null,{default:p(()=>[o(e(v),{title:"Reset Password"}),l("form",{onSubmit:k(c,["prevent"])},[l("div",null,[o(i,{for:"email",value:t.__("reset.form.email")},null,8,["value"]),o(n,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:e(s).email,"onUpdate:modelValue":a[0]||(a[0]=r=>e(s).email=r),required:"",autofocus:"",autocomplete:"email"},null,8,["modelValue"]),o(m,{class:"mt-2",message:e(s).errors.email},null,8,["message"])]),l("div",q,[o(i,{for:"password",value:t.__("reset.form.password")},null,8,["value"]),o(n,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:e(s).password,"onUpdate:modelValue":a[1]||(a[1]=r=>e(s).password=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(m,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),l("div",B,[o(i,{for:"password_confirmation",value:t.__("reset.form.confirm_password")},null,8,["value"]),o(n,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:e(s).password_confirmation,"onUpdate:modelValue":a[2]||(a[2]=r=>e(s).password_confirmation=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(m,{class:"mt-2",message:e(s).errors.password_confirmation},null,8,["message"])]),l("div",N,[o(y,{class:b({"opacity-25":e(s).processing}),disabled:e(s).processing},{default:p(()=>[V(g(t.__("reset.submit")),1)]),_:1},8,["class","disabled"])])],40,$)]),_:1}))}};export{F as default};
