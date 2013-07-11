/*
 * File:        dataTables.editor.min.js

 * Version:     1.2.3
 * Author:      SpryMedia (www.sprymedia.co.uk)
 * Info:        http://editor.datatables.net
 * 
 * Copyright 2012 SpryMedia, all rights reserved.
 * License: DataTables Editor - http://editor.datatables.net/license
 */
/*
     DataTables Editor: http://editor.datatables.net/license
*/
(function(m, o, n, e, j) {
 var f = function(a) {
  !this instanceof f && alert("DataTables Editor must be initilaised as a 'new' instance'");
  this._constructor(a)
 };
 j.Editor = f;
 f.models = {};
 f.models.displayController = {
  init: function() {},
  open: function() {},
  close: function() {}
 };
 f.models.field = {
  className: "",
  name: null,
  dataProp: "",
  label: "",
  id: "",
  type: "text",
  fieldInfo: "",
  labelInfo: "",
  "default": "",
  dataSourceGet: null,
  dataSourceSet: null,
  el: null,
  _fieldMessage: null,
  _fieldInfo: null,
  _fieldError: null,
  _labelInfo: null
 };
 f.models.fieldType = {
  create: function() {},
  get: function() {},
  set: function() {},
  enable: function() {},
  disable: function() {}
 };
 f.models.settings = {
  ajaxUrl: "",
  ajax: null,
  domTable: null,
  dbTable: "",
  opts: null,
  displayController: null,
  fields: [],
  order: [],
  id: -1,
  displayed: !1,
  processing: !1,
  editRow: null,
  removeRows: null,
  action: null,
  idSrc: null,
  events: {
   onProcessing: [],
   onPreOpen: [],
   onOpen: [],
   onPreClose: [],
   onClose: [],
   onPreSubmit: [],
   onPostSubmit: [],
   onSubmitComplete: [],
   onSubmitSuccess: [],
   onSubmitError: [],
   onInitCreate: [],
   onPreCreate: [],
   onCreate: [],
   onPostCreate: [],
   onInitEdit: [],
   onPreEdit: [],
   onEdit: [],
   onPostEdit: [],
   onInitRemove: [],
   onPreRemove: [],
   onRemove: [],
   onPostRemove: [],
   onSetData: [],
   onInitComplete: []
  }
 };
 f.models.button = {
  label: null,
  fn: null,
  className: null
 };
 f.display = {};
 var k = jQuery,
     g;
 f.display.lightbox = k.extend(!0, {}, f.models.displayController, {
  init: function() {
   g._init();
   return g
  },
  open: function(a, c, b) {
   if (g._shown) b && b();
   else {
    g._dte = a;
    k(g._dom.content).children().detach();
    g._dom.content.appendChild(c);
    g._dom.content.appendChild(g._dom.close);
    g._shown =
    true;
    g._show(b)
   }
  },
  close: function(a, c) {
   if (g._shown) {
    g._dte = a;
    g._hide(c);
    g._shown = false
   } else c && c()
  },
  _init: function() {
   if (!g._ready) {
    g._dom.content = k("div.DTED_Lightbox_Content", g._dom.wrapper)[0];
    o.body.appendChild(g._dom.background);
    o.body.appendChild(g._dom.wrapper);
    g._dom.background.style.visbility = "hidden";
    g._dom.background.style.display = "block";
    g._cssBackgroundOpacity = k(g._dom.background).css("opacity");
    g._dom.background.style.display = "none";
    g._dom.background.style.visbility = "visible"
   }
  },
  _show: function(a) {
   a || (a = function() {});
   g._dom.content.style.height = "auto";
   var c = g._dom.wrapper.style;
   c.opacity = 0;
   c.display = "block";
   g._heightCalc();
   c.display = "none";
   c.opacity = 1;
   k(g._dom.wrapper).fadeIn();
   g._dom.background.style.opacity = 0;
   g._dom.background.style.display = "block";
   k(g._dom.background).animate({
    opacity: g._cssBackgroundOpacity
   }, "normal", a);
   k(g._dom.close).bind("click.DTED_Lightbox", function() {
    g._dte.close("icon")
   });
   k(g._dom.background).bind("click.DTED_Lightbox", function() {
    g._dte.close("background")
   });
   k("div.DTED_Lightbox_Content_Wrapper", g._dom.wrapper).bind("click.DTED_Lightbox", function(a) {
    k(a.target).hasClass("DTED_Lightbox_Content_Wrapper") && g._dte.close("background")
   });
   k(m).bind("resize.DTED_Lightbox", function() {
    g._heightCalc()
   })
  },
  _heightCalc: function() {
   g.conf.heightCalc ? g.conf.heightCalc(g._dom.wrapper) : k(g._dom.content).children().height();
   var a = k(m).height() - g.conf.windowPadding * 2 - k("div.DTE_Header", g._dom.wrapper).outerHeight() - k("div.DTE_Footer", g._dom.wrapper).outerHeight();
   k("div.DTE_Body_Content", g._dom.wrapper).css("maxHeight", a)
  },
  _hide: function(a) {
   a || (a = function() {});
   k([g._dom.wrapper, g._dom.background]).fadeOut("normal", a);
   k(g._dom.close).unbind("click.DTED_Lightbox");
   k(g._dom.background).unbind("click.DTED_Lightbox");
   k("div.DTED_Lightbox_Content_Wrapper", g._dom.wrapper).unbind("click.DTED_Lightbox");
   k(m).unbind("resize.DTED_Lightbox")
  },
  _dte: null,
  _ready: !1,
  _shown: !1,
  _cssBackgroundOpacity: 1,
  _dom: {
   wrapper: k('<div class="DTED_Lightbox_Wrapper"><div class="DTED_Lightbox_Container"><div class="DTED_Lightbox_Content_Wrapper"><div class="DTED_Lightbox_Content"></div></div></div></div>')[0],
   background: k('<div class="DTED_Lightbox_Background"></div>')[0],
   close: k('<div class="DTED_Lightbox_Close"></div>')[0],
   content: null
  }
 });
 g = f.display.lightbox;
 g.conf = {
  windowPadding: 100,
  heightCalc: null
 };
 var i = jQuery,
     d;
 f.display.envelope = i.extend(!0, {}, f.models.displayController, {
  init: function(a) {
   d._dte = a;
   d._init();
   return d
  },
  open: function(a, c, b) {
   d._dte = a;
   i(d._dom.content).children().detach();
   d._dom.content.appendChild(c);
   d._dom.content.appendChild(d._dom.close);
   d._show(b)
  },
  close: function(a, c) {
   d._dte = a;
   d._hide(c)
  },
  _init: function() {
   if (!d._ready) {
    d._dom.content = i("div.DTED_Envelope_Container", d._dom.wrapper)[0];
    o.body.appendChild(d._dom.background);
    o.body.appendChild(d._dom.wrapper);
    d._dom.background.style.visbility = "hidden";
    d._dom.background.style.display = "block";
    d._cssBackgroundOpacity = i(d._dom.background).css("opacity");
    d._dom.background.style.display = "none";
    d._dom.background.style.visbility = "visible"
   }
  },
  _show: function(a) {
   a || (a = function() {});
   d._dom.content.style.height = "auto";
   var c = d._dom.wrapper.style;
   c.opacity = 0;
   c.display = "block";
   var b = d._findAttachRow(),
       e = d._heightCalc(),
       h = b.offsetWidth;
   c.display = "none";
   c.opacity = 1;
   d._dom.wrapper.style.width = h + "px";
   d._dom.wrapper.style.marginLeft = -(h / 2) + "px";
   d._dom.wrapper.style.top = i(b).offset().top + b.offsetHeight + "px";
   d._dom.content.style.top = -1 * e - 20 + "px";
   d._dom.background.style.opacity = 0;
   d._dom.background.style.display = "block";
   i(d._dom.background).animate({
    opacity: d._cssBackgroundOpacity
   }, "normal");
   i(d._dom.wrapper).fadeIn();
   d.conf.windowScroll ? i("html,body").animate({
    scrollTop: i(b).offset().top + b.offsetHeight - d.conf.windowPadding
   }, function() {
    i(d._dom.content).animate({
     top: 0
    }, 600, a)
   }) : i(d._dom.content).animate({
    top: 0
   }, 600, a);
   i(d._dom.close).bind("click.DTED_Envelope", function() {
    d._dte.close("icon")
   });
   i(d._dom.background).bind("click.DTED_Envelope", function() {
    d._dte.close("background")
   });
   i("div.DTED_Lightbox_Content_Wrapper", d._dom.wrapper).bind("click.DTED_Envelope", function(a) {
    i(a.target).hasClass("DTED_Envelope_Content_Wrapper") && d._dte.close("background")
   });
   i(m).bind("resize.DTED_Envelope", function() {
    d._heightCalc()
   })
  },
  _heightCalc: function() {
   d.conf.heightCalc ? d.conf.heightCalc(d._dom.wrapper) : i(d._dom.content).children().height();
   var a = i(m).height() - d.conf.windowPadding * 2 - i("div.DTE_Header", d._dom.wrapper).outerHeight() - i("div.DTE_Footer", d._dom.wrapper).outerHeight();
   i("div.DTE_Body_Content", d._dom.wrapper).css("maxHeight", a);
   return i(d._dte.dom.wrapper).outerHeight()
  },
  _hide: function(a) {
   a || (a = function() {});
   i(d._dom.content).animate({
    top: -(d._dom.content.offsetHeight + 50)
   }, 600, function() {
    i([d._dom.wrapper, d._dom.background]).fadeOut("normal", a)
   });
   i(d._dom.close).unbind("click.DTED_Lightbox");
   i(d._dom.background).unbind("click.DTED_Lightbox");
   i("div.DTED_Lightbox_Content_Wrapper", d._dom.wrapper).unbind("click.DTED_Lightbox");
   i(m).unbind("resize.DTED_Lightbox")
  },
  _findAttachRow: function() {
   if (d.conf.attach === "head" || d._dte.s.action === "create") return i(d._dte.s.domTable).dataTable().fnSettings().nTHead;
   if (d._dte.s.action === "edit") return d._dte.s.editRow;
   if (d._dte.s.action === "remove") return d._dte.s.removeRows[0]
  },
  _dte: null,
  _ready: !1,
  _cssBackgroundOpacity: 1,
  _dom: {
   wrapper: i('<div class="DTED_Envelope_Wrapper"><div class="DTED_Envelope_ShadowLeft"></div><div class="DTED_Envelope_ShadowRight"></div><div class="DTED_Envelope_Container"></div></div>')[0],
   background: i('<div class="DTED_Envelope_Background"></div>')[0],
   close: i('<div class="DTED_Envelope_Close">&times;</div>')[0],
   content: null
  }
 });
 d = f.display.envelope;
 d.conf = {
  windowPadding: 50,
  heightCalc: null,
  attach: "row",
  windowScroll: !0
 };
 f.prototype.add = function(a) {
  var c =
  this,
      b = this.classes.field;
  if (e.isArray(a)) for (var b = 0, d = a.length; b < d; b++) this.add(a[b]);
  else a = e.extend(!0, {}, f.models.field, a), a.id = "DTE_Field_" + a.name, "" === a.dataProp && (a.dataProp = a.name), a.dataSourceGet = function() {
   var b = e(c.s.domTable).dataTable().oApi._fnGetObjectDataFn(a.dataProp);
   a.dataSourceGet = b;
   return b.apply(c, arguments)
  }, a.dataSourceSet = function() {
   var b = e(c.s.domTable).dataTable().oApi._fnSetObjectDataFn(a.dataProp);
   a.dataSourceSet = b;
   return b.apply(c, arguments)
  }, b = e('<div class="' + b.wrapper + " " + b.typePrefix + a.type + " " + b.namePrefix + a.name + " " + a.className + '"><label data-dte-e="label" class="' + b.label + '" for="' + a.id + '">' + a.label + '<div data-dte-e="msg-label" class="' + b["msg-label"] + '">' + a.labelInfo + '</div></label><div data-dte-e="input" class="' + b.input + '"><div data-dte-e="msg-error" class="' + b["msg-error"] + '"></div><div data-dte-e="msg-message" class="' + b["msg-message"] + '"></div><div data-dte-e="msg-info" class="' + b["msg-info"] + '">' + a.fieldInfo + "</div></div></div>")[0], d = f.fieldTypes[a.type].create.call(this, a), null !== d ? this._$("input", b).prepend(d) : b.style.display = "none", this.dom.formContent.appendChild(b), this.dom.formContent.appendChild(this.dom.formClear), a.el = b, a._fieldInfo = this._$("msg-info", b)[0], a._labelInfo = this._$("msg-label", b)[0], a._fieldError = this._$("msg-error", b)[0], a._fieldMessage = this._$("msg-message", b)[0], this.s.fields.push(a), this.s.order.push(a.name)
 };
 f.prototype.buttons = function(a) {
  var c = this,
      b, d, h;
  if (e.isArray(a)) {
   e(this.dom.buttons).empty();
   var f = function(a) {
    return function(b) {
     b.preventDefault();
     a.fn && a.fn.call(c)
    }
   };
   b = 0;
   for (d = a.length; b < d; b++) h = o.createElement("button"), a[b].label && (h.innerHTML = a[b].label), a[b].className && (h.className = a[b].className), e(h).click(f(a[b])), this.dom.buttons.appendChild(h)
  } else this.buttons([a])
 };
 f.prototype.clear = function(a) {
  if (a) if (e.isArray(a)) for (var c = 0, b = a.length; c < b; c++) this.clear(a[c]);
  else c = this._findFieldIndex(a), c !== n && (e(this.s.fields[c].el).remove(), this.s.fields.splice(c, 1), a = e.inArray(a, this.s.order), this.s.order.splice(a, 1));
  else e("div." + this.classes.field.wrapper, this.dom.wrapper).remove(), this.s.fields.splice(0, this.s.fields.length), this.s.order.splice(0, this.s.order.length)
 };
 f.prototype.close = function(a) {
  var c = this;
  this._display("close", function() {
   c._clearDynamicInfo()
  }, a)
 };
 f.prototype.create = function(a, c, b) {
  var d = this,
      h = this.s.fields;
  this.s.id = "";
  this.s.action = "create";
  this.dom.form.style.display = "block";
  this._actionClass();
  a && this.title(a);
  c && this.buttons(c);
  a = 0;
  for (c = h.length; a < c; a++) this.field(h[a].name).set(h[a]["default"]);
  this._callbackFire("onInitCreate");
  (b === n || b) && this._display("open", function() {
   e("input,select,textarea", d.dom.wrapper).filter(":visible").filter(":enabled").filter(":eq(0)").focus()
  })
 };
 f.prototype.disable = function(a) {
  if (e.isArray(a)) for (var c = 0, b = a.length; c < b; c++) this.disable(a[c]);
  else this.field(a).disable()
 };
 f.prototype.edit = function(a, c, b, d) {
  var h = this;
  this.s.id = this._rowId(a);
  this.s.editRow = a;
  this.s.action = "edit";
  this.dom.form.style.display = "block";
  this._actionClass();
  c && this.title(c);
  b && this.buttons(b);
  a = e(this.s.domTable).dataTable()._(a)[0];
  c = 0;
  for (b = this.s.fields.length; c < b; c++) {
   var f = this.s.fields[c],
       g = f.dataSourceGet(a, "editor");
   this.field(f.name).set("" !== f.dataProp && g !== n ? g : f["default"])
  }
  this._callbackFire("onInitEdit");
  (d === n || d) && this._display("open", function() {
   e("input,select,textarea", h.dom.wrapper).filter(":visible").filter(":enabled").filter(":eq(0)").focus()
  })
 };
 f.prototype.enable = function(a) {
  if (e.isArray(a)) for (var c = 0, b = a.length; c < b; c++) this.enable(a[c]);
  else this.field(a).enable()
 };
 f.prototype.error = function(a, c) {
  if (c === n) this._message(this.dom.formError, "fade", a);
  else {
   var b = this._findField(a);
   b && (this._message(b._fieldError, "slide", c), e(b.el).addClass(this.classes.field.error))
  }
 };
 f.prototype.field = function(a) {
  var c = this,
      b = {},
      d = this._findField(a),
      h = f.fieldTypes[d.type];
  e.each(h, function(a, e) {
   b[a] = "function" === typeof e ?
   function() {
    var b = [].slice.call(arguments);
    b.unshift(d);
    return h[a].apply(c, b)
   } : e
  });
  return b
 };
 f.prototype.fields = function() {
  for (var a = [], c = 0, b = this.s.fields.length; c < b; c++) a.push(this.s.fields[c].name);
  return a
 };
 f.prototype.get = function(a) {
  var c = this,
      b = {};
  return a === n ? (e.each(this.fields(), function(a, e) {
   b[e] = c.get(e)
  }), b) : this.field(a).get()
 };
 f.prototype.hide = function(a) {
  var c, b;
  if (a) if (e.isArray(a)) {
   c = 0;
   for (b = a.length; c < b; c++) this.hide(a[c])
  } else {
   if (a = this._findField(a)) this.s.displayed ? e(a.el).slideUp() : a.el.style.display = "none"
  } else {
   c = 0;
   for (b = this.s.fields.length; c < b; c++) this.hide(this.s.fields[c].name)
  }
 };
 f.prototype.message = function(a, c) {
  if (c === n) this._message(this.dom.formInfo, "fade", a);
  else {
   var b =
   this._findField(a);
   this._message(b._fieldMessage, "slide", c)
  }
 };
 f.prototype.node = function(a) {
  return (a = this._findField(a)) ? a.el : n
 };
 f.prototype.off = function(a, c) {
  "function" === typeof e().off ? e(this).off(a, c) : e(this).unbind(a, c)
 };
 f.prototype.on = function(a, c) {
  if ("function" === typeof e().on) e(this).on(a, c);
  else e(this).bind(a, c)
 };
 f.prototype.open = function() {
  this._display("open")
 };
 f.prototype.order = function(a) {
  if (!a) return this.s.order;
  1 < arguments.length && !e.isArray(a) && (a = Array.prototype.slice.call(arguments));
  if (this.s.order.slice().sort().join("-") !== a.slice().sort().join("-")) throw "All fields, and no additional fields, must be provided for ordering.";
  e.extend(this.s.order, a)
 };
 f.prototype.remove = function(a, c, b, d) {
  e.isArray(a) ? (this.s.id = "", this.s.action = "remove", this.s.removeRows = a, this.dom.form.style.display = "none", this._actionClass(), c && this.title(c), b && this.buttons(b), this._callbackFire("onInitRemove"), (d === n || d) && this._display("open")) : this.remove([a], c, b, d)
 };
 f.prototype.set = function(a, c) {
  this.field(a).set(c)
 };
 f.prototype.show = function(a) {
  var c, b;
  if (a) if (e.isArray(a)) {
   c = 0;
   for (b = a.length; c < b; c++) this.show(a[c])
  } else {
   if (a = this._findField(a)) this.s.displayed ? e(a.el).slideDown() : a.el.style.display = "block"
  } else {
   c = 0;
   for (b = this.s.fields.length; c < b; c++) this.show(this.s.fields[c].name)
  }
 };
 f.prototype.submit = function(a, c, b, d) {
  var h = this,
      f = !0;
  if (!this.s.processing && this.s.action) {
   this._processing(!0);
   var g = e('div[data-dte-e="msg-error"]:visible', this.dom.wrapper);
   0 < g.length ? g.slideUp(function() {
    f && (h._submit(a, c, b, d), f = !1)
   }) : this._submit(a, c, b, d);
   e("div." + this.classes.field.error, this.dom.wrapper).removeClass(this.classes.field.error);
   e(this.dom.formError).fadeOut()
  }
 };
 f.prototype.title = function(a) {
  this.dom.header.innerHTML = a
 };
 f.prototype._constructor = function(a) {
  a = e.extend(!0, {}, f.defaults, a);
  this.s = e.extend(!0, {}, f.models.settings);
  this.classes = e.extend(!0, {}, f.classes);
  var c = this,
      b = this.classes;
  this.dom = {
   wrapper: e('<div class="' + b.wrapper + '"><div data-dte-e="processing" class="' + b.processing.indicator + '"></div><div data-dte-e="head" class="' + b.header.wrapper + '"><div data-dte-e="head_content" class="' + b.header.content + '"></div></div><div data-dte-e="body" class="' + b.body.wrapper + '"><div data-dte-e="body_content" class="' + b.body.content + '"><div data-dte-e="form_info" class="' + b.form.info + '"></div><form data-dte-e="form" class="' + b.form.tag + '"><div data-dte-e="form_content" class="' + b.form.content + '"><div data-dte-e="form_clear" class="' + b.form.clear + '"></div></div></form></div></div><div data-dte-e="foot" class="' + b.footer.wrapper + '"><div data-dte-e="foot_content" class="' + b.footer.content + '"><div data-dte-e="form_error" class="' + b.form.error + '"></div><div data-dte-e="form_buttons" class="' + b.form.buttons + '"></div></div></div></div>')[0],
   form: null,
   formClear: null,
   formError: null,
   formInfo: null,
   formContent: null,
   header: null,
   body: null,
   bodyContent: null,
   footer: null,
   processing: null,
   buttons: null
  };
  this.s.domTable = a.domTable;
  this.s.dbTable = a.dbTable;
  this.s.ajaxUrl = a.ajaxUrl;
  this.s.ajax = a.ajax;
  this.s.idSrc = a.idSrc;
  this.i18n = a.i18n;
  if (m.TableTools) {
   var d = m.TableTools.BUTTONS,
       h = this.i18n;
   e.each(["create", "edit", "remove"], function(a, c) {
    d["editor_" + c].sButtonText = h[c].button;
    d["editor_" + c].formTitle = h[c].title;
    d["editor_" + c].formButtons[0].label = h[c].submit
   });
   d.editor_remove.question = function(a) {
    return ("string" === h.remove.confirm ? h.remove.confirm : h.remove.confirm[a] ? h.remove.confirm[a] : h.remove.confirm._).replace(/%d/g, a)
   }
  }
  e.each(a.events, function(a, b) {
   c._callbackReg(a, b, "User")
  });
  var b = this.dom,
      g = b.wrapper;
  b.form = this._$("form", g)[0];
  b.formClear = this._$("form_clear", g)[0];
  b.formError =
  this._$("form_error", g)[0];
  b.formInfo = this._$("form_info", g)[0];
  b.formContent = this._$("form_content", g)[0];
  b.header = this._$("head_content", g)[0];
  b.body = this._$("body", g)[0];
  b.bodyContent = this._$("body_content", g)[0];
  b.footer = this._$("foot", g)[0];
  b.processing = this._$("processing", g)[0];
  b.buttons = this._$("form_buttons", g)[0];
  "" !== this.s.dbTable && e(this.dom.wrapper).addClass("DTE_Table_Name_" + this.s.dbTable);
  if (a.fields) {
   b = 0;
   for (g = a.fields.length; b < g; b++) this.add(a.fields[b])
  }
  e(this.dom.form).submit(function(a) {
   c.submit();
   a.preventDefault()
  });
  this.s.displayController = f.display[a.display].init(this);
  this._callbackFire("onInitComplete", [])
 };
 f.prototype._$ = function(a, c) {
  c === n && (c = o);
  return e('*[data-dte-e="' + a + '"]', c)
 };
 f.prototype._actionClass = function() {
  var a = this.classes.actions;
  e(this.dom.wrapper).removeClass([a.create, a.edit, a.remove].join(" "));
  "create" === this.s.action ? e(this.dom.wrapper).addClass(a.create) : "edit" === this.s.action ? e(this.dom.wrapper).addClass(a.edit) : "remove" === this.s.action && e(this.dom.wrapper).addClass(a.remove)
 };
 f.prototype._callbackFire = function(a, c) {
  var b, d;
  c === n && (c = []);
  if (e.isArray(a)) for (b = 0; b < a.length; b++) this._callbackFire(a[b], c);
  else {
   var h = this.s.events[a],
       f = [];
   b = 0;
   for (d = h.length; b < d; b++) f.push(h[b].fn.apply(this, c));
   null !== a && (b = e.Event(a), e(this).trigger(b, c), f.push(b.result));
   return f
  }
 };
 f.prototype._callbackReg = function(a, c, b) {
  c && this.s.events[a].push({
   fn: c,
   name: b
  })
 };
 f.prototype._clearDynamicInfo = function() {
  e("div." + this.classes.field.error, this.dom.wrapper).removeClass(this.classes.field.error);
  this._$("msg-error", this.dom.wrapper).html("").css("display", "none");
  this.error("");
  this.message("")
 };
 f.prototype._display = function(a, c, b) {
  var d = this;
  "open" === a ? (a = this._callbackFire("onPreOpen", [b]), -1 === e.inArray(!1, a) && (e.each(d.s.order, function(a, c) {
   d.dom.formContent.appendChild(d.node(c))
  }), d.dom.formContent.appendChild(d.dom.formClear), d.s.displayed = !0, this.s.displayController.open(this, this.dom.wrapper, function() {
   c && c()
  }), this._callbackFire("onOpen"))) : "close" === a && (a = this._callbackFire("onPreClose", [b]), -1 === e.inArray(!1, a) && (this.s.displayController.close(this, function() {
   d.s.displayed = !1;
   c && c()
  }), this._callbackFire("onClose")))
 };
 f.prototype._findField = function(a) {
  for (var c = 0, b = this.s.fields.length; c < b; c++) if (this.s.fields[c].name === a) return this.s.fields[c];
  return n
 };
 f.prototype._findFieldIndex = function(a) {
  for (var c = 0, b = this.s.fields.length; c < b; c++) if (this.s.fields[c].name === a) return c;
  return n
 };
 f.prototype._message = function(a, c, b) {
  "" === b && this.s.displayed ? "slide" === c ? e(a).slideUp() : e(a).fadeOut() : "" === b ? a.style.display = "none" : this.s.displayed ? "slide" === c ? e(a).html(b).slideDown() : e(a).html(b).fadeIn() : (e(a).html(b), a.style.display = "block")
 };
 f.prototype._processing = function(a) {
  (this.s.processing = a) ? (this.dom.processing.style.display = "block", e(this.dom.wrapper).addClass(this.classes.processing.active)) : (this.dom.processing.style.display = "none", e(this.dom.wrapper).removeClass(this.classes.processing.active));
  this._callbackFire("onProcessing", [a])
 };
 f.prototype._ajaxUri = function(a) {
  a = "create" === this.s.action && this.s.ajaxUrl.create ? this.s.ajaxUrl.create : "edit" === this.s.action && this.s.ajaxUrl.edit ? this.s.ajaxUrl.edit.replace(/_id_/, this.s.id) : "remove" === this.s.action && this.s.ajaxUrl.remove ? this.s.ajaxUrl.remove.replace(/_id_/, a.join(",")) : this.s.ajaxUrl;
  return -1 !== a.indexOf(" ") ? (a = a.split(" "), {
   method: a[0],
   url: a[1]
  }) : {
   method: "POST",
   url: a
  }
 };
 f.prototype._submit = function(a, c, b, d) {
  var h = this,
      f, g, i, k = e(this.s.domTable).dataTable(),
      l = {
    action: this.s.action,
    table: this.s.dbTable,
    id: this.s.id,
    data: {}
      };
  "create" === this.s.action || "edit" === this.s.action ? e.each(this.s.fields, function(a, c) {
   i = k.oApi._fnSetObjectDataFn(c.name);
   i(l.data, h.get(c.name))
  }) : l.data = this._rowId(this.s.removeRows);
  b && b(l);
  b = this._callbackFire("onPreSubmit", [l]); - 1 !== e.inArray(!1, b) ? this._processing(!1) : (b = this._ajaxUri(l.data), this.s.ajax(b.method, b.url, l, function(b) {
   h._callbackFire("onPostSubmit", [b, l]);
   b.error || (b.error = "");
   b.fieldErrors || (b.fieldErrors = []);
   if ("" !== b.error || 0 !== b.fieldErrors.length) {
    h.error(b.error);
    f = 0;
    for (g =
    b.fieldErrors.length; f < g; f++) h._findField(b.fieldErrors[f].name), h.error(b.fieldErrors[f].name, b.fieldErrors[f].status || "Error");
    var j = e("div." + h.classes.field.error + ":eq(0)");
    0 < b.fieldErrors.length && 0 < j.length && e(h.dom.bodyContent, h.s.wrapper).animate({
     scrollTop: j.position().top
    }, 600);
    c && c.call(h, b)
   } else {
    j = b.row ? b.row : {};
    if (!b.row) {
     f = 0;
     for (g = h.s.fields.length; f < g; f++) {
      var m = h.s.fields[f];
      null !== m.dataProp && m.dataSourceSet(j, h.field(m.name).get())
     }
    }
    h._callbackFire("onSetData", [b, j, h.s.action]);
    if (k.fnSettings().oFeatures.bServerSide) k.fnDraw();
    else if ("create" === h.s.action) null === h.s.idSrc ? j.DT_RowId = b.id : (i = k.oApi._fnSetObjectDataFn(h.s.idSrc), i(j, b.id)), h._callbackFire("onPreCreate", [b, j]), k.fnAddData(j), h._callbackFire(["onCreate", "onPostCreate"], [b, j]);
    else if ("edit" === h.s.action) h._callbackFire("onPreEdit", [b, j]), k.fnUpdate(j, h.s.editRow), h._callbackFire(["onEdit", "onPostEdit"], [b, j]);
    else if ("remove" === h.s.action) {
     h._callbackFire("onPreRemove", [b]);
     f = 0;
     //for (g = h.s.removeRows.length; f < g; f++) k.fnDeleteRow(h.s.removeRows[f], !1);
     k.fnDraw();
     h._callbackFire(["onRemove", "onPostRemove"], [b])
    }
    h.s.action = null;
    (d === n || d) && h._display("close", function() {
     h._clearDynamicInfo()
    }, "submit");
    a && a.call(h, b);
    h._callbackFire(["onSubmitSuccess", "onSubmitComplete"], [b, j])
   }
   h._processing(!1)
  }, function(a, b, e) {
   h._callbackFire("onPostSubmit", [a, b, e, l]);
   h.error(h.i18n.error.system);
   h._processing(!1);
   c && c.call(h, a, b, e);
   h._callbackFire(["onSubmitError", "onSubmitComplete"], [a, b, e, l])
  }))
 };
 f.prototype._rowId = function(a, c, b) {
  c = e(this.s.domTable).dataTable();
  b = c._(a)[0];
  c = c.oApi._fnGetObjectDataFn(this.s.idSrc);
  if (e.isArray(a)) {
   for (var d = [], f = 0, g = a.length; f < g; f++) d.push(this._rowId(a[f], c, b));
   return d
  }
  return null === this.s.idSrc ? a.id : c(b)
 };
 f.defaults = {
  domTable: null,
  ajaxUrl: "",
  fields: [],
  dbTable: "",
  display: "lightbox",
  ajax: function(a, c, b, d, f) {
   e.ajax({
    type: a,
    url: c,
    data: b,
    dataType: "json",
    success: function(a) {
     d(a)
    },
    error: function(a, b, c) {
     f(a, b, c)
    }
   })
  },
  idSrc: null,
  events: {
   onProcessing: null,
   onOpen: null,
   onPreOpen: null,
   onClose: null,
   onPreClose: null,
   onPreSubmit: null,
   onPostSubmit: null,
   onSubmitComplete: null,
   onSubmitSuccess: null,
   onSubmitError: null,
   onInitCreate: null,
   onPreCreate: null,
   onCreate: null,
   onPostCreate: null,
   onInitEdit: null,
   onPreEdit: null,
   onEdit: null,
   onPostEdit: null,
   onInitRemove: null,
   onPreRemove: null,
   onRemove: null,
   onPostRemove: null,
   onSetData: null,
   onInitComplete: null
  },
  i18n: {
   create: {
    button: "New",
    title: "Create new entry",
    submit: "Create"
   },
   edit: {
    button: "Edit",
    title: "Edit entry",
    submit: "Update"
   },
   remove: {
    button: "Delete",
    title: "Delete",
    submit: "Delete",
    confirm: {
     _: "Are you sure you wish to delete %d rows?",
     1: "Are you sure you wish to delete 1 row?"
    }
   },
   error: {
    system: "An error has occurred - Please contact the system administrator"
   }
  }
 };
 f.classes = {
  wrapper: "DTE",
  processing: {
   indicator: "DTE_Processing_Indicator",
   active: "DTE_Processing"
  },
  header: {
   wrapper: "DTE_Header",
   content: "DTE_Header_Content"
  },
  body: {
   wrapper: "DTE_Body",
   content: "DTE_Body_Content"
  },
  footer: {
   wrapper: "DTE_Footer",
   content: "DTE_Footer_Content"
  },
  form: {
   wrapper: "DTE_Form",
   content: "DTE_Form_Content",
   tag: "",
   info: "DTE_Form_Info",
   clear: "DTE_Form_Clear",
   error: "DTE_Form_Error",
   buttons: "DTE_Form_Buttons"
  },
  field: {
   wrapper: "DTE_Field",
   typePrefix: "DTE_Field_Type_",
   namePrefix: "DTE_Field_Name_",
   label: "DTE_Label",
   input: "DTE_Field_Input",
   error: "DTE_Field_StateError",
   "msg-label": "DTE_Label_Info",
   "msg-error": "DTE_Field_Error",
   "msg-message": "DTE_Field_Message",
   "msg-info": "DTE_Field_Info"
  },
  actions: {
   create: "DTE_Action_Create",
   edit: "DTE_Action_Edit",
   remove: "DTE_Action_Remove"
  }
 };
 m.TableTools && (j = m.TableTools.BUTTONS, j.editor_create = e.extend(!0, j.text, {
  sButtonText: null,
  editor: null,
  formTitle: null,
  formButtons: [{
   label: null,
   fn: function() {
    this.submit()
   }
  }],
  fnClick: function(a, c) {
   c.editor.create(c.formTitle, c.formButtons)
  }
 }), j.editor_edit = e.extend(!0, j.select_single, {
  sButtonText: null,
  editor: null,
  formTitle: null,
  formButtons: [{
   label: null,
   fn: function() {
    this.submit()
   }
  }],
  fnClick: function(a, c) {
   var b = this.fnGetSelected();
   b.length === 1 && c.editor.edit(b[0], c.formTitle, c.formButtons)
  }
 }), j.editor_remove = e.extend(!0, j.select, {
  sButtonText: null,
  editor: null,
  formTitle: null,
  formButtons: [{
   label: null,
   fn: function() {
    var a = this;
    this.submit(function() {
     m.TableTools.fnGetInstance(e(a.s.domTable)[0]).fnSelectNone()
    })
   }
  }],
  question: null,
  fnClick: function(a, c) {
   var b = this.fnGetSelected();
   if (b.length !== 0) {
    c.editor.message(typeof c.question === "function" ? c.question(b.length) : c.question);
    c.editor.remove(b, c.formTitle, c.formButtons)
   }
  }
 }));
 f.fieldTypes = {};
 var p = function(a) {
  return e.isPlainObject(a) ? {
   val: a.value !== n ? a.value : a.label,
   label: a.label
  } : {
   val: a,
   label: a
  }
 },
     l = f.fieldTypes,
     j = e.extend(!0, {}, f.models.fieldType, {
   get: function(a) {
    return a._input.val()
   },
   set: function(a, c) {
    a._input.val(c)
   },
   enable: function(a) {
    a._input.prop("disabled", false)
   },
   disable: function(a) {
    a._input.prop("disabled", true)
   }
  });
 l.hidden = e.extend(!0, {}, j, {
  create: function(a) {
   a._val = a.value;
   return null
  },
  get: function(a) {
   return a._val
  },
  set: function(a, c) {
   a._val = c
  }
 });
 l.readonly = e.extend(!0, {}, j, {
  create: function(a) {
   a._input = e("<input/>").attr(e.extend({
    id: a.id,
    type: "text",
    readonly: "readonly"
   }, a.attr || {}));
   return a._input[0]
  }
 });
 l.text = e.extend(!0, {}, j, {
  create: function(a) {
   a._input = e("<input/>").attr(e.extend({
    id: a.id,
    type: "text"
   }, a.attr || {}));
   return a._input[0]
  }
 });
 l.password = e.extend(!0, {}, j, {
  create: function(a) {
   a._input = e("<input/>").attr(e.extend({
    id: a.id,
    type: "password"
   }, a.attr || {}));
   return a._input[0]
  }
 });
 l.textarea = e.extend(!0, {}, j, {
  create: function(a) {
   a._input = e("<textarea/>").attr(e.extend({
    id: a.id
   }, a.attr || {}));
   return a._input[0]
  }
 });
 l.select = e.extend(!0, {}, j, {
  _addOptions: function(a, c) {
   var b = a._input[0].options;
   b.length = 0;
   if (c) for (var e = 0, d =
   c.length; e < d; e++) {
    var f = p(c[e]);
    b[e] = new Option(f.label, f.val)
   }
  },
  create: function(a) {
   a._input = e("<select/>").attr(e.extend({
    id: a.id
   }, a.attr || {}));
   l.select._addOptions(a, a.ipOpts);
   return a._input[0]
  },
  update: function(a, c) {
   var b = e(a._input).val();
   l.select._addOptions(a, c);
   e(a._input).val(b)
  }
 });
 l.checkbox = e.extend(!0, {}, j, {
  _addOptions: function(a, c) {
   var b = a._input.empty();
   if (c) for (var e = 0, d = c.length; e < d; e++) {
    var f = p(c[e]);
    b.append('<div><input id="' + a.id + "_" + e + '" type="checkbox" value="' + f.val + '" /><label for="' + a.id + "_" + e + '">' + f.label + "</label></div>")
   }
  },
  create: function(a) {
   a._input = e("<div />");
   l.checkbox._addOptions(a, a.ipOpts);
   return a._input[0]
  },
  get: function(a) {
   var c = [];
   a._input.find("input:checked").each(function() {
    c.push(this.value)
   });
   return a.separator ? c.join(a.separator) : c
  },
  set: function(a, c) {
   var b = a._input.find("input");
   !e.isArray(c) && typeof c === "string" ? c = c.split(a.separator || "|") : e.isArray(c) || (c = [c]);
   var d, f = c.length,
       g;
   b.each(function() {
    g = false;
    for (d = 0; d < f; d++) if (this.value == c[d]) {
     g = true;
     break
    }
    this.checked =
    g
   })
  },
  enable: function(a) {
   a._input.find("input").prop("disabled", false)
  },
  disable: function(a) {
   a._input.find("input").prop("disabled", true)
  },
  update: function(a, c) {
   var b = l.checkbox.get(a);
   l.checkbox._addOptions(a, c);
   l.checkbox.get(a, b)
  }
 });
 l.radio = e.extend(!0, {}, j, {
  _addOptions: function(a, c) {
   var b = a._input.empty();
   if (c) for (var d = 0, f = c.length; d < f; d++) {
    var g = p(c[d]);
    b.append('<div><input id="' + a.id + "_" + d + '" type="radio" name="' + a.name + '" /><label for="' + a.id + "_" + d + '">' + g.label + "</label></div>");
    e("input:last", b).attr("value", g.val)
   }
  },
  create: function(a) {
   a._input = e("<div />");
   l.radio._addOptions(a, a.ipOpts);
   this.on("onOpen", function() {
    a._input.find("input").each(function() {
     if (this._preChecked) this.checked = true
    })
   });
   return a._input[0]
  },
  get: function(a) {
   return a._input.find("input:checked").val()
  },
  set: function(a, c) {
   a._input.find("input").each(function() {
    this._preChecked = false;
    if (this.value == c) this._preChecked = this.checked = true
   })
  },
  enable: function(a) {
   a._input.find("input").prop("disabled", false)
  },
  disable: function(a) {
   a._input.find("input").prop("disabled", true)
  },
  update: function(a, c) {
   var b = l.radio.get(a);
   l.radio._addOptions(a, c);
   l.radio.get(a, b)
  }
 });
 l.date = e.extend(!0, {}, j, {
  create: function(a) {
   a._input = e("<input />").attr(e.extend({
    id: a.id
   }, a.attr || {}));
   if (!a.dateFormat) a.dateFormat = e.datepicker.RFC_2822;
   if (!a.dateImage) a.dateImage = "../media/images/calender.png";
   e(this).bind("onInitComplete", function() {
    e(a._input).datepicker({
     showOn: "both",
     dateFormat: a.dateFormat,
     buttonImage: a.dateImage,
     buttonImageOnly: true
    });
    e("#ui-datepicker-div").css("display", "none")
   });
   return a._input[0]
  },
  set: function(a, c) {
   a._input.datepicker("setDate", c)
  },
  enable: function(a) {
   a._input.datepicker("enable")
  },
  disable: function(a) {
   a._input.datepicker("disable")
  }
 });
 f.prototype.CLASS = "Editor";
 f.VERSION = "1.2.3";
 f.prototype.VERSION = f.VERSION
})(window, document, void 0, jQuery, jQuery.fn.dataTable);