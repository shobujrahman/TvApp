$(document).ready(function () {
    $("#type").change(function () {
        var type = $("#type").val();

        if (type == 'tvChannel') {
            $("#video").hide(1000);
            $("#channel").show(1000);
        }

        if (type == 'video') {
            $("#video").show(1000);
            $("#channel").hide(1000);
        }


    });

    $(window).on('load', function () {
        var type = $("#type").val();

        if (type == 'tvChannel') {
            $("#video").hide(1000);
            $("#channel").show(1000);
        }

        if (type == 'video') {
            $("#video").show(1000);
            $("#channel").hide(1000);
        }

    });

});


$(document).ready(function () {
    $('#watch_ads').change(function () {
        var types = $('#watch_ads').val();

        if(types == 'paid' || types == 'rent') {
            // $("#video").hide(1000);
            $('#content').show(1000);
        }
	
        
        else {
            // $("#video").hide(1000);
            $('#content').hide(1000);
        }

    });

    $(window).on('load', function () {
        var types = $('#watch_ads').val();

       if(types == 'paid' || types == 'rent') {
            // $("#video").hide(1000);
            $('#content').show(1000);
        }

        else {
            // $("#video").hide(1000);
            $('#content').hide(1000);
        }

    });

});