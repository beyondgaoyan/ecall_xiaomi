(function() {
    var a = window.Xmeb || {};
    a = {
        _INSTALL: function() {
            window.Xmeb = a;
        },
        Base: {},
        UI: {},
        App: {},
        Page: {}
    };

    a.App = {
        getBLength: function(b) {
            return $.trim(b).replace(/[^\x00-\xff]/g, "**").length;
        },
        getWLength: function(b) {
            return Math.ceil($.trim(b).replace(/[^\x00-\xff]/g, "**").length / 2);
        },
        lazyload: function(e) {
            var d = {
                defObj: null,
                defHeight: 0
            };
            d = $.extend(d, e || {});
            var c = d.defHeight,
            h = (typeof d.defObj == "object") ? d.defObj.find("img") : $(d.defObj).find("img");
            var b = function() {
                var i = document,
                j = (navigator.userAgent.toLowerCase().match(/iPad/i) == "ipad") ? window.pageYOffset: Math.max(i.documentElement.scrollTop, i.body.scrollTop);
                if (navigator.userAgent.toLowerCase().match(/iPad/i) == "ipad") {
                    d.defHeight = 0;
                }
                return i.documentElement.clientHeight + j - d.defHeight;
            };
            var f = function(j) {
                var i = j.attr("src2");
                if (i) {
                    j.css({
                        opacity: "0.3"
                    }).attr("src", i).removeAttr("src2").animate({
                        opacity: "1"
                    });
                }
            };
            var g = function() {
                h.each(function() {
                    if (navigator.userAgent.toLowerCase().match(/iPad/i) == "ipad") {
                        f($(this));
                    } else {
                        if ($(this).offset().top <= b()) {
                            f($(this));
                        }
                    }
                });
            };
            g();
            $(window).bind("scroll",
            function() {
                g();
            });
        },
     
        xmFocus: {
            init: function(d, c) {
                var e = this;
                this._obj = d;
                this.mlength = this._obj.find("a").length;
                this.setOptions(c);
                this.mwidth = this.options.mwidth;
                this.mtime1 = this.options.mtime1;
                this.mtime2 = this.options.mtime2;
                this.autoWidth = this.options.autoWidth;
                if (this.mlength != 1) {
                    this.ul = this._obj.find("ul");
                    this.build(this.ul, this.mlength);
                    var b = (parseInt(this._obj.find("li").eq(0).width()) + 8) * this.mlength;
                    this.ul.css({
                        width: b
                    });
                    if (this.autoWidth) {
                        this.ul.css({
                            right: "50%",
                            "margin-right": "-465px"
                        });
                        this._obj.find("a").css({
                            display: "inline-block",
                            width: "960",
                            height: "430"
                        });
                    }
                    e.options.AllowAutoSlide = true;
                    this._obj.find("a").mouseenter(function() {
                        e.options.AllowAutoSlide = false;
                    }).mouseleave(function() {
                        e.options.AllowAutoSlide = true;
                    });
                    this.ul.find("li").mouseenter(function(f) {
                        e.options.AllowAutoSlide = false;
                        e.slideTo(this);
                    }).mouseleave(function() {
                        e.options.AllowAutoSlide = true;
                    });
                    setInterval(function() {
                        if (e.options.AllowAutoSlide) {
                            e.slideDown();
                        }
                    },
                    e.mtime1);
                }
                this._obj.css({
                    width: this.mwidth
                });
            },
            setOptions: function(b) {
                this.options = {
                    mwidth: 1024,
                    mtime1: 7000,
                    mtime2: 500,
                    autoWidth: false,
                    AllowAutoSlide: false
                };
                for (var c in b) {
                    this.options[c] = b[c];
                }
            },
            build: function(d, c) {
                this.tmp = "";
                for (var b = 0; b < c; b++) {
                    this.tmp += "<li index=" + (c - b) + "></li>";
                }
                d.html(this.tmp);
                d.find("li").last().addClass("on");
                this.ulWidth = d.width();
            },
            slideDown: function() {
                var d = this;
                var c = d.ul.find("li.on");
                if (c.length <= 0) {
                    return;
                }
                var b = c.get(0).previousSibling;
                d.slideTo(b ? b: d.ul.find("li").last());
            },
            slideTo: function(f) {
                var g = this;
                if (!f) {
                    return;
                }
                var b = g.ul.find("li.on").attr("index");
                if (this.autoWidth) {
                    var e = g._obj.find("div[index='" + b + "']");
                    var c = g._obj.find("div[index='" + $(f).attr("index") + "']");
                } else {
                    var e = g._obj.find("a[index='" + b + "']");
                    var c = g._obj.find("a[index='" + $(f).attr("index") + "']");
                }
                var d = function() {
                    if (b == $(f).attr("index")) {
                        return;
                    }
                    g.ul.find("li.on").removeClass("on");
                    $(f).addClass("on");
                    c.css("z-index", 2);
                    e.css("z-index", 3).fadeOut(g.mtime2,
                    function() {
                        $(this).css("z-index", "1").show();
                    });
                };
                if (!g.options.AllowAutoSlide) {
                    setTimeout(function() {
                        d();
                    },
                    400);
                } else {
                    d();
                }
            }
        }
    };
    a._INSTALL();
})();