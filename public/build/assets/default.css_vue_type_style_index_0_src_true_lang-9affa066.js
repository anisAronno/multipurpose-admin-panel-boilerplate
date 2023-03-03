import{o as H,h as F,b as j,q as P,U as je,e as Ve,n as I,F as fe,m as he,r as J,S as Je,d as fa,t as oe,V as Z,B as ge,i as W,s as p,G as x,C as Le,j as Qe}from"./app-eea0771b.js";function ae(e){return[null,void 0].indexOf(e)!==-1}function pa(e,r,l){const{object:o,valueProp:n,mode:m}=Z(e),t=ge().proxy,v=l.iv,T=(y,C=!0)=>{v.value=c(y);const O=h(y);r.emit("change",O,t),C&&(r.emit("input",O),r.emit("update:modelValue",O))},h=y=>o.value||ae(y)?y:Array.isArray(y)?y.map(C=>C[n.value]):y[n.value],c=y=>ae(y)?m.value==="single"?{}:[]:y;return{update:T}}function ha(e,r){const{value:l,modelValue:o,mode:n,valueProp:m}=Z(e),t=W(n.value!=="single"?[]:{}),v=o&&o.value!==void 0?o:l,T=p(()=>n.value==="single"?t.value[m.value]:t.value.map(c=>c[m.value])),h=p(()=>n.value!=="single"?t.value.map(c=>c[m.value]).join(","):t.value[m.value]);return{iv:t,internalValue:t,ev:v,externalValue:v,textValue:h,plainValue:T}}function ga(e,r,l){const{regex:o}=Z(e),n=ge().proxy,m=l.isOpen,t=l.open,v=W(null),T=W(null),h=()=>{v.value=""},c=O=>{v.value=O.target.value},y=O=>{if(o&&o.value){let k=o.value;typeof k=="string"&&(k=new RegExp(k)),O.key.match(k)||O.preventDefault()}},C=O=>{if(o&&o.value){let A=(O.clipboardData||window.clipboardData).getData("Text"),d=o.value;typeof d=="string"&&(d=new RegExp(d)),A.split("").every(R=>!!R.match(d))||O.preventDefault()}r.emit("paste",O,n)};return x(v,O=>{!m.value&&O&&t(),r.emit("search-change",O,n)}),{search:v,input:T,clearSearch:h,handleSearchInput:c,handleKeypress:y,handlePaste:C}}function ba(e,r,l){const{groupSelect:o,mode:n,groups:m,disabledProp:t}=Z(e),v=W(null),T=c=>{c===void 0||c!==null&&c[t.value]||m.value&&c&&c.group&&(n.value==="single"||!o.value)||(v.value=c)};return{pointer:v,setPointer:T,clearPointer:()=>{T(null)}}}function Se(e,r=!0){return r?String(e).toLowerCase().trim():String(e).toLowerCase().normalize("NFD").trim().replace(new RegExp(/æ/g),"ae").replace(new RegExp(/œ/g),"oe").replace(new RegExp(/ø/g),"o").replace(/\p{Diacritic}/gu,"")}function ma(e){return Object.prototype.toString.call(e)==="[object Object]"}function ya(e,r){const l=r.slice().sort();return e.length===r.length&&e.slice().sort().every(function(o,n){return o===l[n]})}function Oa(e,r,l){const{options:o,mode:n,trackBy:m,limit:t,hideSelected:v,createTag:T,createOption:h,label:c,appendNewTag:y,appendNewOption:C,multipleLabel:O,object:k,loading:A,delay:d,resolveOnLoad:R,minChars:i,filterResults:q,clearOnSearch:G,clearOnSelect:B,valueProp:g,canDeselect:Q,max:M,strict:N,closeOnSelect:X,groups:_,reverse:f,infinite:E,groupOptions:z,groupHideEmpty:le,groupSelect:be,onCreate:ce,disabledProp:L,searchStart:U}=Z(e),D=ge().proxy,S=l.iv,$=l.ev,V=l.search,ie=l.clearSearch,u=l.update,w=l.pointer,Y=l.clearPointer,ke=l.focus,Ye=l.deactivate,we=l.close,Pe=W([]),te=W([]),ee=W(!1),Te=W(null),qe=W(E.value&&t.value===-1?10:t.value),Ge=p(()=>T.value||h.value||!1),Ze=p(()=>y.value!==void 0?y.value:C.value!==void 0?C.value:!0),se=p(()=>{if(_.value){let a=te.value||[],s=[];return a.forEach(b=>{Re(b[z.value]).forEach(K=>{s.push(Object.assign({},K,b[L.value]?{[L.value]:!0}:{}))})}),s}else{let a=Re(te.value||[]);return Pe.value.length&&(a=a.concat(Pe.value)),a}}),Ne=p(()=>_.value?da((te.value||[]).map((a,s)=>{const b=Re(a[z.value]);return{...a,index:s,group:!0,[z.value]:Ae(b,!1).map(K=>Object.assign({},K,a[L.value]?{[L.value]:!0}:{})),__VISIBLE__:Ae(b).map(K=>Object.assign({},K,a[L.value]?{[L.value]:!0}:{}))}})):[]),Ke=p(()=>{let a=se.value;return f.value&&(a=a.reverse()),Ee.value.length&&(a=Ee.value.concat(a)),Ae(a)}),pe=p(()=>{let a=Ke.value;return qe.value>0&&(a=a.slice(0,qe.value)),a}),Ie=p(()=>{switch(n.value){case"single":return!ae(S.value[g.value]);case"multiple":case"tags":return!ae(S.value)&&S.value.length>0}}),$e=p(()=>O!==void 0&&O.value!==void 0?O.value(S.value,D):S.value&&S.value.length>1?`${S.value.length} options selected`:"1 option selected"),xe=p(()=>!se.value.length&&!ee.value&&!Ee.value.length),_e=p(()=>se.value.length>0&&pe.value.length==0&&(V.value&&_.value||!_.value)),Ee=p(()=>Ge.value===!1||!V.value?[]:ia(V.value)!==-1?[]:[{[g.value]:V.value,[c.value]:V.value,[ne.value]:V.value,__CREATE__:!0}]),ne=p(()=>m.value||c.value),ea=p(()=>{switch(n.value){case"single":return null;case"multiple":case"tags":return[]}}),aa=p(()=>A.value||ee.value),de=a=>{switch(typeof a!="object"&&(a=ue(a)),n.value){case"single":u(a);break;case"multiple":case"tags":u(S.value.concat(a));break}r.emit("select",He(a),a,D)},ve=a=>{switch(typeof a!="object"&&(a=ue(a)),n.value){case"single":We();break;case"tags":case"multiple":u(Array.isArray(a)?S.value.filter(s=>a.map(b=>b[g.value]).indexOf(s[g.value])===-1):S.value.filter(s=>s[g.value]!=a[g.value]));break}r.emit("deselect",He(a),a,D)},He=a=>k.value?a:a[g.value],Fe=a=>{ve(a)},la=(a,s)=>{if(s.button!==0){s.preventDefault();return}Fe(a)},We=()=>{r.emit("clear",D),u(ea.value)},re=a=>{if(a.group!==void 0)return n.value==="single"?!1:ra(a[z.value])&&a[z.value].length;switch(n.value){case"single":return!ae(S.value)&&S.value[g.value]==a[g.value];case"tags":case"multiple":return!ae(S.value)&&S.value.map(s=>s[g.value]).indexOf(a[g.value])!==-1}},Ce=a=>a[L.value]===!0,Be=()=>M===void 0||M.value===-1||!Ie.value&&M.value>0?!1:S.value.length>=M.value,ta=a=>{if(!Ce(a)){if(ce&&ce.value&&!re(a)&&a.__CREATE__&&(a={...a},delete a.__CREATE__,a=ce.value(a,D),a instanceof Promise)){ee.value=!0,a.then(s=>{ee.value=!1,Ue(s)});return}Ue(a)}},Ue=a=>{switch(a.__CREATE__&&(a={...a},delete a.__CREATE__),n.value){case"single":if(a&&re(a)){Q.value&&ve(a);return}a&&De(a),B.value&&ie(),X.value&&(Y(),we()),a&&de(a);break;case"multiple":if(a&&re(a)){ve(a);return}if(Be()){r.emit("max",D);return}a&&(De(a),de(a)),B.value&&ie(),v.value&&Y(),X.value&&we();break;case"tags":if(a&&re(a)){ve(a);return}if(Be()){r.emit("max",D);return}a&&De(a),B.value&&ie(),a&&de(a),v.value&&Y(),X.value&&we();break}X.value||ke()},na=a=>{if(!(Ce(a)||n.value==="single"||!be.value)){switch(n.value){case"multiple":case"tags":sa(a[z.value])?ve(a[z.value]):de(a[z.value].filter(s=>S.value.map(b=>b[g.value]).indexOf(s[g.value])===-1).filter(s=>!s[L.value]).filter((s,b)=>S.value.length+1+b<=M.value||M.value===-1));break}X.value&&Ye()}},De=a=>{ue(a[g.value])===void 0&&Ge.value&&(r.emit("tag",a[g.value],D),r.emit("option",a[g.value],D),Ze.value&&ca(a),ie())},ua=()=>{n.value!=="single"&&de(pe.value)},sa=a=>a.find(s=>!re(s)&&!s[L.value])===void 0,ra=a=>a.find(s=>!re(s))===void 0,ue=a=>se.value[se.value.map(s=>String(s[g.value])).indexOf(String(a))],ia=(a,s=!0)=>se.value.map(b=>parseInt(b[ne.value])==b[ne.value]?parseInt(b[ne.value]):b[ne.value]).indexOf(parseInt(a)==a?parseInt(a):a),oa=a=>["tags","multiple"].indexOf(n.value)!==-1&&v.value&&re(a),ca=a=>{Pe.value.push(a)},da=a=>le.value?a.filter(s=>V.value?s.__VISIBLE__.length:s[z.value].length):a.filter(s=>V.value?s.__VISIBLE__.length:!0),Ae=(a,s=!0)=>{let b=a;return V.value&&q.value&&(b=b.filter(K=>U.value?Se(K[ne.value],N.value).startsWith(Se(V.value,N.value)):Se(K[ne.value],N.value).indexOf(Se(V.value,N.value))!==-1)),v.value&&s&&(b=b.filter(K=>!oa(K))),b},Re=a=>{let s=a;return ma(s)&&(s=Object.keys(s).map(b=>{let K=s[b];return{[g.value]:b,[ne.value]:K,[c.value]:K}})),s=s.map(b=>typeof b=="object"?b:{[g.value]:b,[ne.value]:b,[c.value]:b}),s},me=()=>{ae($.value)||(S.value=Oe($.value))},ye=a=>(ee.value=!0,new Promise((s,b)=>{o.value(V.value,D).then(K=>{te.value=K||[],typeof a=="function"&&a(K),ee.value=!1}).catch(K=>{console.error(K),te.value=[],ee.value=!1}).finally(()=>{s()})})),Me=()=>{if(Ie.value)if(n.value==="single"){let a=ue(S.value[g.value]);if(a!==void 0){let s=a[c.value];S.value[c.value]=s,k.value&&($.value[c.value]=s)}}else S.value.forEach((a,s)=>{let b=ue(S.value[s][g.value]);if(b!==void 0){let K=b[c.value];S.value[s][c.value]=K,k.value&&($.value[s][c.value]=K)}})},va=a=>{ye(a)},Oe=a=>ae(a)?n.value==="single"?{}:[]:k.value?a:n.value==="single"?ue(a)||{}:a.filter(s=>!!ue(s)).map(s=>ue(s)),ze=()=>{Te.value=x(V,a=>{a.length<i.value||!a&&i.value!==0||(ee.value=!0,G.value&&(te.value=[]),setTimeout(()=>{a==V.value&&o.value(V.value,D).then(s=>{(a==V.value||!V.value)&&(te.value=s,w.value=pe.value.filter(b=>b[L.value]!==!0)[0]||null,ee.value=!1)}).catch(s=>{console.error(s)})},d.value))},{flush:"sync"})};if(n.value!=="single"&&!ae($.value)&&!Array.isArray($.value))throw new Error(`v-model must be an array when using "${n.value}" mode`);return o&&typeof o.value=="function"?R.value?ye(me):k.value==!0&&me():(te.value=o.value,me()),d.value>-1&&ze(),x(d,(a,s)=>{Te.value&&Te.value(),a>=0&&ze()}),x($,a=>{if(ae(a)){u(Oe(a),!1);return}switch(n.value){case"single":(k.value?a[g.value]!=S.value[g.value]:a!=S.value[g.value])&&u(Oe(a),!1);break;case"multiple":case"tags":ya(k.value?a.map(s=>s[g.value]):a,S.value.map(s=>s[g.value]))||u(Oe(a),!1);break}},{deep:!0}),x(o,(a,s)=>{typeof e.options=="function"?R.value&&(!s||a&&a.toString()!==s.toString())&&ye():(te.value=e.options,Object.keys(S.value).length||me(),Me())}),x(c,Me),{pfo:Ke,fo:pe,filteredOptions:pe,hasSelected:Ie,multipleLabelText:$e,eo:se,extendedOptions:se,fg:Ne,filteredGroups:Ne,noOptions:xe,noResults:_e,resolving:ee,busy:aa,offset:qe,select:de,deselect:ve,remove:Fe,selectAll:ua,clear:We,isSelected:re,isDisabled:Ce,isMax:Be,getOption:ue,handleOptionClick:ta,handleGroupClick:na,handleTagRemove:la,refreshOptions:va,resolveOptions:ye,refreshLabels:Me}}function Sa(e,r,l){const{valueProp:o,showOptions:n,searchable:m,groupLabel:t,groups:v,mode:T,groupSelect:h,disabledProp:c}=Z(e),y=l.fo,C=l.fg,O=l.handleOptionClick,k=l.handleGroupClick,A=l.search,d=l.pointer,R=l.setPointer,i=l.clearPointer,q=l.multiselect,G=l.isOpen,B=p(()=>y.value.filter(u=>!u[c.value])),g=p(()=>C.value.filter(u=>!u[c.value])),Q=p(()=>T.value!=="single"&&h.value),M=p(()=>d.value&&d.value.group),N=p(()=>V(d.value)),X=p(()=>{const u=M.value?d.value:V(d.value),w=g.value.map(ke=>ke[t.value]).indexOf(u[t.value]);let Y=g.value[w-1];return Y===void 0&&(Y=f.value),Y}),_=p(()=>{let u=g.value.map(w=>w.label).indexOf(M.value?d.value[t.value]:V(d.value)[t.value])+1;return g.value.length<=u&&(u=0),g.value[u]}),f=p(()=>[...g.value].slice(-1)[0]),E=p(()=>d.value.__VISIBLE__.filter(u=>!u[c.value])[0]),z=p(()=>{const u=N.value.__VISIBLE__.filter(w=>!w[c.value]);return u[u.map(w=>w[o.value]).indexOf(d.value[o.value])-1]}),le=p(()=>{const u=V(d.value).__VISIBLE__.filter(w=>!w[c.value]);return u[u.map(w=>w[o.value]).indexOf(d.value[o.value])+1]}),be=p(()=>[...X.value.__VISIBLE__.filter(u=>!u[c.value])].slice(-1)[0]),ce=p(()=>[...f.value.__VISIBLE__.filter(u=>!u[c.value])].slice(-1)[0]),L=u=>d.value&&(!u.group&&d.value[o.value]==u[o.value]||u.group!==void 0&&d.value[t.value]==u[t.value])?!0:void 0,U=()=>{R(B.value[0]||null)},D=()=>{!d.value||d.value[c.value]===!0||(M.value?k(d.value):O(d.value))},S=()=>{if(d.value===null)R((v.value&&Q.value?g.value[0]:B.value[0])||null);else if(v.value&&Q.value){let u=M.value?E.value:le.value;u===void 0&&(u=_.value),R(u||null)}else{let u=B.value.map(w=>w[o.value]).indexOf(d.value[o.value])+1;B.value.length<=u&&(u=0),R(B.value[u]||null)}Le(()=>{ie()})},$=()=>{if(d.value===null){let u=B.value[B.value.length-1];v.value&&Q.value&&(u=ce.value,u===void 0&&(u=f.value)),R(u||null)}else if(v.value&&Q.value){let u=M.value?be.value:z.value;u===void 0&&(u=M.value?X.value:N.value),R(u||null)}else{let u=B.value.map(w=>w[o.value]).indexOf(d.value[o.value])-1;u<0&&(u=B.value.length-1),R(B.value[u]||null)}Le(()=>{ie()})},V=u=>g.value.find(w=>w.__VISIBLE__.map(Y=>Y[o.value]).indexOf(u[o.value])!==-1),ie=()=>{let u=q.value.querySelector("[data-pointed]");if(!u)return;let w=u.parentElement.parentElement;v.value&&(w=M.value?u.parentElement.parentElement.parentElement:u.parentElement.parentElement.parentElement.parentElement),u.offsetTop+u.offsetHeight>w.clientHeight+w.scrollTop&&(w.scrollTop=u.offsetTop+u.offsetHeight-w.clientHeight),u.offsetTop<w.scrollTop&&(w.scrollTop=u.offsetTop)};return x(A,u=>{m.value&&(u.length&&n.value?U():i())}),x(G,u=>{if(u){let w=q.value.querySelectorAll("[data-selected]")[0];if(!w)return;let Y=w.parentElement.parentElement;Le(()=>{Y.scrollTop>0||(Y.scrollTop=w.offsetTop)})}}),{pointer:d,canPointGroups:Q,isPointed:L,setPointerFirst:U,selectPointer:D,forwardPointer:S,backwardPointer:$}}function La(e,r,l){const{disabled:o}=Z(e),n=ge().proxy,m=W(!1);return{isOpen:m,open:()=>{m.value||o.value||(m.value=!0,r.emit("open",n))},close:()=>{m.value&&(m.value=!1,r.emit("close",n))}}}function ka(e,r,l){const{searchable:o,disabled:n,clearOnBlur:m}=Z(e),t=l.input,v=l.open,T=l.close,h=l.clearSearch,c=l.isOpen,y=W(null),C=W(null),O=W(null),k=W(!1),A=W(!1),d=p(()=>o.value||n.value?-1:0),R=()=>{o.value&&t.value.blur(),C.value.blur()},i=()=>{o.value&&!n.value&&t.value.focus()},q=(N=!0)=>{n.value||(k.value=!0,N&&v())},G=()=>{k.value=!1,setTimeout(()=>{k.value||(T(),m.value&&h())},1)};return{multiselect:y,wrapper:C,tags:O,tabindex:d,isActive:k,mouseClicked:A,blur:R,focus:i,activate:q,deactivate:G,handleFocusIn:N=>{N.target.closest("[data-tags]")&&N.target.nodeName!=="INPUT"||N.target.closest("[data-clear]")||q(A.value)},handleFocusOut:()=>{G()},handleCaretClick:()=>{G(),R()},handleMousedown:N=>{A.value=!0,c.value&&(N.target.isEqualNode(C.value)||N.target.isEqualNode(O.value))?setTimeout(()=>{G()},0):document.activeElement.isEqualNode(C.value)&&!c.value&&q(),setTimeout(()=>{A.value=!1},0)}}}function wa(e,r,l){const{mode:o,addTagOn:n,openDirection:m,searchable:t,showOptions:v,valueProp:T,groups:h,addOptionOn:c,createTag:y,createOption:C,reverse:O}=Z(e),k=ge().proxy,A=l.iv,d=l.update,R=l.search,i=l.setPointer,q=l.selectPointer,G=l.backwardPointer,B=l.forwardPointer,g=l.multiselect,Q=l.wrapper,M=l.tags,N=l.isOpen,X=l.open,_=l.blur,f=l.fo,E=p(()=>y.value||C.value||!1),z=p(()=>n.value!==void 0?n.value:c.value!==void 0?c.value:["enter"]),le=()=>{o.value==="tags"&&!v.value&&E.value&&t.value&&!h.value&&i(f.value[f.value.map(L=>L[T.value]).indexOf(R.value)])};return{handleKeydown:L=>{r.emit("keydown",L,k);let U,D;switch(["ArrowLeft","ArrowRight","Enter"].indexOf(L.key)!==-1&&o.value==="tags"&&(U=[...g.value.querySelectorAll("[data-tags] > *")].filter(S=>S!==M.value),D=U.findIndex(S=>S===document.activeElement)),L.key){case"Backspace":if(o.value==="single"||t.value&&[null,""].indexOf(R.value)===-1||A.value.length===0)return;d([...A.value].slice(0,-1));break;case"Enter":if(L.preventDefault(),L.keyCode===229)return;if(D!==-1&&D!==void 0){d([...A.value].filter((S,$)=>$!==D)),D===U.length-1&&(U.length-1?U[U.length-2].focus():t.value?M.value.querySelector("input").focus():Q.value.focus());return}if(z.value.indexOf("enter")===-1&&E.value)return;le(),q();break;case" ":if(!E.value&&!t.value){L.preventDefault(),le(),q();return}if(!E.value)return!1;if(z.value.indexOf("space")===-1&&E.value)return;L.preventDefault(),le(),q();break;case"Tab":case";":case",":if(z.value.indexOf(L.key.toLowerCase())===-1||!E.value)return;le(),q(),L.preventDefault();break;case"Escape":_();break;case"ArrowUp":if(L.preventDefault(),!v.value)return;N.value||X(),G();break;case"ArrowDown":if(L.preventDefault(),!v.value)return;N.value||X(),B();break;case"ArrowLeft":if(t.value&&M.value&&M.value.querySelector("input").selectionStart||L.shiftKey||o.value!=="tags"||!A.value||!A.value.length)return;L.preventDefault(),D===-1?U[U.length-1].focus():D>0&&U[D-1].focus();break;case"ArrowRight":if(D===-1||L.shiftKey||o.value!=="tags"||!A.value||!A.value.length)return;L.preventDefault(),U.length>D+1?U[D+1].focus():t.value?M.value.querySelector("input").focus():t.value||Q.value.focus();break}},handleKeyup:L=>{r.emit("keyup",L,k)},preparePointer:le}}function Pa(e,r,l){const{classes:o,disabled:n,openDirection:m,showOptions:t}=Z(e),v=l.isOpen,T=l.isPointed,h=l.isSelected,c=l.isDisabled,y=l.isActive,C=l.canPointGroups,O=l.resolving,k=l.fo,A=p(()=>({container:"multiselect",containerDisabled:"is-disabled",containerOpen:"is-open",containerOpenTop:"is-open-top",containerActive:"is-active",wrapper:"multiselect-wrapper",singleLabel:"multiselect-single-label",singleLabelText:"multiselect-single-label-text",multipleLabel:"multiselect-multiple-label",search:"multiselect-search",tags:"multiselect-tags",tag:"multiselect-tag",tagDisabled:"is-disabled",tagRemove:"multiselect-tag-remove",tagRemoveIcon:"multiselect-tag-remove-icon",tagsSearchWrapper:"multiselect-tags-search-wrapper",tagsSearch:"multiselect-tags-search",tagsSearchCopy:"multiselect-tags-search-copy",placeholder:"multiselect-placeholder",caret:"multiselect-caret",caretOpen:"is-open",clear:"multiselect-clear",clearIcon:"multiselect-clear-icon",spinner:"multiselect-spinner",inifinite:"multiselect-inifite",inifiniteSpinner:"multiselect-inifite-spinner",dropdown:"multiselect-dropdown",dropdownTop:"is-top",dropdownHidden:"is-hidden",options:"multiselect-options",optionsTop:"is-top",group:"multiselect-group",groupLabel:"multiselect-group-label",groupLabelPointable:"is-pointable",groupLabelPointed:"is-pointed",groupLabelSelected:"is-selected",groupLabelDisabled:"is-disabled",groupLabelSelectedPointed:"is-selected is-pointed",groupLabelSelectedDisabled:"is-selected is-disabled",groupOptions:"multiselect-group-options",option:"multiselect-option",optionPointed:"is-pointed",optionSelected:"is-selected",optionDisabled:"is-disabled",optionSelectedPointed:"is-selected is-pointed",optionSelectedDisabled:"is-selected is-disabled",noOptions:"multiselect-no-options",noResults:"multiselect-no-results",fakeInput:"multiselect-fake-input",assist:"multiselect-assistive-text",spacer:"multiselect-spacer",...o.value})),d=p(()=>!!(v.value&&t.value&&(!O.value||O.value&&k.value.length)));return{classList:p(()=>{const i=A.value;return{container:[i.container].concat(n.value?i.containerDisabled:[]).concat(d.value&&m.value==="top"?i.containerOpenTop:[]).concat(d.value&&m.value!=="top"?i.containerOpen:[]).concat(y.value?i.containerActive:[]),wrapper:i.wrapper,spacer:i.spacer,singleLabel:i.singleLabel,singleLabelText:i.singleLabelText,multipleLabel:i.multipleLabel,search:i.search,tags:i.tags,tag:[i.tag].concat(n.value?i.tagDisabled:[]),tagRemove:i.tagRemove,tagRemoveIcon:i.tagRemoveIcon,tagsSearchWrapper:i.tagsSearchWrapper,tagsSearch:i.tagsSearch,tagsSearchCopy:i.tagsSearchCopy,placeholder:i.placeholder,caret:[i.caret].concat(v.value?i.caretOpen:[]),clear:i.clear,clearIcon:i.clearIcon,spinner:i.spinner,inifinite:i.inifinite,inifiniteSpinner:i.inifiniteSpinner,dropdown:[i.dropdown].concat(m.value==="top"?i.dropdownTop:[]).concat(!v.value||!t.value||!d.value?i.dropdownHidden:[]),options:[i.options].concat(m.value==="top"?i.optionsTop:[]),group:i.group,groupLabel:q=>{let G=[i.groupLabel];return T(q)?G.push(h(q)?i.groupLabelSelectedPointed:i.groupLabelPointed):h(q)&&C.value?G.push(c(q)?i.groupLabelSelectedDisabled:i.groupLabelSelected):c(q)&&G.push(i.groupLabelDisabled),C.value&&G.push(i.groupLabelPointable),G},groupOptions:i.groupOptions,option:(q,G)=>{let B=[i.option];return T(q)?B.push(h(q)?i.optionSelectedPointed:i.optionPointed):h(q)?B.push(c(q)?i.optionSelectedDisabled:i.optionSelected):(c(q)||G&&c(G))&&B.push(i.optionDisabled),B},noOptions:i.noOptions,noResults:i.noResults,assist:i.assist,fakeInput:i.fakeInput}}),showDropdown:d}}function Ta(e,r,l){const{limit:o,infinite:n}=Z(e),m=l.isOpen,t=l.offset,v=l.search,T=l.pfo,h=l.eo,c=W(null),y=W(null),C=p(()=>t.value<T.value.length),O=A=>{const{isIntersecting:d,target:R}=A[0];if(d){const i=R.offsetParent,q=i.scrollTop;t.value+=o.value==-1?10:o.value,Le(()=>{i.scrollTop=q})}},k=()=>{m.value&&t.value<T.value.length?c.value.observe(y.value):!m.value&&c.value&&c.value.disconnect()};return x(m,()=>{n.value&&k()}),x(v,()=>{n.value&&(t.value=o.value,k())},{flush:"post"}),x(h,()=>{n.value&&k()},{immediate:!1,flush:"post"}),Qe(()=>{window&&window.IntersectionObserver&&(c.value=new IntersectionObserver(O))}),{hasMore:C,infiniteLoader:y}}function qa(e,r,l){const{placeholder:o,id:n,valueProp:m,label:t,mode:v,groupLabel:T,aria:h,searchable:c}=Z(e),y=l.pointer,C=l.iv,O=l.hasSelected,k=l.multipleLabelText,A=W(null),d=p(()=>{let f=[];return n&&n.value&&f.push(n.value),f.push("assist"),f.join("-")}),R=p(()=>{let f=[];return n&&n.value&&f.push(n.value),f.push("multiselect-options"),f.join("-")}),i=p(()=>{let f=[];if(n&&n.value&&f.push(n.value),y.value)return f.push(y.value.group?"multiselect-group":"multiselect-option"),f.push(y.value.group?y.value.index:y.value[m.value]),f.join("-")}),q=p(()=>o.value),G=p(()=>v.value!=="single"),B=p(()=>{let f="";return v.value==="single"&&O.value&&(f+=C.value[t.value]),v.value==="multiple"&&O.value&&(f+=k.value),v.value==="tags"&&O.value&&(f+=C.value.map(E=>E[t.value]).join(", ")),f}),g=p(()=>{let f={...h.value};return c.value&&(f["aria-labelledby"]=f["aria-labelledby"]?`${d.value} ${f["aria-labelledby"]}`:d.value,B.value&&f["aria-label"]&&(f["aria-label"]=`${B.value}, ${f["aria-label"]}`)),f}),Q=f=>{let E=[];return n&&n.value&&E.push(n.value),E.push("multiselect-option"),E.push(f[m.value]),E.join("-")},M=f=>{let E=[];return n&&n.value&&E.push(n.value),E.push("multiselect-group"),E.push(f.index),E.join("-")},N=f=>{let E=[];return E.push(f[t.value]),E.join(" ")},X=f=>{let E=[];return E.push(f[T.value]),E.join(" ")},_=f=>`${f} ❎`;return Qe(()=>{if(n&&n.value&&document&&document.querySelector){let f=document.querySelector(`[for="${n.value}"]`);A.value=f?f.innerText:null}}),{arias:g,ariaLabel:B,ariaAssist:d,ariaControls:R,ariaPlaceholder:q,ariaMultiselectable:G,ariaActiveDescendant:i,ariaOptionId:Q,ariaOptionLabel:N,ariaGroupId:M,ariaGroupLabel:X,ariaTagLabel:_}}function Ia(e,r,l,o={}){return l.forEach(n=>{n&&(o={...o,...n(e,r,o)})}),o}var Xe={name:"Multiselect",emits:["paste","open","close","select","deselect","input","search-change","tag","option","update:modelValue","change","clear","keydown","keyup","max"],props:{value:{required:!1},modelValue:{required:!1},options:{type:[Array,Object,Function],required:!1,default:()=>[]},id:{type:[String,Number],required:!1},name:{type:[String,Number],required:!1,default:"multiselect"},disabled:{type:Boolean,required:!1,default:!1},label:{type:String,required:!1,default:"label"},trackBy:{type:String,required:!1,default:void 0},valueProp:{type:String,required:!1,default:"value"},placeholder:{type:String,required:!1,default:null},mode:{type:String,required:!1,default:"single"},searchable:{type:Boolean,required:!1,default:!1},limit:{type:Number,required:!1,default:-1},hideSelected:{type:Boolean,required:!1,default:!0},createTag:{type:Boolean,required:!1,default:void 0},createOption:{type:Boolean,required:!1,default:void 0},appendNewTag:{type:Boolean,required:!1,default:void 0},appendNewOption:{type:Boolean,required:!1,default:void 0},addTagOn:{type:Array,required:!1,default:void 0},addOptionOn:{type:Array,required:!1,default:void 0},caret:{type:Boolean,required:!1,default:!0},loading:{type:Boolean,required:!1,default:!1},noOptionsText:{type:String,required:!1,default:"The list is empty"},noResultsText:{type:String,required:!1,default:"No results found"},multipleLabel:{type:Function,required:!1},object:{type:Boolean,required:!1,default:!1},delay:{type:Number,required:!1,default:-1},minChars:{type:Number,required:!1,default:0},resolveOnLoad:{type:Boolean,required:!1,default:!0},filterResults:{type:Boolean,required:!1,default:!0},clearOnSearch:{type:Boolean,required:!1,default:!1},clearOnSelect:{type:Boolean,required:!1,default:!0},canDeselect:{type:Boolean,required:!1,default:!0},canClear:{type:Boolean,required:!1,default:!0},max:{type:Number,required:!1,default:-1},showOptions:{type:Boolean,required:!1,default:!0},required:{type:Boolean,required:!1,default:!1},openDirection:{type:String,required:!1,default:"bottom"},nativeSupport:{type:Boolean,required:!1,default:!1},classes:{type:Object,required:!1,default:()=>({})},strict:{type:Boolean,required:!1,default:!0},closeOnSelect:{type:Boolean,required:!1,default:!0},autocomplete:{type:String,required:!1},groups:{type:Boolean,required:!1,default:!1},groupLabel:{type:String,required:!1,default:"label"},groupOptions:{type:String,required:!1,default:"options"},groupHideEmpty:{type:Boolean,required:!1,default:!1},groupSelect:{type:Boolean,required:!1,default:!0},inputType:{type:String,required:!1,default:"text"},attrs:{required:!1,type:Object,default:()=>({})},onCreate:{required:!1,type:Function},disabledProp:{type:String,required:!1,default:"disabled"},searchStart:{type:Boolean,required:!1,default:!1},reverse:{type:Boolean,required:!1,default:!1},regex:{type:[Object,String,RegExp],required:!1,default:void 0},rtl:{type:Boolean,required:!1,default:!1},infinite:{type:Boolean,required:!1,default:!1},aria:{required:!1,type:Object,default:()=>({})},clearOnBlur:{required:!1,type:Boolean,default:!0}},setup(e,r){return Ia(e,r,[ha,ba,La,ga,pa,ka,Oa,Ta,Sa,wa,Pa,qa])}};const Ea=["id","dir"],Ca=["tabindex","aria-controls","aria-placeholder","aria-expanded","aria-activedescendant","aria-multiselectable","role"],Ba=["type","modelValue","value","autocomplete","id","aria-controls","aria-placeholder","aria-expanded","aria-activedescendant","aria-multiselectable"],Da=["onKeyup","aria-label"],Aa=["onClick"],Ra=["type","modelValue","value","id","autocomplete","aria-controls","aria-placeholder","aria-expanded","aria-activedescendant","aria-multiselectable"],Ma=["innerHTML"],ja=["id"],Va=["id","aria-label","aria-selected"],Ga=["data-pointed","onMouseenter","onClick"],Na=["innerHTML"],Ka=["aria-label"],Ha=["data-pointed","data-selected","onMouseenter","onClick","id","aria-selected","aria-label"],Fa=["data-pointed","data-selected","onMouseenter","onClick","id","aria-selected","aria-label"],Wa=["innerHTML"],Ua=["innerHTML"],za=["value"],Ja=["name","value"],Qa=["name","value"],Xa=["id"];function Ya(e,r,l,o,n,m){return H(),F("div",{ref:"multiselect",class:I(e.classList.container),id:l.searchable?void 0:l.id,dir:l.rtl?"rtl":void 0,onFocusin:r[10]||(r[10]=(...t)=>e.handleFocusIn&&e.handleFocusIn(...t)),onFocusout:r[11]||(r[11]=(...t)=>e.handleFocusOut&&e.handleFocusOut(...t)),onKeyup:r[12]||(r[12]=(...t)=>e.handleKeyup&&e.handleKeyup(...t)),onKeydown:r[13]||(r[13]=(...t)=>e.handleKeydown&&e.handleKeydown(...t))},[j("div",je({class:e.classList.wrapper,onMousedown:r[9]||(r[9]=(...t)=>e.handleMousedown&&e.handleMousedown(...t)),ref:"wrapper",tabindex:e.tabindex,"aria-controls":l.searchable?void 0:e.ariaControls,"aria-placeholder":l.searchable?void 0:e.ariaPlaceholder,"aria-expanded":l.searchable?void 0:e.isOpen,"aria-activedescendant":l.searchable?void 0:e.ariaActiveDescendant,"aria-multiselectable":l.searchable?void 0:e.ariaMultiselectable,role:l.searchable?void 0:"combobox"},l.searchable?{}:e.arias),[P(" Search "),l.mode!=="tags"&&l.searchable&&!l.disabled?(H(),F("input",je({key:0,type:l.inputType,modelValue:e.search,value:e.search,class:e.classList.search,autocomplete:l.autocomplete,id:l.searchable?l.id:void 0,onInput:r[0]||(r[0]=(...t)=>e.handleSearchInput&&e.handleSearchInput(...t)),onKeypress:r[1]||(r[1]=(...t)=>e.handleKeypress&&e.handleKeypress(...t)),onPaste:r[2]||(r[2]=Ve((...t)=>e.handlePaste&&e.handlePaste(...t),["stop"])),ref:"input","aria-controls":e.ariaControls,"aria-placeholder":e.ariaPlaceholder,"aria-expanded":e.isOpen,"aria-activedescendant":e.ariaActiveDescendant,"aria-multiselectable":e.ariaMultiselectable,role:"combobox"},{...l.attrs,...e.arias}),null,16,Ba)):P("v-if",!0),P(" Tags (with search) "),l.mode=="tags"?(H(),F("div",{key:1,class:I(e.classList.tags),"data-tags":""},[(H(!0),F(fe,null,he(e.iv,(t,v,T)=>J(e.$slots,"tag",{option:t,handleTagRemove:e.handleTagRemove,disabled:l.disabled},()=>[(H(),F("span",{class:I(e.classList.tag),tabindex:"-1",onKeyup:Je(h=>e.handleTagRemove(t,h),["enter"]),key:T,"aria-label":e.ariaTagLabel(t[l.label])},[fa(oe(t[l.label])+" ",1),l.disabled?P("v-if",!0):(H(),F("span",{key:0,class:I(e.classList.tagRemove),onClick:Ve(h=>e.handleTagRemove(t,h),["stop"])},[j("span",{class:I(e.classList.tagRemoveIcon)},null,2)],10,Aa))],42,Da))])),256)),j("div",{class:I(e.classList.tagsSearchWrapper),ref:"tags"},[P(" Used for measuring search width "),j("span",{class:I(e.classList.tagsSearchCopy)},oe(e.search),3),P(" Actual search input "),l.searchable&&!l.disabled?(H(),F("input",je({key:0,type:l.inputType,modelValue:e.search,value:e.search,class:e.classList.tagsSearch,id:l.searchable?l.id:void 0,autocomplete:l.autocomplete,onInput:r[3]||(r[3]=(...t)=>e.handleSearchInput&&e.handleSearchInput(...t)),onKeypress:r[4]||(r[4]=(...t)=>e.handleKeypress&&e.handleKeypress(...t)),onPaste:r[5]||(r[5]=Ve((...t)=>e.handlePaste&&e.handlePaste(...t),["stop"])),ref:"input","aria-controls":e.ariaControls,"aria-placeholder":e.ariaPlaceholder,"aria-expanded":e.isOpen,"aria-activedescendant":e.ariaActiveDescendant,"aria-multiselectable":e.ariaMultiselectable,role:"combobox"},{...l.attrs,...e.arias}),null,16,Ra)):P("v-if",!0)],2)],2)):P("v-if",!0),P(" Single label "),l.mode=="single"&&e.hasSelected&&!e.search&&e.iv?J(e.$slots,"singlelabel",{key:2,value:e.iv},()=>[j("div",{class:I(e.classList.singleLabel)},[j("span",{class:I(e.classList.singleLabelText)},oe(e.iv[l.label]),3)],2)]):P("v-if",!0),P(" Multiple label "),l.mode=="multiple"&&e.hasSelected&&!e.search?J(e.$slots,"multiplelabel",{key:3,values:e.iv},()=>[j("div",{class:I(e.classList.multipleLabel),innerHTML:e.multipleLabelText},null,10,Ma)]):P("v-if",!0),P(" Placeholder "),l.placeholder&&!e.hasSelected&&!e.search?J(e.$slots,"placeholder",{key:4},()=>[j("div",{class:I(e.classList.placeholder),"aria-hidden":"true"},oe(l.placeholder),3)]):P("v-if",!0),P(" Spinner "),l.loading||e.resolving?J(e.$slots,"spinner",{key:5},()=>[j("span",{class:I(e.classList.spinner),"aria-hidden":"true"},null,2)]):P("v-if",!0),P(" Clear "),e.hasSelected&&!l.disabled&&l.canClear&&!e.busy?J(e.$slots,"clear",{key:6,clear:e.clear},()=>[j("span",{"aria-hidden":"true",tabindex:"0",role:"button","data-clear":"","aria-roledescription":"❎",class:I(e.classList.clear),onClick:r[6]||(r[6]=(...t)=>e.clear&&e.clear(...t)),onKeyup:r[7]||(r[7]=Je((...t)=>e.clear&&e.clear(...t),["enter"]))},[j("span",{class:I(e.classList.clearIcon)},null,2)],34)]):P("v-if",!0),P(" Caret "),l.caret&&l.showOptions?J(e.$slots,"caret",{key:7},()=>[j("span",{class:I(e.classList.caret),onClick:r[8]||(r[8]=(...t)=>e.handleCaretClick&&e.handleCaretClick(...t)),"aria-hidden":"true"},null,2)]):P("v-if",!0)],16,Ca),P(" Options "),j("div",{class:I(e.classList.dropdown),tabindex:"-1"},[J(e.$slots,"beforelist",{options:e.fo}),j("ul",{class:I(e.classList.options),id:e.ariaControls,role:"listbox"},[l.groups?(H(!0),F(fe,{key:0},he(e.fg,(t,v,T)=>(H(),F("li",{class:I(e.classList.group),key:T,id:e.ariaGroupId(t),"aria-label":e.ariaGroupLabel(t),"aria-selected":e.isSelected(t),role:"option"},[j("div",{class:I(e.classList.groupLabel(t)),"data-pointed":e.isPointed(t),onMouseenter:h=>e.setPointer(t,v),onClick:h=>e.handleGroupClick(t)},[J(e.$slots,"grouplabel",{group:t,isSelected:e.isSelected,isPointed:e.isPointed},()=>[j("span",{innerHTML:t[l.groupLabel]},null,8,Na)])],42,Ga),j("ul",{class:I(e.classList.groupOptions),"aria-label":e.ariaGroupLabel(t),role:"group"},[(H(!0),F(fe,null,he(t.__VISIBLE__,(h,c,y)=>(H(),F("li",{class:I(e.classList.option(h,t)),"data-pointed":e.isPointed(h),"data-selected":e.isSelected(h)||void 0,key:y,onMouseenter:C=>e.setPointer(h),onClick:C=>e.handleOptionClick(h),id:e.ariaOptionId(h),"aria-selected":e.isSelected(h),"aria-label":e.ariaOptionLabel(h),role:"option"},[J(e.$slots,"option",{option:h,isSelected:e.isSelected,isPointed:e.isPointed,search:e.search},()=>[j("span",null,oe(h[l.label]),1)])],42,Ha))),128))],10,Ka)],10,Va))),128)):(H(!0),F(fe,{key:1},he(e.fo,(t,v,T)=>(H(),F("li",{class:I(e.classList.option(t)),"data-pointed":e.isPointed(t),"data-selected":e.isSelected(t)||void 0,key:T,onMouseenter:h=>e.setPointer(t),onClick:h=>e.handleOptionClick(t),id:e.ariaOptionId(t),"aria-selected":e.isSelected(t),"aria-label":e.ariaOptionLabel(t),role:"option"},[J(e.$slots,"option",{option:t,isSelected:e.isSelected,isPointed:e.isPointed,search:e.search},()=>[j("span",null,oe(t[l.label]),1)])],42,Fa))),128))],10,ja),e.noOptions?J(e.$slots,"nooptions",{key:0},()=>[j("div",{class:I(e.classList.noOptions),innerHTML:l.noOptionsText},null,10,Wa)]):P("v-if",!0),e.noResults?J(e.$slots,"noresults",{key:1},()=>[j("div",{class:I(e.classList.noResults),innerHTML:l.noResultsText},null,10,Ua)]):P("v-if",!0),l.infinite&&e.hasMore?(H(),F("div",{key:2,class:I(e.classList.inifinite),ref:"infiniteLoader"},[J(e.$slots,"infinite",{},()=>[j("span",{class:I(e.classList.inifiniteSpinner)},null,2)])],2)):P("v-if",!0),J(e.$slots,"afterlist",{options:e.fo})],2),P(" Hacky input element to show HTML5 required warning "),l.required?(H(),F("input",{key:0,class:I(e.classList.fakeInput),tabindex:"-1",value:e.textValue,required:""},null,10,za)):P("v-if",!0),P(" Native input support "),l.nativeSupport?(H(),F(fe,{key:1},[l.mode=="single"?(H(),F("input",{key:0,type:"hidden",name:l.name,value:e.plainValue!==void 0?e.plainValue:""},null,8,Ja)):(H(!0),F(fe,{key:1},he(e.plainValue,(t,v)=>(H(),F("input",{type:"hidden",name:`${l.name}[]`,value:t,key:v},null,8,Qa))),128))],64)):P("v-if",!0),P(" Screen reader assistive text "),l.searchable&&e.hasSelected?(H(),F("div",{key:2,class:I(e.classList.assist),id:e.ariaAssist,"aria-hidden":"true"},oe(e.ariaLabel),11,Xa)):P("v-if",!0),P(" Create height for empty input "),j("div",{class:I(e.classList.spacer)},null,2)],42,Ea)}Xe.render=Ya;Xe.__file="src/Multiselect.vue";export{Xe as s};