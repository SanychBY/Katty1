<?php
function FormSendData_get_js($formId, $controllerType, $successSendFunction)
{
    return "
    var data = {};
        var idF = '#{$formId}';
        $(idF).find('*') . each(function () {
            if ($(this).attr('name') !== undefined && isNaN($(this).attr('name')) && $(this).attr('name') !== ''){
                data[$(this).attr('name')] = $(this).val();
            }
        });

            $.ajax({
                url: '/?controller={$controllerType}',
                method: 'POST',
                data: data,
                success: {$successSendFunction}
            });
 
 return false;";
 }
