function triggerEvent(el: Element, eventName: string, options: Object = {}) {
    var event;
    try {
        if (window.CustomEvent) {
            event = new CustomEvent(eventName, options);
        } else {
            event = document.createEvent('CustomEvent');
            event.initCustomEvent(eventName, true, true, options);
        }
        el.dispatchEvent(event);
    } catch (e) {
        console.error(e);
    }
}

class MonthsNavigator {
    public element: Element;
    protected _inner: Element;
    protected _list: HTMLUListElement;
    protected _prev: Element;
    protected _next: Element;
    constructor(element: HTMLElement) {
        this.element = element;
        try {
            let _this = this;
            this._inner = this.element.getElementsByClassName('inner').item(0);
            this._list = <HTMLUListElement> this._inner.children.item(0);
            this._prev = this.element.getElementsByClassName('prev').item(0);
            this._prev.addEventListener('click', function (e) {
                _this.prevClick.apply(_this, [this]);
            }, true);
            this._next = this.element.getElementsByClassName('next').item(0);
            this._next.addEventListener('click', function (e) {
                _this.nextClick.apply(_this, [this]);
            }, true);
            for (let i = 0; i < this._list.children.length; i++) {
                this._list.children.item(i).addEventListener('click', function (e) {
                    _this.listItemClick.apply(_this, [this]);
                });
            }
            this.scrollToActive();
        } catch (e) {
            console.error(e);
        }
    }
    protected listItemClick(item: Element) {
        triggerEvent(this.element, 'itemClick', {bubbles: true, cancelable: true, detail: item});
    }
    protected getMaxTop() {
        return this._inner.clientHeight - this._list.clientHeight;
    }
    protected scrollToActive() {
        try {
            let active = <HTMLLIElement> this._list.querySelector('.active');
            let top = Math.floor(this._inner.clientHeight / 2) - active.offsetTop;
            if (top < this.getMaxTop())
                top = this.getMaxTop();
            if (top > 0)
                top = 0;
            this._list.style.top = top + 'px';
        } catch (e) {}
    }
    protected prevClick() {
        try {
            let top = this._list.offsetTop + Math.floor(this._inner.clientHeight / 3);
            if (top > 0)
                top = 0;
            this._list.style.top = top + 'px';
        } catch (e) {}
    }
    protected nextClick() {
        try {
            let top = this._list.offsetTop - Math.floor(this._inner.clientHeight / 3);
            if (top < this.getMaxTop())
                top = this.getMaxTop();
            this._list.style.top = top + 'px';
        } catch (e) {}
    }
}