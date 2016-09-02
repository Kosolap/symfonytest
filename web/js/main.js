/**
 * Created by ln1 on 02.09.16.
 */

$(document).ready(function(){


    $('.hello').text('New text');


    $('#addUser').click(function () {

        $.ajax({
            url: '/save',
            data: {'name': $('#name').val()},
            success: function(data){

                console.log(data);
                },
            async: false});

    });

    $('#getUsers').click(function () {

        $.ajax({
            url: '/loadAll',
            data: '',
            dataType: 'json',
                success: function(data){

                    $('#usersTable').append( '<tr><td>№</td><td>Name</td><td>Login</td><td>Age</td></tr>' );

                    for(i = 0; i < data['users'].length; i++){

                        user = jQuery.parseJSON(data['users'][i]);


                        $('#usersTable').append( '<tr><td>'+(i+1)+'</td><td>'+user.name+'</td><td>'+user.login+'</td><td>'+user.age+'</td></tr>' );

                    }

                },
            async: false

        });

    })

});