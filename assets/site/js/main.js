/* global krajeeDialogCust */

(function (window, $) {
    function getMapForm(id, isSetOnly) {
        var map = {},
                nodes = document.getElementById(id).elements,
                i1 = 0,
                currentNode;
        while (currentNode = nodes[i1++]) {
            switch (currentNode.nodeName.toLowerCase()) {
                case 'input':
                    if ('checkbox' === currentNode.type.toLowerCase()) {
                        if (isSetOnly && !currentNode.checked) {
                            break;
                        }
                        map[currentNode.name] = currentNode.checked;
                        break;
                    }
                    if (currentNode.value.length) {
                        map[currentNode.name] = currentNode.value;
                    }
                    break;
                case 'textarea':
                    if (currentNode.value.length) {
                        map[currentNode.name] = currentNode.value;
                    }
                    break;
                case 'select':
                    if (currentNode.value.length) {
                        map[currentNode.name] = currentNode.value;
                    }
                    break;
            }
        }
        return map;
    }

    var noticeSubmit = function (e) {
        e.preventDefault();
        var fd = getMapForm('notice_form');
        $.post(this.action, fd, function (d) {
            d = JSON.parse(d);
            if (!d.error) {
                showToast('success', d.message);
                var active = $('#mn li.active a');
                var u = $('#mn li.active a').attr('href');
                var p = u.search(/\?/);
                var qs = u.substr(p + 1);
                var h = u.substr(0, p);
                var params = qs.split('&');
                for (var i = 0; i < params.length; i++) {
                    var par = params[i].split('=');
                    if (par[0] === 'currentMonth') {
                        params[i] = 'currentMonth=' + d.month;
                    }
                }
                params.push('sort=-id');
                active.attr('href', h + '?' + params.join('&'));
                $('#mn li.active a').trigger('click');
                noticeFormHide();
            } else {
                showToast('error', d.message);
            }
        });
    };

    var noticeDeleteClick = function (e) {
        e.preventDefault();
        var _that = this;
        krajeeDialogCust.confirm(
                'Действительно желает удалить запись с ID <i>' + _that.parentNode.getAttribute('data-id') + '</i>',
                function (out) {
                    if (out) {
                        $.post(
                                _that.parentNode.getAttribute('href'),
                                {id: _that.parentNode.getAttribute('data-id')},
                        function (d) {
                            d = JSON.parse(d);
                            if (!d.error) {
                                showToast('success', d.message);
                                $('#mn li.active a').trigger('click');
                            } else {
                                showToast('error', d.message);
                            }
                        });
                    }
                });
    };

    var noticeTask = function (e) {
        var bl = $('.task-container');
        if (bl.hasClass('expanded')) {
            bl
                    .removeClass('expanded')
                    .addClass('collapsed');
            return true;
        }
        if (bl.hasClass('collapsed')) {
            bl
                    .removeClass('collapsed')
                    .addClass('expanded');
            return true;
        }
    };
    var noticeAddClick = function (e) {
        var bl = $('.form-container');
        if (bl.hasClass('expanded')) {
            noticeFormHide();
            return true;
        }
        if (bl.hasClass('collapsed')) {
            noticeFormShow();
            return true;
        }
    };

    var noticeFormShow = function () {
        loadForm();
        $('.form-container')
                .removeClass('collapsed')
                .addClass('expanded');
    };
    var noticeFormHide = function () {
        $('.form-container')
                .removeClass('expanded')
                .addClass('collapsed');
    };

    var loadList = function () {
        $.get('/site/list', {}, function (d) {
            $('.list-container').html(d);
        });
    };
    var loadForm = function () {
        $.get('/site/create', {}, function (d) {
            $('.form-container').html(d);
        });
    };

    $(document).ready(function () {
        loadList();
        $(document).on('submit', '#notice_form', noticeSubmit);
        $(document).on('click', '.glyphicon-trash', noticeDeleteClick);
        $(document).on('click', '.btn-add-message', noticeAddClick);
        $(document).on('click', '.btn-read-task', noticeTask);
    });

})(window, jQuery);