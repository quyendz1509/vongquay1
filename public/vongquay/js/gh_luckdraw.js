
(function (g) {
    g = function (c, a) { if (c) this.container = document.getElementById(c), this._li = this.container.querySelectorAll("li"); else throw new ReferenceError("The first selector parameter must be passed~~"); a && (this.order = a.order, this.t = a.t, this.round = a.round, console.log(this.order)) }; g.prototype.start = function (c, a) {
        function h() {
            for (var k = 0; k < d._li.length; k++)d._li[k].className = "drop-shadow-md  bg-white rounded-lg py-5 border-4 px-5"; d._li[d.order[b % d._li.length]].className = "drop-shadow-md  bg-white rounded-lg py-5 px-5 border-4 border-rose-600"; b++; b < e - 8 ? l = setTimeout(h, f) : b >= e - 8 && b < e + c && (f += 5 * (b - e + 8), l = setTimeout(h,
                f)); b >= e + c && (a && a(c), clearTimeout(l))
        } var b = 0, f = this.t, e = 8 * this.round, l = setTimeout(h, f), d = this
    }; window.Luckdraw = g
})(jQuery);