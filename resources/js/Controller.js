var Controller = {

    /**
     * AJAX запрос к контроллеру
     * @param $controller
     * @param $data
     * @param $callback
     * @param $async
     */
    call: function ($controller, $data, $callback, $errorCallBack) {

        let data = {
            'call': $controller,
            'data': $data
        };
        // $.ajax({
        //     type: 'POST',
        //     cache: false,
        //     url: '/Controller/ajax',
        //     dataType: 'html',
        //     async: $async,
        //     headers: {
        //         'contentType': "application/json",
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     data: data,
        //     success: $callback
        // });
        let config = {
            headers: {
                'contentType': "application/json",
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        };
        callback = $callback;
        axios.post('/Controller/ajax', data, config).then(function (response) {
            callback(response, )
        }).catch($errorCallBack);
    }


};
// $(document).on('click', '.js-save_block', function () {
//     var data =  {};
//     var o =  $('.js-block_form').serializeArray();
//     console.log($('.js-block_form'));
//     console.log(o);
//     $.each(o, function () {
//         if (data[this.name]) {
//             if (!data[this.name].push) {
//                 data[this.name] = [data[this.name]];
//             }
//             data[this.name].push(this.value || '');
//         } else {
//             data[this.name] = this.value || '';
//         }
//     });
//     function callback(result) {
//         console.log(result);
//         $('#collback_place').html(result);
//     }
//
//     Controller.call(
//         'AdminController@saveBlock',
//         data,
//         callback,
//         false
//     );
// });