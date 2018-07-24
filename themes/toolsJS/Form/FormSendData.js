function sendFormAjaxData(formId, eventType, controllerType, successSendFunction) {
    var idF = '#' + formId;
    $(idF).on(eventType, function () {
        $.ajax({
            url: "/?controller=",
            context: document.body
        });
    });
}