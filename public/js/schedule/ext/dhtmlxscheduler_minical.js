/*
@license
dhtmlxScheduler v.5.1.6 Stardard

This software is covered by GPL license. You also can obtain Commercial or Enterprise license to use it in non-GPL project - please contact sales@dhtmlx.com. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
scheduler.templates.calendar_month=scheduler.date.date_to_str("%F %Y"),scheduler.templates.calendar_scale_date=scheduler.date.date_to_str("%D"),scheduler.templates.calendar_date=scheduler.date.date_to_str("%d"),scheduler.config.minicalendar={mark_events:!0},scheduler._synced_minicalendars=[],scheduler.renderCalendar=function(e,t,a){var r=null,n=e.date||scheduler._currentDate();if("string"==typeof n&&(n=this.templates.api_date(n)),t)r=this._render_calendar(t.parentNode,n,e,t),scheduler.unmarkCalendar(r);else{
var i=e.container,d=e.position;if("string"==typeof i&&(i=document.getElementById(i)),"string"==typeof d&&(d=document.getElementById(d)),d&&"undefined"==typeof d.left){var l=scheduler.$domHelpers.getOffset(d);d={top:l.top+d.offsetHeight,left:l.left}}i||(i=scheduler._get_def_cont(d)),r=this._render_calendar(i,n,e),r.onclick=function(e){e=e||event;var t=e.target||e.srcElement;if(-1!=t.className.indexOf("dhx_month_head")){var a=t.parentNode.className;if(-1==a.indexOf("dhx_after")&&-1==a.indexOf("dhx_before")){
var r=scheduler.templates.xml_date(this.getAttribute("date"));r.setDate(parseInt(t.innerHTML,10)),scheduler.unmarkCalendar(this),scheduler.markCalendar(this,r,"dhx_calendar_click"),this._last_date=r,this.conf.handler&&this.conf.handler.call(scheduler,r,this)}}}}if(scheduler.config.minicalendar.mark_events)for(var o=scheduler.date.month_start(n),s=scheduler.date.add(o,1,"month"),_=this.getEvents(o,s),c=this["filter_"+this._mode],u={},h=0;h<_.length;h++){var p=_[h];if(!c||c(p.id,p)){var v=p.start_date;
for(v.valueOf()<o.valueOf()&&(v=o),v=scheduler.date.date_part(new Date(v.valueOf()));v<p.end_date&&(u[+v]||(u[+v]=!0,this.markCalendar(r,v,"dhx_year_event")),v=this.date.add(v,1,"day"),!(v.valueOf()>=s.valueOf())););}}return this._markCalendarCurrentDate(r),r.conf=e,e.sync&&!a&&this._synced_minicalendars.push(r),r.conf._on_xle_handler||(r.conf._on_xle_handler=scheduler.attachEvent("onXLE",function(){scheduler.updateCalendar(r,r.conf.date)})),this.config.wai_aria_attributes&&this.config.wai_aria_application_role&&r.setAttribute("role","application"),
r},scheduler._get_def_cont=function(e){return this._def_count||(this._def_count=document.createElement("div"),this._def_count.className="dhx_minical_popup",this._def_count.onclick=function(e){(e||event).cancelBubble=!0},document.body.appendChild(this._def_count)),this._def_count.style.left=e.left+"px",this._def_count.style.top=e.top+"px",this._def_count._created=new Date,this._def_count},scheduler._locateCalendar=function(e,t){if("string"==typeof t&&(t=scheduler.templates.api_date(t)),+t>+e._max_date||+t<+e._min_date)return null;
for(var a=e.querySelector(".dhx_year_body").childNodes[0],r=0,n=new Date(e._min_date);+this.date.add(n,1,"week")<=+t;)n=this.date.add(n,1,"week"),r++;var i=scheduler.config.start_on_monday,d=(t.getDay()||(i?7:0))-(i?1:0);return a.rows[r].cells[d].firstChild},scheduler.markCalendar=function(e,t,a){var r=this._locateCalendar(e,t);r&&(r.className+=" "+a)},scheduler.unmarkCalendar=function(e,t,a){if(t=t||e._last_date,a=a||"dhx_calendar_click",t){var r=this._locateCalendar(e,t);r&&(r.className=(r.className||"").replace(RegExp(a,"g")));
}},scheduler._week_template=function(e){for(var t=e||250,a=0,r=document.createElement("div"),n=this.date.week_start(scheduler._currentDate()),i=0;7>i;i++)this._cols[i]=Math.floor(t/(7-i)),this._render_x_header(i,a,n,r),n=this.date.add(n,1,"day"),t-=this._cols[i],a+=this._cols[i];return r.lastChild.className+=" dhx_scale_bar_last",r},scheduler.updateCalendar=function(e,t){e.conf.date=t,this.renderCalendar(e.conf,e,!0)},scheduler._mini_cal_arrows=["&nbsp;","&nbsp;"],scheduler._render_calendar=function(e,t,a,r){
var n=scheduler.templates,i=this._cols;this._cols=[];var d=this._mode;this._mode="calendar";var l=this._colsS;this._colsS={height:0};var o=new Date(this._min_date),s=new Date(this._max_date),_=new Date(scheduler._date),c=n.month_day,u=this._ignores_detected;this._ignores_detected=0,n.month_day=n.calendar_date,t=this.date.month_start(t);var h,p=this._week_template(e.offsetWidth-1-this.config.minicalendar.padding);r?h=r:(h=document.createElement("div"),h.className="dhx_cal_container dhx_mini_calendar"),
h.setAttribute("date",this.templates.xml_format(t)),h.innerHTML="<div class='dhx_year_month'></div><div class='dhx_year_grid'><div class='dhx_year_week'>"+(p?p.innerHTML:"")+"</div><div class='dhx_year_body'></div></div>";var v=h.querySelector(".dhx_year_month"),m=h.querySelector(".dhx_year_week"),g=h.querySelector(".dhx_year_body");if(v.innerHTML=this.templates.calendar_month(t),a.navigation)for(var f=function(e,t){var a=scheduler.date.add(e._date,t,"month");scheduler.updateCalendar(e,a),scheduler._date.getMonth()==e._date.getMonth()&&scheduler._date.getFullYear()==e._date.getFullYear()&&scheduler._markCalendarCurrentDate(e);
},b=["dhx_cal_prev_button","dhx_cal_next_button"],y=["left:1px;top:2px;position:absolute;","left:auto; right:1px;top:2px;position:absolute;"],x=[-1,1],k=function(e){return function(){if(a.sync)for(var t=scheduler._synced_minicalendars,r=0;r<t.length;r++)f(t[r],e);else f(h,e)}},w=[scheduler.locale.labels.prev,scheduler.locale.labels.next],D=0;2>D;D++){var E=document.createElement("div");E.className=b[D],scheduler._waiAria.headerButtonsAttributes(E,w[D]),E.style.cssText=y[D],E.innerHTML=this._mini_cal_arrows[D],
v.appendChild(E),E.onclick=k(x[D])}h._date=new Date(t),h.week_start=(t.getDay()-(this.config.start_on_monday?1:0)+7)%7;var N=h._min_date=this.date.week_start(t);h._max_date=this.date.add(h._min_date,6,"week"),this._reset_month_scale(g,t,N,6),r||e.appendChild(h),m.style.height=m.childNodes[0].offsetHeight-1+"px";var M=scheduler.uid();scheduler._waiAria.minicalHeader(v,M),scheduler._waiAria.minicalGrid(h.querySelector(".dhx_year_grid"),M),scheduler._waiAria.minicalRow(m);for(var S=m.querySelectorAll(".dhx_scale_bar"),A=0;A<S.length;A++)scheduler._waiAria.minicalHeadCell(S[A]);
for(var O=g.querySelectorAll("td"),C=new Date(N),A=0;A<O.length;A++)scheduler._waiAria.minicalDayCell(O[A],new Date(C)),C=scheduler.date.add(C,1,"day");return scheduler._waiAria.minicalHeader(v,M),this._cols=i,this._mode=d,this._colsS=l,this._min_date=o,this._max_date=s,scheduler._date=_,n.month_day=c,this._ignores_detected=u,h},scheduler.destroyCalendar=function(e,t){!e&&this._def_count&&this._def_count.firstChild&&(t||(new Date).valueOf()-this._def_count._created.valueOf()>500)&&(e=this._def_count.firstChild),
e&&(e.onclick=null,e.innerHTML="",e.parentNode&&e.parentNode.removeChild(e),this._def_count&&(this._def_count.style.top="-1000px"),e.conf&&e.conf._on_xle_handler&&scheduler.detachEvent(e.conf._on_xle_handler))},scheduler.isCalendarVisible=function(){return this._def_count&&parseInt(this._def_count.style.top,10)>0?this._def_count:!1},scheduler._attach_minical_events=function(){dhtmlxEvent(document.body,"click",function(){scheduler.destroyCalendar()}),scheduler._attach_minical_events=function(){}},
scheduler.attachEvent("onTemplatesReady",function(){scheduler._attach_minical_events()}),scheduler.templates.calendar_time=scheduler.date.date_to_str("%d-%m-%Y"),scheduler.form_blocks.calendar_time={render:function(e){var t="<input class='dhx_readonly' type='text' readonly='true'>",a=scheduler.config,r=this.date.date_part(scheduler._currentDate()),n=1440,i=0;a.limit_time_select&&(i=60*a.first_hour,n=60*a.last_hour+1),r.setHours(i/60),e._time_values=[],t+=" <select class='dhx_lightbox_time_select'>";
for(var d=i;n>d;d+=1*this.config.time_step){var l=this.templates.time_picker(r);t+="<option value='"+d+"'>"+l+"</option>",e._time_values.push(d),r=this.date.add(r,this.config.time_step,"minute")}t+="</select>";scheduler.config.full_day;return"<div style='height:30px;padding-top:0; font-size:inherit;' class='dhx_section_time dhx_lightbox_minical'>"+t+"<span style='font-weight:normal; font-size:10pt;'> &nbsp;&ndash;&nbsp; </span>"+t+"</div>"},set_value:function(e,t,a,r){function n(e,t,a){_(e,t,a),e.value=scheduler.templates.calendar_time(t),
e._date=scheduler.date.date_part(new Date(t))}function i(e){for(var t=r._time_values,a=60*e.getHours()+e.getMinutes(),n=a,i=!1,d=0;d<t.length;d++){var l=t[d];if(l===a){i=!0;break}a>l&&(n=l)}return i||n?i?a:n:-1}var d,l,o=e.getElementsByTagName("input"),s=e.getElementsByTagName("select"),_=function(e,t,a){e.onclick=function(){scheduler.destroyCalendar(null,!0),scheduler.renderCalendar({position:e,date:new Date(this._date),navigation:!0,handler:function(t){e.value=scheduler.templates.calendar_time(t),
e._date=new Date(t),scheduler.destroyCalendar(),scheduler.config.event_duration&&scheduler.config.auto_end_date&&0===a&&p()}})}};if(scheduler.config.full_day){if(!e._full_day){var c="<label class='dhx_fullday'><input type='checkbox' name='full_day' value='true'> "+scheduler.locale.labels.full_day+"&nbsp;</label></input>";scheduler.config.wide_form||(c=e.previousSibling.innerHTML+c),e.previousSibling.innerHTML=c,e._full_day=!0}var u=e.previousSibling.getElementsByTagName("input")[0],h=0===scheduler.date.time_part(a.start_date)&&0===scheduler.date.time_part(a.end_date);
u.checked=h,s[0].disabled=u.checked,s[1].disabled=u.checked,u.onclick=function(){if(u.checked===!0){var t={};scheduler.form_blocks.calendar_time.get_value(e,t),d=scheduler.date.date_part(t.start_date),l=scheduler.date.date_part(t.end_date),(+l==+d||+l>=+d&&(0!==a.end_date.getHours()||0!==a.end_date.getMinutes()))&&(l=scheduler.date.add(l,1,"day"))}var r=d||a.start_date,i=l||a.end_date;n(o[0],r),n(o[1],i),s[0].value=60*r.getHours()+r.getMinutes(),s[1].value=60*i.getHours()+i.getMinutes(),s[0].disabled=u.checked,
s[1].disabled=u.checked}}if(scheduler.config.event_duration&&scheduler.config.auto_end_date){var p=function(){d=scheduler.date.add(o[0]._date,s[0].value,"minute"),l=new Date(d.getTime()+60*scheduler.config.event_duration*1e3),o[1].value=scheduler.templates.calendar_time(l),o[1]._date=scheduler.date.date_part(new Date(l)),s[1].value=60*l.getHours()+l.getMinutes()};s[0].onchange=p}n(o[0],a.start_date,0),n(o[1],a.end_date,1),_=function(){},s[0].value=i(a.start_date),s[1].value=i(a.end_date)},get_value:function(e,t){
var a=e.getElementsByTagName("input"),r=e.getElementsByTagName("select");return t.start_date=scheduler.date.add(a[0]._date,r[0].value,"minute"),t.end_date=scheduler.date.add(a[1]._date,r[1].value,"minute"),t.end_date<=t.start_date&&(t.end_date=scheduler.date.add(t.start_date,scheduler.config.time_step,"minute")),{start_date:new Date(t.start_date),end_date:new Date(t.end_date)}},focus:function(e){}},scheduler.linkCalendar=function(e,t){var a=function(){var a=scheduler._date,r=new Date(a.valueOf());
return t&&(r=t(r)),r.setDate(1),scheduler.updateCalendar(e,r),!0};scheduler.attachEvent("onViewChange",a),scheduler.attachEvent("onXLE",a),scheduler.attachEvent("onEventAdded",a),scheduler.attachEvent("onEventChanged",a),scheduler.attachEvent("onEventDeleted",a),a()},scheduler._markCalendarCurrentDate=function(e){var t=scheduler.getState(),a=t.min_date,r=t.max_date,n=t.mode,i=scheduler.date.month_start(new Date(e._date)),d=scheduler.date.add(i,1,"month"),l={month:!0,year:!0,agenda:!0,grid:!0};if(!(l[n]||a.valueOf()<=i.valueOf()&&r.valueOf()>=d.valueOf()))for(var o=a;o.valueOf()<r.valueOf();)i.valueOf()<=o.valueOf()&&d>o&&scheduler.markCalendar(e,o,"dhx_calendar_click"),
o=scheduler.date.add(o,1,"day")},scheduler.attachEvent("onEventCancel",function(){scheduler.destroyCalendar(null,!0)});
//# sourceMappingURL=../sources/ext/dhtmlxscheduler_minical.js.map