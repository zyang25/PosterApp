$("#follow_status").click(function(){
    var user_id = $('#user_id').val();
    var activity_id = $('#activity_id').val();  
    var value = $("#follow_status").attr("key");
    if(value == 2){     // to follow this event
        var now = new Date();
        var month = now.getMonth() + 1;
        var time_stamp = now.getFullYear() + '-' + month + '-' + now.getDate() + ' ' + now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
        var url = '../main/load_activity.php?type=' + 1 +'&user_id=' + user_id + '&activity_id=' + activity_id + '&follow_time=' + time_stamp;        
        $.getJSON(url, function(data){
            $("#follow_status").html("Unfollow");
            $("#follow_status").attr("key","1");    // to unfollow this event
            if(isNumeric(data['max_followers']) && isNumeric(data['followers'])){
                var remain = data['max_followers'] - data['followers'];            
                $("#remaining").html(' <h5> Remaining :' + remain + '&nbsp;/&nbsp;' + data['max_followers'] + '</h5>' );
            }
            else $("#remaining").html('<h5>Please contact the admin this event!!!</h5>');
        });
    }
    else if(value == 1){ // to unfollow this event
        var url = '../main/load_activity.php?type=' + 2 +'&user_id=' + user_id + '&activity_id=' + activity_id;        
        $.getJSON(url, function(data){
            $("#follow_status").html("Follow!!");
            $("#follow_status").attr("key","2");    // to follow this event
            if(isNumeric(data['max_followers']) && isNumeric(data['followers'])){
                 var remain = data['max_followers'] - data['followers'];            
                 $("#remaining").html(' <h5> Remaining :' + remain + '&nbsp;/&nbsp;' + data['max_followers'] + '</h5>' );
            }
            else $("#remaining").html('<h5>Please contact the admin this event!!!</h5>');
        });    
    }
    else if(value == 0){ //jump to personal page to manage this event   modify!!!!!!!!!!!!!!!!!
        window.location.replace("editActivity.php");       
    }
});

$(".reply").click(function(){
    var sp = $(this).text();
    $(this).attr("class", "active");
    var tableId;
    var index;
    if(sp == "«"){
        tableId = "#0";
        index = 0;
    }
    else if(sp == "»"){
        var lastImage = $('#image_number').val() - 1;
        tableId = "#".concat(lastImage);
        index = lastImage;
    }
    else{
        tableId = "#".concat(sp - 1 + "");   
        index = sp - 1;           
    }
    var src;
    var image = $(tableId).val();
    if(index == 0){
        src = image;
    }
    else{
        src = "data:image;base64,".concat(image);
    }
    $('#image_area').attr("src", src);
});

$(function(){
    var user_id = $('#user_id').val();
    var activity_id = $('#activity_id').val();
    var url = '../main/load_activity.php?type=' + 0 +'&user_id=' + user_id + '&activity_id=' + activity_id;
    $.getJSON(url, function(data){
        $("#activity_name").html(strip(data['title']));
        $("#location").html(strip(data['location'])); 
        $("#time_stamp").html(strip(data['start_time']));
        $("#description").html(strip(data['description']));

        var start_t = data['start_time'];
        var now = new Date();
        var month = now.getMonth() + 1;
        var time_stamp = now.getFullYear() + '-' + month + '-' + now.getDate() + ' ' + now.getHours()+':'+now.getMinutes()+':'+now.getSeconds();
        // console.log(start_t);
        // console.log(time_stamp);
        start_t = Date.parse(start_t);
        time_stamp = Date.parse(time_stamp);

        if(start_t < time_stamp){
            $("#follow_status").html("This event is Expired!!!");
        }
        else{
            if(data.count === undefined){
                $("#follow_status").html("Managing This Activity");
                $("#follow_status").attr("key","0");        // to manage this event   
            }
            else{
                if(isNumeric(data['max_followers']) && isNumeric(data['followers'])){
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
                else $("#remaining").html('<h5>Please contact the admin this event!!!</h5>');
            }
        }
    }); 
});


function strip(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent || tmp.innerText || "";
}

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}




