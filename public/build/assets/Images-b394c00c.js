import{_ as a}from"./Image-935c5f6b.js";import{J as d,h as i,b as t,a as n,u as o,o as r}from"./app-126fe506.js";import"./DangerButton-4c3ebc1b.js";import"./SecondaryButton-e7a16315.js";import"./defaultFile-22c0d257.js";import"./toast-08d90f84.js";const c={class:"max-w-7xl mx-auto flex flex-wrap justify-around items-center bg-white dark:bg-gray-800 text-black dark:text-white sm:space-x-2 space-y-2 sm:space-y-0"},p={class:"p-4 space-x-5 shadow flex-1 min-h-full grid place-items-center h-[300px]"},x=t("div",{class:"text-2x block text-center text-2xl"},"Logo",-1),m={class:"p-4 space-x-5 shadow flex-1 min-h-full grid place-items-center h-[300px]"},u=t("div",{class:"text-2x block text-center text-2xl"},"Fav Icon",-1),f={class:"p-4 space-x-5 shadow flex-1 min-h-full grid place-items-center h-[300px]"},_=t("div",{class:"text-2x block text-center text-2xl"},"Banner",-1),B={__name:"Images",setup(b){const e=d().props.global.options;return(h,l)=>(r(),i("div",c,[t("div",p,[x,n(a,{id:"logo",field:"logo",isDeleteable:!0,modelValue:o(e).logo,"onUpdate:modelValue":l[0]||(l[0]=s=>o(e).logo=s),class:"w-48 h-48 rounded-full overflow-clip bg-red-500"},null,8,["modelValue"])]),t("div",m,[u,n(a,{id:"fav_icon",field:"fav_icon",isDeleteable:!0,modelValue:o(e).fav_icon,"onUpdate:modelValue":l[1]||(l[1]=s=>o(e).fav_icon=s),class:"w-48 h-48 rounded-full overflow-clip bg-red-500"},null,8,["modelValue"])]),t("div",f,[_,n(a,{id:"banner",field:"banner",isDeleteable:!0,modelValue:o(e).banner,"onUpdate:modelValue":l[2]||(l[2]=s=>o(e).banner=s),class:"w-48 h-48 rounded-full overflow-clip bg-red-500"},null,8,["modelValue"])])]))}};export{B as default};