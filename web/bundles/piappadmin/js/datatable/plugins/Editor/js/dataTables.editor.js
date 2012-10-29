/*
 * File:        dataTables.editor.min.js
 * Version:     1.1.0
 * Author:      Allan Jardine (www.sprymedia.co.uk)
 * Info:        www.datatables.net
 * 
 * Copyright 2012 Allan Jardine, all rights reserved.
 * License: DataTables Editor - http://editor.datatables.net/license
 */
/*
     DataTables Editor: http://editor.datatables.net/license
*/
(function(h, n, m, f, p) {
  var e = function(b) {
    !this instanceof e && alert("DataTables Editor must be initilaised as a 'new' instance'");
    this._constructor(b)
  };
  p.Editor = e;
  e.models = {};
  e.models.displayController = {
    init: function() {},
    open: function() {},
    close: function() {}
  };
  e.models.field = {
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
    _wrapper: null,
    _fieldMessage: null,
    _fieldInfo: null,
    _fieldError: null,
    _labelInfo: null
  };
  e.models.fieldType = {
    create: function() {},
    get: function() {},
    set: function() {},
    enable: function() {},
    disable: function() {}
  };
  e.models.settings = {
    ajaxUrl: "",
    ajax: null,
    domTable: null,
    dbTable: "",
    opts: null,
    displayController: null,
    fields: [],
    id: -1,
    displayed: !1,
    processing: !1,
    editRow: null,
    removeRows: null,
    action: null,
    events: {
      onProcessing: [],
      onOpen: [],
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
  e.models.button = {
    label: null,
    fn: null,
    className: null
  };
  e.display = {};
  (function(b, c, a) {
    var d;
    e.display.lightbox = a.extend(!0, {}, e.models.displayController, {
      init: function() {
        d._init();
        return d
      },
      open: function(b, c, f) {
        if (d._shown) f && f();
        else {
          d._dte = b;
          a(d._dom.content).children().detach();
          d._dom.content.appendChild(c);
          d._dom.content.appendChild(d._dom.close);
          d._shown = true;
          d._show(f)
        }
      },
      close: function(a, b) {
        if (d._shown) {
          d._dte = a;
          d._hide(b);
          d._shown = false
        } else b && b()
      },
      _init: function() {
        if (!d._ready) {
          d._dom.content = a("div.DTED_Lightbox_Content", d._dom.wrapper)[0];
          c.body.appendChild(d._dom.background);
          c.body.appendChild(d._dom.wrapper);
          d._dom.background.style.visbility = "hidden";
          d._dom.background.style.display = "block";
          d._cssBackgroundOpacity = a(d._dom.background).css("opacity");
          d._dom.background.style.display = "none";
          d._dom.background.style.visbility = "visible";
          a(d._dom.close).click(function() {
            d._dte.close("icon")
          });
          a(d._dom.background).click(function() {
            d._dte.close("background")
          });
          a("div.DTED_Lightbox_Content_Wrapper", d._dom.wrapper).click(function(b) {
            a(b.target).hasClass("DTED_Lightbox_Content_Wrapper") && d._dte.close("background")
          });
          a(b).resize(function() {
            d._heightCalc()
          })
        }
      },
      _show: function(b) {
        b || (b = function() {});
        d._dom.content.style.height = "auto";
        var c = d._dom.wrapper.style;
        c.opacity = 0;
        c.display = "block";
        d._heightCalc();
        c.display = "none";
        c.opacity = 1;
        a(d._dom.wrapper).fadeIn();
        d._dom.background.style.opacity = 0;
        d._dom.background.style.display = "block";
        a(d._dom.background).animate({
          opacity: d._cssBackgroundOpacity
        }, "normal", b)
      },
      _heightCalc: function() {
        d.conf.heightCalc ? d.conf.heightCalc(d._dom.wrapper) : a(d._dom.content).children().height();
        var c = a(b).height() - d.conf.windowPadding * 2 - a("div.DTE_Header", d._dom.wrapper).outerHeight() - a("div.DTE_Footer", d._dom.wrapper).outerHeight();
        a("div.DTE_Body_Content", d._dom.wrapper).css("maxHeight", c)
      },
      _hide: function(b) {
        b || (b = function() {});
        a([d._dom.wrapper, d._dom.background]).fadeOut("normal", b)
      },
      _dte: null,
      _ready: !1,
      _shown: !1,
      _cssBackgroundOpacity: 1,
      _dom: {
        wrapper: a('<div class="DTED_Lightbox_Wrapper"><div class="DTED_Lightbox_Container"><div class="DTED_Lightbox_Content_Wrapper"><div class="DTED_Lightbox_Content"></div></div></div></div>')[0],
        background: a('<div class="DTED_Lightbox_Background"></div>')[0],
        close: a('<div class="DTED_Lightbox_Close"></div>')[0],
        content: null
      }
    });
    d = e.display.lightbox;
    d.conf = {
      windowPadding: 100,
      heightCalc: null
    }
  })(h, n, jQuery, jQuery.fn.dataTable);
  (function(b, c, a) {
    var d;
    e.display.envelope = a.extend(!0, {}, e.models.displayController, {
      init: function(a) {
        d._dte = a;
        d._init();
        return d
      },
      open: function(b, c, f) {
        d._dte = b;
        a(d._dom.content).children().detach();
        d._dom.content.appendChild(c);
        d._dom.content.appendChild(d._dom.close);
        d._show(f)
      },
      close: function(a, b) {
        d._dte = a;
        d._hide(b)
      },
      _init: function() {
        if (!d._ready) {
          d._dom.content = a("div.DTED_Envelope_Container", d._dom.wrapper)[0];
          c.body.appendChild(d._dom.background);
          c.body.appendChild(d._dom.wrapper);
          d._dom.background.style.visbility = "hidden";
          d._dom.background.style.display = "block";
          d._cssBackgroundOpacity = a(d._dom.background).css("opacity");
          d._dom.background.style.display = "none";
          d._dom.background.style.visbility = "visible";
          a(d._dom.close).click(function() {
            d._dte.close("icon")
          });
          a(d._dom.background).click(function() {
            d._dte.close("background")
          });
          a("div.DTED_Envelope_Content_Wrapper", d._dom.wrapper).click(function(b) {
            a(b.target).hasClass("DTED_Envelope_Content_Wrapper") && d._dte.close("background")
          });
          a(b).resize(function() {
            d._heightCalc()
          })
        }
      },
      _show: function(b) {
        b || (b = function() {});
        d._dom.content.style.height = "auto";
        var c = d._dom.wrapper.style;
        c.opacity = 0;
        c.display = "block";
        var f = d._findAttachRow(),
            e = d._heightCalc(),
            o = f.offsetWidth;
        c.display = "none";
        c.opacity = 1;
        d._dom.wrapper.style.width =
        o + "px";
        d._dom.wrapper.style.marginLeft = -(o / 2) + "px";
        d._dom.wrapper.style.top = a(f).offset().top + f.offsetHeight + "px";
        d._dom.content.style.top = -1 * e - 20 + "px";
        d._dom.background.style.opacity = 0;
        d._dom.background.style.display = "block";
        a(d._dom.background).animate({
          opacity: d._cssBackgroundOpacity
        }, "normal");
        a(d._dom.wrapper).fadeIn();
        d.conf.windowScroll ? a("html,body").animate({
          scrollTop: a(f).offset().top + f.offsetHeight - d.conf.windowPadding
        }, function() {
          a(d._dom.content).animate({
            top: 0
          }, 600, b)
        }) : a(d._dom.content).animate({
          top: 0
        }, 600, b)
      },
      _heightCalc: function() {
        d.conf.heightCalc ? d.conf.heightCalc(d._dom.wrapper) : a(d._dom.content).children().height();
        var c = a(b).height() - d.conf.windowPadding * 2 - a("div.DTE_Header", d._dom.wrapper).outerHeight() - a("div.DTE_Footer", d._dom.wrapper).outerHeight();
        a("div.DTE_Body_Content", d._dom.wrapper).css("maxHeight", c);
        return a(d._dte.dom.wrapper).outerHeight()
      },
      _hide: function(b) {
        b || (b = function() {});
        a(d._dom.content).animate({
          top: -(d._dom.content.offsetHeight + 50)
        }, 600, function() {
          a([d._dom.wrapper, d._dom.background]).fadeOut("normal", b)
        })
      },
      _findAttachRow: function() {
        if (d.conf.attach === "head" || d._dte.s.action === "create") return a(d._dte.s.domTable).dataTable().fnSettings().nTHead;
        if (d._dte.s.action === "edit") return d._dte.s.editRow;
        if (d._dte.s.action === "remove") return d._dte.s.removeRows[0]
      },
      _dte: null,
      _ready: !1,
      _cssBackgroundOpacity: 1,
      _dom: {
        wrapper: a('<div class="DTED_Envelope_Wrapper"><div class="DTED_Envelope_ShadowLeft"></div><div class="DTED_Envelope_ShadowRight"></div><div class="DTED_Envelope_Container"></div></div>')[0],
        background: a('<div class="DTED_Envelope_Background"></div>')[0],
        close: a('<div class="DTED_Envelope_Close">&times;</div>')[0],
        content: null
      }
    });
    d = e.display.envelope;
    d.conf = {
      windowPadding: 50,
      heightCalc: null,
      attach: "row",
      windowScroll: !0
    }
  })(h, n, jQuery, jQuery.fn.dataTable);
  e.prototype.add = function(b) {
    var c = this,
        a = this.classes.field;
    if (f.isArray(b)) for (var a = 0, d = b.length; a < d; a++) this.add(b[a]);
    else b = f.extend(!0, {}, e.models.field, b), b.id = "DTE_Field_" + b.name, "" === b.dataProp && (b.dataProp = b.name), b.dataSourceGet =

    function() {
      var a = f(c.s.domTable).dataTable().oApi._fnGetObjectDataFn(b.dataProp);
      b.dataSourceGet = a;
      return a.apply(c, arguments)
    }, b.dataSourceSet = function() {
      var a = f(c.s.domTable).dataTable().oApi._fnSetObjectDataFn(b.dataProp);
      b.dataSourceSet = a;
      return a.apply(c, arguments)
    }, a = f('<div class="' + a.wrapper + " " + a.typePrefix + b.type + " " + a.namePrefix + b.name + '"><label data-dte-e="label" class="' + a.label + '" for="' + b.id + '">' + b.label + '<div data-dte-e="msg-label" class="' + a["msg-label"] + '">' + b.labelInfo + '</div></label><div data-dte-e="input" class="' + a.input + '"><div data-dte-e="msg-error" class="' + a["msg-error"] + '"></div><div data-dte-e="msg-message" class="' + a["msg-message"] + '"></div><div data-dte-e="msg-info" class="' + a["msg-info"] + '">' + b.fieldInfo + "</div></div></div>")[0], d = e.fieldTypes[b.type].create.call(this, b), null !== d ? this._$("input", a).prepend(d) : a.style.display = "none", this.dom.formContent.appendChild(a), this.dom.formContent.appendChild(this.dom.formClear), b._wrapper = a, b._fieldInfo = this._$("msg-info", a)[0], b._labelInfo = this._$("msg-label", a)[0], b._fieldError = this._$("msg-error", a)[0], b._fieldMessage = this._$("msg-message", a)[0], this.s.fields.push(b)
  };
  e.prototype.buttons = function(b) {
    var c = this,
        a, d, i;
    if (f.isArray(b)) {
      f(this.dom.buttons).empty();
      var e = function(a) {
        return function(b) {
          b.preventDefault();
          a.fn && a.fn.call(c)
        }
      };
      a = 0;
      for (d = b.length; a < d; a++) i = n.createElement("button"), b[a].label && (i.innerHTML = b[a].label), b[a].className && (i.className = b[a].className), f(i).click(e(b[a])), this.dom.buttons.appendChild(i)
    } else this.buttons([b])
  };
  e.prototype.clear =

  function(b) {
    if (b) if (f.isArray(b)) for (var c = 0, a = b.length; c < a; c++) this.clear(b[c]);
    else {
      if (b = this._findFieldIndex(b)) f(this.s.fields[b]._wrapper).remove(), this.s.fields.splice(b, 1)
    } else f("div." + this.classes.field.wrapper, this.dom.wrapper).remove(), this.s.fields.splice(0, this.s.fields.length)
  };
  e.prototype.close = function() {
    var b = this;
    this._display("close", function() {
      b._clearDynamicInfo()
    })
  };
  e.prototype.create = function(b, c, a) {
    var d = this,
        i = this.s.fields;
    this.s.id = "";
    this.s.action = "create";
    this.dom.form.style.display = "block";
    this._actionClass();
    b && this.title(b);
    c && this.buttons(c);
    b = 0;
    for (c = i.length; b < c; b++) this.field(i[b].name).set(i[b]["default"]);
    this._callbackFire("onInitCreate");
    (a === m || a) && this._display("open", function() {
      f("input:visible,select:visible,textarea:visible", d.dom.wrapper).filter(":eq(0)").focus()
    })
  };
  e.prototype.disable = function(b) {
    if (f.isArray(b)) for (var c = 0, a = b.length; c < a; c++) this.disable(b[c]);
    else this.field(b).disable()
  };
  e.prototype.edit = function(b, c, a, d) {
    var i = this;
    this.s.id = b.id;
    this.s.editRow =
    b;
    this.s.action = "edit";
    this.dom.form.style.display = "block";
    this._actionClass();
    c && this.title(c);
    a && this.buttons(a);
    b = f(this.s.domTable).dataTable()._(b)[0];
    c = 0;
    for (a = this.s.fields.length; c < a; c++) {
      var e = this.s.fields[c];
      this.field(e.name).set("" !== e.dataProp ? e.dataSourceGet(b, "editor") : e["default"])
    }
    this._callbackFire("onInitEdit");
    (d === m || d) && this._display("open", function() {
      f("input:visible,select:visible,textarea:visible", i.dom.wrapper).filter(":eq(0)").focus()
    })
  };
  e.prototype.enable = function(b) {
    if (f.isArray(b)) for (var c =
    0, a = b.length; c < a; c++) this.enable(b[c]);
    else this.field(b).enable()
  };
  e.prototype.error = function(b, c) {
    if (c) {
      var a = this._findField(b);
      a && (this._message(a._fieldError, "slide", c), f(a._wrapper).addClass(this.classes.field.error))
    } else this._message(this.dom.formError, "fade", b)
  };
  e.prototype.field = function(b) {
    var c = this,
        a = {},
        d = this._findField(b),
        i = e.fieldTypes[d.type];
    f.each(i, function(b, f) {
      a[b] = "function" === typeof f ?
      function() {
        var a = [].slice.call(arguments);
        a.unshift(d);
        return i[b].apply(c, a)
      } : f
    });
    return a
  };
  e.prototype.get = function(b) {
    return this.field(b).get()
  };
  e.prototype.hide = function(b) {
    var c, a;
    if (b) if (f.isArray(b)) {
      c = 0;
      for (a = b.length; c < a; c++) this.hide(b[c])
    } else {
      if (b = this._findField(b)) this.s.displayed ? f(b._wrapper).slideUp() : b._wrapper.style.display = "none"
    } else {
      c = 0;
      for (a = this.s.fields.length; c < a; c++) this.hide(this.s.fields[c].name)
    }
  };
  e.prototype.message = function(b, c) {
    c ? this._message(this._findField(b)._fieldMessage, "slide", c) : this._message(this.dom.formInfo, "fade", b)
  };
  e.prototype.off = function(b, c) {
    "function" === typeof f().off ? f(this).off(b, c) : f(this).unbind(b, c)
  };
  e.prototype.on = function(b, c) {
    if ("function" === typeof f().on) f(this).on(b, c);
    else f(this).bind(b, c)
  };
  e.prototype.open = function() {
    this._display("open")
  };
  e.prototype.remove = function(b, c, a, d) {
    f.isArray(b) ? (this.s.id = "", this.s.action = "remove", this.s.removeRows = b, this.dom.form.style.display = "none", this._actionClass(), c && this.title(c), a && this.buttons(a), this._callbackFire("onInitRemove"), (d === m || d) && this._display("open")) : this.remove([b], c, a, d)
  };
  e.prototype.set = function(b, c) {
    this.field(b).set(c)
  };
  e.prototype.show = function(b) {
    var c, a;
    if (b) if (f.isArray(b)) {
      c = 0;
      for (a = b.length; c < a; c++) this.show(b[c])
    } else {
      if (b = this._findField(b)) this.s.displayed ? f(b._wrapper).slideDown() : b._wrapper.style.display = "block"
    } else {
      c = 0;
      for (a = this.s.fields.length; c < a; c++) this.show(this.s.fields[c].name)
    }
  };
  e.prototype.submit = function(b, c, a, d) {
    var i = this,
        e = !0;
    if (!this.s.processing && this.s.action) {
      this._processing(!0);
      var g = f('div[data-dte-e="msg-error"]:visible', this.dom.wrapper);
      0 < g.length ? g.slideUp(function() {
        e && (i._submit(b, c, a, d), e = !1)
      }) : this._submit(b, c, a, d);
      f("div." + this.classes.field.error, this.dom.wrapper).removeClass(this.classes.field.error);
      f(this.dom.formError).fadeOut()
    }
  };
  e.prototype.title = function(b) {
    this.dom.header.innerHTML = b
  };
  e.prototype._constructor = function(b) {
    b = f.extend(!0, {}, e.defaults, b);
    this.s = f.extend(!0, {}, e.models.settings);
    this.classes = f.extend(!0, {}, e.classes);
    var c = this,
        a = this.classes;
    this.dom = {
      wrapper: f('<div class="' + a.wrapper + '"><div data-dte-e="processing" class="' + a.processing.indicator + '"></div><div data-dte-e="head" class="' + a.header.wrapper + '"><div data-dte-e="head_content" class="' + a.header.content + '"></div></div><div data-dte-e="body" class="' + a.body.wrapper + '"><div data-dte-e="body_content" class="' + a.body.content + '"><div data-dte-e="form_info" class="' + a.form.info + '"></div><form data-dte-e="form" class="' + a.form.tag + '"><div data-dte-e="form_content" class="' + a.form.content + '"><div data-dte-e="form_clear" class="' + a.form.clear + '"></div></div></form></div></div><div data-dte-e="foot" class="' + a.footer.wrapper + '"><div data-dte-e="foot_content" class="' + a.footer.content + '"><div data-dte-e="form_error" class="' + a.form.error + '"></div><div data-dte-e="form_buttons" class="' + a.form.buttons + '"></div></div></div></div>')[0],
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
    this.s.domTable = b.domTable;
    this.s.dbTable =
    b.dbTable;
    this.s.ajaxUrl = b.ajaxUrl;
    this.s.ajax = b.ajax;
    f.each(b.events, function(a, b) {
      c._callbackReg(a, b, "User")
    });
    var a = this.dom,
        d = a.wrapper;
    a.form = this._$("form", d)[0];
    a.formClear = this._$("form_clear", d)[0];
    a.formError = this._$("form_error", d)[0];
    a.formInfo = this._$("form_info", d)[0];
    a.formContent = this._$("form_content", d)[0];
    a.header = this._$("head_content", d)[0];
    a.body = this._$("body", d)[0];
    a.bodyContent = this._$("body_content", d)[0];
    a.footer = this._$("foot", d)[0];
    a.processing = this._$("processing", d)[0];
    a.buttons = this._$("form_buttons", d)[0];
    "" !== this.s.dbTable && f(this.dom.wrapper).addClass("DTE_Table_Name_" + this.s.dbTable);
    if (b.fields) {
      a = 0;
      for (d = b.fields.length; a < d; a++) this.add(b.fields[a])
    }
    f(this.dom.form).submit(function(a) {
      c.submit();
      a.preventDefault()
    });
    this.s.displayController = e.display[b.display].init(this);
    this._callbackFire("onInitComplete", [])
  };
  e.prototype._$ = function(b, c) {
    c === m && (c = n);
    return f('*[data-dte-e="' + b + '"]', c)
  };
  e.prototype._actionClass = function() {
    var b = this.classes.actions;
    f(this.dom.wrapper).removeClass([b.create, b.edit, b.remove].join(" "));
    "create" === this.s.action ? f(this.dom.wrapper).addClass(b.create) : "edit" === this.s.action ? f(this.dom.wrapper).addClass(b.edit) : "remove" === this.s.action && f(this.dom.wrapper).addClass(b.remove)
  };
  e.prototype._callbackFire = function(b, c) {
    var a, d;
    if (f.isArray(b)) for (a = 0; a < b.length; a++) this._callbackFire(b[a], c);
    else {
      var i = this.s.events[b],
          e = [];
      a = 0;
      for (d = i.length; a < d; a++) e.push(i[a].fn.apply(this, c));
      null !== b && (a = f.Event(b), f(this).trigger(a, c), e.push(a.result));
      return e
    }
  };
  e.prototype._callbackReg =

  function(b, c, a) {
    c && this.s.events[b].push({
      fn: c,
      name: a
    })
  };
  e.prototype._clearDynamicInfo = function() {
    f("div." + this.classes.field.error, this.dom.wrapper).removeClass(this.classes.field.error);
    this._$("msg-error", this.dom.wrapper).html("").css("display", "none");
    this.error("");
    this.message("")
  };
  e.prototype._display = function(b, c) {
    var a = this;
    "open" === b ? (a.s.displayed = !0, this.s.displayController.open(this, this.dom.wrapper, function() {
      c && c()
    }), this._callbackFire("onOpen")) : "close" === b && (this.s.displayController.close(this, function() {
      a.s.displayed = !1;
      c && c()
    }), this._callbackFire("onClose"))
  };
  e.prototype._findField = function(b) {
    for (var c = 0, a = this.s.fields.length; c < a; c++) if (this.s.fields[c].name === b) return this.s.fields[c];
    return m
  };
  e.prototype._findFieldIndex = function(b) {
    for (var c = 0, a = this.s.fields.length; c < a; c++) if (this.s.fields[c].name === b) return c;
    return m
  };
  e.prototype._message = function(b, c, a) {
    "" === a && this.s.displayed ? "slide" === c ? f(b).slideUp() : f(b).fadeOut() : "" === a ? b.style.display = "none" : this.s.displayed ? "slide" === c ? f(b).html(a).slideDown() : f(b).html(a).fadeIn() : (f(b).html(a), b.style.display = "block")
  };
  e.prototype._processing = function(b) {
    (this.s.processing = b) ? (this.dom.processing.style.display = "block", f(this.dom.wrapper).addClass(this.classes.processing.active)) : (this.dom.processing.style.display = "none", f(this.dom.wrapper).removeClass(this.classes.processing.active));
    this._callbackFire("onProcessing", [b])
  };
  e.prototype._ajaxUri = function(b) {
    b = "create" === this.s.action && this.s.ajaxUrl.create ? this.s.ajaxUrl.create : "edit" === this.s.action && this.s.ajaxUrl.edit ? this.s.ajaxUrl.edit.replace(/_id_/, this.s.id) : "remove" === this.s.action && this.s.ajaxUrl.remove ? this.s.ajaxUrl.remove.replace(/_id_/, b.join(",")) : this.s.ajaxUrl;
    return -1 !== b.indexOf(" ") ? (b = b.split(" "), {
      method: b[0],
      url: b[1]
    }) : {
      method: "POST",
      url: b
    }
  };
  e.prototype._submit = function(b, c, a, d) {
    var e = this,
        j, g, k = {
        action: this.s.action,
        table: this.s.dbTable,
        id: this.s.id,
        data: {}
        };
    if ("create" === this.s.action || "edit" === this.s.action) f.each(this.s.fields, function(a, b) {
      k.data[b.name] =
      e.get(b.name)
    });
    else {
      k.data = [];
      j = 0;
      for (g = this.s.removeRows.length; j < g; j++) k.data.push(this.s.removeRows[j].id)
    }
    a && a(k);
    a = this._callbackFire("onPreSubmit", [k]); - 1 !== f.inArray(!1, a) ? this._processing(!1) : (a = this._ajaxUri(k.data), this.s.ajax(a.method, a.url, k, function(a) {
      e._callbackFire("onPostSubmit", [a, k]);
      a.error || (a.error = "");
      a.fieldErrors || (a.fieldErrors = []);
      if ("" !== a.error || 0 !== a.fieldErrors.length) {
        e.error(a.error);
        j = 0;
        for (g = a.fieldErrors.length; j < g; j++) e._findField(a.fieldErrors[j].name), e.error(a.fieldErrors[j].name, a.fieldErrors[j].status);
        0 < a.fieldErrors.length && f(e.dom.bodyContent, e.s.wrapper).animate({
          scrollTop: f("div." + e.classes.field.error + ":eq(0)").position().top
        }, 600);
        c && c.call(e, a)
      } else {
        var h = f(e.s.domTable).dataTable(),
            l = {};
        j = 0;
        for (g = e.s.fields.length; j < g; j++) {
          var n = e.s.fields[j];
          null !== n.dataProp && n.dataSourceSet(l, e.field(n.name).get())
        }
        e._callbackFire("onSetData", [a, l, e.s.action]);
        if (h.fnSettings().oFeatures.bServerSide) h.fnDraw();
        else if ("create" === e.s.action) l.DT_RowId = a.id, e._callbackFire("onPreCreate", [a, l]), h.fnAddData(l), e._callbackFire(["onCreate", "onPostCreate"], [a, l]);
        else if ("edit" === e.s.action) e._callbackFire("onPreEdit", [a, l]), h.fnUpdate(l, e.s.editRow), e._callbackFire(["onEdit", "onPostEdit"], [a, l]);
        else if ("remove" === e.s.action) {
          e._callbackFire("onPreRemove", [a]);
          j = 0;
          //for (g = e.s.removeRows.length; j < g; j++) h.fnDeleteRow(e.s.removeRows[j], !1);
          h.fnDraw();
          e._callbackFire(["onRemove", "onPostRemove"], [a])
        }
        e.s.action = null;
        (d === m || d) && e._display("close", function() {
          e._clearDynamicInfo()
        });
        b && b.call(e, a);
        e._callbackFire(["onSubmitSuccess", "onSubmitComplete"], [a, l])
      }
      e._processing(!1)
    }, function(a, b, d) {
      e._callbackFire("onPostSubmit", [a, b, d, k]);
      e.error("An error has occurred - Please contact the system administrator");
      e._processing(!1);
      c && c.call(e, a, b, d);
      e._callbackFire(["onSubmitError", "onSubmitComplete"], [a, b, d, k])
    }))
  };
  e.defaults = {
    domTable: null,
    ajaxUrl: "",
    fields: [],
    dbTable: "",
    display: "lightbox",
    ajax: function(b, c, a, d, e) {
      f.ajax({
        type: b,
        url: c,
        data: a,
        dataType: "json",
        success: function(a) {
          d(a)
        },
        error: function(a, b, d) {
          e(a, b, d)
        }
      })
    },
    events: {
      onProcessing: null,
      onOpen: null,
      onClose: null,
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
    }
  };
  e.classes = {
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
  h.TableTools && (h.TableTools.BUTTONS.editor_create = f.extend(!0, h.TableTools.BUTTONS.text, {
    sButtonText: "New",
    editor: null,
    formTitle: "Create new entry",
    formButtons: [{
      label: "Create",
      fn: function() {
        this.submit()
      }
    }],
    fnClick: function(b, c) {
      c.editor.create(c.formTitle, c.formButtons)
    }
  }), h.TableTools.BUTTONS.editor_edit = f.extend(!0, h.TableTools.BUTTONS.select_single, {
    sButtonText: "Edit",
    editor: null,
    formTitle: "Edit entry",
    formButtons: [{
      label: "Update",
      fn: function() {
        this.submit()
      }
    }],
    fnClick: function(b, c) {
      var a = this.fnGetSelected();
      a.length === 1 && c.editor.edit(a[0], c.formTitle, c.formButtons)
    }
  }), h.TableTools.BUTTONS.editor_remove = f.extend(!0, h.TableTools.BUTTONS.select, {
    sButtonText: "Delete",
    editor: null,
    formTitle: "Delete",
    formButtons: [{
      label: "Delete",
      fn: function() {
        var b = this;
        this.submit(function() {
          h.TableTools.fnGetInstance(f(b.s.domTable)[0]).fnSelectNone()
        })
      }
    }],
    question: function(b) {
      return "Are you sure you wish to delete " + b.length + " row" + (b.length === 1 ? "?" : "s?")
    },
    fnClick: function(b, c) {
      var a = this.fnGetSelected();
      if (a.length !== 0) {
        c.editor.message(typeof c.question === "function" ? c.question(a) : c.question);
        c.editor.remove(a, c.formTitle, c.formButtons)
      }
    }
  }));
  e.fieldTypes = {};
  (function() {
    var b = e.fieldTypes,
        c = f.extend(true, {}, e.models.fieldType, {
        get: function(a) {
          return a._input.value
        },
        set: function(a, b) {
          a._input.value = b
        },
        enable: function(a) {
          a._input.disabled = false
        },
        disable: function(a) {
          a._input.disabled = true
        }
      });
    b.hidden = f.extend(true, {}, c, {
      create: function(a) {
        a._val = a.value;
        return null
      },
      get: function(a) {
        return a._val
      },
      set: function(a, b) {
        a._val = b
      }
    });
    b.readonly = f.extend(true, {}, c, {
      create: function(a) {
        a._input = f('<input id="' + a.id + '" readonly="readonly">')[0];
        return a._input
      }
    });
    b.text = f.extend(true, {}, c, {
      create: function(a) {
        a._input = f('<input id="' + a.id + '">')[0];
        return a._input
      }
    });
    b.password = f.extend(true, {}, c, {
      create: function(a) {
        a._input = f('<input id="' + a.id + '" type="password">')[0];
        return a._input
      }
    });
    b.textarea = f.extend(true, {}, c, {
      create: function(a) {
        a._input =
        f('<textarea id="' + a.id + '">')[0];
        return a._input
      }
    });
    b.select = f.extend(true, {}, c, {
      _addOptions: function(a, b) {
        for (var c = a._input.options, e = 0, g = b.length; e < g; e++) c[e] = f.isPlainObject(b[e]) ? new Option(b[e].label, b[e].value) : new Option(b[e])
      },
      create: function(a) {
        a._input = f('<select id="' + a.id + '">')[0];
        b.select._addOptions(a, a.ipOpts);
        return a._input
      },
      get: function(a) {
        return f(a._input).val()
      },
      set: function(a, b) {
        f(a._input).val(b)
      },
      update: function(a) {
        var d = a._input.options,
            c = f(a._input).val();
        d.length = 0;
        b.select._addOptions(a, a.ipOpts);
        f(a._input).val(c)
      }
    });
    b.checkbox = f.extend(true, {}, c, {
      create: function(a) {
        for (var b, c, e = f("<div>"), g = 0, h = a.ipOpts.length; g < h; g++) {
          if (f.isPlainObject(a.ipOpts[g])) {
            b = a.ipOpts[g].value !== m ? a.ipOpts[g].value : a.ipOpts[g].label;
            c = a.ipOpts[g].label
          } else {
            b = a.ipOpts[g];
            c = a.ipOpts[g]
          }
          e.append('<div><input id="' + a.id + "_" + g + '" type="checkbox" value="' + b + '" /><label for="' + a.id + "_" + g + '">' + c + "</label></div>")
        }
        a._input = e[0];
        return a._input
      },
      get: function(a) {
        var b = [];
        f("input:checked", a._input).each(function() {
          b.push(this.value)
        });
        return b.join("|")
      },
      set: function(a, b) {
        var c = f("input", a._input);
        !f.isArray(b) && typeof b === "string" ? b = b.split("|") : f.isArray(b) || (b = [b]);
        c.each(function() {
          for (var a = 0, c = b.length; a < c; a++) if (this.value == b[a]) this.checked = true
        })
      },
      enable: function(a) {
        f("input", a._input).attr("disabled", false)
      },
      disable: function(a) {
        f("input", a._input).attr("disabled", true)
      }
    });
    b.radio = f.extend(true, {}, c, {
      create: function(a) {
        for (var b = f("<div>"), c = 0, e = a.ipOpts.length; c < e; c++) {
          var g = a.ipOpts[c].value !== m ? a.ipOpts[c].value : a.ipOpts[c].label;
          b.append('<div><input id="' + a.id + "_" + c + '" type="radio" name="' + a.name + '" /><label for="' + a.id + "_" + c + '">' + a.ipOpts[c].label + "</label></div>");
          f("input:last", b).attr("value", g)
        }
        this.on("onOpen", function() {
          f("input", b).each(function() {
            if (this._preChecked) this.checked = true
          })
        });
        a._input = b[0];
        return a._input
      },
      get: function(a) {
        return f("input:checked", a._input).val()
      },
      set: function(a, b) {
        f("input", a._input).each(function() {
          this._preChecked = false;
          if (this.value == b) this._preChecked = this.checked = true
        })
      },
      enable: function(a) {
        f("input", a._input).attr("disabled", false)
      },
      disable: function(a) {
        f("input", a._input).attr("disabled", true)
      }
    });
    b.date = f.extend(true, {}, c, {
      create: function(a) {
        a._input = f('<input id="' + a.id + '">')[0];
        if (!a.dateFormat) a.dateFormat = f.datepicker.RFC_2822;
        if (!a.dateImage) a.dateImage = "../media/images/calender.png";
        f(this).bind("onInitComplete", function() {
          f(a._input).datepicker({
            showOn: "both",
            dateFormat: a.dateFormat,
            buttonImage: a.dateImage,
            buttonImageOnly: true
          });
          f("#ui-datepicker-div").css("display", "none")
        });
        return a._input
      },
      get: function(a) {
        return a._input.value
      },
      set: function(a, b) {
        f(a._input).datepicker("setDate", b)
      },
      enable: function(a) {
        f(a._input).datepicker("enable")
      },
      disable: function(a) {
        f(a._input).datepicker("disable")
      }
    })
  })();
  e.prototype.CLASS = "Editor";
  e.VERSION = "1.1.0";
  e.prototype.VERSION = e.VERSION
})(window, document, void 0, jQuery, jQuery.fn.dataTable);