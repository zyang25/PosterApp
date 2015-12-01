window.current_page = 0;
window.current_category_id = 'all';
window.current_activity_number = 0;
query_activity('all');
console.log(window.current_page);
console.log(window.current_activity_number);


$(document).ready(function(){

            $('.nav.nav-tabs li').on("click",function(event){
                
                // Clear
                $(".tab-pane.fade.in.active .activites_content").empty();
                window.current_activity_number = 0;

                $(event.target).addClass("on_clicked"); 
                category_id = $(".nav.nav-tabs a.on_clicked").data('categoryid');
                $(".nav.nav-tabs a.on_clicked").removeClass( "on_clicked" );
                console.log(category_id);
                query_activity(category_id);
                
                //
                window.current_category_id = category_id;
                console.log(window.current_activity_number);
            });


            // Load automatically
            $(window).scroll(function() {   
               if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                   load_more_activity(current_category_id, window.current_activity_number);
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


function query_activity(categoryId){
    $.ajax({
      url: 'ajax_query.php',
      type: 'POST',
      data: {'category_id': categoryId},
      success: function(data, status) {

        var activities = jQuery.parseJSON(data);
        
        
        var row_page = 0;

        $.each(activities,function(key,activity){
            window.current_activity_number = window.current_activity_number + 1;

            var image_path = '../assets/img/activities-large-pic/' + activity.image;

            if(key % 3 == 0){
                window.current_page = key;
                row_page = 'page'+key;
                //console.log(row_page);
                $(".tab-pane.fade.in.active .activites_content").append(
                    '<div class="row" id="'+row_page+'">'+
                        
                    '</div>'
                    );
            }

            //console.log('Page was created.'+row_page);
            $(".tab-pane.fade.in.active .activites_content #"+row_page).append(
                '<div class="col-md-4 col-sm-6 hero-feature">'+
                        '<div class="thumbnail">'+
                            '<a href="activities.php?activity_id='+activity.activity_id+'">'+
                                '<img class="img-responsive" src="'+ image_path +'" alt="" style="width:100%;height:340px;">'+
                            '</a>'+
                            '<div class="caption">'+
                                '<h2>'+activity.title+'</h2>'+
                                '<h4>'+activity.description+'</h4>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
            );
            
        });

        $(".tab-pane.fade.in.active .activites_content").append(
            '<div class="more_activites_content"></div><center><button type="button" class="btn btn-success" id="load_more">Loading more</button></center>'
        );

        

      },
      error: function(xhr, desc, err) {
        console.log(xhr);
        console.log("Details: " + desc + "\nError:" + err);
      }
    }); // end ajax call
}



function load_more_activity(categoryId, offset){
    $.ajax({
      url: 'ajax_query.php',
      type: 'POST',
      data: {'category_id': categoryId, 'current_activity_number': offset},
      success: function(data, status) {

        //console.log(window.current_page);
        console.log(offset);
        console.log(JSON.parse(data));
        var activities = jQuery.parseJSON(data);
        //console.log(activities[0].title);
        // Clear content in acivity

        $.each(activities,function(key,activity){
            window.current_activity_number = window.current_activity_number + 1;
            var image_path = '../assets/img/activities-large-pic/' + activity.image;

            if(key % 3 == 0){
                
                window.current_page = window.current_page +1;
                new_page = 'page'+window.current_page;
                console.log(new_page);
                $(".tab-pane.fade.in.active .activites_content button").before(
                    '<div class="row" id="'+new_page+'">'+
                        
                    '</div>'
                    );
            }

            console.log('Page was created.'+new_page);
            $(".tab-pane.fade.in.active .activites_content #"+new_page).append(
                '<div class="col-md-4 col-sm-6 hero-feature">'+
                        '<div class="thumbnail">'+
                            '<a href="activities.php?activity_id='+activity.activity_id+'">'+
                                '<img class="img-responsive" src="'+ image_path +'" alt="" style="width:100%;height:340px;">'+
                            '</a>'+
                            '<div class="caption">'+
                                '<h2>'+activity.title+'</h2>'+
                                '<h4>'+activity.description+'</h4>'+
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