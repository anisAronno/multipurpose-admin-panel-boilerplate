import{p as c,v as I,f as v,b as t,a,u as e,w as _,T as U,e as S,o as w,d as j,g as P}from"./app-4dfa7f3b.js";import{a as r,_ as n}from"./InputLabel-fec82426.js";import{_ as C}from"./PrimaryButton-2b535c8b.js";import{_ as m}from"./TextInput-fb418c8e.js";import{d as N}from"./defaultFile-2b6c57d3.js";import{s as b}from"./default.css_vue_type_style_index_0_src_true_lang-5d8f90ba.js";const B={class:"dark:text-white"},T=["onSubmit"],$={class:"mt-10 sm:mt-0"},A={class:"overflow-hidden shadow sm:rounded-md"},E={class:"bg-white dark:bg-gray-800 px-4 py-5 sm:p-6"},L={class:"grid grid-cols-6 gap-6"},O={class:"col-span-6 sm:col-span-3"},R={class:"col-span-6 sm:col-span-3"},F={class:"col-span-6 sm:col-span-3 flex items-center justify-between"},z={class:"inline-block h-24 w-24 overflow-hidden rounded-full bg-gray-100"},M=["src"],q={class:"col-span-6 sm:col-span-3 grid grid-cols-6 gap-5 items-center justify-between relative"},D={class:"col-span-3"},G={class:"col-span-3"},H={class:"col-span-6 sm:col-span-3 lg:col-span-3"},J={class:"col-span-6 sm:col-span-3 lg:col-span-3"},K={class:"flex items-center justify-end pr-5 py-5"},Q={key:0,class:"text-sm text-gray-600 dark:text-gray-400"},as={__name:"CreateUserForm",props:{roles:Object,statusArr:Object},setup(d){const y=d,u=c(null),p=c(null),f=c(null),x=c(null),k=c(null),i=c(null),s=I({name:"",email:"",avatar:"",avatarPreview:N.avatar,status:"",password:"",password_confirmation:"",roles:[]}),V=g=>{const o=g.target.files[0];s.avatarPreview=URL.createObjectURL(o)},h=()=>{s.post(route("user.store"),{preserveScroll:!0,onSuccess:()=>s.reset(),onError:()=>{s.errors.name&&u.value.focus(),s.errors.email&&p.value.focus(),s.errors.status&&x.value.focus(),s.errors.password&&(s.reset("password"),s.reset("password_confirmation"),i.value.focus()),s.errors.roles&&k.value.focus(),s.errors.avatar&&f.value.focus()}})};return(g,o)=>(w(),v("section",B,[t("form",{onSubmit:S(h,["prevent"]),class:"mt-6 space-y-6 p-3"},[t("div",$,[t("div",A,[t("div",E,[t("div",L,[t("div",O,[a(n,{for:"name",value:"Name :",class:"block text-sm font-medium text-gray-700"}),a(m,{id:"name",ref_key:"nameInput",ref:u,modelValue:e(s).name,"onUpdate:modelValue":o[0]||(o[0]=l=>e(s).name=l),type:"text",class:"mt-1 block w-full",autocomplete:"name"},null,8,["modelValue"]),a(r,{message:e(s).errors.name,class:"mt-2 col-start-2 col-span-4"},null,8,["message"])]),t("div",R,[a(n,{for:"email",value:"Email :",class:"block text-sm font-medium text-gray-700"}),a(m,{id:"email",ref_key:"emailInput",ref:p,modelValue:e(s).email,"onUpdate:modelValue":o[1]||(o[1]=l=>e(s).email=l),type:"text",class:"mt-1 block w-full",autocomplete:"email"},null,8,["modelValue"]),a(r,{message:e(s).errors.email,class:"mt-2 col-start-2 col-span-4"},null,8,["message"])]),t("div",F,[t("div",null,[a(n,{for:"avatar",value:"Avatar :",class:"block text-sm font-medium text-gray-700"}),t("input",{id:"avatar",type:"file",class:"mt-1 block form-controll cursor-pointer",onChange:V,ref_key:"avatarInput",ref:f,onInput:o[2]||(o[2]=l=>e(s).avatar=l.target.files[0])},null,544),a(r,{message:e(s).errors.avatar,class:"mt-2 col-start-2 col-span-4"},null,8,["message"])]),t("span",z,[t("img",{src:e(s).avatarPreview,class:"w-full h-full object-contain"},null,8,M)])]),t("div",q,[t("div",D,[a(n,{for:"roles",value:"Role :",class:"block text-sm font-medium text-gray-700 mb-1"}),a(e(b),{modelValue:e(s).roles,"onUpdate:modelValue":o[3]||(o[3]=l=>e(s).roles=l),options:y.roles,selected:e(s).roles,placeholder:"Pick some...",class:"block w-full multiselect-green form-controll dark:text-gray-900",mode:"tags",searchable:!0,"close-on-select":!1},null,8,["modelValue","options","selected"]),a(r,{message:e(s).errors.roles,class:"mt-2 col-start-2 col-span-4 absolute z-5"},null,8,["message"])]),t("div",G,[a(n,{for:"status",value:"Status :",class:"block text-sm font-medium text-gray-700 mb-1"}),a(e(b),{modelValue:e(s).status,"onUpdate:modelValue":o[4]||(o[4]=l=>e(s).status=l),options:d.statusArr,selected:e(s).status,placeholder:"Pick some...",class:"block w-full multiselect-green form-controll dark:text-black",searchable:!0,classes:{search:" border-none border-l-0 rounded-sm mr-2  text-gray-900 bg-gray-200  dark:text-gray-50 dark:bg-gray-700",singleLabelText:"bg-[#10B981] text-white  rounded py-0.5 px-3 text-sm  font-semibold"}},null,8,["modelValue","options","selected","classes"]),a(r,{message:e(s).errors.status,class:"mt-2 col-start-2 col-span-4"},null,8,["message"])])]),t("div",H,[a(n,{for:"password",value:"Password :",class:"block text-sm font-medium text-gray-700"}),a(m,{id:"password",ref_key:"passwordInput",ref:i,modelValue:e(s).password,"onUpdate:modelValue":o[5]||(o[5]=l=>e(s).password=l),type:"password",class:"mt-1 block w-full",autocomplete:"password"},null,8,["modelValue"]),a(r,{message:e(s).errors.password,class:"mt-2 col-start-2 col-span-4"},null,8,["message"])]),t("div",J,[a(n,{for:"password_confirmation",value:"Password Confirmation :",class:"block text-sm font-medium text-gray-700"}),a(m,{id:"password_confirmation",ref_key:"passwordInput",ref:i,modelValue:e(s).password_confirmation,"onUpdate:modelValue":o[6]||(o[6]=l=>e(s).password_confirmation=l),type:"password",class:"mt-1 block w-full",autocomplete:"password_confirmation"},null,8,["modelValue"]),a(r,{message:e(s).errors.password_confirmation,class:"mt-2 col-start-2 col-span-4"},null,8,["message"])])])])])]),t("div",K,[a(C,{disabled:e(s).processing},{default:_(()=>[j("Submit")]),_:1},8,["disabled"]),a(U,{"enter-from-class":"opacity-0","leave-to-class":"opacity-0",class:"transition ease-in-out"},{default:_(()=>[e(s).recentlySuccessful?(w(),v("p",Q," Saved. ")):P("",!0)]),_:1})])],40,T)]))}};export{as as default};
