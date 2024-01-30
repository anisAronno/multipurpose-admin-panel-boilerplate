import{p as n,v as h,f as d,b as a,a as t,u as s,g,w as x,T as V,e as w,o as u,d as U}from"./app-4dfa7f3b.js";import{_ as A}from"./Image-ad5bc90a.js";import{a as c,_ as i}from"./InputLabel-fec82426.js";import{_ as I}from"./PrimaryButton-2b535c8b.js";import{_}from"./TextInput-fb418c8e.js";import{s as b}from"./default.css_vue_type_style_index_0_src_true_lang-5d8f90ba.js";import"./DangerButton-9faead77.js";import"./SecondaryButton-c5891444.js";import"./defaultFile-2b6c57d3.js";import"./toast-ded66f04.js";const S={class:"dark:text-white"},j=["onSubmit"],N={class:"mt-10 sm:mt-0"},$={class:"shadow sm:rounded-md"},B={class:"bg-white dark:bg-gray-800 px-4 py-5 sm:p-6"},E={class:"grid grid-cols-6 gap-6"},T={class:"col-span-6 sm:col-span-3"},O={class:"col-span-6 sm:col-span-3"},P={class:"col-span-6 sm:col-span-3"},C={class:"p-4 space-x-5 shadow flex items-center min-h-full h-[150px]"},D=a("div",{class:"text-2x block text-center text-2xl"}," Avatar: ",-1),F={class:"col-span-6 sm:col-span-3 grid grid-cols-6 gap-5 items-center justify-between"},L={key:0,class:"col-span-3"},M={class:"col-span-3"},R={class:"flex items-center justify-end pr-5 py-5"},q={key:0,class:"text-sm text-gray-600 dark:text-gray-400"},se={__name:"EditUserForm",props:{roleArr:Object,user:Object,statusArr:Object},setup(r){const m=r,p=n(null),f=n(null),v=n(null),y=n(null),e=h({name:m.user.name,email:m.user.email,status:m.user.status,roles:m.user.has_roles}),k=()=>{e.post(route("user.update",m.user.id),{preserveScroll:!0,onSuccess:()=>e.reset(),onError:()=>{e.errors.name&&p.value.focus(),e.errors.email&&f.value.focus(),e.errors.status&&v.value.focus(),e.errors.roles&&y.value.focus()}})};return(z,l)=>(u(),d("section",S,[a("form",{onSubmit:w(k,["prevent"]),class:"mt-6 space-y-6 p-3"},[a("div",N,[a("div",$,[a("div",B,[a("div",E,[a("div",T,[t(i,{for:"name",value:"Name :",class:"block text-sm font-medium text-gray-700"}),t(_,{id:"name",ref_key:"nameInput",ref:p,modelValue:s(e).name,"onUpdate:modelValue":l[0]||(l[0]=o=>s(e).name=o),type:"text",class:"mt-1 block w-full",autocomplete:"name"},null,8,["modelValue"]),t(c,{message:s(e).errors.name,class:"mt-2 col-start-2 col-span-4"},null,8,["message"])]),a("div",O,[t(i,{for:"email",value:"Email :",class:"block text-sm font-medium text-gray-700"}),t(_,{id:"email",ref_key:"emailInput",ref:f,modelValue:s(e).email,"onUpdate:modelValue":l[1]||(l[1]=o=>s(e).email=o),type:"text",class:"mt-1 block w-full",autocomplete:"email"},null,8,["modelValue"]),t(c,{message:s(e).errors.email,class:"mt-2 col-start-2 col-span-4"},null,8,["message"])]),a("div",P,[a("div",C,[D,t(A,{id:r.user.id,field:"avatar",isDeleteable:!0,modelValue:r.user.avatar,"onUpdate:modelValue":l[2]||(l[2]=o=>r.user.avatar=o),route:"user.image",class:"w-32 h-32 rounded-full overflow-clip bg-red-500"},null,8,["id","modelValue"])])]),a("div",F,[r.roleArr.length>0?(u(),d("div",L,[t(i,{for:"roles",value:"Role :",class:"block text-sm font-medium text-gray-700 mb-1"}),t(s(b),{modelValue:s(e).roles,"onUpdate:modelValue":l[3]||(l[3]=o=>s(e).roles=o),options:r.roleArr,selected:s(e).roles,placeholder:"Pick some...",class:"block w-full multiselect-green form-controll dark:text-gray-900",mode:"tags",searchable:!0,"close-on-select":!1},null,8,["modelValue","options","selected"]),t(c,{message:s(e).errors.roles,class:"mt-2 col-start-2 col-span-4"},null,8,["message"])])):g("",!0),a("div",M,[t(i,{for:"status",value:"Status :",class:"block text-sm font-medium text-gray-700 mb-1"}),t(s(b),{modelValue:s(e).status,"onUpdate:modelValue":l[4]||(l[4]=o=>s(e).status=o),options:r.statusArr,selected:s(e).status,placeholder:"Pick some...",class:"block w-full multiselect-green form-controll dark:text-black",searchable:!0,classes:{search:" border-none border-l-0 rounded-sm mr-2  text-gray-900 bg-gray-200  dark:text-gray-50 dark:bg-gray-700",singleLabelText:"  bg-[#10B981] rounded py-0.5 px-3 text-sm  text-white font-semibold"}},null,8,["modelValue","options","selected","classes"]),t(c,{message:s(e).errors.status,class:"mt-2 col-start-2 col-span-4"},null,8,["message"])])])])])])]),a("div",R,[t(I,{disabled:s(e).processing},{default:x(()=>[U("Update")]),_:1},8,["disabled"]),t(V,{"enter-from-class":"opacity-0","leave-to-class":"opacity-0",class:"transition ease-in-out"},{default:x(()=>[s(e).recentlySuccessful?(u(),d("p",q," Ppdated. ")):g("",!0)]),_:1})])],40,j)]))}};export{se as default};