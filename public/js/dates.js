function loadDates() {

    var loading = false; //prevents multiple loads


    var date =$("#booked_date").val()
    if (loading == false) {
        loading = true;  //set loading flag on
        $('.loading-info').show(); //show loading animation

        $.get('/load_times', {
            'date': date,
            'test': test
            // "_token":csrf_token,


        }, function (data) {
            loading = false; //set loading flag off once the content is loaded
            if (data.trim().length == 0) {
                //notify user if nothing to load
                $('.loading-info').html("<div class='col-md-12 text-center'> No  More records found!</div>");
                return;
            }
            $('.loading-info').hide(); //hide loading animation once data is received
            $("#results").html(data); //append data into #results element
           // $("#results").append(data); //append data into #results element

        }).fail(function (xhr, ajaxOptions, thrownError) { //any errors?
            //alert(thrownError); //alert with HTTP error
        })
    }
}




