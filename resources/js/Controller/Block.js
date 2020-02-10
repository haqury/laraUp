var ControllerBlock = {
    submit: function (vue) {
        var vue = vue;
        var callback = function (result) {
            vue.result = result.data;
        };
        Controller.call(
            'AdminController@saveBlock',
            vue.config.model,
            callback,
            false
        );
    }
};