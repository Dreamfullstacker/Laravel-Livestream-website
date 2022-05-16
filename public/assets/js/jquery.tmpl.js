/*!
 * jQuery Templates Plugin 1.0.0pre
 * http://github.com/jquery/jquery-tmpl
 * Requires jQuery 1.4.2
 *
 * Copyright 2011, Software Freedom Conservancy, Inc.
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 */
!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)}((function(t){var e,n=t.fn.domManip,l="_tmplitem",a=/^[^<]*(<[\w\W]+>)[^>]*$|\{\{\! /,r={},p={},i={key:0,data:{}},o=0,u=0,c=[];function f(e,n,l,a){var i={data:a||0===a||!1===a?a:n?n.data:{},_wrap:n?n._wrap:null,tmpl:null,parent:n||null,nodes:[],calls:y,nest:g,wrap:w,html:v,update:k};return e&&t.extend(i,e,{nodes:[],parent:n}),l&&(i.tmpl=l,i._ctnt=i._ctnt||i.tmpl(t,i),i.key=++o,(c.length?p:r)[o]=i),i}function m(e,n,l){var a,r=l?t.map(l,(function(t){return"string"==typeof t?e.key?t.replace(/(<\w+)(?=[\s>])(?![^>]*_tmplitem)([^>]*)/g,'$1 _tmplitem="'+e.key+'" $2'):t:m(t,e,t._ctnt)})):e;return n?r:((r=r.join("")).replace(/^\s*([^<\s][^<]*)?(<[\w\W]+>)([^>]*[^>\s])?\s*$/,(function(e,n,l,r){h(a=t(l).get()),n&&(a=s(n).concat(a)),r&&(a=a.concat(s(r)))})),a||s(r))}function s(e){var n=document.createElement("div");return n.innerHTML=e,t.makeArray(n.childNodes)}function d(e){return new Function("jQuery","$item","var $=jQuery,call,__=[],$data=$item.data;with($data){__.push('"+t.trim(e).replace(/([\\'])/g,"\\$1").replace(/[\r\t\n]/g," ").replace(/\$\{([^\}]*)\}/g,"{{= $1}}").replace(/\{\{(\/?)(\w+|.)(?:\(((?:[^\}]|\}(?!\}))*?)?\))?(?:\s+(.*?)?)?(\(((?:[^\}]|\}(?!\}))*?)\))?\s*\}\}/g,(function(e,n,l,a,r,p,i){var o,u,c,f=t.tmpl.tag[l];if(!f)throw"Unknown template tag: "+l;return o=f._default||[],p&&!/\w$/.test(r)&&(r+=p,p=""),r?(r=$(r),i=i?","+$(i)+")":p?")":"",u=p?r.indexOf(".")>-1?r+$(p):"("+r+").call($item"+i:r,c=p?u:"(typeof("+r+")==='function'?("+r+").call($item):("+r+"))"):c=u=o.$1||"null",a=$(a),"');"+f[n?"close":"open"].split("$notnull_1").join(r?"typeof("+r+")!=='undefined' && ("+r+")!=null":"true").split("$1a").join(c).split("$1").join(u).split("$2").join(a||o.$2||"")+"__.push('"}))+"');}return __;")}function _(e,n){e._wrap=m(e,!0,t.isArray(n)?n:[a.test(n)?n:t(n).html()]).join("")}function $(t){return t?t.replace(/\\'/g,"'").replace(/\\\\/g,"\\"):null}function h(e){var n,a,i,c,m,s="_"+u,d={};for(i=0,c=e.length;i<c;i++)if(1===(n=e[i]).nodeType){for(m=(a=n.getElementsByTagName("*")).length-1;m>=0;m--)_(a[m]);_(n)}function _(e){var n,a,i,c,m=e;if(c=e.getAttribute(l)){for(;m.parentNode&&1===(m=m.parentNode).nodeType&&!(n=m.getAttribute(l)););n!==c&&(m=m.parentNode?11===m.nodeType?0:m.getAttribute(l)||0:0,(i=r[c])||((i=f(i=p[c],r[m]||p[m])).key=++o,r[o]=i),u&&_(c)),e.removeAttribute(l)}else u&&(i=t.data(e,"tmplItem"))&&(_(i.key),r[i.key]=i,m=(m=t.data(e.parentNode,"tmplItem"))?m.key:0);if(i){for(a=i;a&&a.key!=m;)a.nodes.push(e),a=a.parent;delete i._ctnt,delete i._wrap,t.data(e,"tmplItem",i)}function _(t){i=d[t+=s]=d[t]||f(i,r[i.parent.key+s]||i.parent)}}}function y(t,e,n,l){if(!t)return c.pop();c.push({_:t,tmpl:e,item:this,data:n,options:l})}function g(e,n,l){return t.tmpl(t.template(e),n,l,this)}function w(e,n){var l=e.options||{};return l.wrapped=n,t.tmpl(t.template(e.tmpl),e.data,l,e.item)}function v(e,n){var l=this._wrap;return t.map(t(t.isArray(l)?l.join(""):l).filter(e||"*"),(function(t){return n?t.innerText||t.textContent:t.outerHTML||(e=t,(l=document.createElement("div")).appendChild(e.cloneNode(!0)),l.innerHTML);var e,l}))}function k(){var e=this.nodes;t.tmpl(null,null,null,this).insertBefore(e[0]),t(e).remove()}t.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},(function(n,l){t.fn[n]=function(a){var p,i,o,c,f=[],m=t(a),s=1===this.length&&this[0].parentNode;if(e=r||{},s&&11===s.nodeType&&1===s.childNodes.length&&1===m.length)m[l](this[0]),f=this;else{for(i=0,o=m.length;i<o;i++)u=i,p=(i>0?this.clone(!0):this).get(),t(m[i])[l](p),f=f.concat(p);u=0,f=this.pushStack(f,n,m.selector)}return c=e,e=null,t.tmpl.complete(c),f}})),t.fn.extend({tmpl:function(e,n,l){return t.tmpl(this[0],e,n,l)},tmplItem:function(){return t.tmplItem(this[0])},template:function(e){return t.template(e,this[0])},domManip:function(l,a,p,i){if(l[0]&&t.isArray(l[0])){for(var o,c=t.makeArray(arguments),f=l[0],m=f.length,s=0;s<m&&!(o=t.data(f[s++],"tmplItem")););o&&u&&(c[2]=function(e){t.tmpl.afterManip(this,e,p)}),n.apply(this,c)}else n.apply(this,arguments);return u=0,e||t.tmpl.complete(r),this}}),t.extend({tmpl:function(e,n,l,a){var o,u=!a;if(u)a=i,e=t.template[e]||t.template(null,e),p={};else if(!e)return e=a.tmpl,r[a.key]=a,a.nodes=[],a.wrapped&&_(a,a.wrapped),t(m(a,null,a.tmpl(t,a)));return e?("function"==typeof n&&(n=n.call(a||{})),l&&l.wrapped&&_(l,l.wrapped),o=t.isArray(n)?t.map(n,(function(t){return t?f(l,a,e,t):null})):[f(l,a,e,n)],u?t(m(a,null,o)):o):[]},tmplItem:function(e){var n;for(e instanceof t&&(e=e[0]);e&&1===e.nodeType&&!(n=t.data(e,"tmplItem"))&&(e=e.parentNode););return n||i},template:function(e,n){return n?("string"==typeof n?n=d(n):n instanceof t&&(n=n[0]||{}),n.nodeType&&(n=t.data(n,"tmpl")||t.data(n,"tmpl",d(n.innerHTML))),"string"==typeof e?t.template[e]=n:n):e?"string"!=typeof e?t.template(null,e):t.template[e]||t.template(null,a.test(e)?e:t(e)):null},encode:function(t){return(""+t).split("<").join("&lt;").split(">").join("&gt;").split('"').join("&#34;").split("'").join("&#39;")}}),t.extend(t.tmpl,{tag:{tmpl:{_default:{$2:"null"},open:"if($notnull_1){__=__.concat($item.nest($1,$2));}"},wrap:{_default:{$2:"null"},open:"$item.calls(__,$1,$2);__=[];",close:"call=$item.calls();__=call._.concat($item.wrap(call,__));"},each:{_default:{$2:"$index, $value"},open:"if($notnull_1){$.each($1a,function($2){with(this){",close:"}});}"},if:{open:"if(($notnull_1) && $1a){",close:"}"},else:{_default:{$1:"true"},open:"}else if(($notnull_1) && $1a){"},html:{open:"if($notnull_1){__.push($1a);}"},"=":{_default:{$1:"$data"},open:"if($notnull_1){__.push($.encode($1a));}"},"!":{open:""}},complete:function(t){r={}},afterManip:function(e,n,l){var a=11===n.nodeType?t.makeArray(n.childNodes):1===n.nodeType?[n]:[];l.call(e,n),h(a),u++}})}));
