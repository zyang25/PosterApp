window.page = 0;
window.current_category_id = 'all';
window.current_activity_number = 0;

index_activity('all');

$(document).ready(function(){

    $('ul.nav.nav-tabs li').on("click",function(event){
        
        $(".activities").empty();
        window.page = 0;
        window.current_activity_number = 0;


        var category_id = $(event.target).data('categoryid');
        console.log("Category_id: "+category_id);
        index_activity(category_id);
        window.current_category_id = category_id;
        console.log(window.current_activity_number);
    });

    // Load automatically
    $(window).scroll(function() {   
       if($(window).scrollTop() + $(window).height() >= $(document).height()) {
           index_more_activity(current_category_id, window.current_activity_number);
       }
    });

    // Click manually
    // $(document).on('click', '#load_more', function(){ 
    //     console.log('You click');
    //     //category_id = $(".nav.nav-tabs a.on_clicked").data('categoryid');
    //     console.log(current_category_id);
    //     load_more_activity(current_category_id, window.current_activity_number);
    // });

});

function index_activity(categoryId){
    $.ajax({
      url: 'ajax_query.php',
      type: 'GET',
      async: false,
      cache: false,
      data: {'category_id': categoryId},
      success: function(data, status) {

        var activities = jQuery.parseJSON(data); 

        $.each(activities,function(key,activity){
            window.current_activity_number = window.current_activity_number + 1;
            var image_path = '../assets/img/activities-large-pic/' + activity.image;
            
            if( (key% 3 == 0 || key == 0)&& key != (activities.length-1)){
                window.page ++;
                $('.activities').append(
                '<div class="row'+window.page+'">'+
                '</div>'
                );
            }
            
            title = strip(activity.title);

            $('.activities .row'+window.page).append(
            '<div class="_activity">'+
                '<div class="col-md-4 hero-feature">'+
                        '<div class="thumbnail">'+

                            '<a href="activities.php?activity_id='+activity.activity_id+'">'+
                                '<figure><img class="img-responsive" src="'+ image_path +'"></figure>'+
                            '</a>'+
                            '<div class="caption">'+
                                '<h5>'+title+'</h5>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
            '</div>'
                );
            //console.log(row_page);
        });
        
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
}

function index_more_activity(categoryId, offset){
    $.ajax({
      url: 'ajax_query.php',
      type: 'GET',
      async: false,
      cache: false,
      data: {'category_id': categoryId, 'current_activity_number': offset},
      success: function(data, status) {

        var activities = jQuery.parseJSON(data);
        
        if(activities.length > 0){
            window.page ++ ;
        }

        $.each(activities,function(key,activity){
            window.current_activity_number = window.current_activity_number + 1;
            var image_path = '../assets/img/activities-large-pic/' + activity.image;


            if( (key% 3 == 0 || key == 0)&& key != (activities.length-1)){
                window.page ++ ;
                $('.activities').append(
                '<div class="row'+window.page+'">'+
                '</div>'
                );
            }

            title = strip(activity.title);

            $('.activities .row'+window.page).append(
            '<div class="_activity">'+   
                '<div class="col-md-4 hero-feature">'+
                        '<div class="thumbnail">'+

                            '<a href="activities.php?activity_id='+activity.activity_id+'">'+
                                '<figure><img class="img-responsive" src="'+ image_path +'"></figure>'+
                            '</a>'+
                            '<div class="caption">'+
                                '<h5>'+title+'</h5>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
            '</div>'
                );
            
        });
      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
}

function strip(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}


