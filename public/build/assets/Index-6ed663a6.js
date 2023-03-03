import{_ as g}from"./DeleteForm-971c29c6.js";import{_ as y,a as b}from"./Search-d71d72bc.js";import{_ as w}from"./AuthenticatedLayout-8cc6076c.js";import{h as o,a as e,u as k,w as l,F as m,o as s,X as v,b as t,d as _,m as p,t as f,q as r,c as x,k as u}from"./app-eea0771b.js";import"./DangerButton-7f4ae49d.js";import"./SecondaryButton-0e6bc47b.js";import"./Toast-04f17637.js";import"./toast-6aa89247.js";import"./ApplicationLogo-828cdc5d.js";import"./defaultFile-c5d6515b.js";import"./Dropdown-8e7bab99.js";const N=t("h2",{class:"font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"}," Roles ",-1),R={class:"py-12 dark:text-white"},V={class:"max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"},j={class:"p-4 sm:p-8 bg-white dark:bg-gray-800 dark:text-white shadow sm:rounded-lg"},B={class:"px-4 sm:px-6 lg:px-8"},C={class:"sm:flex sm:items-center"},$=t("div",{class:"sm:flex-auto"},[t("h1",{class:"text-xl font-semibold text-gray-900 dark:text-white"}," Roles "),t("p",{class:"mt-2 text-sm text-gray-700 dark:text-white"}," A list of all the Roles. ")],-1),A={class:"mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-1 sm:space-x-2 space-y-2 sm:space-y-0"},D={class:"mt-8 flex flex-col"},L={class:"-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8"},q={class:"inline-block min-w-full py-2 align-middle md:px-6 lg:px-8"},E={class:"flex items-center justify-between pb-4 bg-white dark:bg-gray-800 pt-3 pr-0.5"},F=t("div",{class:"flex-1"},null,-1),T={class:"flex-auto"},z={key:0,class:"relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg"},I={class:"min-w-full table-auto divide-y divide-gray-300 p-3"},O=t("thead",{class:"bg-gray-50"},[t("tr",null,[t("th",{scope:"col",class:"py-3.5 pr-3 pl-3 text-left text-base font-bold text-gray-900"}," Name "),t("th",{scope:"col",class:"px-3 py-3.5 text-left text-base font-bold text-gray-900"}," Role "),t("th",{scope:"col",class:"px-3 py-3.5 text-left text-base font-bold text-gray-900"}," Date Time "),t("th",{scope:"col",class:"px-3 py-3.5 text-center text-base font-bold text-gray-900"}," Action ")])],-1),S={key:0,class:"divide-y divide-gray-200 bg-white"},X=["id"],G={class:"w-[15%] whitespace-nowrap text-left p-4 font-semibold text-gray-900 capitalize"},H={class:"w-60% whitespace-normal p-3 text-md text-gray-500 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4"},J={class:"w-[15%] text-left p-4 text-gray-900"},K={class:"w-[10%] whitespace-nowrap text-right text-sm font-medium"},M={class:"flex justify-end flex-wrap gap-2 pr-3"},P={key:0},Q={class:"bg-gray-50"},U={colspan:"4",class:"w-[100%]"},W={key:1,class:"h-32 grid place-items-center text-2xl"},Y=t("p",null,"Result not found",-1),Z=[Y],_t={__name:"Index",props:{roles:Object},setup(i){return(c,tt)=>{const d=u("font-awesome-icon"),n=u("Link");return s(),o(m,null,[e(k(v),{title:"Role"}),e(w,null,{header:l(()=>[N]),default:l(()=>[t("div",R,[t("div",V,[t("div",j,[t("div",B,[t("div",C,[$,t("div",A,[e(n,{href:c.route("role.create"),class:"btn btn-primary"},{default:l(()=>[e(d,{icon:"fa-solid fa-circle-plus",class:"mr-1"}),_(" Create New ")]),_:1},8,["href"]),e(n,{href:c.route("role.index"),class:"btn btn-primary"},{default:l(()=>[e(d,{icon:"fa-solid fa-eye",class:"mr-1"}),_(" View All ")]),_:1},8,["href"])])]),t("div",D,[t("div",L,[t("div",q,[t("div",E,[F,t("div",T,[e(y)])]),i.roles.data.length>0?(s(),o("div",z,[t("table",I,[O,i.roles.data.length>0?(s(),o("tbody",S,[(s(!0),o(m,null,p(i.roles.data,a=>(s(),o("tr",{key:a.id,id:a.id},[t("td",G,f(a.name),1),t("td",H,[(s(!0),o(m,null,p(a.permissions,h=>(s(),o("p",{key:h.id,class:"mr-2"},[e(d,{icon:"fa-solid fa-user-shield",class:"text-blue-400"}),_(" "+f(h.name),1)]))),128))]),t("td",J,f(a.created_at),1),t("td",K,[t("div",M,[t("div",null,[e(n,{href:c.route("role.show",a.id),class:"btn btn-info"},{default:l(()=>[e(d,{icon:"fa-solid fa-eye",class:"mr-1"})]),_:2},1032,["href"])]),a.isEditable?(s(),o("div",P,[e(n,{href:c.route("role.edit",a.id),class:"btn btn-primary"},{default:l(()=>[e(d,{icon:"fa-solid fa-pen-to-square",class:"mr-1"})]),_:2},1032,["href"])])):r("",!0),a.isDeletable?(s(),x(g,{key:1,data:{id:a.id,model:"role"}},null,8,["data"])):r("",!0)])])],8,X))),128))])):r("",!0),t("tfoot",Q,[t("tr",null,[t("td",U,[i.roles.last_page>1?(s(),x(b,{key:0,class:"mt-6 dark:text-white flex justify-end p-3",links:i.roles.links},null,8,["links"])):r("",!0)])])])])])):(s(),o("div",W,Z))])])])])])])])]),_:1})],64)}}};export{_t as default};