<!DOCTYPE html>
<html>
    <head>
        <title>Demo: Lazy Loader</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/animate.css/3.4.0/animate.min.css">
        <style>
           .list {
                width: 100%;
                float: left;
                margin: 0;
                padding: 0;
            }

            .list li {
                list-style: none;
                /*                        width: 33.3%;*/
                /*                        float: left;
                                        padding-left: 15px;
                                        padding-right: 15px;
                                        margin-bottom: 20px;*/
                display: none;
            }

            .list span {
                background: #77787b;
                color: #fff;
                display: block;
                text-align: center;
                padding: 15px;
                min-height: 400px;
            }

            * {
                box-sizing: border-box;
            }

            .load-btn {
                margin: auto;
                display: block;
                padding: 5px 10px;
                color: black;
                border: none;
                margin-bottom: 200px;
                cursor: pointer;
            }
        </style>
        <script>
            (function ($) {
                $.fn.loaddata = function (options) {// Settings
                    var settings = $.extend({
                        loading_gif_url: "ajax-loader.gif", //url to loading gif
                        end_record_text: 'No more records found!', //no more records to load
                        data_url: 'fetch_pages.php', //url to PHP page
                        start_page: 1 //initial page
                    }, options);

                    var el = this;
                    loading = false;
                    end_record = false;
                    contents(el, settings); //initial data load

                    $(window).scroll(function () { //detact scroll
                        if ($(window).scrollTop() + $(window).height() >= $(document).height()) { //scrolled to bottom of the page
                            contents(el, settings); //load content chunk 
                        }
                    });
                };
                //Ajax load function
                function contents(el, settings) {
                    var load_img = $('<img/>').attr('src', settings.loading_gif_url).addClass('loading-image'); //create load image
                    var record_end_txt = $('<div/>').text(settings.end_record_text).addClass('end-record-info'); //end record text

                    if (loading == false && end_record == false) {
                        loading = true; //set loading flag on
                        el.append(load_img); //append loading image
                        $.post(settings.data_url, {'page': settings.start_page}, function (data) { //jQuery Ajax post
                            if (data.trim().length == 0) { //no more records
                                el.append(record_end_txt); //show end record text
                                load_img.remove(); //remove loading img
                                end_record = true; //set end record flag on
                                return; //exit
                            }
                            loading = false;  //set loading flag off
                            load_img.remove(); //remove loading img 
                            el.append(data);  //append content 
                            settings.start_page++; //page increment
                        })
                    }
                }

            })(jQuery);

            $("#results").loaddata();
        </script>
    </head>
    <body>


    <div class="wrapper">
        <ul id="results"><!-- results appear here as list --></ul>
</div>
</body>
</html>