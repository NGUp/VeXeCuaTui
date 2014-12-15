function showNotification(selector, content, position) {
    var options;
    if (position == null) {
        position = 'left';
    }
    options = function(content) {
        return {
            animation: 'true',
            deplay: 1000,
            placement: position,
            content: content,
            container: 'body'
        };
    };
    $(selector).popover(options(content));
    $(selector).popover('show');
}

function removeNotification(selector) {
    $(selector).popover('destroy');
}