$("#follow_status").click(function(){
    var user_id = $('#user_id').val();
    var activity_id = $('#activity_id').val();  
    var value = $("#follow_status").attr("key");
    if(value == 2){     // to follow this event
        var now = new Date();
        var month = now.getMonth() + 1;
        var time_stamp = now.getFullYear() + '-' + month + '-' + now.getDate() + ' ' + now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
        var url = 'load_activity.php?type=' + 1 +'&user_id=' + user_id + '&activity_id=' + activity_id + '&follow_time=' + time_stamp;        
        $.getJSON(url, function(data){
            $("#follow_status").html("Unfollow");
            $("#follow_status").attr("key","1");    // to unfollow this event
            var remain = data['max_followers'] - data['followers'];            
            $("#remaining").html(' <h5> Remaining :' + remain + '&nbsp;/&nbsp;' + data['max_followers'] + '</h5>' );
        });
    }
    else if(value == 1){ // to unfollow this event
        var url = 'load_activity.php?type=' + 2 +'&user_id=' + user_id + '&activity_id=' + activity_id;        
        $.getJSON(url, function(data){
            $("#follow_status").html("Follow!!");
            $("#follow_status").attr("key","2");    // to follow this event
            var remain = data['max_followers'] - data['followers'];            
            $("#remaining").html(' <h5> Remaining :' + remain + '&nbsp;/&nbsp;' + data['max_followers'] + '</h5>' );
        });    
    }
    else if(value == 0){ //jump to personal page to manage this event
        window.location.replace("http://www.google.com");       
    }
});

$(".reply").click(function(){
    var sp = $(this).text();
    $(this).attr("class", "active");
    var tableId;
    if(sp == "«"){
        tableId = "#0";
    }
    else if(sp == "»"){
        var lastImage = $('#image_number').val() - 1;
        tableId = "#".concat(lastImage);
    }
    else{
        tableId = "#".concat(sp - 1 + "");              
    }
    var image = $(tableId).val();
    var src = "data:image;base64,".concat(image);
    $('#image_area').attr("src", src);
});




$(function(){
    var user_id = $('#user_id').val();
    var activity_id = $('#activity_id').val();
    var url = 'load_activity.php?type=' + 0 +'&user_id=' + user_id + '&activity_id=' + activity_id;
    $.getJSON(url, function(data){
        $("#activity_name").html(data['title']);
       // console.log(data['image']);         //for image
        $("#location").html(data['location']); 
        $("#time_stamp").html(data['start_time']);
        $("#description").html(data['description']);
        if(data.count === undefined){
            $("#follow_status").html("Managing This Activity");
            $("#follow_status").attr("key","0");        // to manage this event   
        }
        else{
            var remain = data['max_followers'] - data['followers'];            

            $("#remaining").html(' <h5> Remaining :' + remain + '&nbsp;/&nbsp;' + data['max_followers'] + '</h5>' );

            if(data.count == 1){
                $("#follow_status").html("Unfollow");
                $("#follow_status").attr("key","1");    // to unfollow this event
            }
            else{
                if(data.followers >= data.max_followers){
                    $("#follow_status").html("This Activity is Full, Please Check later");  //or directly contact with event poster
                }
                else{
                    $("#follow_status").html("Follow!!");
                    $("#follow_status").attr("key","2"); // to follow this event
                }
            }
        }

    }); 
});





