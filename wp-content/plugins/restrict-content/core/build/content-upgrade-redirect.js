(()=>{var e,t={510:(e,t,r)=>{"use strict";const n=window.wp.i18n,o=window.wp.blocks,i=window.React,c=window.wp.element,a=window.wp.blockEditor,l=window.wp.url,s=window.wp.components,p=window.wp.data;var d=r(967),u=r.n(d);const g=window.lodash,f=window.wp.compose,b=["core/button","core/paragraph"],h=[["core/button",{align:"center",placeholder:"Register"}],["core/paragraph",{placeholder:(0,n.__)("Already a Member? Example Text","rcp"),className:"restrict-content-pro-content-login-link",align:"center"}]],m=JSON.parse('{"apiVersion":2,"name":"restrict-content-pro/content-upgrade-redirect","title":"Content Upgrade Redirect","category":"restrict-content-pro","icon":"paperclip","description":"Link to a page containing a Registration Form, then redirect the registration form to the specified Redirect URL.","textdomain":"rcp","keywords":["restrict","rcp","content-upgrade-redirect"],"attributes":{"redirectUrl":{"type":"string"},"registrationUrl":{"type":"string"},"loginUrl":{"type":"string"}},"editorScript":"file:../../../build/content-upgrade-redirect.js","editorStyle":"file:../../../build/content-upgrade-redirect.css","style":"file:../../../build/style-content-upgrade-redirect.css","supports":{"html":false}}');(0,o.registerBlockType)("restrict-content-pro/content-upgrade-redirect",{...m,description:(0,n.__)("Link to the Registration form, and then redirect the registration form to the specified page.","rcp"),title:(0,n.__)("Content Upgrade Redirect","rcp"),edit:function(e){const{className:t,...r}=(0,a.useBlockProps)(),{attributes:{redirectUrl:o,registrationUrl:d,loginUrl:m},setAttributes:v,clientId:w}=e,{blockOrder:_,button:y,paragraph:k}=(0,p.useSelect)((e=>{const t=e("core/block-editor").getBlock(w).innerBlocks;return{blockOrder:e("core/block-editor").getBlockOrder(w),button:e("core/block-editor").getBlock(t?.[0]?.clientId),paragraph:e("core/block-editor").getBlock(t?.[1]?.clientId)}}),[w]),{updateBlockAttributes:U}=(0,p.useDispatch)("core/block-editor"),E=(0,f.usePrevious)(d),R=(0,f.usePrevious)(o);return(0,c.useEffect)((()=>{if(void 0===d&&v({registrationUrl:rcp_default_registration_page}),void 0===m&&v({loginUrl:rcp_default_account_page}),void 0===o&&v({redirectUrl:""}),!(0,g.isEmpty)(y)){const e={};void 0===y.attributes.text&&(e.text=y.attributes.placeholder),void 0===y.attributes.url&&(e.url=d),o!==R&&(e.url=(0,l.addQueryArgs)(d,{rcp_redirect:o})),d!==E&&(e.url=(0,l.addQueryArgs)(d,{rcp_redirect:o})),(0,g.isEmpty)(e)||U(y.clientId,e)}if(!(0,g.isEmpty)(k)){const e={},t=k.attributes.content?k.attributes.content:"",r=t.split(/<br>/),n=(0,l.addQueryArgs)(m,{rcp_redirect:o});if(t.length>0){const e=t.match(/href="([^"]*)/);if(null!==e){const t=e[1];t!==m&&null!==t&&t!==m&&v({loginUrl:t})}}1===r.length&&t.length>0&&(""===r[0]?e.content="<a href='"+n+"'>"+k.attributes.placeholder+"</a>":-1===r[0].search("<a href='"+n+"'>")&&(r[0].replace(/(<([^>]+)>)/gi,"")!==k.attributes.placeholder?e.content="<a href='"+n+"'>"+k.attributes.content.replace(/(<([^>]+)>)/gi,"")+"</a>":e.content="<a href='"+n+"'>"+k.attributes.placeholder+"</a>")),(0,g.isEmpty)(e)||U(k.clientId,e)}}),[_,d,E,o,m,y,k]),(0,i.createElement)(i.Fragment,null,(0,i.createElement)(a.InspectorControls,null,(0,i.createElement)(s.PanelBody,{title:(0,n.__)("Redirect Settings","rcp")},(0,i.createElement)(s.PanelRow,null,(0,i.createElement)(a.URLInput,{label:(0,n.__)("Registration Button URL","rcp"),className:"rcp-content-upgrade-redirect-url",value:d,onChange:e=>v({registrationUrl:e})})),(0,i.createElement)(s.PanelRow,null,(0,i.createElement)(a.URLInput,{label:(0,n.__)("Login Text URL","rcp"),className:"rcp-content-upgrade-redirect-url",value:m,onChange:e=>v({loginUrl:e})})),(0,i.createElement)(s.PanelRow,null,(0,i.createElement)(a.URLInput,{label:(0,n.__)("Redirect Destination URL","rcp"),className:"rcp-content-upgrade-redirect-url",value:o,onChange:e=>v({redirectUrl:e})})))),(0,i.createElement)("div",{...r,className:u()("restrict-content-pro-content-upgrade-redirect__inner-content",t)},(0,i.createElement)(a.InnerBlocks,{allowedBlocks:b,template:h,templateLock:"all"})))},save:function(){const{className:e,...t}=a.useBlockProps.save();return(0,i.createElement)("div",{...t,className:u()("restrict-content-pro-content-upgrade-redirect__inner-content",e)},(0,i.createElement)(a.InnerBlocks.Content,null))}})},967:(e,t)=>{var r;!function(){"use strict";var n={}.hasOwnProperty;function o(){for(var e="",t=0;t<arguments.length;t++){var r=arguments[t];r&&(e=c(e,i(r)))}return e}function i(e){if("string"==typeof e||"number"==typeof e)return e;if("object"!=typeof e)return"";if(Array.isArray(e))return o.apply(null,e);if(e.toString!==Object.prototype.toString&&!e.toString.toString().includes("[native code]"))return e.toString();var t="";for(var r in e)n.call(e,r)&&e[r]&&(t=c(t,r));return t}function c(e,t){return t?e?e+" "+t:e+t:e}e.exports?(o.default=o,e.exports=o):void 0===(r=function(){return o}.apply(t,[]))||(e.exports=r)}()}},r={};function n(e){var o=r[e];if(void 0!==o)return o.exports;var i=r[e]={exports:{}};return t[e](i,i.exports,n),i.exports}n.m=t,e=[],n.O=(t,r,o,i)=>{if(!r){var c=1/0;for(p=0;p<e.length;p++){for(var[r,o,i]=e[p],a=!0,l=0;l<r.length;l++)(!1&i||c>=i)&&Object.keys(n.O).every((e=>n.O[e](r[l])))?r.splice(l--,1):(a=!1,i<c&&(c=i));if(a){e.splice(p--,1);var s=o();void 0!==s&&(t=s)}}return t}i=i||0;for(var p=e.length;p>0&&e[p-1][2]>i;p--)e[p]=e[p-1];e[p]=[r,o,i]},n.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return n.d(t,{a:t}),t},n.d=(e,t)=>{for(var r in t)n.o(t,r)&&!n.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},n.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={733:0,902:0};n.O.j=t=>0===e[t];var t=(t,r)=>{var o,i,[c,a,l]=r,s=0;if(c.some((t=>0!==e[t]))){for(o in a)n.o(a,o)&&(n.m[o]=a[o]);if(l)var p=l(n)}for(t&&t(r);s<c.length;s++)i=c[s],n.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return n.O(p)},r=globalThis.webpackChunkrestrict_content_pro=globalThis.webpackChunkrestrict_content_pro||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))})();var o=n.O(void 0,[902],(()=>n(510)));o=n.O(o)})();