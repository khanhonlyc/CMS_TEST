!function(t){"use strict";var e={url:null,values:null,method:"POST",target:null,traditional:!1,redirectTop:!1,shouldKeepBlankFields:!1};t.redirect=function(r,a,n,l,o,i,u){var d=r;"object"!=typeof r&&(d={url:r,values:a,method:n,target:l,traditional:o,redirectTop:i,shouldKeepBlankFields:u});var p=t.extend({},e,d),s=t.redirect.getForm(p.url,p.values,p.method,p.target,p.traditional,p.shouldKeepBlankFields);t("body",p.redirectTop?window.top.document:void 0).append(s.form),s.submit(),s.form.remove()},t.redirect.getForm=function(e,r,l,o,i,u){l=l&&-1!==["GET","POST","PUT","DELETE"].indexOf(l.toUpperCase())?l.toUpperCase():"POST";var d=(e=e.split("#"))[1]?"#"+e[1]:"";if(e=e[0],!r){var p=t.parseUrl(e);e=p.url,r=p.params}r=n(r,u);var s=t("<form>").attr("method",l).attr("action",e+d);o&&s.attr("target",o);var f=s[0].submit;return a(r,[],s,null,i),{form:s,submit:function(){f.call(s[0])}}},t.parseUrl=function(t){if(-1===t.indexOf("?"))return{url:t,params:{}};var e,r,a=t.split("?"),n=a[1].split("&");t=a[0];var l={};for(e=0;e<n.length;e+=1)l[(r=n[e].split("="))[0]]=r[1];return{url:t,params:l}};var r=function(e,r,a,n,l){var o,i;if(a.length>0){for(i=1,o=a[0];i<a.length;i+=1)o+="["+a[i]+"]";e=n&&l?o:o+"["+e+"]"}return t("<input>").attr("type","hidden").attr("name",e).attr("value",r)},a=function(t,e,n,l,o){var i=[];Object.keys(t).forEach(function(u){"object"==typeof t[u]?((i=e.slice()).push(u),a(t[u],i,n,Array.isArray(t[u]),o)):n.append(r(u,t[u],e,l,o))})},n=function(t,e){for(var r=Object.getOwnPropertyNames(t),a=0;a<r.length;a++){var l=r[a];null===t[l]||void 0===t[l]?delete t[l]:"object"==typeof t[l]?t[l]=n(t[l],e):!e&&t[l].length<1&&delete t[l]}return t}}(window.jQuery||window.Zepto||window.jqlite);