$( document )
    .ready( function () {

        $.ajaxSetup( {
            headers: {
                'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' )
                    .attr( 'content' )
            }
        } );


        function authenticated( url ) {
            window.location = url;
        }

        function resetForm( $form ) {
            $form.find(
                    'input:text, input:password, input:file, select, textarea'
                )
                .val( '' );
            $form.find( 'input:radio, input:checkbox' )
                .removeAttr( 'checked' )
                .removeAttr( 'selected' );
        }

        function loader( v ) {
            if ( v == 'on' ) {
                $( '#activatefirstlink_form' )
                    .css( {
                        opacity: 0.2
                    } );
                $( '#activatorloader' )
                    .show();
            } else {
                $( '#activatefirstlink_form' )
                    .css( {
                        opacity: 1
                    } );
                $( '#activatorloader' )
                    .hide();
            }
        }

        $( '#activatefirstlink_form' )
            .on( 'submit', function ( e ) {

                e.preventDefault();
                var datalink = $( '#activatefirstlink_form' )
                    .serializeArray();
                var url = $( '#activatefirstlink_form' )
                    .attr( 'action' );
                loader( 'on' );

                $.ajax( {
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: datalink,
                    success: function ( data ) {
                        loader( 'off' );
                        
                        if ( data.success === false ) {
                            $.each( data.errors, function (
                                index, error ) {
                                Materialize.toast(
                                    error, 4000,
                                    '',
                                    function () {
                                        console
                                            .log(
                                                error
                                            );
                                    } );
                            } );
                        }
                        if ( data.success === true ) {
                            var $toastContent = $(
                                '<span>Congratulations! Your Link is Activated!</span>'
                            );
                            Materialize.toast(
                                $toastContent, 5000 );
                            resetForm( $(
                                '#activatefirstlink_form'
                            ) );
                        }
                    },
                    error: function ( data ) {
                        loader( 'off' );
                        var errors = data.responseJSON;
                        $.each( errors.errors, function (
                            index, error ) {
                            Materialize.toast(
                                error, 4000, '',
                                function () {
                                    console.log(
                                        error
                                    );
                                } );
                        } );

                    }
                } );

            } );



    } );
