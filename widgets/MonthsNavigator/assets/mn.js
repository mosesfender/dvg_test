function triggerEvent(el, eventName, options) {
    if (options === void 0) { options = {}; }
    var event;
    try {
        if (window.CustomEvent) {
            event = new CustomEvent(eventName, options);
        }
        else {
            event = document.createEvent('CustomEvent');
            event.initCustomEvent(eventName, true, true, options);
        }
        el.dispatchEvent(event);
    }
    catch (e) {
        console.error(e);
    }
}
var MonthsNavigator = (function () {
    function MonthsNavigator(element) {
        this.element = element;
        try {
            var _this_1 = this;
            this._inner = this.element.getElementsByClassName('inner').item(0);
            this._list = this._inner.children.item(0);
            this._prev = this.element.getElementsByClassName('prev').item(0);
            this._prev.addEventListener('click', function (e) {
                _this_1.prevClick.apply(_this_1, [this]);
            }, true);
            this._next = this.element.getElementsByClassName('next').item(0);
            this._next.addEventListener('click', function (e) {
                _this_1.nextClick.apply(_this_1, [this]);
            }, true);
            for (var i = 0; i < this._list.children.length; i++) {
                this._list.children.item(i).addEventListener('click', function (e) {
                    _this_1.listItemClick.apply(_this_1, [this]);
                });
            }
            this.scrollToActive();
        }
        catch (e) {
            console.error(e);
        }
    }
    MonthsNavigator.prototype.listItemClick = function (item) {
        triggerEvent(this.element, 'itemClick', { bubbles: true, cancelable: true, detail: item });
    };
    MonthsNavigator.prototype.getMaxTop = function () {
        return this._inner.clientHeight - this._list.clientHeight;
    };
    MonthsNavigator.prototype.scrollToActive = function () {
        try {
            var active = this._list.querySelector('.active');
            var top_1 = Math.floor(this._inner.clientHeight / 2) - active.offsetTop;
            if (top_1 < this.getMaxTop())
                top_1 = this.getMaxTop();
            if (top_1 > 0)
                top_1 = 0;
            this._list.style.top = top_1 + 'px';
        }
        catch (e) { }
    };
    MonthsNavigator.prototype.prevClick = function () {
        try {
            var top_2 = this._list.offsetTop + Math.floor(this._inner.clientHeight / 3);
            if (top_2 > 0)
                top_2 = 0;
            this._list.style.top = top_2 + 'px';
        }
        catch (e) { }
    };
    MonthsNavigator.prototype.nextClick = function () {
        try {
            var top_3 = this._list.offsetTop - Math.floor(this._inner.clientHeight / 3);
            if (top_3 < this.getMaxTop())
                top_3 = this.getMaxTop();
            this._list.style.top = top_3 + 'px';
        }
        catch (e) { }
    };
    return MonthsNavigator;
}());
