$(window).on('unload', function () {

    $(window).scrollTop(0);

});


// var csrf_token = $('meta[name="csrf-token"]').attr('content');

var track_page = 1; //track user scroll as page number, right now page number is 1
var loading = false; //prevents multiple loads
//$("#results").empty();
load_contents(track_page, search);


$(window).scroll(function () { //detect page scroll
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled to bottom of the page
        //      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 100) {

        track_page++; //page number increment
        load_contents(track_page, search); //load content
    }
});

//Ajax load function
function load_contents(track_page, search) {
//alert(search);
    longitude = "";
    latitude = "";

    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(function (position) {

            latitude = position.coords.latitude;
            longitude  = position.coords.longitude;

            if (loading == false) {

                loading = true;  //set loading flag on
                $('.loading-info').show(); //show loading animation

                $.get('/search/list', {
                    'page': track_page,
                    'longitude': longitude,
                    'latitude': latitude,
                    'search': search,
                    // "_token":csrf_token,


                }, function (data) {
                    loading = false; //set loading flag off once the content is loaded
                    if (data.trim().length == 0) {
                        //notify user if nothing to load
                        $('.loading-info').html("<div class='col-md-12 text-center'> No  More records found!</div>");
                        return;
                    }
                    $('.loading-info').hide(); //hide loading animation once data is received
                    $("#results").append(data); //append data into #results element


                }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?
                    //alert(thrownError); //alert with HTTP error
                })
            }
        });
    }else{
        if (loading == false) {

            loading = true;  //set loading flag on
            $('.loading-info').show(); //show loading animation

            $.get('/search/list', {
                'page': track_page,
                'search': search,
                // "_token":csrf_token,


            }, function (data) {
                loading = false; //set loading flag off once the content is loaded
                if (data.trim().length == 0) {
                    //notify user if nothing to load
                    $('.loading-info').html("<div class='col-md-12 text-center'> No  More records found!</div>");
                    return;
                }
                $('.loading-info').hide(); //hide loading animation once data is received
                $("#results").append(data); //append data into #results element


            }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?
                //alert(thrownError); //alert with HTTP error
            })
        }
    }



}


$("#search").keyup(function (event) {
    var stt = $(this).val();

    //   $("div").text(stt);
    $('#results').empty();

    load_contents(1, stt); //load content

});




