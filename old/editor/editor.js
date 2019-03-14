/*---------------------------------------------------------------------------*\
|  Subject:       小小菜刀编辑器 HtmlEditor                                   |
|  Version:       2.0                                                         |
|-----------------------------------------------------------------------------|
|  QQ: 275171   http://www.1715.cn                                            |
|  blueidea.com ID: blgl0528 im286.com ID: blgl1984                           |
\*---------------------------------------------------------------------------*/

var CD = {};
CD.g = {};
CD.lang = {
    items : [
		 ["bold","0","19","0 0 0 2px;","","加粗"]
		,["italic","20","20","0","","斜体"]
		,["underline","40","20","0","","下划线"]
		,["-","320","3","-1px 3px 0 4px","","间隔线"]
		,["fontname","60","20","0 2px","","选择字体"]
		,["fontsize","80","21","0 2px","","字体大小"]
		,["forecolor","240","20","0 2px","","字体颜色"]
		,["backcolor","260","20","0 2px","","背景颜色"]
		,["-","320","3","-1px 3px 0 1px","","间隔线"]
		,["picture","322","22","0","","插入图片"]
		,["createlink","280","22","0","","增加链接"]
		,["-","320","3","-1px 4px 0 2px","","间隔线"]
		,["alignmode","427","21","0 4px 0 0","","对齐方式"]
		,["serial","449","22","0 4px 0 0","","编号"]
		,["indent","470","22","0 4px 0 0","","缩进"]
    ],
    font : [
		 ["宋体","宋体"]
		,["黑体","黑体"]
		,["楷体_GB2312","楷书"]
		,["幼圆","幼圆"]
		,["Arial","Arial"]
		,["Arial Black","Arial Black"]
		,["Times New Roman","Times New Roman"]
		,["Verdana","Verdana"]
    ],
    size : [
		 [1,"10px;line-height:12px;height:12px;","小"]
		,[2,"14px;line-height:16px;height:16px;","中"]
		,[4,"16px;line-height:18px;height:18px;","大"]
		,[5,"22px;line-height:24px;height:24px;","较大"]
		,[6,"30px;line-height:32px;height:32px;","最大"]
    ],
	color : [
		 ['000000'],['993300'],['333300'],['003300'],['003366'],['000080'],['333399'],['333333']
		,['800000'],['FF6600'],['808000'],['008000'],['008080'],['0000FF'],['666699'],['808080']
		,['FF0000'],['FF9900'],['99CC00'],['339966'],['33CCCC'],['3366FF'],['800080'],['999999']
		,['FF00FF'],['FFCC00'],['FFFF00'],['00FF00'],['00FFFF'],['00CCFF'],['993366'],['C0C0C0']
		,['FF99CC'],['FFCC99'],['FFFF99'],['CCFFCC'],['CCFFFF'],['99CCFF'],['CC99FF'],['FFFFFF']
	],
	alignmode : [
		 ["justifyleft","100","20","-3px 0 0 0","&nbsp;左对齐"]
		,["justifycenter","120","20","-3px 0 0 0","&nbsp;居中对齐"]
		,["Justifyright","140","20","-3px 0 0 0","&nbsp;右对齐"]
	],
	serial : [
		 ["insertorderedlist","160","20","-3px 0 0 0","&nbsp;数字编号"]
		,["insertunorderedlist","180","20","-3px 0 0 0","&nbsp;项目编号"]
	],
	indent : [
		 ["indent","220","20","-3px 0 0 0","&nbsp;向右缩进"]
		,["outdent","200","20","-3px 0 0 0","&nbsp;向左缩进"]
	]
};
CD.$ = function(i, win) {
	try {
		return ( win || window ).document.getElementById(i);
	}catch( e ) {return null;}
}
CD.$$ = function(name, doc){
    var doc = doc || document;
    return doc.createElement(name);
};
CD.event = {
    add : function(el, event, listener) {
        if (el.addEventListener){
            el.addEventListener(event, listener, false);
        } else if (el.attachEvent){
            el.attachEvent('on' + event, listener);
        }
    },
    remove : function(el, event, listener) {
        if (el.removeEventListener){
            el.removeEventListener(event, listener, false);
        } else if (el.detachEvent){
            el.detachEvent('on' + event, listener);
        }
    }
};
CD.IniEditor = function(d) {
	CD.func.loadStyle(d.root+'/images/editor.css');
	for(var i=0;i<d.id.length;i++){
		var config       = {};
		config.id         = d.id[i];
		config.use        = d.use[i];
		config.root       = d.root;
		config.codeMode   = true;
		config.filterMode = false;//开启过滤
		CD.g[d.id[i]]    = config;//保存数据
		CD.event.add(window, 'load', new Function('CD.create("'+d.id[i]+'")'));
	}
};
CD.create = function(id, mode) {
	var width = CD.$(id).style.width;
    var height = CD.$(id).style.height;
    var container = CD.$$('div');
	container.className = 'editor_container';
    container.style.width = width;
    container.style.height = height;
    CD.$(id).parentNode.insertBefore(container,CD.$(id));
	var toolbarDiv = CD.toolbar.create(id);
    container.appendChild(toolbarDiv);

    var iframe = CD.$$('iframe');
    iframe.className = 'editor_iframe';
    iframe.setAttribute("frameBorder", "0");
    var newTextarea = CD.$$('textarea');
    newTextarea.className = 'editor_textarea';
    newTextarea.style.display = 'none';
	
    var formDiv = CD.$$('div');
    formDiv.className = 'editor_form';
    formDiv.appendChild(iframe);
    formDiv.appendChild(newTextarea);
    container.appendChild(formDiv);

    var hideDiv = CD.$$('div');
    hideDiv.style.display = 'none';
    var maskDiv = CD.$$('div');
    maskDiv.className = 'editor_mask';
    CD.func.setOpacity(maskDiv, 50);
    document.body.appendChild(hideDiv);
    document.body.appendChild(maskDiv);
    CD.$(id).style.display = "none";
	
	var iframeWin = iframe.contentWindow;
    var iframeDoc = CD.func.getIframeDoc(iframe);
    iframeDoc.designMode = "On";
    var html = CD.func.getFullHtml(id);
    iframeDoc.open();
    iframeDoc.write(html);
    iframeDoc.close();
    if (!CD.g[id].codeMode) {
        newTextarea.value = CD.$(id).value;
        newTextarea.style.display = 'block';
        iframe.style.display = 'none';
    }

	var form = CD.$(id).parentNode;
	while (form != null && form.tagName != 'FORM') { form = form.parentNode; }
	if (form != null && form.tagName == 'FORM') {
		CD.event.add(form, 'submit', new Function('CD.func.setData("'+id+'")'));
		CD.event.add(form, 'reset', new Function('CD.func.Reset("'+id+'")'));
	}

    CD.g[id].container = container;
    CD.g[id].toolbarDiv = toolbarDiv;
    CD.g[id].formDiv = formDiv;
    CD.g[id].iframe = iframe;
    CD.g[id].newTextarea = newTextarea;
    CD.g[id].srcTextarea = CD.$(id);
    CD.g[id].hideDiv = hideDiv;
    CD.g[id].maskDiv = maskDiv;
    CD.g[id].iframeWin = iframeWin;
    CD.g[id].iframeDoc = iframeDoc;
    width = container.offsetWidth;
    height = container.offsetHeight;
    CD.g[id].width = width + 'px';
    CD.g[id].height = height + 'px';
    CD.func.resize(id,width,height);
    if(CD.$(id).value) iframeDoc.body.innerHTML = CD.$(id).value;
}

CD.func = {
    getIframeDoc : function(iframe) {
        var win = iframe.contentWindow;
        var doc = null;
        if (iframe.contentDocument) {
            doc = iframe.contentDocument;
        } else {
            doc = win.document;
        }
        return doc;
    },
    getFullHtml : function(id) {
        var html = '<html>';
        html += '<head>';
        html += '<title>editor</title>';
		html += '<style type="text/css">';
        html += 'body {';
        html += '    font-family: Verdana;';
        html += '    font-size:12px;';
        html += '    margin:2px;';
        html += '    background-color:#ffffff;';
        html += '}</style>';
        html += '</head>';
        html += '<body>';
        html += '</body>';
        html += '</html>';
        return html;
    },
    getBrowser : function() {
        var browser = false;
        var ua = navigator.userAgent.toLowerCase();
        if (ua.indexOf("msie") > -1) browser = true;//IE浏览器
        return browser;
    },
    setOpacity : function(el, opacity) {
        if (CD.browser) {
            el.style.filter = (opacity == 100) ? "" : "gray() alpha(opacity=" + opacity + ")";
        } else {
            el.style.opacity = (opacity == 100) ? "" : "0." + opacity.toString();
        }
    },
	ClickHandle : function(e){	
		var o = e.srcElement || e.target;
		if(o.id.indexOf('_editor_source')!=-1 || o.id.indexOf('_toolbar')!=-1 || !o.id) return false;
		var v  = o.id.split('_');if(v[2]=="-" ||!v[2]) return false;
		var k  =0;
		for (var i=0;i<CD.lang["items"].length;i++){
			k = i;if(CD.lang["items"][i][0]==v[2]) break;
		}
		var t = o.getAttribute("para") ? o.getAttribute("para") : o.parentNode.getAttribute("para");
		CD.func.fHide(v[0],k);//关闭所有下拉菜单
		if(o.type !="button") CD.func.SavePos(v[0]);//保存光标
		if("bold,italic,underline,-".indexOf(v[2])!=-1){
			CD.func.execCommand(v[0],v[2],t);
		}else{
			if(!t){
				CD.func.fDisp(v[0]+"_"+k+"_prompt");//显示下拉
			}else if(t=="createlink"){
				CD.func.CreateLink(v[0]);
			}else if(t=="InsertImage"){
				CD.func.InsertImage(v[0]);
			}else{
				CD.func.execCommand(v[0],v[2],t);
			}
		}
	},
    execCommand : function(id, cmd, value) {
		if("alignmode serial indent".indexOf(cmd)!=-1){
			cmd = value;value = false;
		}
		CD.func.fHide(id);
		try {
			CD.g[id].iframeDoc.execCommand(cmd,false,!value ? false : value);
        } catch(e) {}
    },
	CreateLink : function(id){
		var u = CD.$(id+"_url").value;
		if(!u || u=="http://") return false;
		u = !(( u.indexOf("://") > 1 ) || (u.indexOf(":\\") > 1)) ? "http://" + u : u;
		CD.func.LoadPos(id);
		CD.func.execCommand(id,"createlink",u);
	},
	InsertImage : function(id){
		var p = CD.$(id+"_picture").value;
		if(!p || p=="http://") return false;
		CD.func.LoadPos(id);
		CD.func.execCommand(id,"InsertImage",p);
	},
    SavePos : function(id) {
        var win = CD.g[id].iframeWin;
        var doc = CD.g[id].iframeDoc;
        var sel = win.getSelection ? win.getSelection() : doc.selection;
        var range;
        try {
            if (sel.rangeCount > 0) {
                range = sel.getRangeAt(0);
            } else {
                range = sel.createRange ? sel.createRange() : doc.createRange();
            }
        } catch(e) {}
        if (!range) {
            range = (CD.browser) ? doc.body.createTextRange() : doc.createRange();
        }
        CD.g[id].selection = sel;
        CD.g[id].range = range;
    },
	LoadPos : function(id){
		if(CD.browser && CD.g[id].range){
			CD.g[id].range.select();
			CD.g[id].range = null;
		}
	},
	fHide : function(id,k){
		for(var i=0;i<CD.lang["items"].length;i++){
			if(CD.lang["items"][i][0] == "picture" && CD.g[id].use != true) continue;
			if("bold,italic,underline,-".indexOf(CD.lang["items"][i][0])==-1 && i!=k) CD.$(id+"_"+i+"_prompt").style.display = 'none';
		}
	},
	fDisp : function(id){
		CD.$(id).style.display = CD.$(id).style.display != 'block' ? "block" : "none";	
	},
	BMouse : function(obj, flag){
		if (obj.title == "间隔线") return;
		obj.className = (flag == 0 ? "editor_btn_mover" : flag == 1 ? "editor_btn_mdown" : "editor_btn");
	},
	Mcolor : function(obj,t){
		obj.className = !t ? "editor_menu_mover" : "editor_menu";
	},
	toolprompt : function(id,k,t){
		if("bold,italic,underline,-".indexOf(t)!=-1) return "";
		var d = "<div unselectable=on  id='"+id+"_"+k+"_prompt' class='editor_prompt'>";
		switch(t){
		    case "fontname":
				for(var i=0;i<CD.lang["font"].length;i++){
					d += "<div class='editor_menu' title='"+CD.lang["font"][i][1]+"' onmouseover='CD.func.Mcolor(this)' onmouseout='CD.func.Mcolor(this,1)' ";
					d += " unselectable=on style='width:100px;font:normal 12px "+CD.lang["font"][i][0]+"' ";
					d += " id='"+id+"_"+i+"_"+t+"' para='"+CD.lang["font"][i][0]+"'>";
					d += CD.lang["font"][i][1]+"</div>";
				}
			break;
			case "fontsize":
				for(var i=0;i<CD.lang["size"].length;i++){
					d += "<div class='editor_menu' title='"+CD.lang["size"][i][2]+"' onmouseover='CD.func.Mcolor(this)' onmouseout='CD.func.Mcolor(this,1)' ";
					d += " unselectable=on style='width:100px;font-size:"+CD.lang["size"][i][1]+"' ";
					d += " id='"+id+"_"+i+"_"+t+"' para='"+CD.lang["size"][i][0]+"'>";
					d += CD.lang["size"][i][2]+"</div>";
				}
			break;
			case "alignmode":
				for(var i=0;i<CD.lang["alignmode"].length;i++){
					d += "<div style='width:100px;' class='editor_menu' onmouseover='CD.func.Mcolor(this)' onmouseout='CD.func.Mcolor(this,1)' ";
					d += " unselectable='on' id='"+id+"_"+i+"_"+t+"' para='"+CD.lang["alignmode"][i][0]+"'>";
					d += "  <div unselectable='on' style='background:url("+CD.g[id].root+"images/editoricon.gif) -"+CD.lang["alignmode"][i][1]+"px 0;";
					d += "width:20px;height:17px;float:left;margin:"+CD.lang["alignmode"][i][3]+";' title='"+CD.lang["alignmode"][i][4]+"' ";
					d += " id='"+id+"_"+i+"_"+t+"' para='"+CD.lang["alignmode"][i][0]+"'></div>";
					d += CD.lang["alignmode"][i][4]+"</div>";
				}
			break;
			case "serial":
			   for(var i=0;i<CD.lang["serial"].length;i++){
					d += "<div style='width:100px;' class='editor_menu' onmouseover='CD.func.Mcolor(this)' onmouseout='CD.func.Mcolor(this,1)' ";
					d += " unselectable='on'  id='"+id+"_"+i+"_"+t+"' para='"+CD.lang["serial"][i][0]+"'>";
					d += "  <div unselectable='on' style='background:url("+CD.g[id].root+"images/editoricon.gif) -"+CD.lang["serial"][i][1]+"px 0;";
					d += "width:20px;height:17px;float:left;margin:"+CD.lang["serial"][i][3]+";' title='"+CD.lang["serial"][i][4]+"' ";
					d += " id='"+id+"_"+i+"_"+t+"' para='"+CD.lang["serial"][i][0]+"' ></div>";
					d += CD.lang["serial"][i][4]+"</div>"; 
			   }
			break;
			case "indent":
			   for(var i=0;i<CD.lang["indent"].length;i++){
					d += "<div style='width:100px;' class='editor_menu' onmouseover='CD.func.Mcolor(this)' onmouseout='CD.func.Mcolor(this,1)' ";
					d += " unselectable='on' id='"+id+"_"+i+"_"+t+"' para='"+CD.lang["indent"][i][0]+"'>";
					d += "  <div unselectable='on' style='background:url("+CD.g[id].root+"images/editoricon.gif) -"+CD.lang["indent"][i][1]+"px 0;";
					d += "width:20px;height:17px;float:left;margin:"+CD.lang["indent"][i][3]+";' title='"+CD.lang["indent"][i][4]+"' ";
					d += " id='"+id+"_"+i+"_"+t+"' para='"+CD.lang["indent"][i][0]+"'></div>";
					d += CD.lang["indent"][i][4]+"</div>"; 
			   }
			break;
			case "picture" :
			   d += "<div unselectable='on' style='width:325px;margin:8px 10px;'>";
			   d += "  <div unselectable='on'>选择上传：";
			   d += "<iframe frameborder='0' scrolling='no' src='"+CD.g[id].root+"upload.php?id="+id+"_picture' style='width:260px;height:25px;'></iframe>";
			   d += "</div>";
			   d += "  <div>网络地址：<input type='text' name='"+id+"_picture' id='"+id+"_picture' value='http://' class='editor_picture'></div>";
			   d += "<div unselectable='on' style='margin-top:5px;padding-left:60px;'>";
			   d += "<input id='"+id+"_link_"+t+"' para='InsertImage' type='button' value='立即插入' style='margin-left:2px;width:70px;'>";
			   d += "<input type='button' value='取消' style='margin-left:2px;' onclick='CD.func.fHide(\""+id+"\");'>";
			   d += "</div>";
			   d += "</div>";
			break;
			case "createlink":
			   d += "<div unselectable='on' style='width:200px;margin:8px 10px;'>";
			   d += "<div unselectable='on'>请输入链接的目标地址：</div>";
			   d += "<div unselectable='on'><input id='"+id+"_url' type='text' class='editor_txt' value='http://' /></div>";
			   d += "<div unselectable='on' style='margin-top:5px;padding-left:50px;'>";
			   d += "<input id='"+id+"_link_"+t+"' para='createlink' type='button' value='确定' style='margin-left:2px;'>";
			   d += "<input type='button' value='取消' style='margin-left:2px;' onclick='CD.func.fHide(\""+id+"\");'>";
			   d += "</div>";
			   d += "</div>";
			break;
			default:
			    if(t!="forecolor" && t!="backcolor") break;
				d += "<div style='width:160px;'>";
				for(var i=0;i<CD.lang["color"].length;i++){
					d += "<div class='editor_menu' style='font-size:1px;float:left;width:14px;height:14px;' title='#"+CD.lang["color"][i]+"' unselectable='on' ";
					d += " onmouseover='CD.func.Mcolor(this)' onmouseout='CD.func.Mcolor(this,1)' >";
					d += "  <div style='border:1px solid #a6a6a6;width:12px;height:12px;background:#"+CD.lang["color"][i]+"' unselectable='on' ";
					d += " id='"+id+"_"+i+"_"+t+"' para='#"+CD.lang["color"][i]+"'>&nbsp;</div>";
					d += "</div>";
				}
				d += "</div>";
			break;
		}
		d += "</div>";
		return d;
	},
	CodeEditor : function(id,r){
		var o = CD.g[id];
		if(o.codeMode){
			for(var i = 0; i < CD.lang["items"].length; i++){
			    var p = CD.lang["items"][i][0];
				if((r==true && p=="picture") ||  p!="picture") CD.$(id+"_"+i+"_"+p).style.display = 'none';	
			}
			CD.$(id+"_editor_source").innerHTML = "预览<b>&#187;</b>";
			CD.$(id+"_editor_source").title     = "预览效果";
			if(o.filterMode){
				o.newTextarea.value = CD.func.HtmlToText(o.iframeDoc.body.innerHTML);
			}else{
				o.newTextarea.value = o.iframeDoc.body.innerHTML;
			}
			o.iframe.style.display = 'none';
			o.newTextarea.style.display = 'block';
			o.codeMode = false;
		}else{
			for(var i = 0; i < CD.lang["items"].length; i++){
			    var p = CD.lang["items"][i][0];
				if((r==true && p=="picture") ||  p!="picture") CD.$(id+"_"+i+"_"+p).style.display = 'block';	
			}
			CD.$(id+"_editor_source").innerHTML = "&lt;HTML&gt;";
			CD.$(id+"_editor_source").title     = "编辑HTML源码";
	
			o.iframeDoc.body.innerHTML = o.newTextarea.value;
			o.iframe.style.display = 'block';
			o.newTextarea.style.display = 'none';
			o.codeMode = true;
		}
	},
    getData : function(id,filterMode) {
        var data;
        if (CD.g[id].codeMode) {
            if(filterMode) {
                data = CD.func.HtmlToText(CD.g[id].iframeDoc.body.innerHTML);
            }else{
                data = CD.g[id].iframeDoc.body.innerHTML;
            }
        } else {
            data = CD.g[id].newTextarea.value;
        }
        return data;
    },
    setData : function(id) {
		var data = CD.func.getData(id,CD.g[id].filterMode);
		CD.g[id].srcTextarea.value = data;
    },
	Reset : function(id){
	    CD.g[id].iframeDoc.body.innerHTML = "";
		CD.g[id].newTextarea.value = "";
		CD.g[id].srcTextarea.value = "";
	},
    loadStyle : function(path) {
        var link = CD.$$('link');
        link.setAttribute('type', 'text/css');
        link.setAttribute('rel', 'stylesheet');
        link.setAttribute('href', path);
        document.getElementsByTagName("head")[0].appendChild(link);
    },
    resize : function(id, width, height) {
		var obj = CD.g[id];
        if (width <= obj.minWidth || height <= obj.minHeight) return;
        obj.container.style.width = width + 'px';
        obj.container.style.height = height + 'px';
        obj.formDiv.style.height = height + 'px';
		var diff = obj.toolbarDiv.offsetHeight;
        var formBorder = obj.formDiv.offsetHeight - obj.formDiv.clientHeight;
        height -= diff + formBorder;
        if (CD.browser) {
            var border = obj.container.offsetWidth - obj.container.clientWidth;
            if (document.compatMode != "CSS1Compat") {
                height -= border;
                width -= border;
                obj.formDiv.style.height = (height + formBorder) + 'px';
            } else {
                obj.formDiv.style.height = height + 'px';
            }
            obj.iframe.style.height = height + 'px';
            obj.newTextarea.style.width = (width - border) + 'px';
            obj.newTextarea.style.height = (height - formBorder) + 'px';
        } else {
            obj.formDiv.style.height = height + 'px';
            obj.iframe.style.height = height + 'px';
            obj.newTextarea.style.width = '100%';
            obj.newTextarea.style.height = height + 'px';
        }
    },
	HtmlToText : function(w){
		var res = w.replace( /\n/ig, "" );
		res = res.replace( /(<\/div>)|(<\/p>)|(<br\/?>)/ig, "\n" );
		return res;
	}
}
CD.browser = CD.func.getBrowser();
CD.toolbar = {
    create : function(id) {
		var toolbar = CD.$$('div');	
		var tool = "<div id='"+id+"_toolbar' unselectable='on' class='editor_toolbar'>";
		for (var i = 0; i < CD.lang["items"].length; i++) {
			if(CD.lang["items"][i][0] == "picture" && CD.g[id].use != true) continue;
			var p = CD.func.toolprompt(id,i,CD.lang["items"][i][0]);
			tool += "<div id="+id+"_"+i+"_"+CD.lang["items"][i][0]+" style='";
			tool += "background:url("+CD.g[id].root+"images/editoricon.gif) -"+CD.lang["items"][i][1]+"px 0;width:"+CD.lang["items"][i][2]+"px;";
			tool += "' class='editor_btn' unselectable='on' title="+CD.lang["items"][i][5]; 
			tool += " onmousedown=CD.func.BMouse(this,1) onmouseover=CD.func.BMouse(this,0) onmouseout=CD.func.BMouse(this,2) onmouseup=CD.func.BMouse(this,0)";
			tool += ">"+p+"</div>";
		}
		tool += "<div id='"+id+"_editor_source' class=editor_abtn onclick='CD.func.CodeEditor(\""+id+"\","+CD.g[id].use+");' ";
		tool += " unselectable='on' title='编辑HTML源码'>&lt;HTML&gt;</div>";
		tool += "</div>";
		toolbar.innerHTML = tool;
		
		CD.event.add(toolbar, 'click',CD.func.ClickHandle);//监听toolbar
		return toolbar;
    }
};