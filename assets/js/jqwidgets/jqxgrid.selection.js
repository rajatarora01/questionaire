/*
jQWidgets v4.5.0 (2017-Jan)
Copyright (c) 2011-2017 jQWidgets.
License: http://jqwidgets.com/license/
*/
!function(a){a.extend(a.jqx._jqxGrid.prototype,{selectallrows:function(){this._trigger=!1;var a=this.virtualmode?this.dataview.totalrecords:this.dataview.loadedrecords.length;this.selectedrowindexes=new Array;for(var b=this.dataview.loadedrecords,c=0;c<a;c++){var d=b[c];if(d){var e=this.getboundindex(d);void 0!=e&&(this.selectedrowindexes[c]=e)}else this.selectedrowindexes[c]=c}"checkbox"!=this.selectionmode||this._checkboxcolumnupdating||this._checkboxcolumn&&this._checkboxcolumn.checkboxelement.jqxCheckBox({checked:!0}),this._renderrows(this.virtualsizeinfo),this._trigger=!0,"checkbox"==this.selectionmode&&this._raiseEvent(2,{rowindex:this.selectedrowindexes})},unselectallrows:function(){this._trigger=!1;this.virtualmode?this.dataview.totalrecords:this.dataview.loadedrecords.length;this.selectedrowindexes=new Array,"checkbox"!=this.selectionmode||this._checkboxcolumnupdating||this._checkboxcolumn&&this._checkboxcolumn.checkboxelement.jqxCheckBox({checked:!1}),this._renderrows(this.virtualsizeinfo),this._trigger=!0,"checkbox"==this.selectionmode&&this._raiseEvent(2,{rowindex:this.selectedrowindexes})},selectrow:function(a,b){this._applyrowselection(a,!0,b),b!==!1&&this._updatecheckboxselection()},_updatecheckboxselection:function(){if("checkbox"==this.selectionmode){var a=this.getrows();if(a&&this._checkboxcolumn){if(0===a.length)return void this._checkboxcolumn.checkboxelement.jqxCheckBox({checked:!1});var b=a.length;this.groupable&&(b=this.dataview.loadedrecords.length),this.virtualmode&&(b=this.source._source.totalrecords);var c=this.selectedrowindexes.length;c===b?this._checkboxcolumn.checkboxelement.jqxCheckBox({checked:!0}):0===c?this._checkboxcolumn.checkboxelement.jqxCheckBox({checked:!1}):this._checkboxcolumn.checkboxelement.jqxCheckBox({checked:null})}}},unselectrow:function(a,b){this._applyrowselection(a,!1,b),b!==!1&&this._updatecheckboxselection()},selectcell:function(a,b){this._applycellselection(a,b,!0)},unselectcell:function(a,b){this._applycellselection(a,b,!1)},clearselection:function(a,b){if(this._trigger=!1,this.selectedrowindex=-1,this._oldselectedcell=null,b!==!1)for(var c=0;c<this.selectedrowindexes.length;c++)this._raiseEvent(3,{rowindex:this.selectedrowindexes[c]});return this.selectedrowindexes=new Array,this.selectedcells=new Array,this.selectedcell=null,"checkbox"!=this.selectionmode||this._checkboxcolumnupdating||this._checkboxcolumn.checkboxelement.jqxCheckBox({checked:!1}),!1===a?void(this._trigger=!0):(this._renderrows(this.virtualsizeinfo),this._trigger=!0,void("checkbox"==this.selectionmode&&this._raiseEvent(3,{rowindex:this.selectedrowindexes})))},getselectedrowindex:function(){if(this.selectedrowindex==-1||void 0==this.selectedrowindex)for(var a=0;a<this.selectedrowindexes.length;a++)return this.selectedrowindexes[a];return this.selectedrowindex},getselectedrowindexes:function(){return this.selectedrowindexes},getselectedcell:function(){if(!this.selectedcell)return null;var a=this.selectedcell;return a.row=this.selectedcell.rowindex,a.column=this.selectedcell.datafield,a.value=this.getcellvalue(a.row,a.column),a},getselectedcells:function(){var a=new Array;for(obj in this.selectedcells)a[a.length]=this.selectedcells[obj];return a},_getcellsforcopypaste:function(){var a=new Array;if(this.selectionmode.indexOf("cell")==-1)for(var b=this.selectedrowindexes,c=0;c<b.length;c++)for(var d=b[c],e=0;e<this.columns.records.length;e++)if("_checkboxcolumn"!==this.columns.records[e].datafield){var f=(d+"_"+this.columns.records[e].datafield,{rowindex:d,datafield:this.columns.records[e].datafield});a.push(f)}return a},deleteselection:function(){var a=this,b=a.getselectedcells();if(this.selectionmode.indexOf("cell")==-1&&(b=this._getcellsforcopypaste()),null!=b&&b.length>0){for(var c=0;c<b.length;c++){var d=b[c],e=a.getcolumn(d.datafield),f=a.getcellvalue(d.rowindex,d.datafield);if(e&&""!==f){var g=null;"checkbox"==e.columntype&&(e.threestatecheckbox||(g=!1)),a._raiseEvent(17,{rowindex:d.rowindex,datafield:d.datafield,value:f}),c==b.length-1?(a.setcellvalue(d.rowindex,d.datafield,g,!0),e.displayfield!=e.datafield&&a.setcellvalue(d.rowindex,e.displayfield,g,!0)):(a.setcellvalue(d.rowindex,d.datafield,g,!1),e.displayfield!=e.datafield&&a.setcellvalue(d.rowindex,e.displayfield,g,!0)),a._raiseEvent(18,{rowindex:d.rowindex,datafield:d.datafield,oldvalue:f,value:g})}}this.dataview.updateview(),this._renderrows(this.virtualsizeinfo)}},copyselection:function(){var b="",c=this;this.clipboardselection={},this.logicalclipboardselection={},this._clipboardselection=[];var d=c.getselectedcells();this.selectionmode.indexOf("cell")==-1&&(d=this._getcellsforcopypaste());var e=new Array;if(null!=d&&d.length>0){for(var f=999999999999999,g=-1,h=0;h<d.length;h++){var i=d[h],j=c.getcolumn(i.datafield);if(null!=j&&j.clipboard&&(!j.hidden||this.copytoclipboardhiddencolumns)){e.indexOf(j.text)==-1&&e.push(j.text);var k=c.getcelltext(i.rowindex,j.displayfield),l=this.getrowdisplayindex(i.rowindex);this.clipboardselection[l]||(this.clipboardselection[l]={}),this.clipboardselection[l][j.displayfield]=k,this.logicalclipboardselection[l]||(this.logicalclipboardselection[l]={}),this.logicalclipboardselection[l][j.displayfield]=k,j.displayfield!=j.datafield&&(this.logicalclipboardselection[l][j.datafield]=c.getcellvalue(i.rowindex,j.datafield)),f=Math.min(f,l),g=Math.max(g,l)}}for(var m=new Array,n=f;n<=g;n++)if(this.logicalclipboardselection[n]){var o=a.extend({},this.logicalclipboardselection[n]);m.push(o)}if(this.logicalclipboardselection=m,this.copytoclipboardwithheaders){for(var p=0;p<e.length;p++)p>0&&(b+="\t"),b+=e[p];b+="\r\n"}for(var n=f;n<=g;n++){var q=0;this._clipboardselection[this._clipboardselection.length]=new Array,void 0!=this.clipboardselection[n]&&(a.each(this.clipboardselection[n],function(a,d){q>0&&(b+="\t");var e=d;null==d&&(e=""),c._clipboardselection[c._clipboardselection.length-1][q]=e,q++,b+=e}),n<g&&(b+="\r\n"))}}return this.clipboardselectedtext=b,b},pasteselection:function(){var a=this.getselectedcells();if(this._oldselectedcell=null,this.selectionmode.indexOf("cell")==-1&&(a=this._getcellsforcopypaste()),null!=a&&a.length>0){var b=a[0].rowindex,c=this.getrowdisplayindex(b),d=a[0].datafield,e=this._getcolumnindex(d);this.selectedrowindexes=new Array,this.selectedcells=new Array;var f=(a.length,0),g=new Array;this.copytoclipboardwithheaders&&this._clipboardselection.splice(0,1);for(var h=0;h<this._clipboardselection.length;h++){f+=this._clipboardselection[h].length,g[h]=new Array;for(var i=0;i<this._clipboardselection[h].length;i++){var j=this._clipboardselection[h][i];g[h].push(j)}}if(f<a.length){for(var k=new Array,h=0;h<a.length;h++){var l=a[h];k[l.rowindex]||(k[l.rowindex]=new Array),k[l.rowindex].push(l)}for(var m=0,n=0,h=0;h<k.length;h++)if(k[h]){for(var i=0;i<k[h].length;i++){var l=k[h][i],o=l.rowindex,p=this.getcolumn(l.datafield);if("_checkboxcolumn"!==p.datafield&&!p.hidden){var j="";if(g[m][n]||(n=0),j=g[m][n],n++,p.cellsformat&&(p.cellsformat.indexOf("p")!=-1||p.cellsformat.indexOf("c")!=-1||p.cellsformat.indexOf("n")!=-1||p.cellsformat.indexOf("f")!=-1)){j.indexOf(this.gridlocalization.currencysymbol)>-1&&(j=j.replace(this.gridlocalization.currencysymbol,""));var q=function(a,b,c){var d=a;if(b==c)return a;for(var e=d.indexOf(b);e!=-1;)d=d.replace(b,c),e=d.indexOf(b);return d};j=q(j,this.gridlocalization.thousandsseparator,""),j=j.replace(this.gridlocalization.decimalseparator,"."),j.indexOf(this.gridlocalization.percentsymbol)>-1&&(j=j.replace(this.gridlocalization.percentsymbol,""));for(var r="",s=0;s<j.length;s++){var t=j.substring(s,s+1);"-"===t&&(r+="-"),"."===t&&(r+="."),null!=t.match(/^[0-9]+$/)&&(r+=t)}j=r,j=j.replace(/ /g,""),j=new Number(j),isNaN(j)&&(j="")}if(this._raiseEvent(17,{rowindex:o,datafield:l.datafield,value:j}),this.setcellvalue(o,p.displayfield,j,!1),p.displayfield!=p.datafield&&this.logicalclipboardselection&&this.logicalclipboardselection[o]){var u=this.logicalclipboardselection[o][p.datafield];void 0!=u&&this.setcellvalue(o,p.datafield,u,!1)}this._raiseEvent(18,{rowindex:o,datafield:l.datafield,oldvalue:this.getcellvalue(l.rowindex,l.datafield),value:j}),this._applycellselection(o,l.datafield,!0,!1)}}m++,g[m]||(m=0)}}else{if(!this._clipboardselection)return;for(var v=0;v<this._clipboardselection.length;v++)for(var w=0;w<this._clipboardselection[v].length;w++){var p=this.getcolumnat(e+w);if(p&&"_checkboxcolumn"!==p.datafield&&!p.hidden){var o=this.getrowboundindex(c+v),l=this.getcell(o,p.datafield),j=null;if(j=this._clipboardselection[v][w],null!=j){if(p.cellsformat&&(p.cellsformat.indexOf("p")!=-1||p.cellsformat.indexOf("c")!=-1||p.cellsformat.indexOf("n")!=-1||p.cellsformat.indexOf("f")!=-1)){j.indexOf(this.gridlocalization.currencysymbol)>-1&&(j=j.replace(this.gridlocalization.currencysymbol,""));var q=function(a,b,c){var d=a;if(b==c)return a;for(var e=d.indexOf(b);e!=-1;)d=d.replace(b,c),e=d.indexOf(b);return d};j=q(j,this.gridlocalization.thousandsseparator,""),j=j.replace(this.gridlocalization.decimalseparator,"."),j.indexOf(this.gridlocalization.percentsymbol)>-1&&(j=j.replace(this.gridlocalization.percentsymbol,""));for(var r="",s=0;s<j.length;s++){var t=j.substring(s,s+1);"-"===t&&(r+="-"),"."===t&&(r+="."),null!=t.match(/^[0-9]+$/)&&(r+=t)}j=r,j=j.replace(/ /g,""),j=new Number(j),isNaN(j)&&(j="")}if(this._raiseEvent(17,{rowindex:o,datafield:l.datafield,value:j}),this.setcellvalue(o,p.displayfield,j,!1),p.displayfield!=p.datafield&&this.logicalclipboardselection){var u=this.logicalclipboardselection[v][p.datafield];void 0!=u&&this.setcellvalue(o,p.datafield,u,!1)}this._raiseEvent(18,{rowindex:o,datafield:l.datafield,oldvalue:this.getcellvalue(l.rowindex,l.datafield),value:j}),this._applycellselection(o,l.datafield,!0,!1)}}}}"checkbox"==this.selectionmode&&this._updatecheckboxselection(),this.dataview.updateview(),this._renderrows(this.virtualsizeinfo)}this.clipboardend&&this.clipboardend("paste")},_applyrowselection:function(a,b,c,d,e){if(null==a)return!1;var f=this.selectedrowindex;if("singlerow"==this.selectionmode&&(b?this._raiseEvent(2,{rowindex:a,row:this.getrowdata(a)}):this._raiseEvent(3,{rowindex:a,row:this.getrowdata(a)}),this._raiseEvent(3,{rowindex:f}),this.selectedrowindexes=new Array,this.selectedcells=new Array),1==d&&(this.selectedrowindexes=new Array),this.dataview.filters.length>0){var g=this.getrowdata(a);g&&void 0!==g.dataindex?a=g.dataindex:g&&void 0===g.dataindex&&void 0!=g.uid&&(a=this.getrowboundindexbyid(g.uid))}var h=this.selectedrowindexes.indexOf(a);if(b)this.selectedrowindex=a,h==-1?(this.selectedrowindexes.push(a),"singlerow"!=this.selectionmode&&this._raiseEvent(2,{rowindex:a,row:this.getrowdata(a)})):"multiplerows"==this.selectionmode&&(this.selectedrowindexes.splice(h,1),this._raiseEvent(3,{rowindex:this.selectedrowindex,row:this.getrowdata(a)}),this.selectedrowindex=this.selectedrowindexes.length>0?this.selectedrowindexes[this.selectedrowindexes.length-1]:-1);else if(h>=0||"singlerow"==this.selectionmode||"multiplerowsextended"==this.selectionmode||"multiplerowsadvanced"==this.selectionmode){var i=this.selectedrowindexes[h];this.selectedrowindexes.splice(h,1),this._raiseEvent(3,{rowindex:i,row:this.getrowdata(a)}),this.selectedrowindex=-1}return(void 0==c||c)&&this._rendervisualrows(),!0},_applycellselection:function(a,b,c,d){if(null==a)return!1;if(null==b)return!1;this.selectedrowindex;if("singlecell"==this.selectionmode){var e=this.selectedcell;null!=e&&this._raiseEvent(16,{rowindex:e.rowindex,datafield:e.datafield}),this.selectedcells=new Array}if("multiplecellsextended"==this.selectionmode||"multiplecellsadvanced"==this.selectionmode){var e=this.selectedcell;null!=e&&this._raiseEvent(16,{rowindex:e.rowindex,datafield:e.datafield})}var f=a+"_"+b;if(this.dataview.filters.length>0){var g=this.getrowdata(a);if(g&&void 0!==g.dataindex){a=g.dataindex;var f=a+"_"+b}else if(g&&void 0===g.dataindex&&g.uid){a=this.getrowboundindexbyid(g.uid);var f=a+"_"+b}}var h={rowindex:a,datafield:b};return c?(this.selectedcell=h,this.selectedcells[f]?"multiplecells"!=this.selectionmode&&"multiplecellsextended"!=this.selectionmode&&"multiplecellsadvanced"!=this.selectionmode||(delete this.selectedcells[f],this.selectedcells.length>0&&this.selectedcells.length--,this._raiseEvent(16,h)):(this.selectedcells[f]=h,this.selectedcells.length++,this._raiseEvent(15,h))):(delete this.selectedcells[f],this.selectedcells.length>0&&this.selectedcells.length--,this._raiseEvent(16,h)),(void 0==d||d)&&this._rendervisualrows(),!0},_getcellindex:function(b){var c=-1;return a.each(this.selectedcells,function(){if(c++,this[b])return!1}),c},_clearhoverstyle:function(){if(void 0!=this.hoveredrow&&this.hoveredrow!=-1&&!this.vScrollInstance.isScrolling()&&!this.hScrollInstance.isScrolling()){var a=this.table.find(".jqx-grid-cell-hover");a.length>0&&(a.removeClass(this.toTP("jqx-grid-cell-hover")),a.removeClass(this.toTP("jqx-fill-state-hover"))),this.hoveredrow=-1}},_clearselectstyle:function(){for(var b=this.table[0].rows.length,c=this.table[0].rows,d=this.toTP("jqx-grid-cell-selected"),e=this.toTP("jqx-fill-state-pressed"),f=this.toTP("jqx-grid-cell-hover"),g=this.toTP("jqx-fill-state-hover"),h=0;h<b;h++)for(var i=c[h],j=i.cells.length,k=i.cells,l=0;l<j;l++){var m=k[l],n=a(m);m.className.indexOf("jqx-grid-cell-selected")!=-1&&(n.removeClass(d),n.removeClass(e)),m.className.indexOf("jqx-grid-cell-hover")!=-1&&(n.removeClass(f),n.removeClass(g))}},_selectpath:function(a,b){var c=this,d=this._lastClickedCell?Math.min(this._lastClickedCell.row,a):0,e=this._lastClickedCell?Math.max(this._lastClickedCell.row,a):0;if(d<=e){var f=this._getcolumnindex(this._lastClickedCell.column),g=this._getcolumnindex(b),h=Math.min(f,g),i=Math.max(f,g);this.selectedcells=new Array;for(var j=this.dataview.loadedrecords,k=d;k<=e;k++)for(var l=h;l<=i;l++){var a=j[k];this._applycellselection(c.getboundindex(a),c._getcolumnat(l).datafield,!0,!1)}this._rendervisualrows()}},_selectrowpath:function(a){if("multiplerowsextended"==this.selectionmode){var b=this._lastClickedCell?Math.min(this._lastClickedCell.row,a):0,c=this._lastClickedCell?Math.max(this._lastClickedCell.row,a):0,d=this.dataview.loadedrecords;if(b<=c){this.selectedrowindexes=new Array;for(var e=b;e<=c;e++){var a=d[e],f=this.getrowboundindex(e);this._applyrowselection(f,!0,!1)}this._rendervisualrows()}}},_selectrowwithmouse:function(a,b,c,d,e,f){var g=b.row;if(void 0!=g){var h=b.index;if(void 0!=this.hittestinfo[h]){var i=this.hittestinfo[h].visualrow;if(!this.hittestinfo[h].details){i.cells[0].className;if(!g.group){if("multiplerows"==this.selectionmode||"multiplecells"==this.selectionmode||"checkbox"==this.selectionmode||this.selectionmode.indexOf("multiple")!=-1&&(1==f||1==e)){var j=this.getboundindex(g);if(this.dataview.filters.length>0){var k=this.getrowdata(j);if(k&&(j=k.dataindex,void 0==j))var j=this.getboundindex(g)}var l=c.indexOf(j)!=-1,m=this.getboundindex(g)+"_"+d;if(this.selectionmode.indexOf("cell")!=-1){var n=void 0!=this.selectedcells[m];if(void 0!=this.selectedcells[m]&&n?this._selectcellwithstyle(a,!1,h,d,i):this._selectcellwithstyle(a,!0,h,d,i),f&&void 0==this._lastClickedCell){var o=this.getselectedcells();o&&o.length>0&&(this._lastClickedCell={row:o[0].rowindex,column:o[0].datafield})}f&&this._lastClickedCell&&(this._selectpath(g.visibleindex,d),this.mousecaptured=!1,"visible"==this.selectionarea.css("visibility")&&this.selectionarea.css("visibility","hidden"))}else{if(l?e?this._applyrowselection(this.getboundindex(g),!1):this._selectrowwithstyle(a,i,!1,d):this._selectrowwithstyle(a,i,!0,d),f&&void 0==this._lastClickedCell){var p=this.getselectedrowindexes();p&&p.length>0&&(this._lastClickedCell={row:p[0],column:d})}if(f&&this._lastClickedCell){this.selectedrowindexes=new Array;for(var q=this._lastClickedCell?Math.min(this._lastClickedCell.row,g.visibleindex):0,r=this._lastClickedCell?Math.max(this._lastClickedCell.row,g.visibleindex):0,s=this.dataview.loadedrecords,t=q;t<=r;t++){var g=s[t];g&&this._applyrowselection(this.getboundindex(g),!0,!1,!1)}this._rendervisualrows()}}}else this._clearselectstyle(),this._selectrowwithstyle(a,i,!0,d),this.selectionmode.indexOf("cell")!=-1&&this._selectcellwithstyle(a,!0,h,d,i);f||(this._lastClickedCell={row:g.visibleindex,column:d})}}}}},_selectcellwithstyle:function(b,c,d,e,f){var g=a(f.cells[b._getcolumnindex(e)]);g.removeClass(this.toTP("jqx-grid-cell-hover")),g.removeClass(this.toTP("jqx-fill-state-hover")),c?(g.addClass(this.toTP("jqx-grid-cell-selected")),g.addClass(this.toTP("jqx-fill-state-pressed"))):(g.removeClass(this.toTP("jqx-grid-cell-selected")),g.removeClass(this.toTP("jqx-fill-state-pressed")))},_selectrowwithstyle:function(b,c,d,e){var f=c.cells.length,g=0;b.rowdetails&&b.showrowdetailscolumn?this.rtl?(f-=1,f-=this.groups.length):g=1+this.groups.length:this.groupable&&(this.rtl?f-=this.groups.length:g=this.groups.length);for(var h=g;h<f;h++){var i=c.cells[h];d?(a(i).removeClass(this.toTP("jqx-grid-cell-hover")),a(i).removeClass(this.toTP("jqx-fill-state-hover")),b.selectionmode.indexOf("cell")==-1&&(a(i).addClass(this.toTP("jqx-grid-cell-selected")),a(i).addClass(this.toTP("jqx-fill-state-pressed")))):(a(i).removeClass(this.toTP("jqx-grid-cell-hover")),a(i).removeClass(this.toTP("jqx-grid-cell-selected")),a(i).removeClass(this.toTP("jqx-fill-state-hover")),a(i).removeClass(this.toTP("jqx-fill-state-pressed")))}},_handlemousemoveselection:function(b,c){if(c.hScrollInstance.isScrolling()||c.vScrollInstance.isScrolling())return!1;if(("multiplerowsextended"==c.selectionmode||"multiplecellsextended"==c.selectionmode||"multiplecellsadvanced"==c.selectionmode)&&c.mousecaptured){if(c.multipleselectionbegins){var d=c.multipleselectionbegins(b);if(d===!1)return!0}var e=this.showheader?this.columnsheader.height()+2:0,f=this._groupsheader()?this.groupsheader.height():0,g=this.showtoolbar?this.toolbar.height():0;f+=g;var h=this.host.coord();if(this.hasTransform){h=a.jqx.utilities.getOffset(this.host);var i=this._getBodyOffset();h.left-=i.left,h.top-=i.top}"0px"===this.host.css("border-top-width")&&(f-=2);var j=b.pageX,k=b.pageY-f;if(Math.abs(this.mousecaptureposition.left-j)>3||Math.abs(this.mousecaptureposition.top-k)>3){var l=parseInt(this.columnsheader.coord().top);this.hasTransform&&(l=a.jqx.utilities.getOffset(this.columnsheader).top),j<h.left&&(j=h.left),j>h.left+this.host.width()&&(j=h.left+this.host.width());var m=h.top+e;k<m&&(k=m+5);var n=parseInt(Math.min(c.mousecaptureposition.left,j)),o=-5+parseInt(Math.min(c.mousecaptureposition.top,k)),p=parseFloat(Math.abs(c.mousecaptureposition.left-j)),q=parseInt(Math.abs(c.mousecaptureposition.top-k));if(n-=h.left,o-=h.top,this.selectionarea.css("visibility","visible"),"multiplecellsadvanced"==c.selectionmode){var j=n,r=j+p,s=c.hScrollInstance,t=s.value;this.rtl&&("hidden"!=this.hScrollBar.css("visibility")&&(t=s.max-s.value),"hidden"!=this.vScrollBar[0].style.visibility);var u=c.table[0].rows[0],v=0,w=c.mousecaptureposition.clickedcell,x=w,y=!1,z=0,A=u.cells.length;c.mousecaptureposition.left<=b.pageX&&(z=w);for(var B=!1,C=z;C<A;C++){var D=parseFloat(a(this.columnsrow[0].cells[C]).css("left")),E=D-t;if(!c.columns.records[C].pinned||c.columns.records[C].hidden){if(B){y=!0,x--;break}var F=this._getcolumnat(C);if(!(null!=F&&F.hidden||c.groupable&&c.groups.length>0&&C<c.groups.length)){var G=E+a(this.columnsrow[0].cells[C]).width();if(c.mousecaptureposition.left>b.pageX){if(G>=j&&j>=E){x=C,y=!0;break}}else if(G>=r&&r>=E){x=C,y=!0;break}}}else{C==w&&(B=!0);var G=D+a(this.columnsrow[0].cells[C]).width();if(c.mousecaptureposition.left>b.pageX){if(G>=j&&j>=E){x=C,y=!0;break}}else if(G>=r&&r>=E){x=C,y=!0;break}}}y||(c.mousecaptureposition.left>b.pageX?a.each(this.columns.records,function(a,b){return!!(c.groupable&&c.groups.length>0&&a<c.groups.length)||(this.pinned||this.hidden?void 0:(x=a,!1))}):(!c.groupable||c.groupable&&!c.groups.length>0)&&(x=u.cells.length-1));var H=w;w=Math.min(w,x),x=Math.max(H,x),o+=5,o+=f;for(var I=(c.table[0].rows.indexOf(c.mousecaptureposition.clickedrow),0),J=-1,K=-1,L=0,C=0;C<c.table[0].rows.length;C++){var M=a(c.table[0].rows[C]);0==C&&(L=M.coord().top);var N=M.height(),O=L-h.top;if(J==-1&&O+N>=o){for(var P=!1,Q=0;Q<c.groups.length;Q++){var R=M[0].cells[Q].className;if(R.indexOf("jqx-grid-group-collapse")!=-1||R.indexOf("jqx-grid-group-expand")!=-1){P=!0;break}}if(P)continue;J=C}if(L+=N,c.groupable&&c.groups.length>0){for(var P=!1,Q=0;Q<c.groups.length;Q++){var R=M[0].cells[Q].className;if(R.indexOf("jqx-grid-group-collapse")!=-1||R.indexOf("jqx-grid-group-expand")!=-1){P=!0;break}}if(P)continue;for(var v=0,S=c.groups.length;S<M[0].cells.length;S++){var T=M[0].cells[S];""==a(T).html()&&v++}if(v==M[0].cells.length-c.groups.length)continue}if(J!=-1&&(I+=N),O+N>o+q){K=C;break}}if(J!=-1){o=a(c.table[0].rows[J]).coord().top-h.top-f-2;var U=0;this.filterable&&this.showfilterrow&&(U=this.filterrowheight),parseFloat(c.table[0].style.top)<0&&o<this.rowsheight+U&&(o-=parseFloat(c.table[0].style.top),I+=parseFloat(c.table[0].style.top)),q=I;var V=a(this.columnsrow[0].cells[w]),W=a(this.columnsrow[0].cells[x]);if(n=parseFloat(V.css("left")),p=parseFloat(W.css("left"))-parseFloat(n)+W.width()-2,n-=t,B&&(n+=t),c.editcell&&c.editable&&c.endcelledit&&(w!=x||J!=K)){if(0==c.editcell.validated)return;c.endcelledit(c.editcell.row,c.editcell.column,!0,!0)}}}this.selectionarea.width(p),this.selectionarea.height(q),this.selectionarea.css("left",n),this.selectionarea.css("top",o)}}},_handlemouseupselection:function(b,c){if(this.selectionarea){if("visible"!=this.selectionarea[0].style.visibility)return c.mousecaptured=!1,!0;if(c.mousecaptured&&("multiplerowsextended"==c.selectionmode||"multiplerowsadvanced"==c.selectionmode||"multiplecellsextended"==c.selectionmode||"multiplecellsadvanced"==c.selectionmode)&&(c.mousecaptured=!1,"visible"==this.selectionarea.css("visibility"))){this.selectionarea.css("visibility","hidden");var d=this.showheader?this.columnsheader.height()+2:0,e=this._groupsheader()?this.groupsheader.height():0;"0px"===this.host.css("border-top-width")&&(e-=2);var f=this.showtoolbar?this.toolbar.height():0;e+=f;var g=this.selectionarea.coord(),h=this.host.coord();this.hasTransform&&(h=a.jqx.utilities.getOffset(this.host),g=a.jqx.utilities.getOffset(this.selectionarea)),"0px"===this.host.css("border-top-width")&&(e-=2);var i=g.left-h.left,j=g.top-d-h.top-e,k=j,l=i+this.selectionarea.width(),m=i,n=new Array,o=new Array;if("multiplerowsextended"==c.selectionmode){for(;j<k+this.selectionarea.height();){var p=this._hittestrow(i,j),q=p.row,r=p.index;r!=-1&&(o[r]||(o[r]=!0,n[n.length]=p)),j+=20}var k=0;a.each(n,function(){var a=this.row;"none"!=c.selectionmode&&c._selectrowwithmouse&&(b.ctrlKey||b.metaKey?c._applyrowselection(c.getboundindex(a),!0,!1,!1):0==k?c._applyrowselection(c.getboundindex(a),!0,!1,!0):c._applyrowselection(c.getboundindex(a),!0,!1,!1),k++)})}else{"multiplecellsadvanced"==c.selectionmode&&(j+=2);var s=c.hScrollInstance,t=s.value;this.rtl&&("hidden"!=this.hScrollBar.css("visibility")&&(t=s.max-s.value),"hidden"!=this.vScrollBar[0].style.visibility&&(t-=this.scrollbarsize+4));var u=c.table[0].rows[0],v=c.selectionarea.height();!b.ctrlKey&&!b.metaKey&&v>0&&(c.selectedcells=new Array);for(var w=v;j<k+w;){var p=c._hittestrow(i,j);if(p){var q=p.row,r=p.index;if(r!=-1&&!o[r]){o[r]=!0;for(var x=0;x<u.cells.length;x++){var y=parseFloat(a(c.columnsrow[0].cells[x]).css("left"))-t,z=y+a(c.columnsrow[0].cells[x]).width();(m>=y&&m<=z||l>=y&&l<=z||y>=m&&y<=l)&&c._applycellselection(c.getboundindex(q),c._getcolumnat(x).datafield,!0,!1)}}j+=5}else j+=5}}c.autosavestate&&c.savestate&&c.savestate(),c._renderrows(c.virtualsizeinfo)}}},selectprevcell:function(a,b){var c=this._getcolumnindex(b),d=(this.columns.records.length,this._getprevvisiblecolumn(c));null!=d&&(this.clearselection(),this.selectcell(a,d.datafield))},selectnextcell:function(a,b){var c=this._getcolumnindex(b),d=(this.columns.records.length,this._getnextvisiblecolumn(c));null!=d&&(this.clearselection(),this.selectcell(a,d.datafield))},_getfirstvisiblecolumn:function(){for(var a=this.columns.records.length,b=0;b<a;b++){var c=this.columns.records[b];if(!c.hidden&&null!=c.datafield)return c}return null},_getlastvisiblecolumn:function(){for(var a=this.columns.records.length,b=a-1;b>=0;b--){var c=this.columns.records[b];if(!c.hidden&&null!=c.datafield)return c}return null},_handlekeydown:function(b,c){if(c.groupable&&c.groups.length>0,c.disabled)return!1;var d=b.charCode?b.charCode:b.keyCode?b.keyCode:0;if(c.editcell&&"multiplecellsadvanced"!=c.selectionmode)return!0;if(c.editcell&&"multiplecellsadvanced"==c.selectionmode){if(!(d>=33&&d<=40))return!0;if(b.altKey)return c._cancelkeydown=!1,!0;if(void 0!=c._cancelkeydown&&0!=c._cancelkeydown)return c._cancelkeydown=!1,!0;if("selectedrow"===c.editmode)return!0;if(c.endcelledit(c.editcell.row,c.editcell.column,!1,!0),c._cancelkeydown=!1,c.editcell&&!c.editcell.validated)return c._rendervisualrows(),c.endcelledit(c.editcell.row,c.editcell.column,!1,!0),!1}if("none"==c.selectionmode)return!0;if(c.showfilterrow&&c.filterable&&this.filterrow&&a(b.target).ischildof(c.filterrow))return!0;if(c.showeverpresentrow){if(c.addnewrowtop&&a(b.target).ischildof(c.addnewrowtop))return!0;if(c.addnewrowbottom&&a(b.target).ischildof(c.addnewrowbottom))return!0}if(b.target.className&&b.target.className.indexOf("jqx-grid-widget")>=0)return!0;if(c.pageable&&a(b.target).ischildof(this.pager))return!0;if(this.showtoolbar&&a(b.target).ischildof(this.toolbar))return!0;if(this.showstatusbar&&a(b.target).ischildof(this.statusbar))return!0;var e=!1;if(b.altKey)return!0;if((b.ctrlKey||b.metaKey)&&this.clipboard){var f=String.fromCharCode(d).toLowerCase();if(this.clipboardbegin){var g=null;if("c"==f?g=this.clipboardbegin("copy",this.copyselection()):"x"==f?g=this.clipboardbegin("cut",this.copyselection()):"v"==f&&(g=this.clipboardbegin("paste")),g===!1)return!1}if("c"==f||"x"==f){var h=this.copyselection();if("c"==f&&this.clipboardend&&this.clipboardend("copy"),"x"==f&&this.clipboardend&&this.clipboardend("cut"),window.clipboardData)window.clipboardData.setData("Text",h);else{var i=a('<textarea style="position: absolute; left: -1000px; top: -1000px;"/>');i.val(h),a("body").append(i),i.select(),setTimeout(function(){document.designMode="off",i.select(),i.remove(),c.focus()},100)}if("c"==f&&a.jqx.browser.msie)return!1;if("c"==f)return!0}else if("v"==f){var j=a('<textarea style="position: absolute; left: -1000px; top: -1000px;"/>');a("body").append(j),j.select();var k=this;return setTimeout(function(){k._clipboardselection=new Array;var a=j.val();if(0==a.length&&window.clipboardData){j.val(window.clipboardData.getData("Text"));var a=j.val()}for(var b=a.split("\n"),c=0;c<b.length;c++)if(b[c].split("\t").length>0){var d=b[c].split("\t");if(1==d.length&&c==b.length-1&&""==d[0])continue;d.length>0&&k._clipboardselection.push(d)}k.pasteselection(),j.remove(),k.focus()},100),!0}if("x"==f)return this.deleteselection(),this.host.focus(),!1}var l=Math.round(c._gettableheight()),m=Math.round(l/c.rowsheight),n=c.getdatainformation();switch(c.selectionmode){case"singlecell":case"multiplecells":case"multiplecellsextended":case"multiplecellsadvanced":var o=c.getselectedcell();if(null!=o){var p=this.getrowvisibleindex(o.rowindex),q=p,r=o.datafield,s=c._getcolumnindex(r),t=(c.columns.records.length,function(a,d,f,g){var h=function(a,b){var d=c.dataview.loadedrecords[a];if(c.groupable&&c.groups.length>0){var h=a;"up"==g&&h++,"down"==g&&h--;for(var d=c.getdisplayrows()[h],i=function(a){return!!a.group&&(c.expandedgroups[a.uniqueid]?c.expandedgroups[a.uniqueid].expanded:void 0)},j=1,k=!0;k&&j<300&&(k=!1,"down"==g?d=c.getdisplayrows()[h+j]:"up"==g&&(d=c.getdisplayrows()[h-j]),d);){d&&d.group&&(k=!0);for(var l=d.parentItem;l;)l&&!i(l)&&(k=!0),l=l.parentItem;if(!k)break;j++}if(300==j&&(d=null),c.pageable){var m=!1;if(d){for(var n=0;n<c.dataview.rows.length;n++)c.dataview.rows[n].boundindex==d.boundindex&&(m=!0);m||(d=null)}}}if(void 0!=d&&null!=b){(f||void 0==f)&&c.clearselection();var o=c.getboundindex(d);return c.selectcell(o,b),c._oldselectedcell=c.selectedcell,e=!0,c.ensurecellvisible(a,b),!0}return!1};h(a,d)||(c.ensurecellvisible(a,d),h(a,d),c.virtualmode&&c.host.focus());var i=c.groupable&&c.groups.length>0;if(!i)if(b.shiftKey&&9!=b.keyCode){if(("multiplecellsextended"==c.selectionmode||"multiplecellsadvanced"==c.selectionmode)&&c._lastClickedCell){c._selectpath(a,d);var j=c.dataview.loadedrecords[a],k=c.getboundindex(j);return void(c.selectedcell={rowindex:k,datafield:d})}}else b.shiftKey||(c._lastClickedCell={row:a,column:d})}),u=b.shiftKey&&"singlecell"!=c.selectionmode&&"multiplecells"!=c.selectionmode,v=function(){t(0,r,!u)},w=function(){var a=n.rowscount-1;t(a,r,!u)},x=9==d&&!b.shiftKey,y=9==d&&b.shiftKey;if(c.rtl){var z=x;x=y,y=z}if((x||y)&&(u=!1),(x||y)&&document.activeElement&&document.activeElement.className&&document.activeElement.className.indexOf("jqx-grid-cell-add-new-row")>=0)return!0;var A=b.ctrlKey||b.metaKey;if(A&&37==d){var B=c._getfirstvisiblecolumn(s);null!=B&&t(q,B.datafield)}else if(A&&39==d){var C=c._getlastvisiblecolumn(s);null!=C&&t(q,C.datafield)}else if(39==d||x){var D=c._getnextvisiblecolumn(s);if(null!=D)t(q,D.datafield,!u);else if(x){var E=c._getfirstvisiblecolumn();d=40,r=E.displayfield}else e=!0}else if(37==d||y){var B=c._getprevvisiblecolumn(s);if(null!=B)t(q,B.datafield,!u);else if(y){var F=c._getlastvisiblecolumn();d=38,r=F.displayfield}else e=!0}else if(36==d)v();else if(35==d)w();else if(33==d)if(q-m>=0){var G=q-m;t(G,r,!u)}else v();else if(34==d)if(n.rowscount>q+m){var G=q+m;t(G,r,!u)}else w();38==d&&(A?v():q>0?t(q-1,r,!u,"up"):e=!0),40==d&&(A?w():n.rowscount>q+1||c.groupable&&c.groups.length>0?t(q+1,r,!u,"down"):e=!0)}break;case"singlerow":case"multiplerows":case"multiplerowsextended":case"multiplerowsadvanced":var q=c.getselectedrowindex();if(null==q||q==-1)return!0;q=this.getrowvisibleindex(q);var H=function(a,f,g){var h=function(a){var b=c.dataview.loadedrecords[a];if(c.groupable&&c.groups.length>0){"up"==g&&a++,"down"==g&&a--;for(var b=c.getdisplayrows()[a],d=function(a){return!!a.group&&(c.expandedgroups[a.uniqueid]?c.expandedgroups[a.uniqueid].expanded:void 0)},h=1,i=!0;i&&h<300&&(i=!1,"down"==g?b=c.getdisplayrows()[a+h]:"up"==g&&(b=c.getdisplayrows()[a-h]),b);){b&&b.group&&(i=!0);for(var j=b.parentItem;j;)j&&!d(j)&&(i=!0),j=j.parentItem;if(!i)break;h++}if(300==h&&(b=null),c.pageable){var k=!1;if(b){for(var l=0;l<c.dataview.rows.length;l++)c.dataview.rows[l].boundindex==b.boundindex&&(k=!0);k||(b=null)}}}if(void 0!=b){var m=c.getboundindex(b),n=c.selectedrowindex;(f||void 0==f)&&c.clearselection(),c.selectedrowindex=n,c.selectrow(m,!1);var o=c.ensurerowvisible(a);return(!o||c.autoheight||c.groupable)&&c._rendervisualrows(),e=!0,!0}return!1};h(a)||(c.ensurerowvisible(a),h(a,f),c.virtualmode&&setTimeout(function(){h(a,f)},25),c.virtualmode&&c.host.focus());var i=c.groupable&&c.groups.length>0;if(!i)if(b.shiftKey&&9!=d){if("multiplerowsextended"==c.selectionmode&&c._lastClickedCell)return c._selectrowpath(a),void(c.selectedrowindex=c.getrowboundindex(a))}else b.shiftKey||(c._lastClickedCell={row:a},c.selectedrowindex=c.getrowboundindex(a))},u=b.shiftKey&&"singlerow"!=c.selectionmode&&"multiplerows"!=c.selectionmode,v=function(){H(0,!u)},w=function(){var a=n.rowscount-1;H(a,!u)},A=b.ctrlKey||b.metaKey;if(36==d||A&&38==d)v();else if(35==d||A&&40==d)w();else if(33==d)if(q-m>=0){var G=q-m;H(G,!u)}else v();else if(34==d)if(n.rowscount>q+m){var G=q+m;H(G,!u)}else w();else 38==d?q>0?H(q-1,!u,"up"):e=!0:40==d&&(n.rowscount>q+1||c.groupable&&c.groups.length>0?H(q+1,!u,"down"):e=!0)}return!e||(c.autosavestate&&c.savestate&&c.savestate(),!1)},_handlemousemove:function(b,c){if(!c.vScrollInstance.isScrolling()&&!c.hScrollInstance.isScrolling()){var d,e,f,g,h;if(c.enablehover||"multiplerows"==c.selectionmode){d=this.showheader?this.columnsheader.height()+2:0,e=this._groupsheader()?this.groupsheader.height():0;
var i=this.showtoolbar?this.toolbarheight:0;if(e+=i,f=this.host.coord(),this.hasTransform){f=a.jqx.utilities.getOffset(this.host);var j=this._getBodyOffset();f.left-=j.left,f.top-=j.top}g=b.pageX-f.left,h=b.pageY-d-f.top-e}if("multiplerowsextended"!=c.selectionmode&&"multiplecellsextended"!=c.selectionmode&&"multiplecellsadvanced"!=c.selectionmode||1!=c.mousecaptured){if(!c.enablehover)return!0;if(!c.disabled&&!this.vScrollInstance.isScrolling()&&!this.hScrollInstance.isScrolling()){var k=this._hittestrow(g,h);if(k){var l=k.row,m=k.index;if((this.hoveredrow==-1||m==-1||this.hoveredrow!=m||this.selectionmode.indexOf("cell")!=-1||"checkbox"==this.selectionmode)&&(this._clearhoverstyle(),m!=-1&&void 0!=l)){var n=this.hittestinfo[m].visualrow;if(null!=n&&!(this.hittestinfo[m].details||b.clientX>a(n).width()+a(n).coord().left)){var o=0,p=n.cells.length;if(c.rowdetails&&c.showrowdetailscolumn?this.rtl?(p-=1,p-=this.groups.length):o=1+this.groups.length:this.groupable&&(this.rtl?p-=this.groups.length:o=this.groups.length),0!=n.cells.length){var q=n.cells[o].className;if(!(l.group||this.selectionmode.indexOf("row")>=0&&q.indexOf("jqx-grid-cell-selected")!=-1))if(this.hoveredrow=m,this.selectionmode.indexOf("cell")==-1&&"checkbox"!=this.selectionmode)for(var r=o;r<p;r++){var s=n.cells[r];a(s).addClass(this.toTP("jqx-grid-cell-hover")),a(s).addClass(this.toTP("jqx-fill-state-hover")),this.cellhover&&this.cellhover(s,b.pageX,b.pageY)}else{var t=-1,u=this.hScrollInstance,v=u.value;this.rtl&&"hidden"!=this.hScrollBar.css("visibility")&&(v=u.max-u.value);for(var r=o;r<p;r++){var w=parseInt(a(this.columnsrow[0].cells[r]).css("left"))-v;this.columns.records[r].pinned&&!this.rtl&&(w=parseInt(a(this.columnsrow[0].cells[r]).css("left")));var x=w+a(this.columnsrow[0].cells[r]).width();if(x>=g&&g>=w){t=r;break}}if(t!=-1){var s=n.cells[t];if(this.cellhover&&this.cellhover(s,b.pageX,b.pageY),s.className.indexOf("jqx-grid-cell-selected")==-1){if(this.editcell){var y=this._getcolumnat(t);if(y&&this.editcell.row==m&&this.editcell.column==y.datafield)return}a(s).addClass(this.toTP("jqx-grid-cell-hover")),a(s).addClass(this.toTP("jqx-fill-state-hover"))}}}}}}}}}}}})}(jqxBaseFramework);

