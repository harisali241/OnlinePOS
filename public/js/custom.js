var base_url = window.location.origin;

$("#location").keyup(function() {
    var mylocation = $(this).val();
    console.log(mylocation);
    $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address="+encodeURIComponent(mylocation), function(val) {
        if(val.results.length) {
            var location = val.results[0].geometry.location;
            $("#latitude").val(location.lat);
            $("#longitude").val(location.lng);
        }
    });

    if(mylocation === '')
    {
        $("#latitude").val('');
        $("#longitude").val('');
    }



});

$(".location2").keyup(function() {
    var mylocation = $(this).val();
    var user_id = $(this).data('userid');

    console.log(mylocation);
    $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?address="+encodeURIComponent(mylocation), function(val) {
        if(val.results.length) {
            var location = val.results[0].geometry.location;
            $("#latitude"+user_id).val(location.lat);
            $("#longitude"+user_id).val(location.lng);
        }
    });

    if(mylocation === '')
    {
        $("#latitude"+user_id).val('');
        $("#longitude"+user_id).val('');
    }



});

$('#show_map1').click(function () {
    var latitude = $("#latitude").val();
    var longitude = $("#longitude").val();

    if(latitude !== '' && longitude !== '')
    {
        $("#create_map").css('height','400px');
        var latlng = new google.maps.LatLng(latitude, longitude);
        var myOptions = {
            zoom: 18,
            center: latlng,
            zoomControl: true,
            mapTypeControl: false,
            streetViewControl: false,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("create_map"), myOptions);
        var marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
    }
    else{
        swal({
            title: "Required!",
            text: "PLease Enter Location!",
            confirmButtonColor: "#0098a3",
        });
    }

});

$('.show_map2').click(function () {
    var user_id = $(this).data('userid');
    var latitude = $("#latitude"+user_id).val();
    var longitude = $("#longitude"+user_id).val();
    //alert(user_id);
    if(latitude !== '' && longitude !== '')
    {
        $("#create_map"+user_id).css('height','400px');
        var latlng = new google.maps.LatLng(latitude, longitude);
        var myOptions = {
            zoom: 18,
            center: latlng,
            zoomControl: true,
            mapTypeControl: false,
            streetViewControl: false,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("create_map"+user_id), myOptions);
        var marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
    }
    else{
        swal({
            title: "Required!",
            text: "PLease Enter Location!",
            confirmButtonColor: "#0098a3",
        });
    }

});

$('.username').keyup(function () {
    var username = $(this).val();

    $.ajax({
        url: base_url+'/check_username',
        type: 'GET',
        data: {username: username},
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if(response === 0)
            {
                $('.submit_form_check').attr('disabled','disabled');

                var hmtl='<span class="text-danger">Username Is Already In Use Choose Another</span>';

                $('.username_check').html(hmtl);
            }
            else if(response === 1)
            {
                $('.submit_form_check').removeAttr('disabled','disabled');

                var hmtl='<span class="text-success">Available</span>';

                $('.username_check').html(hmtl);
            }
        }
    });
});



$('.username2').keyup(function () {
    var username = $(this).val();
    var user_id = $(this).data('userid');

    $.ajax({
        url: base_url+'/check_username_edit',
        type: 'GET',
        data: {username: username,userId: user_id},
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if(response === 0)
            {
                $('.submit_form_check'+user_id).attr('disabled','disabled');

                var hmtl='<span class="text-danger">Username Is Already In Use Choose Another</span>';

                $('.username_check'+user_id).html(hmtl);
            }
            else if(response === 1)
            {
                $('.submit_form_check'+user_id).removeAttr('disabled','disabled');

                var hmtl='<span class="text-success">Available</span>';

                $('.username_check'+user_id).html(hmtl);
            }
        }
    });
});

$('.change_pass').click(function () {
    var user_id = $(this).data('userid');

    $('#password'+user_id).removeAttr('readonly','readonly');
});