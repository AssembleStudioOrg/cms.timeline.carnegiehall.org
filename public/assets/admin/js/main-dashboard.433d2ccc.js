(function(t){function e(e){for(var r,i,o=e[0],c=e[1],l=e[2],d=0,_=[];d<o.length;d++)i=o[d],Object.prototype.hasOwnProperty.call(n,i)&&n[i]&&_.push(n[i][0]),n[i]=0;for(r in c)Object.prototype.hasOwnProperty.call(c,r)&&(t[r]=c[r]);u&&u(e);while(_.length)_.shift()();return s.push.apply(s,l||[]),a()}function a(){for(var t,e=0;e<s.length;e++){for(var a=s[e],r=!0,o=1;o<a.length;o++){var c=a[o];0!==n[c]&&(r=!1)}r&&(s.splice(e--,1),t=i(i.s=a[0]))}return t}var r={},n={"main-dashboard":0},s=[];function i(e){if(r[e])return r[e].exports;var a=r[e]={i:e,l:!1,exports:{}};return t[e].call(a.exports,a,a.exports,i),a.l=!0,a.exports}i.m=t,i.c=r,i.d=function(t,e,a){i.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},i.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},i.t=function(t,e){if(1&e&&(t=i(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(i.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)i.d(a,r,function(e){return t[e]}.bind(null,r));return a},i.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="/";var o=window["webpackJsonp"]=window["webpackJsonp"]||[],c=o.push.bind(o);o.push=e,o=o.slice();for(var l=0;l<o.length;l++)e(o[l]);var u=c;s.push([1,"chunk-vendors","chunk-common"]),a()})({1:function(t,e,a){t.exports=a("e378")},"436d":function(t,e,a){"use strict";a("feb9")},"4cb4":function(t,e,a){},"5dc8":function(t,e,a){},6532:function(t,e,a){},"7e58":function(t,e,a){"use strict";a("5dc8")},"94ce":function(t,e,a){"use strict";a("6532")},a5ec:function(t,e,a){},b164:function(t,e,a){},b484:function(t,e,a){"use strict";a("a5ec")},d535:function(t,e,a){"use strict";a("4cb4")},e378:function(t,e,a){"use strict";a.r(e);var r=a("a026"),n=a("1539"),s=a("b171"),i=(a("878a"),a("16f9")),o=a("2e01"),c=a("54d3"),l=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"shortcutCreator"},[t.entities.length?a("div",{staticClass:"container"},[a("div",{staticClass:"wrapper wrapper--reverse"},[a("div",{staticClass:"shortcutCreator__create"},[a("a17-dropdown",{ref:"createNewDropdown",staticClass:"shortcutCreator__dropdown",attrs:{position:"bottom-right",width:"full",offset:0}},[a("a17-button",{staticClass:"shortcutCreator__btn",attrs:{type:"button",variant:"action"},on:{click:function(e){return t.$refs.createNewDropdown.toggle()}}},[t._v(" "+t._s(t.$trans("dashboard.create-new","Create new"))+" "),a("span",{staticClass:"shortcutCreator__trigger"},[a("span",{directives:[{name:"svg",rawName:"v-svg"}],attrs:{symbol:"dropdown_module"}})])]),a("div",{attrs:{slot:"dropdown__content"},slot:"dropdown__content"},[a("ul",[t._l(t.entities,(function(e,r){return[e.createUrl?a("li",{key:r},[a("a",{attrs:{href:e.createUrl}},[t._v(t._s(e.singular))])]):t._e()]}))],2)])],1)],1),a("div",{staticClass:"shortcutCreator__listing"},[t._l(t.entities,(function(e,r){return[e.number?a("a",{key:r,staticClass:"shortcutCreator__listingItem",attrs:{href:e.url}},[a("span",{staticClass:"shortcutCreator__label"},[t._v(t._s(e.label))]),a("h3",{staticClass:"shortcutCreator__sum f--heading"},[t._v(t._s(e.number))])]):t._e()]}))],2)])]):t._e()])},u=[],d={name:"A17ShortcutCreator",props:{entities:{type:Array,default:function(){return[]}}},computed:{},methods:{}},_=d,f=(a("fecc"),a("7e58"),a("2877")),p=Object(f["a"])(_,l,u,!1,null,"a2ab6288",null),b=p.exports,v=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"box activityFeed"},[a("header",{staticClass:"box__header"},[t._t("default"),a("ul",{staticClass:"box__filter"},t._l(t.navFilters,(function(e,r){return a("li",{key:r},[a("a",{class:{"s--on":t.navActive===r},attrs:{href:"#"},on:{click:function(a){return a.preventDefault(),t.filterStatus(r,e.slug)}}},[t._v(t._s(e.name))])])})),0)],2),a("div",{staticClass:"box__body"},[t.rows.length>0?a("table",{staticClass:"activityFeed__table"},[t._l(t.rows,(function(e,r){return[a("a17-activity-row",{key:e.id,attrs:{row:e,index:r,columns:t.columns}})]}))],2):[a("div",{staticClass:"activityFeed__empty"},[a("h4",[t._v(t._s(t.emptyMessage))])])]],2)])},m=[],h=a("2f62"),y=a("0429"),w=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("tr",{staticClass:"activityRow"},[t._l(t.columns,(function(e){return a("td",{key:e.name,staticClass:"activityCell",class:t.cellClasses(e)},[t.isSpecificColumn(e)?["published"===e.name?a("span",{directives:[{name:"tooltip",rawName:"v-tooltip"}],staticClass:"activityCell__pubstate",class:{"activityCell__pubstate--live":t.row[e.name]},attrs:{"data-tooltip-title":t.row[e.name]?"Published":"Draft"}}):t._e(),t._v(" "),"thumbnail"===e.name?a("a",{staticClass:"activityCell__thumb",attrs:{href:t.row["edit"]}},[a("img",{attrs:{src:t.row[e.name]}})]):t._e()]:["name"===e.name?[a("a",{staticClass:"activityCell__link",attrs:{href:t.row["edit"]}},[t._v(t._s(t.row[e.name]))]),a("p",{staticClass:"activityCell__meta f--note"},[t._v(" "+t._s(t.row["activity"])+" "),a("timeago",{attrs:{"auto-update":1,datetime:new Date(t.row["date"])}}),t._v(" "+t._s(t.$trans("dashboard.activity-row.by","by"))+" "+t._s(t.row["author"])+" "),a("span",{staticClass:"activityCell__type"},[t._v(t._s(t.row["type"]))])],1)]:t._e()]],2)})),a("td",{staticClass:"activityCell activityCell--icon"},[a("a17-dropdown",{ref:"activityRowSetupDropdown",attrs:{position:"bottom-right"}},[a("a17-button",{attrs:{variant:"icon"},on:{click:function(e){return t.$refs.activityRowSetupDropdown.toggle()}}},[a("span",{directives:[{name:"svg",rawName:"v-svg"}],attrs:{symbol:"more-dots"}})]),a("div",{attrs:{slot:"dropdown__content"},slot:"dropdown__content"},[t.row.hasOwnProperty("permalink")?a("a",{attrs:{href:t.row["permalink"],target:"_blank"}},[t._v(t._s(t.$trans("dashboard.activity-row.view-permalink","View Permalink")))]):t._e(),t.row.hasOwnProperty("edit")?a("a",{attrs:{href:t.row["edit"]}},[t._v(t._s(t.$trans("dashboard.activity-row.edit","Edit")))]):t._e()])],1)],1)],2)},g=[],C={name:"A17ActivityRow",props:{index:{type:Number,default:0},row:{type:Object,default:function(){return{}}},columns:{type:Array,default:function(){return[]}}},computed:{},methods:{cellClasses:function(t){return{"activityCell--icon":"featured"===t.name||"published"===t.name,"activityCell--pub hide--xsmall":"published"===t.name,"activityCell--thumb hide--xsmall":"thumbnail"===t.name}},isSpecificColumn:function(t){return"featured"===t.name||"published"===t.name||"thumbnail"===t.name}}},O=C,P=(a("b484"),Object(f["a"])(O,w,g,!1,null,"44a9a60b",null)),F=P.exports;function j(t,e){var a=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),a.push.apply(a,r)}return a}function k(t){for(var e=1;e<arguments.length;e++){var a=null!=arguments[e]?arguments[e]:{};e%2?j(Object(a),!0).forEach((function(e){x(t,e,a[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(a)):j(Object(a)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(a,e))}))}return t}function x(t,e,a){return e in t?Object.defineProperty(t,e,{value:a,enumerable:!0,configurable:!0,writable:!0}):t[e]=a,t}var A={name:"A17ActivityFeed",components:{"a17-activity-row":F},props:{emptyMessage:{type:String,default:"You don't have any activity yet."}},data:function(){return{navFilters:[{name:this.$trans("dashboard.all-activity","All activity"),slug:"all"},{name:this.$trans("dashboard.my-activity","My activity"),slug:"mine"}],navActive:0}},computed:k({rows:{get:function(){return this.$store.state.datatable.data},set:function(t){this.$store.commit(y["e"].UPDATE_DATATABLE_DATA,t)}}},Object(h["c"])({page:function(t){return t.datatable.page},maxPage:function(t){return t.datatable.maxPage},columns:function(t){return t.datatable.columns}})),methods:{filterStatus:function(t,e){this.navActive!==t&&(this.navActive=t,window["TWILL"].STORE.datatable&&window["TWILL"].STORE.datatable.hasOwnProperty(e)&&(this.rows=window["TWILL"].STORE.datatable[e]))}}},S=A,D=(a("d535"),Object(f["a"])(S,v,m,!1,null,"6a695007",null)),$=D.exports,T=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"box statFeed"},[a("header",{staticClass:"box__header"},[a("div",{staticClass:"wrapper"},[a("div",{staticClass:"col--double"},[a("b",[t._t("default")],2)]),a("div",{staticClass:"col--double"},[a("div",{staticClass:"statFeed__dropdown"},[a("a17-dropdown",{ref:"statPeriodDropdown",attrs:{position:"bottom-right"}},[a("a17-button",{attrs:{variant:"ghost"},on:{click:function(e){return t.$refs.statPeriodDropdown.toggle()}}},[t._v(t._s(t.selectedPeriodLabel)+" "),a("span",{directives:[{name:"svg",rawName:"v-svg"}],staticClass:"statFeed__dropdownIcon",attrs:{symbol:"dropdown_module"}})]),a("div",{attrs:{slot:"dropdown__content"},slot:"dropdown__content"},[t._l(t.periods,(function(e,r){return[e.value!==t.selectedPeriod?a("button",{key:r,attrs:{type:"button"},on:{click:function(a){return t.selectPeriod(e.value)}}},[t._v(t._s(e.label))]):t._e()]}))],2)],1)],1)])])]),a("div",{staticClass:"box__body"},[t._l(t.factsForSelectedPeriod,(function(e,r){return[a("a",{key:r,staticClass:"statFeed__item",attrs:{href:e.url,target:"_blank"}},[a("h3",{staticClass:"statFeed__numb f--heading",class:t.trending(r)},[t._v(t._s(e.figure))]),a("div",{staticClass:"statFeed__info"},[a("h4",{staticClass:"statFeed__label"},[t._v(t._s(e.label))]),a("p",{staticClass:"statFeed__meta f--note f--small"},[t._v(t._s(e.insight))])]),a("div",{staticClass:"statFeed__line"},[a("trend",{attrs:{data:e.data,gradient:["#cccccc"],"stroke-width":"2",padding:0,"auto-draw":"",smooth:"",width:"100",height:"50"}})],1)])]}))],2),t._m(0)])},E=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("footer",{staticClass:"box__footer statFeed__footer"},[a("a",{staticClass:"f--external",attrs:{href:"https://analytics.google.com/analytics/web",target:"_blank"}},[t._v("Google Analytics")])])}],L=a("da19");r["a"].use(L["a"]);var M={name:"A17StatFeed",props:{facts:{type:Object,default:function(){return{}}}},data:function(){return{selectedPeriod:"yesterday",periods:[{label:"Today",value:"today"},{label:"Yesterday",value:"yesterday"},{label:"This week",value:"week"},{label:"This month",value:"month"}]}},computed:{factsForSelectedPeriod:function(){return this.facts[this.selectedPeriod]},selectedPeriodLabel:function(){var t=this;return this.periods.find((function(e){return e.value===t.selectedPeriod})).label}},methods:{trending:function(t){return"statFeed__numb--"+this.factsForSelectedPeriod[t].trend},selectPeriod:function(t){this.selectedPeriod=t}}},N=M,R=(a("436d"),Object(f["a"])(N,T,E,!1,null,"5d1b8a8c",null)),I=R.exports,W=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"box genericFeed"},[a("header",{staticClass:"box__header"},[a("b",[t._t("default")],2)]),a("div",{staticClass:"box__body"},[a("ol",{staticClass:"genericFeed__list",class:{"genericFeed__list--numbered":t.hasNumber}},t._l(t.entities,(function(e,r){return a("li",{key:r},[a("a",{staticClass:"genericFeed__item",attrs:{href:e.url,target:t.target(e)}},[e.thumbnail?a("span",{staticClass:"genericFeed__thumbnails"},[a("img",{attrs:{src:e.thumbnail}})]):t._e(),a("span",{staticClass:"genericFeed__label"},[a("span",[a("span",{staticClass:"genericFeed__hover"},[t._v(t._s(e.name))])])]),e.number?a("span",{staticClass:"genericFeed__views f--tiny"},[t._v(t._s(e.number))]):t._e(),e.type?a("span",{staticClass:"genericFeed__type"},[t._v(t._s(e.type))]):t._e()])])})),0)])])},U=[],G={name:"A17GenericFeed",props:{entities:{type:Array,default:function(){return[]}}},computed:{hasNumber:function(){return this.entities.filter((function(t){return t.hasOwnProperty("number")})).length}},methods:{target:function(t){return!!t.hasOwnProperty("external")&&"_blank"}}},J=G,Y=(a("94ce"),Object(f["a"])(J,W,U,!1,null,"5723cbaf",null)),B=Y.exports,V=a("b0ae"),q=a("c5ec"),z=a("ce72");r["a"].use(o["a"]),r["a"].use(c["a"]),n["a"].registerModule("datatable",V["a"]),n["a"].registerModule("language",q["a"]),n["a"].registerModule("form",z["a"]),window["TWILL"].vm=window.vm=new r["a"]({store:n["a"],el:"#app",components:{"a17-shortcut-creator":b,"a17-activity-feed":$,"a17-stat-feed":I,"a17-feed":B},created:function(){Object(i["a"])()}}),document.addEventListener("DOMContentLoaded",s["a"])},feb9:function(t,e,a){},fecc:function(t,e,a){"use strict";a("b164")}});